@extends('front.layouts.app')
@section('content')

<!-- CSS Files -->
<link rel="shortcut icon" href="{{ asset('assets/front/cartdesign/img/favicon.png') }}" type="image/x-icon" />
<link href="{{ asset('assets/front/cartdesign/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/cartdesign/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/cartdesign/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/cartdesign/css/helper.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/cartdesign/css/plugins.css') }}" rel="stylesheet">
<link href="{{ asset('assets/front/cartdesign/css/style.css') }}" rel="stylesheet">
<!-- Banner -->
<section class="banner-section">
    <div class="banner-inner">
        <div class="container">
            <div class="banner-text">
                <h1>My Cart</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="my-cart section-space">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="offer-for-you">
                    <div class="offer-head">
                        <h3>Offers for you</h3>
                        <a id="total_offers"></a>
                    </div>
                    <div id="static_offers">

                    </div>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="locate-sec select-box">
                    <h5><i class="fa-solid fa-location-dot"></i> &nbsp;Check Delivery</h5>
                    <div class="locate-form w-100">
                        <input type="text" name=""id="pincodeInput" placeholder="302012" class="form-control" />
                        <button class="btn" onclick="calculateDelivery()">
                            Check
                        </button>
                    </div>
                     <p id="delivery_time">
                        
                    </p>
                </div>
                 <div class="gift-sec">
                    <div class="icon_del">
                        <img src="{{ asset('assets/front/img/delivery_cart.png')}}" alt="img">
                    </div>
                    <div class="right_icon_txt">
                        <h4>Free Delivery Above ₹300</h4>
                        <p>Valid on all orders</p>
                    </div>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sub-title-main mb-4">
                <h2 class="sub-title">My Cart</h2>
            </div>
            <div class="col-md-8">
                <div class="my-cart-inner productListContainer" id="productListContainer">

                </div>
            </div>
            <div class="col-md-4 my-cart-r total-cart">
                <!--<div class="total-cart">-->
                    <!-- <div class="sale-info">
                        <p>HO HO Home Sale! You're Saving ₹10,765 today!</p>
                    </div> -->
                    <!--<div class="special-gift">-->
                    <!--    <figure>-->
                    <!--        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"-->
                    <!--            xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0"-->
                    <!--            viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;" xml:space="preserve"-->
                    <!--            class="">-->
                    <!--            <g>-->
                    <!--                <path fill="#ffc73b"-->
                    <!--                    d="M455.813 511.66H56.18c-10.47 0-18.953-8.484-18.953-18.953v-305.59H474.77v305.59c0 10.469-8.489 18.953-18.957 18.953zm0 0"-->
                    <!--                    opacity="1" data-original="#ffc73b" class=""></path>-->
                    <!--                <path fill="#efb025" d="M37.227 187.117H474.77v63.59H37.227zm0 0" opacity="1"-->
                    <!--                    data-original="#efb025" class=""></path>-->
                    <!--                <path fill="#ffc73b"-->
                    <!--                    d="M512 120.824v78.781c0 8.415-6.828 15.23-15.242 15.23H15.23c-8.414 0-15.23-6.815-15.23-15.23v-78.78c0-8.415 6.816-15.231 15.23-15.231h481.528c8.414 0 15.242 6.816 15.242 15.23zm0 0"-->
                    <!--                    opacity="1" data-original="#ffc73b" class=""></path>-->
                    <!--                <path fill="#efb025"-->
                    <!--                    d="M238.594 141.813a457.06 457.06 0 0 0-9.77 11.765 441.723 441.723 0 0 0-32.539 46.285 455.11 455.11 0 0 0-8.762 14.973H83.683a534.603 534.603 0 0 1 19.926-40.484 535.69 535.69 0 0 1 44.649-68.758 537.045 537.045 0 0 1 12.23-15.418c2.5-3.055 5.043-6.067 7.621-9.067l28.426 24.485c1.469 1.258 2.938 2.531 4.403 3.793 11.187 9.633 22.375 19.261 33.558 28.906 1.371 1.164 2.73 2.348 4.098 3.52zM393.527 214.836H289.68a435.15 435.15 0 0 0-8.762-14.973 443.478 443.478 0 0 0-32.54-46.285 474.393 474.393 0 0 0-9.784-11.766c1.37-1.171 2.73-2.347 4.101-3.519 11.196-9.645 22.383-19.285 33.567-28.906 1.468-1.262 2.937-2.535 4.406-3.793 9.477-8.164 18.957-16.32 28.426-24.485a491.79 491.79 0 0 1 7.62 9.059 514.988 514.988 0 0 1 12.231 15.426 536.583 536.583 0 0 1 44.657 68.758 534.602 534.602 0 0 1 19.925 40.484zm0 0"-->
                    <!--                    opacity="1" data-original="#efb025" class=""></path>-->
                    <!--                <g fill="#ff4440">-->
                    <!--                    <path-->
                    <!--                        d="M255.992 141.82a442.767 442.767 0 0 0-9.773 11.762 441.945 441.945 0 0 0-32.54 46.29 444.229 444.229 0 0 0-60.593 167.41c-13.121-17.403-25.23-36.231-36.125-56.364-19.164 12.5-37.895 26.797-55.93 42.883a537.293 537.293 0 0 1 59.977-179.446 536.07 536.07 0 0 1 56.875-84.175 505.65 505.65 0 0 1 7.62-9.067c10.946 9.426 21.884 18.852 32.833 28.278 11.184 9.632 22.371 19.261 33.559 28.906 1.367 1.164 2.726 2.348 4.097 3.523zM450.96 353.8c-18.034-16.085-36.765-30.382-55.929-42.882-10.894 20.133-23.004 38.96-36.125 56.363a444.162 444.162 0 0 0-60.594-167.41 443.114 443.114 0 0 0-32.539-46.289 475.516 475.516 0 0 0-9.78-11.762c1.366-1.175 2.726-2.351 4.097-3.523 11.195-9.645 22.383-19.285 33.57-28.906 10.945-9.438 21.895-18.852 32.828-28.278a491.794 491.794 0 0 1 7.621 9.059 536.115 536.115 0 0 1 56.887 84.183 537.448 537.448 0 0 1 59.965 179.446zm0 0"-->
                    <!--                        fill="#ff4440" opacity="1" data-original="#ff4440" class=""></path>-->
                    <!--                    <path d="M215.234 141.82h81.528v73.016h-81.528zm0 0" fill="#ff4440" opacity="1"-->
                    <!--                        data-original="#ff4440" class=""></path>-->
                    <!--                </g>-->
                    <!--                <path fill="#ea2f2f"-->
                    <!--                    d="m390.996 174.355-92.683 25.516a443.114 443.114 0 0 0-32.54-46.289l-5.683-15.285-4.098-11.024 37.668-17.882 40.45-19.22a536.115 536.115 0 0 1 56.886 84.184zm0 0"-->
                    <!--                    opacity="1" data-original="#ea2f2f" class=""></path>-->
                    <!--                <path fill="#ea2f2f"-->
                    <!--                    d="m255.992 127.273-4.097 11.024-5.676 15.285a441.945 441.945 0 0 0-32.54 46.29l-92.671-25.517a536.07 536.07 0 0 1 56.875-84.175l40.453 19.21zm0 0"-->
                    <!--                    opacity="1" data-original="#ea2f2f" class=""></path>-->
                    <!--                <path fill="#ff4440"-->
                    <!--                    d="M403.914 3.543 255.996 73.789l28.414 76.418 157.883-43.457c20.648-5.684 31.992-27.844 24.527-47.918l-13.03-35.039c-7.462-20.074-30.528-29.438-49.876-20.25zM108.078 3.543l147.918 70.246-28.414 76.418L69.703 106.75c-20.648-5.684-31.992-27.844-24.527-47.918l13.027-35.039C65.668 3.719 88.73-5.645 108.078 3.543zm0 0"-->
                    <!--                    opacity="1" data-original="#ff4440" class=""></path>-->
                    <!--                <path fill="#ea2f2f"-->
                    <!--                    d="M291.316 104.5a8.138 8.138 0 0 1-6.875-3.762 8.149 8.149 0 0 1 2.473-11.258c1.121-.714 27.762-17.668 58.348-30.039 44.093-17.836 73.539-16.879 87.508 2.844a8.15 8.15 0 0 1-1.942 11.367 8.15 8.15 0 0 1-11.363-1.941c-18.938-26.734-97.676 14.836-123.766 31.508a8.124 8.124 0 0 1-4.383 1.281zM219.871 104.5a8.124 8.124 0 0 1-4.383-1.281C189.398 86.547 110.66 44.977 91.723 71.71a8.155 8.155 0 0 1-11.368 1.941 8.154 8.154 0 0 1-1.937-11.367c13.969-19.722 43.41-20.68 87.508-2.844 30.586 12.368 57.226 29.325 58.347 30.04a8.153 8.153 0 0 1 2.477 11.257 8.155 8.155 0 0 1-6.879 3.762zm0 0"-->
                    <!--                    opacity="1" data-original="#ea2f2f" class=""></path>-->
                    <!--                <path fill="#ea2f2f"-->
                    <!--                    d="M279.191 47.523h-46.39c-12.696 0-22.989 10.293-22.989 22.993v67.394c0 12.7 10.293 22.992 22.989 22.992h46.39c12.696 0 22.989-10.293 22.989-22.992V70.516c0-12.7-10.293-22.993-22.989-22.993zm0 0"-->
                    <!--                    opacity="1" data-original="#ea2f2f" class=""></path>-->
                    <!--                <path fill="#ff4440" d="M215.234 214.836h81.528V511.66h-81.528zm0 0" opacity="1"-->
                    <!--                    data-original="#ff4440" class=""></path>-->
                    <!--                <path fill="#ea2f2f" d="M215.234 214.836h81.528v35.871h-81.528zm0 0" opacity="1"-->
                    <!--                    data-original="#ea2f2f" class=""></path>-->
                    <!--            </g>-->
                    <!--        </svg>-->
                    <!--        <span>Make this order special</span>-->
                    <!--    </figure>-->
                    <!--    <a class="arrow-gift" data-bs-toggle="modal" data-bs-target="#gift-wrap">Free Gift Wrap <i class="fa-solid fa-arrow-right"></i></a>-->
                    <!--</div>-->
                    <div class="flate-off">
                        <!--<div class="flate-off-l"></div> -->
                        <div class="apply-field mb-3">
                            <input type="text" id="coupon_code_input" placeholder="Enter your coupan code" class="form-control">
                            <button class="field-btn" id="apply-coupon-btn">Apply</button>
                        </div>
                        <!--<div class="flate-off-bottom">-->
                        <!--    <a class="apply-btn view-more-link" data-bs-target="#view-coupon" data-bs-toggle="modal">Apply</a>-->
                        <!--    <div class="view-more-link"><a href="javascript:void('0')" data-bs-toggle="modal"-->
                        <!--            data-bs-target="#view-coupon">More Offers/Coupons</a></div>-->
                        <!--</div>-->
                    </div>
                    <a href="javascript:void('0')" data-bs-toggle="modal" data-bs-target="#view-coupon">
                        <div class="gift-sec1">
                            <div class="icon_del1">
                                <img src="https://vasvi.in/assets/front/img/dis_icon1.png" alt="img">
                            </div>
                            <div class="right_icon_txt1">
                                <h4>Coupons And Offers</h4>
                                <p class="offer-available">5 Offers Available</p>
                            </div>
                        </div>
                    </a>
                    <!-- <div class="use-wallet">
                        <div class="use-wallet-l">
                            <h4>Use Vasvi Wallet</h4>
                            <p>Login to redeem a Gift card and use wallet balance</p>
                        </div>
                        <a class="login-link">Login</a>
                    </div> -->
                   
                        <div class="total-bill-sec">
                                <h4>Price Details</h4>
                                <ul class="total-list">
                                    <li>
                                        <span>Item MRP</span>
                                        <p id="subTotal"> ₹0</p>
                                    </li>
                                    <li>
                                        <span>Coupon Discount </span>
                                        <p class="text-green" id="couponDiscount"><del>₹70.00</del></p>
                                    </li>
                                    <li>
                                        <span>Delivery Charges</span>
                                        <p class="text-green" id="delivery">FREE</p>
                                    </li>
                                    <li>
                                        <hr />
                                    </li>
                                    <li>
                                        <span><b>Total Payable</b> (Tax Included)</span>
                                        <p><b class="finalAmount">₹0</b></p>
                                    </li>
                                </ul>
                            </div>

                            <button type="button" class="checkoutButton btn_place_order">Place Order</button>

                   
                <!--</div>-->
            </div>
        </div>


        @if(count($bestproduct) > 0)
        <!--Best Sellers Products-->
        <div class="col-md-12 mt-5 recent-product-sec">
            <h3>Best Sellers Products</h3>
            <section class="women-seller custom-seller-slider women-seller-slider" id="best-seller">
                <div class="owl-carousel owl-theme" id="best-seller-slider">
                    @foreach($bestproduct as $products)
                    <?php
                   
                        $graphics = $products->product_main_images->where('status', 1);
                        
                        $frontImage = $graphics->Where('is_front', 1)->first();
                        
                        $backImage = $graphics->firstWhere('is_back', 1);
                        $fallbackImages = $graphics->pluck('graphic')->take(2);
                        
                        $firstImage = $frontImage? $frontImage->graphic: ($fallbackImages->get(0) ?? null);
                       
                        $secondImage = $backImage? $backImage->graphic: ($fallbackImages->get(1) ?? $firstImage);
                       ?>


                    <div class="item">
                        <div class="product-card">
                            <figure>
                                  <a href="{{ route('front-product.detail',['sku' =>$products->sku, 'slug' => productSlug($products->short_description)])}}">
                                    <img src="{{ $firstImage ? asset('uploads/products/' . $firstImage) : asset('img/no-image.jpg') }}"
                                        alt="{{ $products->name }}" class="default-image">
                                    <img src="{{ $secondImage ? asset('uploads/products/' . $secondImage) : asset('img/no-image.jpg') }}"
                                        alt="{{ $products->name }} Hover" class="hover-image">
                                </a>
                                <span class="icon-top addtoWishList" data-product-id="{{ $products->id }}">
                                    @if(isset($isWishlisted[0]))
                                    <i
                                        class="{{ in_array($products->id, $isWishlisted) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                    @else
                                    <i class="fa-regular fa-heart"></i>
                                    @endif
                                </span>
                            </figure>
                            @if(isset($products->productVariants))
                            
                            <div class="color-choose">

                                @foreach($products->productVariants as $productVariantsValue)
                                @foreach($productVariantsValue->variantValues as $variantValue)
                                @if($variantValue->variant_value->variant_id == 1)
                                <div>
                                    <input data-image="{{ strtolower($variantValue->variant_value->name) }}"
                                        type="radio" id="{{ strtolower($variantValue->variant_value->name) }}"
                                        name="color" value="{{ strtolower($variantValue->variant_value->name) }}"
                                        checked />
                                    <label
                                        for="{{ strtolower($variantValue->variant_value->name) }}"><span></span></label>

                                </div>
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="bottom-content">
                            <p>{{ $products->name }}</p>
                            <div class="price-btn-sec d-flex ">
                                <div class="product-color">
                                    <ul>
                                        <li class="price">{{ $products->selling_price}}</li>
                                        @if ($products->discount_type == 'flat' || $products->discount_type ==
                                        'percentage')
                                        <li class="full-price">{{ $products->buying_price }}</li>
                                        @endif
                                    </ul>

                                    {!! \App\Helpers\Attributes::productDiscountMsg($products) !!}
                                </div>

                                <div class="add-cart-btn ms-4">
                                    <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To
                                        Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </section>
        </div>
        @endif
    </div>


    <div class="modal fade flip-modal view-coupon" id="view-coupon" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Offer & Coupon Codes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                
                </div>
                
                <div class="modal-body">
                    <div class="apply-field mt-4 mb-4">
                        <input type="text" id="coupon_code_input" placeholder="Enter your coupan code"
                            class="form-control" />
                        <button class="field-btn" id="apply-coupon-btn">Apply</button>
                    </div>
                    <span class="coupon_error error"></span>
                    
                    <div class="offer_coupon_view">
                                    <div class="accordion accordion-flush" id="all_coupons">
                    </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
