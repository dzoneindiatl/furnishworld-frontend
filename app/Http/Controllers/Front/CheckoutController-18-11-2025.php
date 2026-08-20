<?php

namespace App\Http\Controllers\Front;

use Exception;
use Session, Auth;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use Razorpay\Api\Api;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;

use App\Models\Currency;
use App\Models\OrderItem;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use App\Helpers\EmailHelper;
use App\Models\OrderItemTax;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\WalletHistory;
use App\Models\InvoiceSetting;
use App\Mail\orderSuccessEmail;
use Barryvdh\DomPDF\Facade\Pdf;
use FontLib\TrueType\Collection;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductVariantCombination;
use App\Models\ProductVariantCombinationImage;
use App\Models\{OrderNotifications, OrderAddress, CouponUse};

class CheckoutController extends Controller
{

    public function getUserAddress(Request $request, $addressId)
    {

        $address = UserAddress::where('id', $addressId)->first();


        if (!$address) {
            return response()->json(['error' => 'Address not found.'], 404);
        }

        $name = $address->name;
        $parts = explode(' ', $name, 2);
        $firstname = $parts[0];
        $lastname = isset($parts[1]) ? $parts[1] : '';

        return response()->json([
            'country' => $address->country_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address->address,
            'addressSecond' => $address->landmark,
            'state' => $address->state_id,
            'city' => $address->city_id,
            'city_name' => $address->city->name ?? '', // if you're storing city name
            'pinCode' => $address->postal_code,
            'phone' => $address->phone_number,
            //'address_place_type' => ($address->address_type ==1 ? 'Home' : ($address->address_type ==2? 'Office': 'Others') ),
            'address_place_type' => $address->address_type,
            'address_id' => $addressId,
        ]);

        //echo "<pre>@@".$addressId; print_r($userAddresses); exit;
    }

    public function saveAddress(Request $request)
    {
        $postData = $request->all();


        $user = Auth::guard('customer')->user();

        $address = new UserAddress();
        $address->type = $postData['address_type'];
        $address->user_id = $user->id;
        $address->name = $postData['firstname'] . ' ' . $postData['lastname'];
        $address->email = $user->email;
        $address->phone_number = $postData['phone'];
        $address->alternate_number = $postData['phone'];
        $address->country_id = $postData['country'];
        $address->state_id = $postData['state'];
        $address->city_id = $postData['city'];
        $address->postal_code = $postData['pinCode'];
        $address->landmark = $postData['addressSecond'];
        $address->address = $postData['address'];
        $address->address_type = $postData['address_place_type'];
        $address->save();


        return response()->json([
            'success' => true,
            'message' => 'Your address has been successfully saved.',
            'redirect_url' => url('/checkout')
        ]);
    }

    public function updateAddress(Request $request)
    {
        $postData = $request->all();
        $address = UserAddress::where('id', $postData['addressId'])->firstOrFail();
        $address->name = $postData['firstname'] . ' ' . $postData['lastname'];
        $address->phone_number = $postData['phone'];
        $address->alternate_number = $postData['phone'];
        $address->country_id = $postData['country'];
        $address->state_id = $postData['state'];
        $address->city_id = $postData['city'];
        $address->postal_code = $postData['pinCode'];
        $address->landmark = $postData['addressSecond'] ?? null;
        $address->address = $postData['address'];
        $address->address_type = $postData['address_place_type'];
        $address->save();

        return response()->json(['success' => true, 'message' => 'Address updated successfully.']);
    }



