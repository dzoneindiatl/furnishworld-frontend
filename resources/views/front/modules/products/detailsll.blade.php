@dd("t4");
@extends('front.layouts.app')
@section('content')

        <section class="banner-section">
            <!--  <div class="shape shape-three"><span><img src="assets/img/curved-arrow.png" alt=""></span></div>
            <div class="shape shape-four"><span><img src="assets/img/stars.png" alt=""></span></div> -->
            <div class="banner-inner">
                  <div class="shape1"><img src="{{ asset('assets/front/img/breadcumb-shape1_1.png') }}" alt="shape" /></div>
        <div class="shape2"><img src="{{asset("assets/front/img/breadcumb-shape1_2.png")}}" alt="shape" /></div>
        <div class="shape3"><img src="{{asset("assets/front/img/breadcumb-shape1_3.png")}}" alt="shape" /></div>
        <div class="shape4"><img src="{{asset("assets/front/img/breadcumb-shape1_4.png" )}}" alt="shape" /></div>
                <div class="container">
                    <div class="banner-text">
                        <h1>Shop Detail</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
          
        </section>
        <section class="product-detail-sec space-sec-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="detail-grid">
                            <div class="row">
                             
                        @foreach($product->detaill_default_images as $productImageVal)
                        @if ($productImageVal['graphic_type']=='image')


                        <div class="col-md-6 detail-grid-img">
                            <a data-bs-toggle="modal" data-bs-target="#modal1">

                                <div class="pro-nav-thumb"><img src="{{$productImageVal['graphic'] ?? '' }}" alt="" /></div>

                            </a>
                        </div>
                        @else
                        <div class="col-md-6 detail-grid-img">
                            <video width="100%" height="350" controls>
                                <source src="{{$productImageVal['graphic'] ?? '' }}" type="video/mp4">

                            </video>

                        </div>
                        @endif
                        @endforeach
                       
                            </div>
                        </div>
                        <div class="faq-inner mt-4">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Product Description
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                Here is a radiant blend of tradition and contemporary allure. The copper pot with leafy designs etched into it gives the lamp a rustic charm offering not just light but a touch of history and
                                                artistry to your space.
                                            </p>
                                            <ul>
                                                <li>1. The product includes a table lamp.</li>
                                                <li>2. The size of the product (6.5x9x14 inches) or (16.51x22.86x35.56 cm).</li>
                                                <li>3. The material of the shade is cotton and stand is metal.</li>
                                                <li>4. The length of the wire is 1.5 m or 59.05 inches.</li>
                                                <li>5. Wipe it with a clean, dry cloth.</li>
                                                <li>6. Bulb is not provided with the product. Type of bulb required for the product is E-27.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Additional Info
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="addition-box">
                                                <b>Seller Name:</b>
                                                <p>PJ crafts</p>
                                            </div>
                                            <div class="addition-box">
                                                <b>Seller Name:</b>
                                                <p>PJ crafts</p>
                                            </div>
                                            <div class="addition-box">
                                                <b>Seller Name:</b>
                                                <p>PJ crafts</p>
                                            </div>
                                            <div class="addition-box">
                                                <b>Seller Name:</b>
                                                <p>PJ crafts</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Return and Exchange Policy
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="Policy-return">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="40"
                                                    height="40"
                                                    x="0"
                                                    y="0"
                                                    viewBox="0 0 512 512"
                                                    style="enable-background: new 0 0 512 512;"
                                                    xml:space="preserve"
                                                    class=""
                                                >
                                                    <g>
                                                        <path
                                                            fill="#ff5633"
                                                            d="m510.28 311.87-70.81-89.72a8.001 8.001 0 0 0-6.27-3.04h-85.46v-53.29c0-4.42-3.58-7.99-7.99-7.99h-61.4c-4.42 0-7.99 3.58-7.99 7.99s3.58 7.99 7.99 7.99h53.4v230.2H151.28c-3.85-24.38-25-43.09-50.45-43.09s-46.6 18.71-50.45 43.09H15.99v-230.2h53.4c4.42 0 7.99-3.58 7.99-7.99s-3.58-7.99-7.99-7.99H8c-4.42 0-7.99 3.58-7.99 7.99v246.19C0 416.42 3.58 420 8 420h42.38c3.85 24.38 25 43.09 50.45 43.09s46.6-18.71 50.45-43.09H371.4c3.85 24.38 25 43.09 50.45 43.09 25.46 0 46.63-18.71 50.48-43.09H504c4.42 0 7.99-3.58 7.99-7.99v-95.19c.01-1.8-.6-3.54-1.71-4.95zM100.83 447.1c-19.35 0-35.09-15.74-35.09-35.09s15.74-35.09 35.09-35.09 35.09 15.74 35.09 35.09c0 19.34-15.74 35.09-35.09 35.09zm321.02 0c-19.35 0-35.09-15.74-35.09-35.09s15.74-35.09 35.09-35.09c19.37 0 35.12 15.74 35.12 35.09.01 19.34-15.75 35.09-35.12 35.09zm74.16-43.09h-23.68c-3.85-24.38-25.02-43.09-50.48-43.09-25.45 0-46.6 18.71-50.45 43.09h-23.67V235.1h81.59l66.69 84.5zm-80.28-148.9h-40c-4.42 0-7.99 3.58-7.99 7.99v66.19c0 4.42 3.58 7.99 7.99 7.99H468c3.06 0 5.86-1.75 7.19-4.51 1.34-2.76.98-6.04-.92-8.44L422 258.14a7.993 7.993 0 0 0-6.27-3.03zm-32 66.19v-50.2h28.13l39.65 50.2zm46.18 90.71c0 4.42-3.58 7.99-7.99 7.99s-8.04-3.58-8.04-7.99 3.54-7.99 7.95-7.99h.08c4.42-.01 8 3.57 8 7.99zm-321.03 0c0 4.42-3.58 7.99-7.99 7.99h-.11c-4.42 0-7.99-3.58-7.99-7.99s3.58-7.99 7.99-7.99h.11c4.41-.01 7.99 3.57 7.99 7.99zm113.78-86.94c0-4.42 3.58-7.99 7.99-7.99h58.76c4.42 0 7.99 3.58 7.99 7.99s-3.58 7.99-7.99 7.99h-58.76c-4.41 0-7.99-3.58-7.99-7.99zm0 46.77c0-4.42 3.58-7.99 7.99-7.99h22.56c4.42 0 7.99 3.58 7.99 7.99s-3.58 7.99-7.99 7.99h-22.56c-4.41 0-7.99-3.58-7.99-7.99z"
                                                            opacity="1"
                                                            data-original="#21324d"
                                                            class=""
                                                        ></path>
                                                        <path
                                                            fill="#ff5633"
                                                            d="M173.88 48.91c-62.07 0-112.56 50.48-112.56 112.54s50.5 112.54 112.56 112.54c62.05 0 112.54-50.48 112.54-112.54S235.93 48.91 173.88 48.91zm0 209.09c-53.25 0-96.58-43.31-96.58-96.55s43.32-96.55 96.58-96.55c53.24 0 96.55 43.31 96.55 96.55S227.12 258 173.88 258zm66.78-96.55c0 36.64-29.82 66.44-66.47 66.44-22.37 0-43.1-11.15-55.45-29.83-2.43-3.68-1.42-8.64 2.26-11.08 3.68-2.43 8.64-1.42 11.08 2.26 9.38 14.19 25.13 22.66 42.12 22.66 27.84 0 50.48-22.63 50.48-50.46s-22.65-50.46-50.48-50.46c-21.38 0-40.11 13.56-47.31 32.91l7.89-4.44c3.84-2.17 8.72-.8 10.89 3.04 2.17 3.85.8 8.72-3.04 10.89l-22.9 12.9a8 8 0 0 1-3.92 1.03c-.72 0-1.45-.1-2.15-.3a7.985 7.985 0 0 1-4.81-3.78l-12.9-22.93A8.002 8.002 0 0 1 99 129.41c3.85-2.16 8.72-.8 10.89 3.05l2.55 4.54c9.84-24.76 34.12-42 61.77-42 36.64.01 66.45 29.81 66.45 66.45z"
                                                            opacity="1"
                                                            data-original="#ff5633"
                                                            class=""
                                                        ></path>
                                                    </g>
                                                </svg>
                                                5 Days Returnable
                                            </div>
                                            <ul class="Policy-return-list">
                                                <li>Return &amp; exchange window for this product is open for 5 days post delivery.</li>
                                                <li>Product to be returned in original packaging including external box with all the tags.</li>
                                                <li>Products cannot be exchanged or returned once used.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     @php
                    $discountType = (float) $product->selling_price;
                    $buyingPrice = (float) $product->buying_price;
                    $savings = $buyingPrice - $discountType;
                    $discountPercentage = ($buyingPrice > 0 && $savings > 0) ? (($savings / $buyingPrice) * 100) : 0;
                @endphp
                    <div class="col-md-5">
                        <div class="detail-head">
                            <h4 class="title">{{ @$product->name }}</h4>
                            <div class="price-box">
                                <p class="price-text">{{ $discountType }} <del>{{ $buyingPrice }}</del></p>
                                <span class="off-tag">{{ $discountPercentage }} OFF</span>
                            </div>
                            <small>Inclusive of all taxes</small>
                        </div>
                        <div class="deal-off-day mt-4">
                            <span class="offer-img">
                                <img src="assets/img/blink_new.gif" />
                                Check best offers for you
                            </span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="14"
                                height="14"
                                x="0"
                                y="0"
                                viewBox="0 0 451.847 451.847"
                                style="enable-background: new 0 0 512 512;"
                                xml:space="preserve"
                                class=""
                            >
                                <g>
                                    <path
                                        d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                        fill="#000000"
                                        opacity="1"
                                        data-original="#000000"
                                    ></path>
                                </g>
                            </svg>
                        </div>
                   
                        <div class="select-box mt-2">
                                 @foreach ($productvariants as $variant)
                     <!-- Add code by mohit -->
                     @php
                        $hasMain = collect($variant['variant_values'])->where('is_main', 1)->isNotEmpty();
                        $activeValue = collect($variant['variant_values'])->first(function ($val) {
                           return $val['is_main'] == 1;
                        }) ?? $variant['variant_values'][0] ?? null;
                     @endphp

                           <div class="variant-box">
                           <h5>
                              {{ $variant['variant_name'] }}: <span id="selected-value-{{ $variant['id'] }}"> {{ $activeValue ? $activeValue['name'] : '' }} </span>
                           </h5>
                           <ul class="variant-list">
                              @foreach ($variant['variant_values'] as $k=>$value)
                                 @php
                                       $type = $variant['variant_type'];
                                       $color = $value['color_code'];
                                       $name = $value['name'];
                                       $image = $value['image'] ? asset('uploads/products/'.$value['image']) : asset('img/no-image.jpg');
                                       $variantName = $variant['variant_name'];

                                       $isActive = ($hasMain && $value['is_main'] == 1) || (!$hasMain && $k == 0);
                                 @endphp
                  
                                 <li 
                                       data-id="{{ $variant['id'] }}"
                                       data-type="{{ $variantName }}"
                                       data-value="{{ $name }}"
                                       data-vid="{{ $value['variant_value_id'] }}"
                                       data-ptype="{{ $type }}"
                                       onclick="selectVariant(this)"
                                       title="{{ $name }}"
                                       class="s-variant {{ $isActive ? 'active' : '' }}
                                          {{ in_array($type, [1,3,5]) ? 'variant-round' : '' }}
                                          {{ in_array($type, [2,4,6]) ? 'variant-rectangle' : '' }}
                                          {{ in_array($type, [5,6]) ? 'variant-name' : '' }}"
                                       
                                       style="
                                          {{ in_array($type, [1,2]) ? 'background-color:' . $color . ';' : '' }}
                                          {{ in_array($type, [3,4]) ? 'background-image:url(' . $image . '); background-size:cover;' : '' }}"
                                 >
                                       @if (in_array($type, [5,6]))
                                          {{ $name }}
                                       @elseif ($variantName != 'Color' && in_array($type, [1,2]))
                                          <div>{{ $name }}</div>
                                       @endif
                                 </li>


                              @endforeach
                           </ul>
                     </div>
                  @endforeach
                    <div class="mt-4 add-product-sec shop-d-box">
                     <h4>Quantity
                     </h4>
                     <div class="input-number-container">
                        <span class="input-number-decrement">-</span><input class="input-number quantityInput" type="text" value="1" min="{{$product->min_selling_units?$product->min_selling_units:0}}" max="{{$product->max_selling_units?$product->max_selling_units:10}}"><span class="input-number-increment">+</span>
                    </div>
                  </div>
                        </div>
                        <div class="select-box mt-1">
                            <h5>Select Size</h5>
                            <ul class="size-list">
                                <li>
                                    <span class="disable-size"><del>XS</del></span>
                                </li>
                                <li><span>S</span></li>
                                <li><span>M</span></li>
                                <li><span>L</span></li>
                                <li>
                                    <span class="disable-size"><del>XL</del></span>
                                </li>
                                <li>
                                    <span class="disable-size"><del>XXL</del></span>
                                </li>
                                <li class="size-chart">Size Chart</li>
                            </ul>
                        </div>
                        <div class="btn-action add-btn-box mt-4">
                             <button type="button"
                        class="addToCartBtn add-to-cart-btn solid-btn detail-cart-btn me-3"
                        style="margin-right:30px;"
                        {{(!empty($productDetails->isProductAddedIntoCart)) ? 'disabled' : ''}}>
                        {{(!empty($productDetails->isProductAddedIntoCart)) ? 'Go to cart' : 'Add to Cart'}}
                     </button>
                            <button type="submit" name="add" class="buy-now-btn me-3">
                                Buy Now
                            </button>
                            <span class="wishlist-icon sm-box">
                                <i class="fa-regular fa-heart"></i>
                            </span>
                        </div>
                        <hr />
                        <div class="select-box mt-4">
                            <h5>All Avaiable Offers</h5>
                            <div class="order-qoutes">
                                <h4>Orders more than 10 Items? <i class="fa-solid fa-boxes-packing"></i></h4>
                                <span>Contact us for dedicated support and special pricing.</span>
                                <a href="" data-bs-toggle="modal" data-bs-target="#get-quote">Get Quote</a>
                            </div>
                        </div>
                        <hr />
                        <div class="locate-sec select-box">
                            <h5><i class="fa-solid fa-location-dot"></i> &nbsp;Check Delivery Time</h5>
                            <div class="locate-form">
                                <input type="text" name="" placeholder="302012" class="form-control" />
                                <button class="btn">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20"
                                        height="20"
                                        x="0"
                                        y="0"
                                        viewBox="0 0 469.333 469.333"
                                        style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve"
                                        class=""
                                    >
                                        <g>
                                            <path
                                                d="M234.667 149.333c-47.147 0-85.333 38.187-85.333 85.333S187.52 320 234.667 320 320 281.813 320 234.667s-38.187-85.334-85.333-85.334zm190.72 64C415.573 124.373 344.96 53.76 256 43.947V0h-42.667v43.947C124.373 53.76 53.76 124.373 43.947 213.333H0V256h43.947c9.813 88.96 80.427 159.573 169.387 169.387v43.947H256v-43.947C344.96 415.573 415.573 344.96 425.387 256h43.947v-42.667h-43.947zM234.667 384c-82.453 0-149.333-66.88-149.333-149.333s66.88-149.333 149.333-149.333S384 152.213 384 234.667 317.12 384 234.667 384z"
                                                fill="#ffffff"
                                                opacity="1"
                                                data-original="#000000"
                                                class=""
                                            ></path>
                                        </g>
                                    </svg>
                                    Locate
                                </button>
                            </div>
                            <p>
                                <svg
                                    class="me-2"
                                    xmlns="http://www.w3.org/2000/svg"
                                    version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20"
                                    height="20"
                                    x="0"
                                    y="0"
                                    viewBox="0 0 512 512"
                                    style="enable-background: new 0 0 512 512;"
                                    xml:space="preserve"
                                    class=""
                                >
                                    <g>
                                        <path
                                            d="M386.689 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269c0 17.797-14.473 32.269-32.269 32.269zM166.185 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269c17.791 0 32.269 14.473 32.269 32.269 0 17.797-14.473 32.269-32.269 32.269zM430.15 119.675a16.143 16.143 0 0 0-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"
                                            fill="#fc2424"
                                            opacity="1"
                                            data-original="#000000"
                                            class=""
                                        ></path>
                                        <path
                                            d="M216.202 353.345h122.084v32.269H216.202zM117.781 353.345H61.849c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134 0-8.912-7.223-16.134-16.135-16.134zM508.612 254.709l-31.736-40.874a16.112 16.112 0 0 0-12.741-6.239H346.891V94.655c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.773V223.73c0 8.912 7.223 16.134 16.134 16.134h125.478l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134V264.605c0-3.582-1.194-7.067-3.388-9.896zM116.706 271.597H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.133-16.134zM153.815 208.134H16.134C7.223 208.134 0 215.357 0 224.269s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135z"
                                            fill="#fc2424"
                                            opacity="1"
                                            data-original="#000000"
                                            class=""
                                        ></path>
                                        <path
                                            d="M180.168 144.672H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.134-16.134z"
                                            fill="#fc2424"
                                            opacity="1"
                                            data-original="#000000"
                                            class=""
                                        ></path>
                                    </g>
                                </svg>
                                Get it by <b>9:00PM on Mon, 30th Dec</b>
                            </p>
                        </div>
                        <hr />
                        <div class="delevery-step">
                            <li>
                                <figure>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="50"
                                        height="50"
                                        x="0"
                                        y="0"
                                        viewBox="0 0 512.002 512.002"
                                        style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve"
                                        class=""
                                    >
                                        <g>
                                            <circle
                                                cx="149.996"
                                                cy="346.001"
                                                r="50"
                                                style="fill-rule: evenodd; clip-rule: evenodd; stroke-width: 20; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;"
                                                transform="rotate(-25.671 149.991 345.99)"
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                fill="none"
                                                stroke="#fc2424"
                                                stroke-width="20"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-miterlimit="22.9256"
                                                data-original="#000000"
                                                class=""
                                                opacity="1"
                                            ></circle>
                                            <path
                                                d="M149.993 346.001H150"
                                                style="fill-rule: evenodd; clip-rule: evenodd; stroke-width: 20; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;"
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                fill="none"
                                                stroke="#fc2424"
                                                stroke-width="20"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-miterlimit="22.9256"
                                                data-original="#000000"
                                                class=""
                                                opacity="1"
                                            ></path>
                                            <circle
                                                cx="402.006"
                                                cy="346.001"
                                                r="50"
                                                style="fill-rule: evenodd; clip-rule: evenodd; stroke-width: 20; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;"
                                                transform="rotate(-19.898 402.064 346.003)"
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                fill="none"
                                                stroke="#fc2424"
                                                stroke-width="20"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-miterlimit="22.9256"
                                                data-original="#000000"
                                                class=""
                                                opacity="1"
                                            ></circle>
                                            <path
                                                d="M402.002 346.001h.007M397.014 151.001v75h84.987c11.792 0 20 8.458 20 20v110h-49.496m18.361-131.407-33.855-78.593h-79.999m-5.005 160v-190H70.003l-20 240h49.496m339.082-45h58.421m-145.496 45H200.499m-145.497-45h58.172m73.65 0h178.607M79.089 262.251H10M149.089 213.501H40M104.089 164.751H25M186.133 164.751h-37.044M212.611 213.501h-18.522"
                                                style="fill-rule: evenodd; clip-rule: evenodd; stroke-width: 20; stroke-linecap: round; stroke-linejoin: round; stroke-miterlimit: 22.9256;"
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                fill="none"
                                                stroke="#fc2424"
                                                stroke-width="20"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-miterlimit="22.9256"
                                                data-original="#000000"
                                                class=""
                                                opacity="1"
                                            ></path>
                                        </g>
                                    </svg>
                                </figure>
                                <span>Free Delivery</span>
                            </li>
                            <li>
                                <figure>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="35"
                                        height="35"
                                        x="0"
                                        y="0"
                                        viewBox="0 0 120 120"
                                        style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve"
                                        class=""
                                    >
                                        <g>
                                            <g data-name="Layer 2">
                                                <path
                                                    d="M120 60A59.895 59.895 0 1 1 .21 60a4 4 0 0 1 8 0 51.946 51.946 0 1 0 5.395-23.105h8.364a4 4 0 0 1 0 8H4a4 4 0 0 1-4-4V21.791a4 4 0 0 1 8 0v8.623A59.875 59.875 0 0 1 120 60zM56 79.514V63.677C46.882 62.191 40 55.727 40 48s6.882-14.19 16-15.678V28a4 4 0 0 1 8 0v4.322C73.118 33.81 80 40.273 80 48a4 4 0 0 1-8 0c0-3.406-3.394-6.387-8-7.514v15.836C73.118 57.81 80 64.273 80 72s-6.882 14.19-16 15.677V92a4 4 0 0 1-8 0v-4.323C46.882 86.191 40 79.727 40 72a4 4 0 0 1 8 0c0 3.406 3.394 6.387 8 7.514zm8-15.028v15.028c4.606-1.127 8-4.108 8-7.514s-3.394-6.387-8-7.514zm-8-8.972V40.486c-4.606 1.127-8 4.108-8 7.514s3.394 6.387 8 7.514z"
                                                    data-name="refund"
                                                    fill="#fc2424"
                                                    opacity="1"
                                                    data-original="#000000"
                                                    class=""
                                                ></path>
                                            </g>
                                        </g>
                                    </svg>
                                </figure>
                                <span>7 days Refund</span>
                            </li>
                            <li>
                                <figure>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="35"
                                        height="35"
                                        x="0"
                                        y="0"
                                        viewBox="0 0 32 32"
                                        style="enable-background: new 0 0 512 512;"
                                        xml:space="preserve"
                                        class=""
                                    >
                                        <g>
                                            <path
                                                d="M25.846 28.356h-.476a1 1 0 0 1 0-2h.476a3.153 3.153 0 0 0 3.153-3.153V9.074a3.15 3.15 0 0 0-.923-2.228l-1.567-1.567a3.154 3.154 0 0 0-2.23-.924H7.72c-.836 0-1.638.332-2.23.924L3.922 6.847a3.152 3.152 0 0 0-.923 2.229v14.126a3.153 3.153 0 0 0 3.153 3.153h13.477v2H6.153A5.153 5.153 0 0 1 1 23.202V9.076a5.15 5.15 0 0 1 1.51-3.644l1.567-1.567a5.158 5.158 0 0 1 3.645-1.509h16.559a5.15 5.15 0 0 1 3.642 1.509l1.567 1.568a5.154 5.154 0 0 1 1.509 3.644v14.126a5.153 5.153 0 0 1-5.153 5.153z"
                                                fill="#fc2424"
                                                opacity="1"
                                                data-original="#000000"
                                                class=""
                                            ></path>
                                            <path
                                                d="M1.999 6.356h28v2h-28zM18.052 29.707a1 1 0 0 1 0-1.414l.928-.928-.928-.928a1 1 0 0 1 1.414-1.414l1.815 1.815a.745.745 0 0 1 0 1.054l-1.815 1.815a.999.999 0 0 1-1.414 0zM8.081 22.165c-1.459-.259-2.452-1.64-2.452-3.122v-3.258c0-1.884.995-3.265 2.456-3.523a3.004 3.004 0 0 1 3.544 2.952v.437a1 1 0 0 1-2 0v-.437a1.001 1.001 0 0 0-2 0v4a1.001 1.001 0 0 0 2 0v-.258a1 1 0 0 1 2 0v.258a3.004 3.004 0 0 1-3.548 2.951zM15.999 22.213c-1.654 0-3-1.346-3-3v-4c0-1.654 1.346-3 3-3s3 1.346 3 3v4c0 1.654-1.346 3-3 3zm0-8c-.552 0-1 .449-1 1v4a1.001 1.001 0 0 0 2 0v-4c0-.551-.448-1-1-1zM22.906 22.213h-.27a2.265 2.265 0 0 1-2.265-2.265v-5.471a2.264 2.264 0 0 1 2.264-2.264h.272a3.464 3.464 0 0 1 3.464 3.464v3.071a3.465 3.465 0 0 1-3.465 3.465zm.071-2c.77 0 1.394-.624 1.394-1.394v-3.213c0-.77-.624-1.394-1.394-1.394a.606.606 0 0 0-.606.606v4.787c0 .335.272.606.606.606z"
                                                fill="#fc2424"
                                                opacity="1"
                                                data-original="#000000"
                                                class=""
                                            ></path>
                                        </g>
                                    </svg>
                                </figure>
                                <span>Cash On Delivery</span>
                            </li>
                        </div>
                        <div class="product-custome-sec">
                            <h5>Product Review By Customers</h5>
                            <ul class="rating-review">
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                            </ul>
                            <a class="write-btn-review">Write a review</a>
                            <div class="write-review" style="display: none;">
                                <div class="product-custome-sec">
                                    <h5>Product Rating</h5>
                                    <ul class="rating-review">
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                        <li><i class="fa-regular fa-star"></i></li>
                                    </ul>
                                    <div class="review-box">
                                        <div class="form-group">
                                            <label>Review Title</label>
                                            <input type="text" name="" class="form-control" placeholder="Give your review a title" class="Give your review a title" />
                                        </div>
                                        <div class="form-group">
                                            <label>Review (5000)</label>
                                            <textarea class="form-control" placeholder="Write your comments here"></textarea>
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <button class="btn">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="40"
                                                    height="40"
                                                    x="0"
                                                    y="0"
                                                    viewBox="0 0 64 64"
                                                    style="enable-background: new 0 0 512 512;"
                                                    xml:space="preserve"
                                                    class=""
                                                >
                                                    <g>
                                                        <path
                                                            d="M56 47.6V56c0 1.1-.4 2.1-1.2 2.8S53.1 60 52 60H12c-.5 0-1-.1-1.5-.3s-.9-.5-1.3-.9-.7-.8-.9-1.3-.3-1-.3-1.5v-8.4c0-.6.5-1.1 1.1-1.1h1.8c.6 0 1.1.5 1.1 1.1V56h40v-8.4c0-.6.5-1.1 1.1-1.1h1.8c.6 0 1.1.5 1.1 1.1z"
                                                            fill="#000000"
                                                            opacity="1"
                                                            data-original="#000000"
                                                            class=""
                                                        ></path>
                                                        <path
                                                            d="m52.5 26.1-1.3 1.3c-.4.4-1.1.4-1.5 0l-2.9-2.9c-.1 0-.1-.1-.2-.2L34 11.7v36.5c0 .6-.5 1.1-1.1 1.1h-1.8c-.6 0-1.1-.5-1.1-1.1V11.7L17.4 24.3c0 .1-.1.1-.1.2l-2.9 2.9c-.4.4-1.1.4-1.5 0l-1.3-1.3c-.4-.4-.4-1.1 0-1.5l.4-.6 2.4-2.4 1.2-1.2 3-3 3.9-3.9 4.1-4.1L30 6c1.2-1.2 2.6-1.4 4 0l2.8 2.8 4.1 4.1L45 17l3.2 3.2 1.4 1.4L52 24l.5.5c.5.5.5 1.2 0 1.6z"
                                                            fill="#000000"
                                                            opacity="1"
                                                            data-original="#000000"
                                                            class=""
                                                        ></path>
                                                    </g>
                                                </svg>
                                            </button>
                                            <input type="file" name="myfile" />
                                        </div>
                                        <p class="bottom-text">
                                            We’ll only contact you about the review you left, and only if necessary. By submitting your review, you agree to Vaaree’s <a href="#">terms and conditions</a> and <a href="#">privacy policy</a>
                                        </p>
                                        <div class="btn-group">
                                            <button class="border-fill me-2">Submit Review</button>
                                            <button class="border-btn">Cancel Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 recent-product-sec">
                        <h3>Recent products</h3>
                        <section class="women-seller women-seller-slider">
                            <div class="owl-carousel owl-theme" id="women-seller-slider">
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens1.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens6.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                        </figure>
                                        <div class="color-choose">
                                            <div>
                                                <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                <label for="red"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                <label for="blue"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                <label for="black"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens6.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens5.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                        </figure>
                                        <div class="color-choose">
                                            <div>
                                                <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                <label for="red"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                <label for="blue"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                <label for="black"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens5.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens4.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                        </figure>
                                        <div class="color-choose">
                                            <div>
                                                <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                <label for="red"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                <label for="blue"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                <label for="black"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens4.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens3.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                            <div class="color-choose">
                                                <div>
                                                    <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                    <label for="red"><span></span></label>
                                                </div>
                                                <div>
                                                    <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                    <label for="blue"><span></span></label>
                                                </div>
                                                <div>
                                                    <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                    <label for="black"><span></span></label>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens3.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens2.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                        </figure>
                                        <div class="color-choose">
                                            <div>
                                                <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                <label for="red"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                <label for="blue"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                <label for="black"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="product-card">
                                        <figure>
                                            <img src="assets/img/womens2.webp" alt="Product 1" class="default-image" />
                                            <img src="assets/img/womens1.webp" alt="Product 1 Hover" class="hover-image" />
                                            <span class="icon-top">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon-icon-P1l"
                                                >
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </span>
                                        </figure>
                                        <div class="color-choose">
                                            <div>
                                                <input data-image="red" type="radio" id="red" name="color" value="red" checked />
                                                <label for="red"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="blue" type="radio" id="blue" name="color" value="blue" />
                                                <label for="blue"><span></span></label>
                                            </div>
                                            <div>
                                                <input data-image="black" type="radio" id="black" name="color" value="black" />
                                                <label for="black"><span></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <p>Georgette Flared Lehenga Choli with Embroidery</p>
                                        <div class="price-btn-sec d-flex ">
                                            <div class="product-color">
                                                <ul>
                                                    <li class="price">₹8,999</li>
                                                    <li class="full-price">₹11,999</li>
                                                </ul>
                                                <span class="Discount">25% off</span>
                                            </div>
                                            <div class="add-cart-btn ms-4">
                                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
               $(document).ready(function() {
                  // On "Add to Cart" button click
                  $('.addToCartBtn').on('click', function(e) {
                     e.preventDefault();
                     var quantity = parseInt($('.quantityInput').val()) || 1;
                     var productName = "{{ $product->name }}";
                     var productImage = "{{ str_replace('/public', '', $product->image) }}";
                     var productId = {{ $product->id }};
                     var productWeight = "{{ $product->weight }}";
                     var productWeightType = "{{ $product->weight_type }}";
                     // var fullPrice = {{ $product->buying_price }};
                     var activeVariant = $('.variant-list .active');
                     var selectedVid = activeVariant.attr('data-vid');
                     var priceTag = $('.price-tag');
                     var discountedPrice = parseFloat(priceTag.clone().children().remove().end().text().replace(/[^\d]/g, ''));
                     var originalPrice = parseFloat(priceTag.find('del').text().replace(/[^\d]/g, '') || discountedPrice);
                     console.log(discountedPrice);
                     console.log(originalPrice);
                     // Safe checks for size, color, and pattern
                     var selectedSizeEl = $('li[data-type="Size"].active');
                     var selectedColorEl = $('li[data-type="Color"].active');
                     var selectedPatternEl = $('li[data-type="Pattern"].active');

                     var selectedSize = selectedSizeEl.length ? selectedSizeEl.attr('data-value') : null;
                     var selectedColor = selectedColorEl.length ? selectedColorEl.attr('data-value') : null;
                     var selectedPattern = selectedPatternEl.length ? selectedPatternEl.attr('data-value') : null;

                     // Get background image from selected color element if exists
                     var colorImageUrl = productImage;
                     if (selectedColorEl.length) {
                        var bgImg = selectedColorEl.css('background-image');
                        var match = /url\(["']?([^"')]+)["']?\)/.exec(bgImg);
                        if (match) {
                           colorImageUrl = match[1];
                        }
                     }

                     // If size variant is required, validate it
                     if ($('li[data-type="Size"]').length && !selectedSize) {
                        alert("Please select a size.");
                        return;
                     }

                     // Build final product data object
                     var productData = {
                        name: productName,
                        quantity: quantity,
                        size: selectedSize,
                        color: selectedColor,
                        pattern: selectedPattern,
                        // price: productPrice,
                        price: discountedPrice,
                        image: colorImageUrl,

                        productId: productId,
                        weight: productWeight,
                        weightType: productWeightType,
                        productVariantId: selectedVid,
                        originalPrice: originalPrice
                     };

                     var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                     var existingItemIndex = cartItems.findIndex(function(item) {
                        return item.name === productData.name &&
                              item.size === productData.size &&
                              item.color === productData.color &&
                              item.pattern === productData.pattern;
                     });

                     if (existingItemIndex > -1) {
                        cartItems[existingItemIndex].quantity = 
                           parseInt(cartItems[existingItemIndex].quantity) + parseInt(productData.quantity);
                     } else {
                        cartItems.push(productData);
                     }

                     localStorage.setItem('cartItems', JSON.stringify(cartItems));
                     var notRequiredQtyAjaxClickonQtyBtn = true;
                     console.log('seventh');
                     displayCartItems(notRequiredQtyAjaxClickonQtyBtn);
                     $('.modal-overlay, #productModal').fadeIn();
                  });

                  $('.close-modal').on('click', function () {
                     $('#productModal, .modal-overlay').hide();
                  });

                  $('.modal-overlay').on('click', function () {
                     $('#productModal, .modal-overlay').hide();
                  });

                  // Remove individual product block
                  $(document).on('click', '.close-product', function() {
                     var index = $(this).data('index');
                     var cartItems = JSON.parse(localStorage.getItem('cartItems'));
                     cartItems.splice(index, 1);
                     localStorage.setItem('cartItems', JSON.stringify(cartItems));
                     var notRequiredQtyAjaxClickonQtyBtn = true;
                     displayCartItems(notRequiredQtyAjaxClickonQtyBtn);
                  });

                  $('#view-bag').on('click', function() {
                     window.location.href = '/cart';
                  });

                  $('#checkout').on('click', function() {
                     window.location.href = '/checkoutBag';
                  });

                  function displayCartItems(notRequiredQtyAjaxClickonQtyBtn) {
                     var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                     var productListContainer = $('#productListContainer').find('ul');

                     productListContainer.empty();

                     cartItems.forEach(function(item, index) {
                        var productHTML = `
                           <li class="d-flex align-items-start mb-3">
                              <img src="${item.image}" alt="Item Image" style="width: 100px; height: auto;" class="me-3">
                              <div class="item-details w-100">
                                 <div class="item-title"><h5>${item.name}</h5></div>
                                 <div class="item-info text-sm">Quantity: ${item.quantity}</div>
                                 ${item.size ? `<div class="item-info text-sm">Size: ${item.size}</div>` : ''}
                                 ${item.pattern ? `<div class="item-pattern text-sm">Pattern: ${item.pattern}</div>` : ''}
                                 ${item.color ? `<div class="item-price text-sm">Color: ${item.color}</div>` : ''}
                                 <div class="item-price text-sm">Price: ₹${item.price * item.quantity}</div>
                                 <div class="item-actions d-flex justify-content-between mt-2">
                                    <button class="btn btn-outline-secondary btn-sm">
                                       <i class="fas fa-heart me-1"></i>Buy later
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm close-product" ...>
                                       <i class="fas fa-times me-1"></i>Remove
                                    </button>
                                 </div>
                              </div>
                           </li>
                           <hr>
                        `;
                        productListContainer.append(productHTML);
                     });
                  }

                  // Display cart items when modal is opened
                  if (localStorage.getItem('cartItems')) {
                     displayCartItems();
                  }
               });
            </script>
            
<script>
      const selectedValues = {}; 
      function updateSelectedDisplay() {
         let output = "";
         for (const [type, value] of Object.entries(selectedValues)) {
            output += `<span>${type}: ${value}</span> `;
         }   
      }
    </script>



<script>
function initCustomSlider(images = []) {
   if (!images.length) return;

   const mainImage = document.getElementById("main-image");
   const thumbnailRow = document.querySelector(".thumbnail-row");

   // Clear old thumbnails
   thumbnailRow.innerHTML = "";

   // Set the first image as default
   mainImage.src = images[0].graphic;

   images.forEach((img, index) => {
      const thumb = document.createElement("img");
      thumb.src = img.graphic;
      thumb.classList.add("thumbnail");
      if (index === 0) thumb.classList.add("active");

      thumb.addEventListener("click", () => {
         document.querySelectorAll(".thumbnail-row img").forEach(i => i.classList.remove("active"));
         thumb.classList.add("active");
         mainImage.src = img.graphic;
      });

      thumbnailRow.appendChild(thumb);
   });
}
</script>
@endsection
