<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('assets/favicon.png')}}" type="image/x-icon">
    <title>{{ config('Site.title') ?? '' }} Order Invoice</title>
    <style>
        @page { margin: 15px 30px; } 
        </style>
</head>

<body style="background-color: #fbfbfb; padding: 0; margin: 0; font-weight: 400;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #fbfbfb; padding: 5px;"> 
                        <tbody>
                            <tr>
                                <td style="height: 10px;"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center">
                                                    <h2 style="color: #101010; font-weight: 600; font-size: 22px; margin-bottom: 0; margin-top: 0;">
                                                        Tjap India 
                                                    </h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"><hr></td>
                            </tr>

                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr>
                                                <!-- <td>
                                                   <img src="{{asset('assets/images/tjap-logo.png') }}" alt="" width="90px"/>
                                                </td> -->
                                                <td align="center">
                                                    <h3 style="color: #101010; font-weight: 600; font-size: 25px; margin-bottom: 0; margin-top: 0;">
                                                       TAX INVOICE
                                                    </h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"><hr></td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr> 
                                                <td style="font-size: 12px; width: 30%">
                                                    <p><strong>SHIPPING ADDRESS:</strong></p>
                                                </td>                                              
                                                <td style="font-size: 12px; width: 30%">
                                                    <p><strong>SOLD BY:</strong></p>
                                                </td>                                               
                                                <td style="font-size: 12px; width: 40%">
                                                    <p><strong>INVOICE DETAILS:</strong></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; width: 30%">
                                                    <p>
                                                        {!! $order->getAddressForInvoice($order->shipping_address_id) !!}
                                                    </p>
                                                </td>
                                                <td style="font-size: 12px; width: 30%">
                                                    <p>{{ $settings['Contact.address'] }}</p>
                                                    @if(!empty($settings['Site.PAN']))
                                                        <p>PAN : {{ $settings['Site.PAN'] }}</p>
                                                    @endif
                                                    @if(!empty($settings['Site.CIN']))
                                                        <p>CIN : {{ $settings['Site.CIN'] }}</p>
                                                    @endif
                                                    @if(!empty($settings['Site.GSTIN']))
                                                        <p>GSTIN : {{ $settings['Site.GSTIN'] }}</p>
                                                    @endif
                                                </td>                                               
                                                <td style="font-size: 12px; width: 40%"> 
                                                    <p><strong>INVOICE NUMBER : </strong># {{ "INV-".$order->order_number }}</p>
                                                    <p><strong>INVOICE DATE : </strong>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                                                    <p><strong>ORDER NO.    : </strong>{{ $order->order_number }}</p>
                                                    <p><strong>ORDER DATE   : </strong>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>                                                    
                                                    <p><strong>CHANNEL      : </strong>TJAP</p> 
                                                    <!-- <p><strong>SHIPPED BY   : </strong></p>
                                                    <p><strong>AWB NO.      : </strong></p> -->
                                                    <p><strong>PAYMENT METHOD : </strong>{{ ucfirst($order->payment_method) }}</p>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="height: 10px;"></td>
                            </tr> 
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">S.NO.</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">PRODUCT</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">HSN</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">QTY</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">UNIT PRICE</p>
                                                </td>
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">DISCOUNT</p>
                                                </td>
                                                
                                                <td>
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">GST</p>
                                                </td>
                                                 
                                                <td align="right">
                                                    <p style="margin: 0; font-size: 12px; font-weight: 600;">TOTAL <br> (Including<br>GST)</p>
                                                </td>
                                            </tr>
                                            @if(!empty($order->items))
                                            <?php $gross_total = $discount = $total = $qty = $taxable_value = $sgst = $cgst = 0; ?>
                                            <tr><td style="height: 30px;" colspan="11"><hr></td></tr>
                                            @foreach($order->items as $key => $item)
                                                <tr>
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">{{ $key+1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">
                                                            {{ strlen($item->product->name) > 15 ? substr($item->product->name,0,15)."..." : $item->product->name }} <br>
                                                            <small>Size : {{ $item->size }}</small><br>
                                                            <small>Color: {{ $item->color }}</small><br>
                                                            <small>SKU: {{ $item->product->sku }}</small>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">{{ $item->product->hsn }}</p>
                                                    </td>
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">{{ $item->qty }}</p>
                                                    </td>
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">Rs. {{ $item->mrp  }}</p>
                                                    </td>
                                                    <td>                                                   
                                                        <p style="margin: 10px 0; font-size: 12px;">Rs. {{ $item->mrp - $item->selling_price }}</p>
                                                    </td>
                                                   
                                                    <td>
                                                        <p style="margin: 10px 0; font-size: 12px;">Rs. {{ $item->gst }} </p>
                                                        <!-- <p style="margin: 10px 0; font-size: 12px;">Rs. {{ $item->gst }} || {{ round(($item->gst / $item->total ) * 100),2 }} %</p> -->
                                                    </td>
                                                    
                                                    <td align="right">
                                                        <p style="margin: 10px 0; font-size: 12px;">Rs. {{ $item->total }}</p>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $gross_total += $item->mrp;
                                                    $discount += $item->mro-$item->selling_price;
                                                    $total += $item->total;
                                                    $qty += $item->qty;
                                                    $taxable_value += ($item->gst);
                                                    $sgst += $item->sgst;
                                                    $cgst += $item->cgst;
                                                ?>
                                                @endforeach
                                            @endif
                                            <tr>
                                                <td colspan="3"></td>
                                                <td style="height: 10px;" colspan="8"><hr></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                             @if(!$order->coupon_name=='')
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>   
                                            <tr>
                                                <td align="right" colspan="9">Coupon Discount: ({{$order->coupon_name}})
                                                </td>
                                                <td align="right" colspan="2">- Rs. {{ $order->coupon_discount }}
                                                </td>                
                                            </tr>  
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endif
                              @if(!empty($order->shippingcharge) && $order->shippingcharge > 0)
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>   
                                            <tr>
                                                <td align="right" colspan="9">Shipping
                                                </td>
                                                <td align="right" colspan="2">Rs. {{ $order->shippingcharge }}
                                                </td>                
                                            </tr>  
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>                                        
                                            <tr>
                                                <td align="right" colspan="9">
                                                    <strong>NET TOTAL (In Value)</strong>
                                                </td>
                                                <td align="right" colspan="2">
                                                    <strong>Rs. {{ $order->total }}</strong>
                                                </td>                
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="height: 30px;"><hr></td>
                            </tr>
                            

                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="border: none;">
                                                <div>
                                                    <input type="text" style="height: 100px;width: 221px;">
                                                </div>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="font-size: 14px;">
                                                    Authorized Signatory for Tjap India
                                                </td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="height: 30px;"><hr></td>
                            </tr>

                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0px" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 14px;">
                                                    <p>{!! $settings['Site.invoice_terms'] !!}</p>
                                                    {{--<p style="font-size: 14px;">The goods sold as are intended for end user consumption and not for re-sale.</p>--}}
                                                    <p style="font-size: 14px;">Contact TJAP : {{ $settings['Contact.contact_number'] }}  </p>
                                                </td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 20px;"></td>
                            </tr>
                        </tbody>
                    </table>
</body>