    public function placeOrder(Request $request)
    {

        $resp = [];

        if ($request->payment_mode == 'cod') {
            $order_id = $this->createOrder(
                'cod',
                $request->sub_total,
                'unpaid',
                $request->coupon_id,
                $request->coupon_discount,
                0,
                $request->shippingcharge,
                $request->billing_id,
                $request->shipping_id,
                $request->cartItems
            );
            $resp['success'] = true;
            $resp['message'] = "Success";
            $resp['url'] = route('front-order.success', ['order_id' => encrypt($order_id)]);
            return response()->json($resp);
        } elseif ($request->payment_mode == 'razorpay') {
            $cartNotes = $request->cartItems;
            session()->put('cart_items', $cartNotes);
            $post_fields = [
                "amount" => $request->sub_total * 100,
                "currency" => "INR",
                "receipt" => "Receipt",
                "partial_payment" => false,
                "first_payment_min_amount" => 200,
                "notes" => [
                    "coupon_id"         => $request->coupon_id,
                    "coupon_discount"   => $request->coupon_discount,
                    "shippingcharge"    => $request->shippingcharge,
                    "billing_id"        => $request->billing_id,
                    "shipping_id"       => $request->shipping_id,
                    "wallet_amount"   => $request->wallet_amount,
                ]
            ];

            $order_url = env('RAZORPAY_DEFAULT_URL') . "orders";
            $order = $this->callApi($order_url, $post_fields, 'razorpay');
            if (isset($order['error'])) {
                $resp['success'] = false;
                $resp['data'] = [];
                $resp['product_order_id'] = false;
                $resp['message'] = $order['error']['description'];
            } else {
                $resp['success'] = true;
                $resp['data'] = $order;
                $resp['product_order_id'] = false;
                $resp['message'] = "Success";
            }

            return response()->json($resp);
        } elseif ($request->payment_mode == 'wallet') {

            $order_number = $this->random_strings(8);

            $order_id = $this->createOrder($request->payment_mode, $request->wallet_amount, 'received', $request->coupon_id, $request->coupon_discount, $request->wallet_amount, $request->shippingcharge, $request->billing_id, $request->shipping_id, $request->cartItems);
            Order::find($order_id)->update([
                'payment_status'      => 'paid',
            ]);
            $resp['success'] = true;
            $resp['url'] = route('front-order.success', ['order_id' => encrypt($order_id)]);
            $resp['message'] = "Success";
            return response()->json($resp);
        }
    }

    public function checkout_callback(Request $request)
    {
        $razorpayOrderId = $request->razorpay_order_id;

        // Call Razorpay to get all payments for this order
        $paymentsResponse = $this->callApi(
            "https://api.razorpay.com/v1/orders/{$razorpayOrderId}/payments",
            [],
            'razorpay'
        );

        Log::info('Payment Response');
        Log::info($paymentsResponse);
        
        $latestPayment = $paymentsResponse['items'][0];
        if ($latestPayment['status'] === 'authorized' && !$latestPayment['captured']) {
            $paymentsResponse = $this->callApi(
                "https://api.razorpay.com/v1/payments/{$latestPayment['id']}/capture",
                [
                    'amount' => $latestPayment['amount'],
                    'currency' => $latestPayment['currency']
                ],
                'razorpay',
                'POST'
            );
        }

        if (!empty($paymentsResponse['items'])) {
            // Filter only successful payments
            $successfulPayments = array_filter($paymentsResponse['items'], function ($payment) {
                return $payment['status'] === 'captured' && $payment['captured'] === true;
            });
            // Get the latest successful payment
            $latestPayment = null;
            if (!empty($successfulPayments)) {
                usort($successfulPayments, function ($a, $b) {
                    return $b['created_at'] <=> $a['created_at'];
                });
                $latestPayment = $successfulPayments[0];
            }

            if ($latestPayment) {
                $wAmount = $latestPayment['notes']['wallet_amount'] ?? 0;
                $payAmount = $latestPayment['amount'] / 100;
                $totalAmt = $payAmount + $wAmount;
                // Create the order in Laravel
                $order_id = $this->createOrder(
                    'razorpay',
                    $totalAmt,
                    'paid',
                    $latestPayment['notes']['coupon_id'] ?? null,
                    $latestPayment['notes']['coupon_discount'] ?? 0,
                    $wAmount,
                    $latestPayment['notes']['shippingcharge'] ?? 0,
                    $latestPayment['notes']['billing_id'] ?? null,
                    $latestPayment['notes']['shipping_id'] ?? null,
                    session()->get('cart_items')
                );


                // Save payment ID
                Order::find($order_id)->update([
                    'razorpay_payment_id' => $latestPayment['id'],
                    'payment_status'      => 'paid',
                ]);

                session()->forget('cart_items');

                return redirect()->route('front-order.success', ['order_id' => encrypt($order_id)]);
            }
        }

        return redirect()->back();
    }


