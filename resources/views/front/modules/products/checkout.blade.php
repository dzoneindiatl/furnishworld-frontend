@extends('front.layouts.app')
@section('content')

    @php
        $minSellingQty = 1;
        $maxSellingQty = 10;
        if (!empty($cartItems[0]['product'])) {
            $getMinMaxOrderQty = getMinMaxOrderQty($cartItems[0]['product']->id);
            if (!empty($getMinMaxOrderQty)) {
                $minSellingQty = $getMinMaxOrderQty['minSellQty'];
                $maxSellingQty = $getMinMaxOrderQty['maxSellQty'];
            }
        }
    @endphp
    <script>
        var minSellingQty = '<?php echo $minSellingQty; ?>';
        var maxSellingQty = '<?php echo $maxSellingQty; ?>';
        var getVarientReaminingQty = "{{ route('get-variant-remaining-qty') }}";
    </script>

    @php
        use App\Models\InvoiceSetting;

        $codMaxLimit = 12000;
        $invoiceSetting = InvoiceSetting::where('prefix', 'site')->first();
        if (!empty($invoiceSetting)) {
            $codMaxLimit = $invoiceSetting->cash_on_limit;
        }
    @endphp
    <script>
        var codMaxLimit = '<?php echo $codMaxLimit; ?>';
        window.dbCartItems = @json($cart ?? []); 
    </script>

    <!-- Banner -->
    <!-- Checkout section -->
    <section class="site-content checkout-site-content">
        <div class="page-banner-section">
            <div class="page-banner">
                <div class="container">
                    <div class="page-banner-wrap">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb-items">
                                <li class="breadcrumb-item trail-begin"><a href="{{ url('/') }}" rel="home"><span
                                            itemprop="name">Home</span></a></li>
                                <li class="breadcrumb-item trail-end"><span itemprop="name">Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="container">
                <div class="page-header text-center">
                    <h1 class="page-title">Checkout</h1>
                </div>
                <div class="content-area">
                    <div class="checkout-inner">

                        <div class="checkout-inner-left">
                            {{-- <div class="checkout-login">
                  <p class="f-16 font-medium mb-3">If you dont login? <a class="btn-url" href="{{ route('front-user.login') }}">Log in</a></p>
                </div>     --}}
                            <div class="shipping-section">
                                <!-- Billing - section -->
                                <div class="shipping-address">
                                    <h5 class="shipping-add-title">Billing Address</h5>
                                    <div class="shipping-address-items">
                                        @if ($userBillingAddress->count() > 0)
                                            @foreach ($userBillingAddress as $billingAddress)
                                                <div
                                                    class="shipping-address-item {{ $billingAddress->is_default == 1 ? 'selected-item' : 'not-selected-item' }}">
                                                    <input class="shipping-address-input select_billing_address"
                                                        id="add{{ $billingAddress->id }}" type="radio"
                                                        value="{{ $billingAddress->id }}" name="billaddress"
                                                        {{ $billingAddress->is_primary == 1 ? 'checked' : '' }}>
                                                    <label class="shipping-address-label"
                                                        for="add{{ $billingAddress->id }}">
                                                        <p>{{ $billingAddress->name }} <span
                                                                class="ml-3">{{ $billingAddress->phone_number }}</span>
                                                            <span class="edit-address-btn"
                                                                data-id="{{ $billingAddress->id }}"
                                                                style="float: right;color: #1e5a3b;font-weight: 600;">Edit</span>
                                                        </p>
                                                        <p>{{ $billingAddress->address }},
                                                            {{ $billingAddress->landmark }},
                                                            {{ $billingAddress->city?->name }},
                                                            {{ $billingAddress->state?->name }},{{ $billingAddress->country?->name }}
                                                            - <span>{{ $billingAddress->postal_code }}</span></p>
                                                        <?php if ($billingAddress->is_primary == 1) {
                                                            echo '<span style="float: left;color: #c2a188;">Primary</span>';
                                                        } ?>
                                                        <span id="removeAddressBtn" class="remove-address-btn"
                                                            data-adddressId="{{ $billingAddress->id }}"
                                                            style="float: right;font-size: 14px;color: #1a623e;font-weight: 500;">Remove</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No billing address found. Please add a billing address.</p>
                                        @endif
                                    </div>

                                    <div class="shipping-add-new">
                                        <button id="add-new-address" class="btn-add-new">+ Add New Address</button>
                                    </div>
                                    <div id="new-address" class="shipping-address-inner">
                                        <p class="add-new-update-txt">Add/Update Address</p>
                                        <span class="error-msg text-danger"></span>
                                        <form method="post" id="editAddressForm">
                                            <input type="hidden" name="addressId" id="addressId" value="">
                                            <div class="new-add-row">
                                                <div class="form-group half-right col-sm-6 col-12">
                                                    <label>Country/Region <span class="required">*</span></label>
                                                    <select class="form-select selectcommon requiredField" name="country"
                                                        id="country" aria-label="Default select example" required>
                                                        <option>Country/Region</option>
                                                        <option value="101" selected="">India</option>
                                                    </select>
                                                </div>
                                                <div class="form-group half-left col-sm-6 col-12">
                                                    <label>First Name <span class="required">*</span></label>
                                                    <input type="text" class="form-control requiredField"
                                                        name="firstname" placeholder="First name" />
                                                </div>
                                                <div class="form-group half-right col-sm-6 col-12">
                                                    <label>Last Name <span class="required">*</span></label>
                                                    <input type="text" class="form-control requiredField" name="lastname"
                                                        placeholder="Last name" />
                                                </div>
                                                <div class="form-group half-left col-sm-6 col-12">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input type="text" name="address" class="form-control requiredField"
                                                        placeholder="Address" required />
                                                </div>
                                                <div class="form-group half-right col-sm-6 col-12">
                                                    <label>landmark</label>
                                                    <input type="text" name="landmark" class="form-control"
                                                        placeholder="Apartment, suite, etc. (optional)" />
                                                </div>
                                                <div class="form-group half-left col-sm-6 col-12">
                                                    <label>State <span class="required">*</span></label>
                                                    <select class="form-select selectcommon editState requiredField"
                                                        id="state" name="state" required>
                                                        <option value="">State</option>
                                                        @if (isset($states))
                                                            @foreach ($states as $key => $state)
                                                                <option value="{{ $key }}">{{ $state }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group half-right col-sm-6 col-12">
                                                    <label>City <span class="required">*</span></label>
                                                    <select class="form-select selectcommon editCity requiredField"
                                                        name="city" required>
                                                        <option value="">City</option>
                                                    </select>
                                                </div>
                                                <div class="form-group half-left col-sm-6 col-12">
                                                    <label>Postal Code <span class="required">*</span></label>
                                                    <input type="text" name="pinCode" class="form-control"
                                                        placeholder="PIN code" required />
                                                </div>
                                                <div class="form-group col-sm-12 col-12">
                                                    <label>Contact Number <span class="required">*</span></label>
                                                    <input type="text" name="phone"
                                                        class="form-control requiredField" placeholder="Phone"
                                                        value="{{ Auth::guard('customer')->user()->phone_number }}"
                                                        required />
                                                </div>
                                                <div class="form-group half-right col-sm-6 col-12">
                                                    <label>Type <span class="required">*</span></label>
                                                    <select class="form-select requiredField" name="type" required>
                                                        <option value="">Select Type</option>
                                                        <option value="shipping">Shipping</option>
                                                        <option value="billing">Billing</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-12 col-12">
                                                    <label> Address Type <span class="required">*</span></label>
                                                    <div class="form-check-list">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="home" value="1"
                                                                checked>
                                                            <label class="form-check-label" for="home">
                                                                <div class="sp-content">
                                                                    <h6>Home</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="office" value="2">
                                                            <label class="form-check-label" for="office">
                                                                <div class="sp-content">
                                                                    <h6>Office</h6>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="address_place_type" id="Others" value="3">
                                                            <label class="form-check-label" for="Others">
                                                                <div class="sp-content">
                                                                    <h6>Others</h6>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-button">
                                                <button type="button" class="btn btn-primary"
                                                    id="updateAddressBtn">Save</button>
                                                <button type="button" class="cancel btn btn-secondary">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Billing - section -->
                                <!-- same as billing checkbox -->
                                <div class="form-group mb-3 col-sm-12 col-12 has-value">
                                    <input class="form-check-input" type="checkbox" value="0" id="same_as_billing"
                                        name="same_as_billing" checked onclick="toggleShippingAddressForm()">
                                    <label class="form-check-label" for="same_as_billing">
                                        Same as billing address
                                    </label>
                                </div>
                                <!-- same as billing checkbox -->

                                <!-- shipping-section -->
                                <div class="shipping-address">
                                    <h5 class="shipping-add-title">Shipping Address</h5>
                                    <div class="shipping-address-items">
                                        @if ($usershippingAddress->count() > 0)
                                            @foreach ($usershippingAddress as $shippingAddress)
                                                <div
                                                    class="shipping-address-item {{ $shippingAddress->is_default == 1 ? 'selected-item' : 'not-selected-item' }}">
                                                    <input class="shipping-address-input select_shipping_address"
                                                        id="add{{ $shippingAddress->id }}" type="radio"
                                                        value="{{ $shippingAddress->id }}" name="shipaddress"
                                                        {{ $shippingAddress->is_primary == 1 ? 'checked' : '' }}>
                                                    <label class="shipping-address-label"
                                                        for="add{{ $shippingAddress->id }}">
                                                        <p>{{ $shippingAddress->name }} <span
                                                                class="ml-3">{{ $shippingAddress->phone_number }}</span>
                                                            <span class="edit-address-btn"
                                                                data-id="{{ $shippingAddress->id }}"
                                                                style="float: right;color: #1e5a3b;font-weight: 600;">Edit</span>
                                                        </p>
                                                        <p>{{ $shippingAddress->address }},
                                                            {{ $shippingAddress->landmark }},
                                                            {{ $shippingAddress->city?->name }},
                                                            {{ $shippingAddress->state?->name }},{{ $shippingAddress->country?->name }}
                                                            - <span>{{ $shippingAddress->postal_code }}</span></p>
                                                        <?php if ($shippingAddress->is_primary == 1) {
                                                            echo '<span style="float: left;color: #c2a188;">Primary</span>';
                                                        } ?>
                                                        <span id="removeAddressBtn" class="remove-address-btn"
                                                            data-adddressId="{{ $shippingAddress->id }}"
                                                            style="float: right;font-size: 14px;color: #1a623e;font-weight: 500;">Remove</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No shipping address found. Please add a shipping address.</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- shipping-section -->

                            </div>
                            <!-- shipping-section -->

                            <div class="checkout-payment-section">
                                <h5 class="shipping-add-title">Payment</h5>
                                <p class="shi-txt-bt">All transactions are secure and encrypted.</p>
                                <form action="">
                                    <div class="checkout-payment-items">
                                        <div class="checkout-payment-item">
                                            <input class="checkout-payment-input" id="payment1" type="checkbox"
                                                name="wallet_online" value="wallet"
                                                @if (empty($userRecord->wallet_avl_balance) && is_null($userRecord->wallet_avl_balance)) disabled @endif
                                                onclick="togglewalletCod()">
                                            <label class="checkout-payment-label" for="payment1">
                                                <p class="checkout-payment-title"><img src="images/icon-wallet.png"
                                                        alt=""> Wallet</p>
                                                <div class="checkout-payment-box">
                                                    <p>Pay with your wallet</p>
                                                    <p>Balance : ₹ {{ $userRecord->wallet_avl_balance }}</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="checkout-payment-item">
                                            <input class="checkout-payment-input" id="payment2" type="radio"
                                                name="pay_online" value="razorpay">
                                            <label class="checkout-payment-label" for="payment2">
                                                <p class="checkout-payment-title"><img src="images/icon-upi.png"
                                                        alt=""> Razorpay</p>
                                                <div class="checkout-payment-box">
                                                    <p>Pay by Razorpay online</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="checkout-payment-item">
                                            <input class="checkout-payment-input" id="payment3" type="radio"
                                                name="pay_online" value="cod" />
                                            <label class="checkout-payment-label" for="payment3">
                                                <p class="checkout-payment-title"><img src="images/icon-cod.png"
                                                        alt="">COD</p>
                                                <div class="checkout-payment-box">
                                                    <p>Pay with Cash on delivery.</p>
                                                </div>
                                            </label>
                                        </div>
                                        <!-- <div class="checkout-payment-item">
                                                                                                        <input class="checkout-payment-input" id="payment4" type="radio" name="payment" >
                                                                                                        <label class="checkout-payment-label" for="payment4">
                                                                                                          <p class="checkout-payment-title"><img src="images/icon-paypal.png" alt=""> Pay with PayPal</p>
                                                                                                          <div class="checkout-payment-box">
                                                                                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account. </p>
                                                                                                          </div>
                                                                                                        </label>
                                                                                                      </div> -->
                                    </div>
                                </form>
                            </div>

                            <div class="mt-3">
                                <span class="error-msg" style="color: red;font-size: 16px;font-weight: bold;"></span>
                                <button type="button" class="btn btn-primary py-3 btn-lg w-100"
                                    name="checkout_place_order" id="pay_now">Place your order</button>
                                <p id="shoopping_continue" style="display:none;"><a href="<?php echo env('WEBSITE_URL'); ?>"
                                        class="btn btn-primary py-3 btn-lg w-100"> Continue Shopping</a></p>
                            </div>

                        </div>

                        <div class="checkout-inner-right">
                            <div class="checkout-order-review">
                                <div class="cart-collaterals">
                                    <div class="cart-totals">
                                        <h4>Order Summary</h4>
                                        <div class="cart-items productListCartPageContainer">

                                            <!-- <div class="cart-item">
                                                                                                          <div class="cart-image">
                                                                                                            <img src="images/product-1.jpg" alt="">
                                                                                                          </div>
                                                                                                          <div class="cart-summery">
                                                                                                            <div class="cart-summerydata">
                                                                                                              <p class="cart-title">Desert Eagle Hoodie</p>
                                                                                                              <p>Size : 46</p>
                                                                                                              <p>Navy</p>
                                                                                                            </div>
                                                                                                            <div class="cart-summeryprice">
                                                                                                              <span class="cart-price">
                                                                                                                  <del>₹ 4,990</del>
                                                                                                                  <ins>₹ 2,994</ins>
                                                                                                              </span>
                                                                                                            </div>
                                                                                                          </div>
                                                                                                        </div> -->

                                        </div>
                                        <div class="coupon">
                                            <label for="coupon_code">Apply Coupon Code</label>
                                            <!-- <span class="coupon_error" style="color:red;font-size:16px;font-weight:bold"></span>
                                                                                                        <span class="coupon_success" style="color:green;font-size:16px;font-weight:bold"></span> -->
                                            <div class="coupon-group">
                                                <input type="text" name="coupon_code" class="form-control"
                                                    id="coupon_code_input" value=""
                                                    placeholder="Enter Your Coupon Code">
                                                <button type="submit" class="btn btn-primary btn_apply_coup"
                                                    id="apply-coupon-btn" name="apply_coupon"
                                                    value="Apply coupon">Apply</button>
                                            </div>
                                        </div>
                                        <div class="cart-totals-table">
                                            <table class="shop-table">
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Total MRP</th>
                                                        <td data-title="Subtotal" class="text-end"><strong
                                                                id="totalMrp"></strong> </td>
                                                    </tr>
                                                    <tr class="shipping-totals shipping">
                                                        <td>Discount</td>
                                                        <td data-title="Shipping" class="text-end text-green"
                                                            id="totalDiscount"></td>
                                                    </tr>
                                                    <tr class="shipping-totals shipping">
                                                        <td>Sub Total</td>
                                                        <td data-title="Shipping" class="text-end" id="subTotal"></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Coupon Discount</th>
                                                        <td data-title="Total" class="text-end"><strong
                                                                id="couponDiscount"></strong></td>
                                                    </tr>
                                                    <tr class="cart-subtotal">
                                                        <th>Grand Total</th>
                                                        <td data-title="Subtotal" class="text-end"><strong
                                                                id="grandTotal"></strong></td>
                                                    </tr>
                                                    <tr class="shipping-totals shipping">
                                                        <td>Taxable Amount</td>
                                                        <td data-title="Shipping" class="text-end text-green"
                                                            id="taxableAmount"></td>
                                                    </tr>
                                                    <tr class="shipping-totals shipping">
                                                        <td>Total GST(Tax)</td>
                                                        <td data-title="Shipping" class="text-end" id="taxPrice"></td>
                                                    </tr>
                                                    <tr class="shipping-totals shipping">
                                                        <td>Shipping Charge</td>
                                                        <td data-title="Shipping" class="text-end"
                                                            id="totalShippingCharge"></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th><b>Total Payable</b> (Tax Included)</th>
                                                        <td data-title="Total" class="text-end"><strong
                                                                class="finalAmount"></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!--content-area-->
            </div>
            <!--container-->
        </div>

    </section>
    <!-- Checkout section -->

@endsection

@push('scripts')
    <script>
        var RAZORPAYKEY = "{{ env('RAZORPAY_MODE') == 'test' ? env('RAZORPAY_TEST_KEY') : env('RAZORPAY_LIVE_KEY') }}";
    </script>
    <script>
        window.dbCartItems = @json($cart ?? []); 
    </script>
    <script src="{{ asset('assets/front/js/checkouts.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <script>
        var USERID = "{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : '' }}";
        var USERNAME = "{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->name : '' }}";
        var USEREMAIL = "{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->email : '' }}";
        var USERPHONE =
            "{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->phone_number : '9876543210' }}";

        localStorage.setItem('uw_amount', '<?php echo number_format($userwallet->wallet_avl_balance ?? 0, 2); ?>'); // user wallet amount
    </script>

    <script>
        $(document).ready(function() {
            var couponDiscount = $('#couponDiscount').text().replace("-₹", "");
            if (parseFloat(couponDiscount) > 0) {
                $('.flate-off').hide();
            }
        });

        console.log('sixth');
        var notRequiredQtyAjaxClickonQtyBtn = true;
        displayCartItems(notRequiredQtyAjaxClickonQtyBtn);
        $('#apply-coupon-btn').click(function() {
            var couponCode = $('#coupon_code_input').val();
            applyCoupon(couponCode);
        });

        $(document).on('click', '.coupon-apply', function() {
            var couponCode = $(this).data('code');
            applyCoupon(couponCode);
        });

        // localStorage.removeItem('coupon_id');
        // localStorage.removeItem('coupon_discount');
        getCoupon();

        function applyCoupon(couponCode) {
            var couponDiscount = $('#couponDiscount').text().replace("-₹", "");
            console.log(' discoutn  : ', couponDiscount);
            if (parseFloat(couponDiscount) > 0) {
                showFlashMessage("You have already applied", 'error');
                return false;
            }


            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            let subTotal = 0;
            cartItems.forEach(function(item) {
                subTotal += item.price * item.quantity;
            });

            $.post("{{ route('apply.coupon') }}", {
                coupon_code: couponCode,
                cart_total: subTotal,
                cart_items: cartItems,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }, function(response) {
                if (response.status) {
                    showFlashMessage(response.message);
                    let couponHTML = `<figure>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"
                viewBox="0 0 512.035 512.035" style="enable-background: new 0 0 512 512;"
                xml:space="preserve" class="">
                <g>
                    <path
                        d="m488.502 256.035 22.464-58.592c2.464-6.464.544-13.792-4.864-18.176l-48.704-39.488-9.856-61.984c-1.088-6.848-6.464-12.192-13.312-13.28l-61.984-9.856L332.79 5.923c-4.352-5.408-11.84-7.328-18.144-4.864l-58.624 22.496L197.43 1.091c-6.496-2.496-13.76-.512-18.144 4.864l-39.488 48.736-61.984 9.856a16.033 16.033 0 0 0-13.28 13.28l-9.856 61.984-48.736 39.488c-5.376 4.352-7.328 11.68-4.864 18.144l22.464 58.592-22.464 58.592c-2.496 6.464-.512 13.792 4.864 18.144l48.736 39.456 9.856 61.984c1.088 6.848 6.432 12.224 13.28 13.312l61.984 9.856 39.488 48.704a15.923 15.923 0 0 0 18.176 4.864l58.56-22.432 58.592 22.464a16.066 16.066 0 0 0 5.728 1.056c4.704 0 9.344-2.08 12.448-5.952l39.456-48.704 61.984-9.856a16.03 16.03 0 0 0 13.312-13.312l9.856-61.984 48.704-39.456c5.408-4.384 7.328-11.68 4.864-18.144l-22.464-58.592z"
                        style="" fill="#fc2424" data-original="#f44336" class="" opacity="1"></path>
                    <path
                        d="M208.022 224.035c-26.464 0-48-21.536-48-48s21.536-48 48-48 48 21.536 48 48-21.536 48-48 48zm0-64c-8.832 0-16 7.168-16 16s7.168 16 16 16 16-7.168 16-16-7.168-16-16-16zM304.022 384.035c-26.464 0-48-21.536-48-48s21.536-48 48-48 48 21.536 48 48-21.536 48-48 48zm0-64c-8.8 0-16 7.2-16 16s7.2 16 16 16 16-7.2 16-16-7.2-16-16-16zM176.022 384.035c-3.232 0-6.464-.96-9.28-2.976-7.2-5.152-8.864-15.136-3.712-22.336l160-224c5.152-7.2 15.136-8.864 22.336-3.712 7.2 5.12 8.832 15.136 3.712 22.304l-160 224c-3.168 4.384-8.064 6.72-13.056 6.72z"
                        style="" fill="#fafafa" data-original="#fafafa" class=""></path>
                        </g>
                    </svg>
                </figure>
                <figcaption>
                    <h4>${response.coupon.coupon_code}<span>Best Offer For You Only</span></h4>
                    <p>Save ${response.discount} on this order</p>
                </figcaption>`;
                    $('.flate-off-l').html(couponHTML);
                    localStorage.setItem('coupon_id', response.coupon.id);
                    localStorage.setItem('coupon_discount', response.discount);
                    $('#view-coupon').modal('hide');
                    priceCalculation();
                } else {
                    showFlashMessage(response.message, 'error');
                    $(".coupon_error").html(response.message)
                    setTimeout(() => {
                        $(".coupon_error").html("")
                    }, 3000);
                }
            });
        }

        function calculateDelivery() {
            const pincode = document.getElementById('pincodeInput').value.trim();
            const deliveryTimeEl = document.getElementById('delivery_time');

            if (!pincode) {
                deliveryTimeEl.innerHTML = "<span style='color:red;'>Please enter a valid pincode.</span>";
                return;
            }

            $.ajax({
                url: '/check-delevery',
                method: 'POST',
                data: {
                    pincode: pincode
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        const data = response.data;
                        deliveryTimeEl.innerHTML = `<span>${data.message}</span>`;
                    } else {
                        deliveryTimeEl.innerHTML = `<span style="color:red;">${response.message}</span>`;
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    deliveryTimeEl.innerHTML =
                        `<span style="color:red;">Invalid Pincode.</span>`;
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {

            $('#new-address').hide();

            $('#add-new-address').on('click', function() {

                if ($('#new-address').is(':visible')) {
                    $('#new-address').hide();
                    $(this).text('+ Add New Address');
                } else {
                    $('#new-address').show();
                    $(this).text('− Close Address');
                }

            });

            $('.cancel').on('click', function() {
                $('#new-address').hide();
                $('#add-new-address').text('+ Add New Address');
            });

        });
    </script>
@endpush