displayCartItems();
$('#apply-coupon-btn').click(function() {
    var couponCode = $('#coupon_code_input').val();
    applyCoupon(couponCode);
});

$(document).on('click', '.coupon-apply', function() {
    var couponCode =  $(this).data('code');
    applyCoupon(couponCode);
});

$(document).on('click', '.checkoutButton', function() {
    if (isLoggedIn) {
        window.location.href = "{{ route('front-product.checkoutBag') }}";
    } else {
        $('.login-sign-modal').modal('show'); // Bootstrap modal
    }
});

localStorage.removeItem('coupon_id');
localStorage.removeItem('coupon_discount');
getCoupon();
function applyCoupon(couponCode){
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    let subTotal = 0;
    cartItems.forEach(function(item) {
        subTotal += item.price * item.quantity;
    });
    
    $.post("{{ route('apply.coupon') }}", {
        coupon_code:couponCode,
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
            localStorage.setItem('coupon_discount',response.discount);
            $('#view-coupon').modal('hide');
            priceCalculation();
        } else {
            showFlashMessage(response.message,'error');
            $(".coupon_error").html(response.message)
             setTimeout(() => {
                $(".coupon_error").html("")
            }, 3000);
        }
    });
}

   document.getElementById('pincodeInput').addEventListener('input', function () {
        // Allow only numbers
        this.value = this.value.replace(/\D/g, '');
            if (this.value.length === 6) {
            calculateDelivery();
        }
    });

    function calculateDelivery() {
        const deliveryTimeEl = document.getElementById('delivery_time');
    
        const today = new Date();
        today.setDate(today.getDate() + 7); // 7 days ahead
    
        const options = { weekday: 'short', day: 'numeric', month: 'short' };
        const formattedDate = today.toLocaleDateString('en-US', options);
    
        const svgImage = `<svg
            class="me-2"
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 512 512"
            style="enable-background: new 0 0 512 512;"
            xml:space="preserve">
            <g>
                <path d="M386.689 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269c0 17.797-14.473 32.269-32.269 32.269zM166.185 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269c17.791 0 32.269 14.473 32.269 32.269 0 17.797-14.473 32.269-32.269 32.269zM430.15 119.675a16.143 16.143 0 0 0-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"
                    fill="#fc2424"></path>
                <path d="M216.202 353.345h122.084v32.269H216.202zM117.781 353.345H61.849c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134 0-8.912-7.223-16.134-16.135-16.134zM508.612 254.709l-31.736-40.874a16.112 16.112 0 0 0-12.741-6.239H346.891V94.655c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.773V223.73c0 8.912 7.223 16.134 16.134 16.134h125.478l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134V264.605c0-3.582-1.194-7.067-3.388-9.896zM116.706 271.597H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.133-16.134zM153.815 208.134H16.134C7.223 208.134 0 215.357 0 224.269s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135z"
                    fill="#fc2424"></path>
                <path d="M180.168 144.672H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.134-16.134z"
                    fill="#fc2424"></path>
            </g>
        </svg>`;
    
        // Set the content
        deliveryTimeEl.innerHTML = `${svgImage} Get it by <b>9:00 PM on ${formattedDate}</b>`;
    }
    
        
    $(function () { // Best Sellers Products
        const $s = $("#best-seller-slider"), c = $s.find(".item").length > 4;
        if($s.find(".item").length > 4){ $('#best-seller').removeClass('custom-seller-slider'); }
        
        $s.owlCarousel({
            loop: c,
            nav: c,
            margin: 10,
            autoplay: false,
            responsive: {
                0: { items: 1 },
                600: { items: 3 },
                1000: { items: c ? 4 : $s.find(".item").length }
            }
        });
    });
   
</script>
@endpush