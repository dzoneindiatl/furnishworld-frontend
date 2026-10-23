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
            <td style="font-size: 24px; font-weight: 700; padding-bottom: 40px;" >Tax Invoice
            </td>
         </tr>
         <tr>
            <td>
               <table  width="100%">
                  <tr>
                     <td>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Invoice Number:</b> {{ $supplySetting->invoice_number }}{{ $supplySetting->id }}  </p>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Order Number:</b> {{ $order->order_number }}</p>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Nature of Transaction:</b> {{ $order->payment_method }}</p>
                        <p style="font-size: 16px; margin-bottom: 0px; margin-top: 5px;"><b>Place of Supply :</b> {{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</p>
                     </td>
                     <td align="right">
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>PacketID:</b> {{ $supplySetting->packet_id }}{{ $supplySetting->id }}   </p>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Invoice Date: </b> {{ $order->created_at }}</p>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Order Date:</b> {{ $order->created_at }}</p>
                        <p style="font-size: 16px; margin-bottom: 5px; margin-top: 5px;"><b>Nature of Supply:</b> {{ $supplySetting->nature_spilly }}</p>
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
                        <p style="margin-bottom: 10px;font-size: 16px;"><b >Bill to / Ship to:</b></p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 16px;">{{ $bAddress->billing_customer_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 16px;">{{ $supplySetting->address }} {{ $supplySetting->pincode }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 16px;">{{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</p>
                     </td>
                     <td width="50%">
                        <p><b>Customer Email:</b> {{ $order->email }} </p>
                     </td>
                  </tr>
                  <tr style="vertical-align: top;">
                     <td>
                        <p><b>Bill From: </b></p>
                        <p style="margin-bottom: 0;margin-top: 0;">{{ $supplySetting->website_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 16px;">{{ $bAddress->billing_address }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;font-size: 16px;">{{ $bAddress->billing_city }} ({{ $bAddress->billing_pincode }}), {{ $bAddress->billing_state }}, {{ $bAddress->billing_country }}</p>
                        <p style="font-size: 16px;"><b>GSTIN Number:</b> {{ $GSTIN }} </p>
                     </td>
                     <td>
                        <p><b>Ship From: </b></p>
                        <p style="margin-bottom: 0;margin-top: 0;">{{ $supplySetting->website_name }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;">{{ $sAddress->shipping_address }}</p>
                        <p style="margin-bottom: 0;margin-top: 0;">{{ $sAddress->shipping_city }} ({{ $sAddress->shipping_pincode }}), {{ $sAddress->shipping_state }}, {{ $sAddress->shipping_country }}</p>
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
                     <th align="left" style="font-size: 14px;">Qty </th>
                     <th align="left" style="font-size: 14px;">Gross Amount </th>
                     <th align="left" style="font-size: 14px;">Discount </th>
                     <th align="left" style="font-size: 14px;">Other Charges </th>
                     <th align="left" style="font-size: 14px;">Taxable Amount</th>
                     <th align="left" style="font-size: 14px;">CGST </th>
                     <th align="left" style="font-size: 14px;">GST/UGST</th>
                     <th align="left" style="font-size: 14px;">IGST</th>
                     <th align="right" style="font-size: 14px;">Cess Total Amount</th>
                  </tr>
                  @php
                     $taxPrice = 0;
                     $cgstTaxTotal = 0;
                     $igstTaxTotal = 0;
                  @endphp
                  @if(!empty($checkout_data))
                     @foreach($checkout_data as $checkout)
                        @php
                           $taxPrice += $checkout['tax_price'] ?? 0;

                           $checkoutTax = $checkout['tax_price'] ?? 0;
                           $shippingState = strtolower($sAddress->shipping_state ?? '');
                           $supplyState = strtolower($supplySetting->country->state ?? '');

                           if ($supplyState === $shippingState) {
                              // Intra-state: Split into CGST and SGST (or CGST/SGST equivalent)
                              $cgstTax = $checkoutTax / 2;
                              $igstTax = 0.00;
                              $cgstTaxTotal += $cgstTax;
                           } else {
                              // Inter-state: Apply IGST
                              $cgstTax = 0.00;
                              $igstTax = $checkoutTax;
                              $igstTaxTotal += $igstTax;
                           }
                        @endphp
                        <tr>
                           <td colspan="9">
                              <hr>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="9">
                              <p style="margin-top: 0; font-size: 20px; margin-bottom: 0;font-size: 18px;"><b>CDAIKAS	S100969585(A1C24300511vory) - {{ $checkout['name'] ?? '' }}, Size: {{ $checkout['selectedVariants']['size'] ?? '' }} , Color: {{ $checkout['selectedVariants']['colour'] ?? '' }} </b></p>
                              <p style="margin-top: 0; font-size: 20px; font-size: 18px;"><b>HSN: 62114210, 12.0% IGST </b></p>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-size: 14px;">{{ $checkout['quantity'] ?? '' }}</td>
                           <td style="font-size: 14px;">Rs {{ number_format($checkout['sellingPrice'] ?? 0, 2) }}</td>
                           <td style="font-size: 14px;">Rs {{ number_format($checkout['discountAmount'] ?? 0, 2) }}</td>
                           <td style="font-size: 14px;">Rs 0.00</td>
                           <td style="font-size: 14px;">Rs {{ number_format(($checkout['price'] ?? 0) * ($checkout['quantity'] ?? 0), 2) }}</td>
                           <td style="font-size: 14px;">Rs {{ number_format($cgstTax ?? 0, 2) }}</td>
                           <td style="font-size: 14px;">Rs {{ number_format($cgstTax ?? 0, 2) }}</td>
                           <td style="font-size: 14px;">Rs {{ number_format($igstTax ?? 0, 2) }}</td>
                           <td align="right" style="font-size: 14px;">Rs {{ number_format(($checkout['price'] ?? 0) * ($checkout['quantity'] ?? 0), 2) }}</td>

                        </tr>
                     @endforeach
                  @endif
                  <tr>
                     <td colspan="9">
                        <hr>
                     </td>
                  </tr>
                  <tr>
                     <td style="font-size: 14px;"><b>TOTAL</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($order['sub_total'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($order['coupon_discount'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($order['shippingcharge'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($order['total'] ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($cgstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($cgstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;"><b>Rs {{ number_format($igstTaxTotal ?? 0, 2) }}</b></td>
                     <td style="font-size: 14px;" align="right"><b>Rs {{ number_format($order['total'] ?? 0, 2) }}</b></td>
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
                        <p  style="margin-bottom: 40px;"><b>FOR {{ $supplySetting->website_name }} </b></p>
                        <p style="font-size: 14px;"><b>Signature:</b>{{ $supplySetting->signature }}</p>
                        <p style="font-size: 14px;"><b>Name</b>: {{ $supplySetting->name }}</p>
                        <p style="font-size: 14px;"><b>Designation</b>: {{ $supplySetting->designation }}</p>
                        <p  style="margin-top: 20px;">Authorized Signatory </p>
                     </td>
                     <!-- <td align="right"><img src="{{ $supplySetting->scanner_image }}"></td> -->
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td>
               <p style="margin-bottom: 0;"><b>DECLARATION</b></p>
               <p style="margin-top: 0; margin-bottom: 0;font-size: 14px;">{{ $supplySetting->note }} 
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
               <p style="margin-top: 10px; font-size: 14px;"><b>Reg Address:  {{ $supplySetting->address }}, {{ $supplySetting->pincode }}, {{ $supplySetting->city->name }}, {{ $supplySetting->state->name }}, {{ $supplySetting->country->name }}</b></p>
            </td>
         </tr>
      </table>
      @php
         //echo "<pre>";print_r($supplySetting);die;
      @endphp
    </body>
</html>