    public function createOrder($payment_method, $amount, $order_status, $coupon_id, $coupon_discount, $wallet_amount = 0, $shippingcharge, $billingId, $shippingId, $checkout_data)
    {

        //     DB::beginTransaction();
        //   try {

        $debitFromWallet = 0;
        $user_id =  Auth::guard('customer')->user()->id;
        $customerName = Auth::guard('customer')->user()->name ?? 'Customer';
        $customerEmail = Auth::guard('customer')->user()->email ?? 'Customer';

        $shipping_id = $billing_id = null;
        $shippingItems = [];
        $total_discount = 0;

        if (isset($billingId)) {
            $billing_id = $billingId;

            $billAddress = UserAddress::getShippingAddress('billing', $billing_id);
        }
        if (isset($shippingId)) {
            $shipping_id = $shippingId;
            $shipAddress = UserAddress::getShippingAddress('shipping', $shipping_id);
        }

        $taxPrice = 0;
        foreach ($checkout_data as $item) {
            $taxPrice += $item['tax_price'];
        }

        $order = new Order;

        $discount = 0;

        $coupon = Coupon::find($coupon_id);
        $couponCategoryId = 0;
        $couponSubCategoryIds = null;

        if (!empty($coupon)) {
            $couponCategoryId = $coupon->category_id ?? 0; // 0 for all
            $couponSubCategoryIds = !empty($coupon->sub_categories) ? array_filter(json_decode($coupon->sub_categories, true)) : null;
            $order->coupon_name = $coupon->coupon_code;
            $order->coupon_discount = round($coupon_discount, 2);
            $discount  = round($coupon_discount, 2);
        }

        // $order->order_number = $this->random_strings(8);
        $order->order_number = generateOrderNumber();
        $ordernumber = $order->order_number;
        $order->user_id = $user_id;
        $order->billing_address = json_encode($billAddress);
        $order->shipping_address = json_encode($shipAddress);
        $order->shippingcharge = floor($shippingcharge);
        //$order->sub_total = floor($amount + $discount - ($taxPrice + $coupon_discount)); 
        $order->sub_total = floor($amount + $discount);

        $order->total = floor($amount);
        $order->payment_method = $payment_method;
        $order->payment_status = $order_status;
        $order->save();

        $order_id = $order->id;
        if (!empty($coupon)) {
            CouponUse::create([
                'user_id' => $user_id,
                'coupon_id' => $coupon_id,
                'order_id' => $order->id,
            ]);
            if ($coupon->available_coupons) {
                $coupon->decrement('available_coupons');
                $coupon->save();
            }
        }

        $productIds = collect($checkout_data ?? [])->pluck('productId')?->toArray();
        $productQty = collect($checkout_data ?? [])->pluck('quantity', 'productId')?->toArray();

        if (!empty($productIds)) {
            $allProducts = Product::query()
                ->whereIn('id', $productIds)
                ->select('id', 'main_category_id', 'main_sub_category_id')->get()
                ->map(function ($product) {
                    return $product->only(['id', 'main_category_id', 'main_sub_category_id']);
                })->keyBy('id')->toArray();
        } else {
            $allProducts = [];
        }


        // check eligibile items quantity for coupon/discount
        $couponAppliedQty = 0;
        foreach ($checkout_data as $item) {
            $applyDiscount = false;
            $productCategoryId = $allProducts[$item['productId']]['main_category_id'] ?? 0;
            $productSubCategoryId = $allProducts[$item['productId']]['main_sub_category_id'] ?? 0;
            if ($couponCategoryId == 0) {
                $applyDiscount = true;
            } elseif ($productCategoryId == $couponCategoryId) {
                if (empty($couponSubCategoryIds)) {
                    $applyDiscount = true;
                } elseif (in_array($productSubCategoryId, $couponSubCategoryIds)) {
                    $applyDiscount = true;
                }
            }
            if ($applyDiscount) {
                $couponAppliedQty += $productQty[$item['productId']] ?? 0;
            }
        }

        foreach ($checkout_data as $item) {

            $applyDiscount = false;
            $productCategoryId = $allProducts[$item['productId']]['main_category_id'] ?? 0;
            $productSubCategoryId = $allProducts[$item['productId']]['main_sub_category_id'] ?? 0;
            if ($couponCategoryId == 0) {
                $applyDiscount = true;
            } elseif ($productCategoryId == $couponCategoryId) {
                if (empty($couponSubCategoryIds)) {
                    $applyDiscount = true;
                } elseif (in_array($productSubCategoryId, $couponSubCategoryIds)) {
                    $applyDiscount = true;
                }
            }
            $discountAmt = ($applyDiscount && $couponAppliedQty) ? round($coupon_discount / $couponAppliedQty, 2) : 0;
            $total_discount = $discountAmt * $item['quantity'];

            $order_items = new OrderItem;
            $order_items->order_id = $order_id;
            $order_items->product_id = $item['productId'];
            $order_items->qty = $item['quantity'];
            $order_items->mrp = $item['price'];
            $order_items->selling_price = $item['sellingPrice'];
            $order_items->discount_amount = $total_discount;
            $order_items->tax_amount = $item['tax_price'];
            $order_items->sub_total = (($item['quantity'] * $item['sellingPrice']) - ($item['tax_price'] +  $total_discount));
            $order_items->total = (($item['quantity'] * $item['sellingPrice']) - $total_discount);
            $order_items->combination =  json_encode($item['selectedVariants']);
            $order_items->order_status_id = 1; // Pending
            $order_items->save();

            $order_items_tax = new OrderItemTax;
            // $order_items_tax->order_item_id = $order_id;
            $order_items_tax->order_item_id = $order_items->id;
            $order_items_tax->category_tax_id = $item['tax_id'];
            $order_items_tax->tax_val = $item['tax_rate'];
            $order_items_tax->tax_price = $item['tax_price'];
            $order_items_tax->save();

            $orderStatusHistory = new OrderStatusHistory();
            $orderStatusHistory->user_id = $user_id;
            $orderStatusHistory->order_id = $order_id;
            $orderStatusHistory->order_status_id = 2;
            $orderStatusHistory->order_item_id = $order_items->id;
            $orderStatusHistory->order_status = 'pending';
            $orderStatusHistory->save();

            $orderitemvari = json_decode($order_items->combination, true);
            $valueIds = [];

            foreach ($orderitemvari as $variantName => $variantValue) {

                $valueId = DB::table('variant_values')
                    ->where('name', $variantValue)
                    ->value('id');
                $valueIds[] = $valueId;
            }
            $combinations = json_encode($valueIds);

            $productids = $order_items->product_id;
            $productcomb = ProductVariantCombination::where('combination_id', $combinations)->where('product_id', $productids)->first();
            if ($productcomb) {
                $productcomb->qty = $productcomb->qty - $order_items->qty;
                $productcomb->save();
                $order_items->product_variant_combination_id = $productcomb->id; // Pending
                $order_items->save();
            }
            $product = Product::where('id', $productids)->first();
            $product->qty = $product->qty - $order_items->qty;
            $product->save();
        }

        if ($wallet_amount > 0) {
            $walletHistory = new WalletHistory();
            $walletHistory->user_id = $user_id;
            $walletHistory->amount = $wallet_amount;
            $walletHistory->type = 'debit';
            $walletHistory->transaction_id = $ordernumber;
            $walletHistory->save();

            $userwallet = User::where('id', $user_id)->first();
            $userwallet->wallet_avl_balance = $userwallet->wallet_avl_balance - $wallet_amount;
            $userwallet->save();
        }

        // Notification bell
        $orderNotifications = new OrderNotifications();
        $orderNotifications->user_id = '1';
        $orderNotifications->order_id = $order_id;
        $orderNotifications->title = 'New Order Created';
        $orderNotifications->message = 'A new order has been placed with Order ID: ' . $order_id;
        $orderNotifications->save();

        Cart::where('user_id', $user_id)->delete();

        //Generating Invoice
        $invoicePath = $this->generateInvoiceAmit($checkout_data, $order_id);

        Order::where('id', $order_id)->update(['invoice_path' => $invoicePath]);

        $orderDetails = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Total Price</th>
                                <th>Combination</th>
                            </tr>';

        foreach ($checkout_data as $item) {
            $applyDiscount = false;
            $productCategoryId = $allProducts[$item['productId']]['main_category_id'] ?? 0;
            $productSubCategoryId = $allProducts[$item['productId']]['main_sub_category_id'] ?? 0;
            if ($couponCategoryId == 0) {
                $applyDiscount = true;
            } elseif ($productCategoryId == $couponCategoryId) {
                if (empty($couponSubCategoryIds)) {
                    $applyDiscount = true;
                } elseif (in_array($productSubCategoryId, $couponSubCategoryIds)) {
                    $applyDiscount = true;
                }
            }
            $discountAmt = ($applyDiscount && $couponAppliedQty) ? round($coupon_discount / $couponAppliedQty, 2) : 0;
            $total_discount = $discountAmt * $item['quantity'];
            $variants = [];
            foreach ($item['selectedVariants'] as $key => $val) {
                $variants[] = ucfirst($key) . ': ' . $val;
            }
            $orderDetails .= '<tr>
                                <td><img src="' . $item['image'] . '" width="90" alt="' . $item['name'] . '"></td>
                                <td>' . $item['name'] . '</td>
                                <td>' . $item['quantity'] . '</td>
                                <td>' . (($item['quantity'] * $item['sellingPrice']) - $total_discount) . '</td>
                               <td>' . implode(', ', $variants) . '</td>
                            </tr>';
        }

        $orderDetails .= '</table>';


        // 3. Placeholder Data
        $data = [
            'CUSTOMER_NAME' => $customerName,
            'ORDER_ID'      => $ordernumber,
            'ORDER_DETAILS' => $orderDetails,
        ];

        // 4. Get Processed Template
        $template = EmailHelper::getProcessedTemplate('order-success', $data);

        // 5. Send Email
        Mail::to($customerEmail)
            ->send(new orderSuccessEmail($template['subject'], $template['body']));

        return $order_id;
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json(['error' => $e->getMessage()], 500); // Return error response
        // }
    }

