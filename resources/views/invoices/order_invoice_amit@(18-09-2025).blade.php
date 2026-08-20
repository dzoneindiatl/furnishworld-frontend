<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
      <link rel="icon" href="favicon.png" type="image/x-icon">
      <title>Tax Invoice</title>
      <!-- <link
         href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&display=swap"
         rel="stylesheet"> -->
   </head>
   <body style="background-color: #fbfbfb; padding: 0; margin: 0; font-family: 'Nunito Sans', sans-serif; font-weight: 400;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#ffffff; padding: 20px 20px 20px 20px; width: 100%; max-width: 1116px; margin: 0 auto; border: 1px solid #eee;">
         <tr >
            <td style="font-size: 24px; font-weight: 700; padding-bottom: 15px;text-align: center;" >Tax Invoice</td>
         </tr>
         <tr>
            <td>
               <table  width="100%">
                  <tr>
                     <td>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Invoice Number:</b> {{ $supplySetting->invoice_number }}{{ $order->id }}  </p>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Order Number:</b> {{ $order->order_number }}</p>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Nature of Transaction:</b> {{ $order->payment_method }}</p>
                        <p style="font-size: 14px; margin-bottom: 0px; margin-top: 5px;"><b>Place of Supply :</b> {{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</p>
                     </td>
                     <td align="right">
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>PacketID:</b> {{ $supplySetting->packet_id }}{{ $order->id }}   </p>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Invoice Date: </b> {{ $order->created_at }}</p>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Order Date:</b> {{ $order->created_at }}</p>
                        <p style="font-size: 14px; margin-bottom: 5px; margin-top: 5px;font-family: 'Nunito Sans', sans-serif;"><b>Nature of Supply:</b> {{ $supplySetting->nature_spilly }}</p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <hr>
            </td>
         </tr>
         @php
            $bAddress = json_decode($order->billing_address);
            $sAddress = json_decode($order->shipping_address);
         @endphp
         <tr >
            <td>
               <table width="100%" >
                  <tr>
                     <td width="50%">
                        <p style="margin-bottom: 10px;font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b >Bill to / Ship to:</b></p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $bAddress->billing_customer_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $supplySetting->address }} {{ $supplySetting->pincode }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</p>
                     </td>
                     <td width="50%">
                        <p><b>Customer Type:</b> Reregistered </p>
                     </td>
                  </tr>
                  <tr style="vertical-align: top;">
                     <td>
                        <p><b>Bill From: </b></p>
                        <p style="margin-bottom: 0;margin-top: 0;font-family: 'Nunito Sans', sans-serif;">{{ $supplySetting->website_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $bAddress->billing_address }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $bAddress->billing_city }} ({{ $bAddress->billing_pincode }}), {{ $bAddress->billing_state }}, {{ $bAddress->billing_country }}</p>
                        <p style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>GSTIN Number:</b> {{ $GSTIN }} </p>
                     </td>
                     <td>
                        <p><b>Ship From: </b></p>
                        <p style="margin-bottom: 0;margin-top: 0;font-family: 'Nunito Sans', sans-serif;">{{ $supplySetting->website_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-family: 'Nunito Sans', sans-serif;">{{ $sAddress->shipping_address }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-family: 'Nunito Sans', sans-serif;">{{ $sAddress->shipping_city }} ({{ $sAddress->shipping_pincode }}), {{ $sAddress->shipping_state }}, {{ $sAddress->shipping_country }}</p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <hr>
            </td>
         </tr>
         <tr>
            <td>
               <table width="100%">
                  <tr>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Qty </th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">MRP. </th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Discount </th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Discount Coupon </th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Taxable Amount</th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">CGST </th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">GST/UGST</th>
                     <th align="left" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">IGST</th>
                     <th align="right" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Cess Total Amount</th>
                  </tr>
                  @php
                     $taxPrice = 0;
                     $cgstTaxTotal = 0;
                     $igstTaxTotal = 0;
                     $discount = 0;
                     $totalProduct = count($checkout_data);
                     $coupanDiscount = ($order['coupon_discount'] > 0) ? $order['coupon_discount'] / $totalProduct : 0;
                     $mrpPrice = 0;
                     $taxableAmount = 0;
                  @endphp
                  @if(!empty($checkout_data))
                     @foreach($checkout_data as $checkout)
                        @php
                           $cgstTax = 0;
                           $igstTax = 0;
                           $taxPrice += $checkout['tax_price'] ?? 0;

                           $checkoutTax = $checkout['tax_price'] ?? 0;
                           $shippingState = strtolower($sAddress->shipping_state ?? '');
                           $supplyState = strtolower($supplySetting->country->state ?? '');

                           $discount = $discount + ($checkout['price'] - $checkout['sellingPrice']);
                           if ($supplyState === $shippingState) {
                              // Intra-state: Split into CGST and SGST (or CGST/SGST equivalent)
                              $cgstTaxPrice = $checkoutTax / 2;
                              $igstTaxPrice = 0.00;
                              $cgstTaxTotal += $cgstTaxPrice;
                              $cgstTax += $cgstTaxPrice;
                              $igstTax =  0.00;
                           } else {
                              // Inter-state: Apply IGST
                              $cgstTaxPrice = 0.00;
                              $igstTaxPrice = $checkoutTax;
                              $igstTaxTotal += $igstTaxPrice;
                              $cgstTax = 0.00;
                              $igstTax += $igstTaxPrice;
                           }
                           $mrpPrice += $checkout['price'];
                           $taxableAmount = ((($checkout['sellingPrice'] ?? 0) * ($checkout['quantity'] ?? 0)) - ($checkout['tax_price'] + ($coupanDiscount ?? 0)));
                        @endphp
                        <tr>
                           <td colspan="9">
                              <hr>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="9">
                              <p style="margin-top: 0; font-size: 16px; margin-bottom: 0;font-family: 'Nunito Sans', sans-serif;"><b> {{ $checkout['name'] ?? '' }}, Size: {{ $checkout['selectedVariants']['size'] ?? '' }} , Color: {{ $checkout['selectedVariants']['colour'] ?? '' }} </b></p>
                              <p style="margin-top: 0; font-size: 16px;font-family: 'Nunito Sans', sans-serif;"><b>HSN: 62114210, {{ $checkout['tax_rate'] }} % </b></p>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $checkout['quantity'] ?? '' }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($checkout['price'] ?? 0, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($checkout['price'] - $checkout['sellingPrice'] ?? 0, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($coupanDiscount ?? 0, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($taxableAmount, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($cgstTax ?? 0, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($cgstTax ?? 0, 2) }}</td>
                           <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format($igstTax ?? 0, 2) }}</td>
                           <td align="right" style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Rs {{ number_format(($taxableAmount ?? 0) + ($igstTax ?? 0), 2) }}</td>

                        </tr>
                     @endforeach
                  @endif
                  <tr>
                     <td colspan="9">
                        <hr>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>TOTAL</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format(($mrpPrice ?? 0), 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($discount ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($order['coupon_discount'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($order['sub_total'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($cgstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($cgstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Rs {{ number_format($igstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;" align="right"><b>Rs {{ number_format($order['total'] ?? 0) }}</b></td>
                  </tr>
                  <tr>
                     <td colspan="9">
                        <hr>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <table width="100%">
                  <tr>
                     <td style="vertical-align: text-top;">
                        <p  style="margin-bottom: 10px;font-family: 'Nunito Sans', sans-serif;"><b>FOR {{ $supplySetting->website_name }} </b></p>   
                     </td>
                     <td align="left" colspan="6">
                        <p style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Signature:</b>{{ $supplySetting->signature }}</p>
                        <p style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Name</b>: {{ $supplySetting->name }}</p>
                     </td>
                     <td align="right" colspan="6">
                        <p style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Designation</b>: {{ $supplySetting->designation }}</p>
                        <p  style="font-size: 14px;font-family: 'Nunito Sans', sans-serif;">Authorized Signatory </p>
                     </td>
                     <!-- <td align="right"><img src="{{ $supplySetting->scanner_image }}"></td> -->
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <p style="margin-bottom: 0;font-family: 'Nunito Sans', sans-serif;"><b>DECLARATION</b></p>
               <p style="margin-top: 0; margin-bottom: 0;font-size: 14px;font-family: 'Nunito Sans', sans-serif;">{{ $supplySetting->note }} 
               </p>
            </td>
         </tr>
         <tr>
            <td >
               <hr>
            </td>
         </tr>
         <tr>
            <td>
               <p style="margin-top: 10px; font-size: 14px;font-family: 'Nunito Sans', sans-serif;"><b>Reg Address:  {{ $supplySetting->address }}, {{ $supplySetting->pincode }}, {{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</b></p>
            </td>
         </tr>
      </table>
      @php
        // echo "<pre>";print_r($checkout_data);die;
        // echo "<pre>";print_r($order);die;
      @endphp
    </body>
</html>