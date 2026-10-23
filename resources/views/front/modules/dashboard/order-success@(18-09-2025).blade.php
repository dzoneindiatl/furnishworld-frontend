@extends('front.layouts.app')
@section('content')    
<section class="banner-section">
    <div class="banner-inner">
        <div class="shape1"><img src="{{ asset('assets/front/img/breadcumb-shape1_1.png') }}" alt="shape" /></div>
        <div class="shape2"><img src="{{ asset('assets/front/img/breadcumb-shape1_2.png') }}" alt="shape" /></div>
        <div class="shape3"><img src="{{ asset('assets/front/img/breadcumb-shape1_3.png') }}" alt="shape" /></div>
        <div class="shape4"><img src="{{ asset('assets/front/img/breadcumb-shape1_4.png') }}" alt="shape" /></div>
        <div class="container">
           <div class="banner-text">
              <h1>Order Success</h1>
              <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Success</li>
                 </ol>
              </nav>
           </div>
        </div>
    </div>
 </section>

     <section class="order-success section-space">
         <div class="container">
            <div class="order-place-sec">
               <div class="order-place-l">
                  <figure>
                     <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="100" x="0" y="0" viewBox="0 0 48 48" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                           <path fill="#ffc127" d="m40.335 37.3-2.16-21.6A2.989 2.989 0 0 0 35.19 13H8.81a2.989 2.989 0 0 0-2.985 2.7l-2.16 21.6A7 7 0 0 0 10.63 45h22.74a7 7 0 0 0 6.965-7.7z" opacity="1" data-original="#ffc127"></path>
                           <g fill="#ee4d2d">
                              <circle cx="14" cy="17" r="2" fill="#ee4d2d" opacity="1" data-original="#ee4d2d"></circle>
                              <circle cx="30" cy="17" r="2" fill="#ee4d2d" opacity="1" data-original="#ee4d2d"></circle>
                              <path d="M30 18a1 1 0 0 1-1-1v-5a7 7 0 0 0-14 0v5a1 1 0 0 1-2 0v-5a9 9 0 0 1 18 0v5a1 1 0 0 1-1 1z" fill="#ee4d2d" opacity="1" data-original="#ee4d2d"></path>
                              <circle cx="34" cy="34" r="11" fill="#ee4d2d" opacity="1" data-original="#ee4d2d"></circle>
                           </g>
                           <path fill="#ffffff" d="M33 38a1 1 0 0 1-.707-.293l-3-3a1 1 0 0 1 1.414-1.414L33 35.586l5.293-5.293a1 1 0 0 1 1.414 1.414l-6 6A1 1 0 0 1 33 38z" opacity="1" data-original="#ffffff"></path>
                        </g>
                     </svg>
                  </figure>
                  <figcaption>
                     <h4>Order Placed Successfuly</h4>
                     <h5>Hey {{ auth()->guard('customer')->user()->name}}</h5>
                     <p>we've got your order! we'll keep you updated when your order ships.please find your order details below.</p>
                     <p>Visit <b>My Orders</b> section to get further updates on your order.</p>
                  </figcaption>
               </div>
               <div class="order-place-r">
                  <a href="{{route('front-home.index')}}" class="btn btn-primary">Continue Shopping</a>
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-md-8">
                  <div class="border-box order-detail-sec mb-4">
                     <h4 class="box-title">Order  Detail</h4>
                     <ul class="order-detail-list d-flex justify-content-between">
                        <li>
                           <b>Order ID#</b>
                           <p>{{ $order->order_number}}</p>
                        </li>
                        <li>
                           <b>Order  Placed</b>
                           <p>{{ $order->created_at->format('jS M, Y') }}</p>
                        </li>
                        <li>
                           <b>Order status: <span>Success</span></b>
                           <p>Order will Be Delivered In 3-5 Days.</p>
                        </li>
                     </ul>
                  </div>
                  <div class="border-box delivery-mode mb-4">
                     <h4 class="box-title">Delivery Mode & Address</h4>
                     <ul class="delivery-mode-list">
                        <li>
                           <i class="fa-solid fa-gift"></i>
                           <div class="delivery-mode-content"><span>Standard Delivery</span></div>
                        </li>
                        @php
                            $billing = json_decode($order->billing_address);
                        @endphp
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <div class="delivery-mode-content">
                                <span>{{ $billing->billing_customer_name }} {{ $billing->billing_last_name }}</span>
                                <p>{{ $billing->billing_address }}, {{ $billing->billing_city }}, {{ $billing->billing_state }}, {{ $billing->billing_country }}, {{ $billing->billing_pincode }}</p>
                                <p>Phone: +{{ $billing->billing_phone }}</p>
                            </div>
                        </li>
                     </ul>
                  </div>
                  <div class="border-box mb-4 product-info">
                    @foreach ($order->items as $orderItems)
                        @php
                        $combination = json_decode($orderItems->combination);
                        $variantId = \App\Models\VariantValue::where('name', 'like', '%' . reset($combination) .
                        '%')->value('id');
                        $img = \App\Models\ProductGraphics::where('product_id', $orderItems->product_id)
                        ->where('variant_id', $variantId)
                        ->value('graphic') ?? \App\Models\ProductGraphics::where('product_id',
                        $orderItems->product_id)->value('graphic');
                        $combinationData = '';
                        foreach ($combination as $key => $data) {
                        $key = ucfirst($key);
                        $combinationData .= "<p class='c-color'>$key: $data</p>";
                        }
                        $price = $orderItems->selling_price * $orderItems->qty;
                        @endphp
                     <div class="product-detail-content">
                        <figure><img src="{{ url('uploads/products/' . $img) }}" /></figure>
                        <figcaption>
                           <h4>{{ $orderItems->product->name ?? 'N/A' }}</h4>
                           <span>Solid Cotton Blend Hood Boys Sweatshirt</span>
                           <div class="product-cs">{!! $combinationData !!}</div>
                            <p class="QTY">QTY: {{ $orderItems->qty }}</p>
                           <div class="price-tag"><span>₹{{ $price }}</span></div>
                        </figcaption>
                     </div>

                      @endforeach
                  </div>
                  <!-- <div class="border-box Shopping-rating">
                     <h4 class="box-title">Rate Your Shopping Experience</h4>
                     <ul class="rating-review mb-3">
                        <li><i class="fa-regular fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                        <li><i class="fa-regular fa-star"></i></li>
                     </ul>
                     <a class="common-btn">Submit
                     </a>
                  </div> -->
               </div>
               <div class="col-md-4">
                  <div class="border-box ">
                     <h4 class="box-title d-flex justify-content-between align-items-center">Price Detail  <span class="product-item">{{ count($order->items)}} Item</span></h4>
                     <div class="total-bill-sec">
                        <ul class="total-list">
                           <li>
                              <span> Total MRP</span>
                              <p>₹ {{$order->sub_total}}</p>
                           </li>
                           <li>
                              <span>Offer Discount </span>
                              <p class="text-green">-₹ {{$order->coupon_discount}}</p>
                           </li>
                           <li>
                              <span>Delivery Fee</span>
                              <p>₹0</p>
                           </li>
                           <li>
                              <hr>
                           </li>
                           <li>
                              <span><b>Total Payable Amount</b></span>
                              <p><b>₹{{$order->total}}</b></p>
                           </li>
                           <li class="mb-0">

                            @php
                                $paymentMode = match ($order->payment_method) {
                                    'cod' => 'Cash On Delivery',
                                    'paypal', 'razorpay' => 'Pay Online',
                                    default => 'Use Vasvi Wallet',
                                };
                            @endphp
                              <span>Mode of Payment</span>
                              <p>{{ $paymentMode }}</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
     
    
@endsection