    public function generateInvoiceAmit($checkout_data, $order_id)
    {

        return '';
        $productIds = array_column($checkout_data, 'productId');
        $skus = Product::whereIn('id', $productIds)->pluck('sku', 'id'); // returns [id => sku]
        $hsns = Product::whereIn('id', $productIds)->pluck('hsn', 'id'); // returns [id => sku]
        foreach ($checkout_data as &$item) {
            $productId = $item['productId'];
            $item['sku'] = $skus[$productId] ?? null; // null if productId not found
            $item['hsn'] = $hsns[$productId] ?? null; // null if productId not found
        }
        $order = Order::where('orders.id', $order_id)->leftJoin('users', 'users.id', 'orders.user_id')->select('orders.*', 'users.name as user_name', 'users.email as user_email')->first();
        $GSTIN = config('Site.GSTIN');
        $currency = Currency::where('currency_code', $order->currency_code)->value('symbol');
        $supplySetting = InvoiceSetting::with(['country', 'state', 'city'])
            ->where('is_active', 1)
            ->first();

        $randonNum = rand(1000, 9999);
        $pdf = PDF::loadView('invoices.order_invoice_amit', ['checkout_data' => $checkout_data, 'order' => $order, 'currency' => $currency, 'GSTIN' => $GSTIN, 'supplySetting' => $supplySetting]);
        $path = Config('constant.ORDER_INVOICE_ROOT_PATH') . $order_id . $randonNum . "_invoice.pdf";
        $invoiceDirectory = Config('constant.ORDER_INVOICE_ROOT_PATH');
        if (!file_exists($invoiceDirectory)) {
            mkdir($invoiceDirectory, 0755, true);
        }
        $pdf->save($path);
        return $path;
    }




    public function getShippingData(Request $request)
    {
        $addressId = $request->shippingId;
        $totalAmountcart = $request->totalAmount;

        $address = UserAddress::getShippingAddress('shipping', $addressId);
        $pincode = $address['shipping_pincode'];

        $productIds = array_column($request->productData, 'productId');
        $product = Product::whereIn('id', $productIds)->select('weight', 'weight_type')->get();
        $totalWeight = 0;
        foreach ($product as $products) {
            $weight = $products->weight;
            if ($products->weight_type == 'kg') {
                $weight = $products->weight * 1000;
            }
            $totalWeight += $weight;
        }
        $productweight = $totalWeight ?? 250;
        $shippingPrice =  getShippingCharge($pincode, $productweight, $totalAmountcart);
        return response()->json([
            'success' => true,
            'message' => 'Shipping Price fetched successfully.',
            'shippingPrice' => $shippingPrice,
            'data' => [
                $pincode,
                $productweight,
                $totalAmountcart
            ]
        ]);
    }
}
