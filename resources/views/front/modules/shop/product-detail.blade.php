@extends('front.layouts.app')
@section('content')

    
    <script>
        var getVarient = "{{ route('variant.combination.prices') }}";
        window.csrfToken = "{{ csrf_token() }}";
        const maxSellingUnits = {{ $product?->max_selling_units ?? 10 }};
        const minSellingUnit = {{ $product?->min_selling_units ?? 1 }};
        const minStockLimit = {{ $product?->min_stock_limit ?? 1 }};
        let maxQtyLimit = maxSellingUnits;
    </script>
    @push('body-class')
        product-details-page
    @endpush
    <section class="site-content">
        <div class="offer-banner">
            <div class="offer-banner-content">
                <span class="offer-highlight">UPTO 70% OFF</span>
                <span class="offer-divider">|</span>
                <span class="offer-delivery">FREE DELIVERY AVAILABLE</span>
            </div>
        </div>
        <div class="page-banner-section">
            <div class="page-banner">
                <div class="container">
                    <div class="page-banner-wrap">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb-items">
                                <li class="breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                                @if (!empty($productcat))
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('category.show', ['path' => $productcat->slug]) }}">{{ $productcat->name }}</a>
                                    </li>
                                @endif
                                @if (!empty($productSubCat))
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('category.show', ['path' =>$productcat->slug.'/'.$productSubCat->slug]) }}">{{ $productSubCat->name }}</a>
                                    </li>
                                @endif
                                @if (!empty($productChildCat))
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('category.show', ['path' =>$productcat->slug.'/'.$productSubCat->slug.'/'.$productChildCat->slug]) }}">{{ $productChildCat->name }}</a>
                                    </li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- page-banner-section -->
        <div class="content-wrapper">
            <div class="content-area">
                <div id="{{ $product->id }}" class="single-product-details">
                    <div class="single-product-imagesummery">
                        <div class="container">
                            <div class="single-product-details-wrap">
                                <div class="single-product-details-left">
                                    <?php
                                    if ($product->product_type == 1) {
                                        $firstImage = getActiveFrontImg($product->id, $product->id);
                                        $secondImage = getActiveBackImg($product->id, $product->id);
                                    } else {
                                        $activeVarientId = activeVarientByProductId($product->id);
                                        $firstImage = getActiveFrontImg($product->id, $activeVarientId);
                                        $secondImage = getActiveBackImg($product->id, $activeVarientId);
                                    }
                                    
                                    if ($product->product_type == 2) {
                                        $priceData = getPriceByActiveVarientId($product->id, $activeVarientId);
                                        $buying_price = $priceData['buying_price'];
                                        $selling_price = $priceData['selling_price'];
                                        $discount_product = $buying_price - $selling_price;
                                        $productImages = getActiveVarientImg($product->id, $activeVarientId);
                                    } else {
                                        $buying_price = $product->buying_price;
                                        $selling_price = $product->selling_price;
                                        $discount_product = $buying_price - $selling_price;
                                        $productImages = getActiveVarientImg($product->id, $product->id);
                                    }
                                    
                                    $discountText = '';
                                    
                                    if (!empty($product->discount) && !empty($product->discount_type)) {
                                        if ($product->discount_type == 'percentage') {
                                            $discountText = $product->discount . '% Off';
                                        }
                                        if ($product->discount_type == 'flat') {
                                            $discountText = '₹' . $product->discount . 'Off';
                                        }
                                    }
                                    
                                    ?>
                                    <div class="product-gallery">
                                        <div class="product-gallery-area product-gallery-with-images">
                                            <!-- Main Slider -->
                                            <div class="product-gallery">
                                                <div class="product-main-slider">
                                                    @foreach($product->product_main_images as $img)
                                                        <div class="product-slide" data-variant-id="{{ $img->variant_id }}">
                                                            <img src="{{ asset('uploads/products/'.$img->graphic) }}"
                                                                alt="Product 1">
                                                        </div>  
                                                    @endforeach 
                                                </div>

                                                <div class="product-thumb-slider">
                                                    @foreach($product->product_main_images as $img)
                                                    <div class="thumb" data-variant-id="{{ $img->variant_id }}">
                                                        <img src="{{ asset('uploads/products/'.$img->graphic) }}"
                                                            alt="">
                                                    </div>
                                                    @endforeach 
                                                </div>
                                            </div>

                                            <!-- Popup Gallery -->
                                            <div class="gallery-popup">
                                                <button class="gallery-close">&times;</button>
                                                <div class="popup-gallery-wrap">

                                                    <!-- Popup Main Slider -->
                                                    <div class="popup-main-slider">
                                                    @foreach($product->product_main_images as $img)
                                                        <div class="popup-slide" data-variant-id="{{ $img->variant_id }}">
                                                            <img src="{{ asset('uploads/products/'.$img->graphic) }}"
                                                                alt="">
                                                        </div>
                                                    @endforeach     
                                                </div>

                                                    <!-- Popup Thumbnail Slider -->
                                                    <div class="popup-thumb-slider">
                                                        @foreach($product->product_main_images as $img)
                                                            <div class="popup-thumb" data-variant-id="{{ $img->variant_id }}">
                                                                <img src="{{ asset('uploads/products/'.$img->graphic) }}"
                                                                    alt="">
                                                            </div>
                                                        @endforeach     
                                                 </div>
                                                </div>

                                                <div class="zoom-controls">
                                                    <button type="button" class="zoom-minus">−</button>
                                                    <button type="button" class="zoom-plus">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-product-details-right">
                                    <div class="summary single-product-summary">
                                        <div class="single-product-headwishlist">
                                            <div class="single-product-head">
                                                <h1 class="single-product-title">{{ $product->name ?? '' }}</h1>
                                                <p class="single-product-subtitle">{{ $product->short_description ?? '' }}
                                                </p>
                                            </div>
                                            <div class="single-wishlist-btn">
                                                <span class="icon-top addtoWishList"
                                                    data-product-id="{{ $product->id }}">
                                                    @if (isset($isWishlisteddata))
                                                        <i
                                                            class="{{ in_array($product->id, $isWishlisteddata) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                                    @else
                                                        <i class="fa-regular fa-heart"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>


                                        <div class="single-product-price">
                                            <del id="pdpStrikedMrp">₹ {{ floor($buying_price) }}</del>
                                            <ins id="productPrice">₹ {{ floor($selling_price) }}</ins>
                                            <span class="single-product-priceoff"
                                                id="discountShow">{{ $discountText }}</span>
                                        </div>

                                        <div class="single-product-summarycart">
                                            <form class="variations-form addcart" action="#" method="post">
                                                <div class="single-product-attribute">
                                                    @if ($productvariants)
                                                        @foreach ($productvariants as $variant)
                                                            @php
                                                                $hasMain = collect($variant['variant_values'])
                                                                    ->where('is_main', 1)
                                                                    ->isNotEmpty();
                                                                $activeValue =
                                                                    collect($variant['variant_values'])->first(
                                                                        fn($val) => $val['is_main'] == 1,
                                                                    ) ??
                                                                    ($variant['variant_values'][0] ?? null);
                                                            @endphp

                                                            <div class="attribute-item">
                                                                <div class="attribute-title">
                                                                    <p>{{ $variant['variant_name'] }}</p>
                                                                </div>
                                                                <div class="attribute-wrap">
                                                                    <ul class="attribute-menu attribute-color">
                                                                        @foreach ($variant['variant_values'] as $k => $variantValue)
                                                                            @php
                                                                                $isActive = false;
                                                                                $image = $variantValue['image'] ? asset('uploads/products/' . $variantValue['image'],): asset('img/no-image.jpg');
                                                                                $type = $variant['variant_type'];
                                                                                $color = $variantValue['color_code'];
                                                                                $name = $variantValue['name'];
                                                                                $variantName = $variant['variant_name'];
                                                                                $isActive = ($hasMain && $variantValue['is_main'] ==1) ||(!$hasMain && $k == 0);
                                                                            @endphp
                                                                            <li data-productId = "{{ $variant['product_id'] }}"
                                                                                data-id="{{ $variantValue['id'] }}"
                                                                                data-type="{{ $variant['variant_name'] }}"
                                                                                data-value="{{ $variantValue['name'] }}"
                                                                                data-vid="{{ $variantValue['variant_value_id'] }}"
                                                                                onclick="selectVariant(this); checkVariantStock(this);updateVariantSpecification(this); updateVariantImages({{ $variantValue['variant_value_id'] }})"
                                                                                class="s-variant activeVarientLi {{ $isActive ? 'active' : '' }}"
                                                                                style="padding:5px; cursor: pointer;">
                                                                                <input class="attribute-input"
                                                                                    name="color"
                                                                                    id="color_brown{{ $variantValue['id'] }}"
                                                                                    value="{{ $variantValue['id'] }}"
                                                                                    type="radio">
                                                                                <div class="pro_img">
                                                                                    <img src="{{ $image }}"
                                                                                        alt="{{ $variantValue['name'] }}">
                                                                                </div>
                                                                                <p style="margin-top:5px;margin-bottom:5px">
                                                                                    {{ $variantValue['name'] }}</p>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="quantity-addcart-button">
                                                    <div class="quantity">
                                                        <label for="quantity"><strong>Qty :</strong></label>
                                                        <div class="quantity-group">
                                                            <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                            <input type="text" id="quantity" class="input-text qty"
                                                                name="quantity" value="1" maxlength="50">
                                                            <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="product-summary-button">
                                                    <!--span class="varient_less_than_min_qty_notice"></span-->
                                                    @if ($product->in_stock == '1')
                                                        <button type="button" name="add"
                                                            class="btn btn-primary detail-cart-btn me-3 addToCartBtn addToCartText"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-producttype="{{ $product->product_type }}"
                                                            data-sku="{{ $product->sku }}"
                                                            data-price="{{ $buying_price }}"
                                                            data-salePrice="{{ $selling_price }}"
                                                            data-discountType="Flat"
                                                            data-discount="{{ $discount_product }}"
                                                            data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                                            Add To Cart
                                                        </button>
                                                    @endif
                                                    @if ($product->in_stock == '1')
                                                        <button type="button"
                                                            class="buy_now_button btn btn-primary buy-now-btn me-3 checkoutButton btn_place_order"
                                                            id="buy_now_auto_add_to_cart" data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-producttype="{{ $product->product_type }}"
                                                            data-sku="{{ $product->sku }}"
                                                            data-price="{{ $buying_price }}"
                                                            data-salePrice="{{ $selling_price }}"
                                                            data-discountType="Flat"
                                                            data-discount="{{ $discount_product }}"
                                                            data-image = "{{ $product->images['first'] }}"
                                                            data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">Buy
                                                            Now</button>
                                                    @endif
                                                </div> --}}
                                                <div class="product-action-buttons">

                                                    <button type="button" class="add-cart-btn addToCartBtn addToCartText" data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-producttype="{{ $product->product_type }}"
                                                            data-sku="{{ $product->sku }}"
                                                            data-price="{{ $buying_price }}"
                                                            data-salePrice="{{ $selling_price }}"
                                                            data-discountType="Flat"
                                                            data-discount="{{ $discount_product }}"
                                                            data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                                        <span class="btn-icon">
                                                            <span class="material-symbols-outlined">shopping_bag</span>
                                                        </span>
                                                        <span class="btn-text">Add to Cart</span>
                                                    </button>

                                                    <button type="button" class="buy-now-btn" id="buy_now_auto_add_to_cart" data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-producttype="{{ $product->product_type }}"
                                                            data-sku="{{ $product->sku }}"
                                                            data-price="{{ $buying_price }}"
                                                            data-salePrice="{{ $selling_price }}"
                                                            data-discountType="Flat"
                                                            data-discount="{{ $discount_product }}"
                                                            data-image = "{{ $product->images['first'] }}"
                                                            data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                                        <span class="btn-text">Buy Now</span>
                                                        <span class="btn-icon">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </span>
                                                    </button>

                                                </div>
                                            </form>
                                            <div class="delevery-main-txt">
                                                <p class="delevery-txt-head">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M22.5 11.25H16.5V7.5H20.4922C20.6421 7.5 20.7886 7.54491 20.9127 7.62895C21.0368 7.71298 21.1329 7.83228 21.1886 7.97146L22.5 11.25Z"
                                                            stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M1.5 13.5H16.5" stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M17.625 20.25C18.8676 20.25 19.875 19.2426 19.875 18C19.875 16.7574 18.8676 15.75 17.625 15.75C16.3824 15.75 15.375 16.7574 15.375 18C15.375 19.2426 16.3824 20.25 17.625 20.25Z"
                                                            stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M6.375 20.25C7.61764 20.25 8.625 19.2426 8.625 18C8.625 16.7574 7.61764 15.75 6.375 15.75C5.13236 15.75 4.125 16.7574 4.125 18C4.125 19.2426 5.13236 20.25 6.375 20.25Z"
                                                            stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path d="M15.375 18H8.625" stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M4.125 18H2.25C2.05109 18 1.86032 17.921 1.71967 17.7803C1.57902 17.6397 1.5 17.4489 1.5 17.25V6.75C1.5 6.55109 1.57902 6.36032 1.71967 6.21967C1.86032 6.07902 2.05109 6 2.25 6H16.5V16.0514"
                                                            stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M16.5 16.0514V11.25H22.5V17.25C22.5 17.4489 22.421 17.6397 22.2803 17.7803C22.1397 17.921 21.9489 18 21.75 18H19.875"
                                                            stroke="#333333" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg> Check delivery &amp; assembly details
                                                </p>
                                                <div class="gghg">
                                                    <div class="delevery-box">
                                                        <input type="text" class="delivery-input"
                                                            placeholder="Enter Pincode" maxlength="6" value="">
                                                        <button type="button" class="btn-check-txt">CHECK</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="save-extra-offers">
                                                <h5>Save Extra with Below Offers</h5>
                                                <div class="save-extra-offers-txt">
                                                    {{-- <div class="extra-offers">
                                                        <div class="extra-offers-inner">
                                                            <p class="extra-txt-easy">Easy EMI<i
                                                                    class="fa-solid fa-circle-arrow-right"></i></p>
                                                        </div>
                                                        <div class="extra-inne-price">Get it for ₹608/m</div>
                                                    </div> --}}

                                                    <div class="diwali-banner">

                                                        <div class="demand-label">
                                                            Extended On Demand
                                                        </div>

                                                        <div class="diwali-heading">
                                                            <span>Why</span>
                                                            <span class="wait-text">Wait</span>
                                                            <span>for Diwali Sale</span>
                                                        </div>

                                                        <div class="offer-circle">
                                                            <strong>Upto 70% Off +</strong>
                                                            <strong>20% Cashback</strong>

                                                            <span class="offer-line"></span>

                                                            <strong>Free Shipping</strong>
                                                        </div>

                                                        <div class="offer-bar">

                                                            <div class="offer-content">
                                                                <strong>FLAT Rs. 1,000 OFF</strong>
                                                                <span>On Min. Purchase Of Rs. 5,999</span>
                                                            </div>

                                                            <div class="coupon-box">
                                                                <span>Use Code:</span>
                                                                <input type="text" value="WWFD1K" class="coupon-inp">
                                                                <div class="circle1"></div>
                                                                <div class="circle2"></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="product-benefit-summery">
                                                <ul class="product-benefit-items">
                                                    <li>
                                                        <div class="product-benefit-wrap">
                                                            <div class="product-benefit-icon"><img
                                                                    src="{{ asset('assets/front/tejap/images/icon-return.svg') }}"
                                                                    alt="" /></div>
                                                            <p class="product-benefit-title">15 Day Returns</p>
                                                        </div>
                                                    </li>
                                                    <li><span class="product-benefit-wrap">
                                                            <div class="product-benefit-icon"><img
                                                                    src="{{ asset('assets/front/tejap/images/icon-free-shipping.svg') }}"
                                                                    alt=""></div>
                                                            <p class="product-benefit-title">Free Shipping</p>
                                                        </span></li>
                                                    <li>
                                                        <div class="product-benefit-wrap">
                                                            <div class="product-benefit-icon"><img
                                                                    src="{{ asset('assets/front/tejap/images/icon-money-bag.svg') }}"
                                                                    alt=""></div>
                                                            <p class="product-benefit-title">Safe & Payment</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="right-specification-txt" id="productSpecificationBox" style="display:none">
                                                <h5 class="spec-pro-txt">Product Specifications</h5>
                                                <div id="productSpecificationContent"></div>
                                               
                                            </div>

                                            {{-- <div class="product-share">
                                                <p>Share On : </p>
                                                <div class="product-share-icon">
                                                    <a class="facebook" href="{{ $facebook->value }}" target="_blank"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                    <a class="twitter" href="{{ $instagram->value }}" target="_blank"><i
                                                            class="fab fa-twitter"></i></a>
                                                    <a class="whatsapp" href="{{ $pinterst->value }}" target="_blank"><i
                                                            class="fab fa-whatsapp"></i></a>
                                                    <a class="envelope" href="{{ $youtube->value }}" target="_blank"><i
                                                            class="far fa-envelope"></i></a>
                                                </div>
                                            </div> --}}

                                            <div class="need-help-txt">
                                                <h5>Need Help in Buying?</h5>
                                                <div class="cursor-pointer">
                                                    <a class="need-anchor" href="tel:+91-9314444747">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="46"
                                                            height="46" viewBox="0 0 46 46" fill="none">
                                                            <path
                                                                d="M15.2709 5.6611L10.5099 8.92314L8.95806 12.7848L10.8182 20.6051L15.7377 29.8273L23.5137 37.0923L28.8301 39.7462L32.3391 38.7412L35.0458 37.5862L36.4477 34.5269L34.4905 31.6703L31.0785 27.7116L29.4739 27.4118L25.6651 30.0214L24.8628 29.8716L22.7557 27.8173L19.3438 23.8586L17.0339 18.4451L19.2381 15.5357L21.2924 13.4286L20.1375 10.7219L16.8755 5.96089L15.2709 5.6611Z"
                                                                fill="white"></path>
                                                            <path
                                                                d="M12.3203 26.3553C14.7331 30.6652 18.041 34.4132 22.0227 37.3486C23.8152 38.738 25.8547 39.7774 28.0339 40.412C28.1882 40.4408 28.3314 40.4816 28.4857 40.5104C29.249 40.6766 30.0394 40.6746 30.8013 40.5044C31.5633 40.3342 32.2785 40.0001 32.8968 39.5254C32.9093 39.5175 32.9206 39.5078 32.9302 39.4966C33.4225 39.1065 33.9355 38.7431 34.4671 38.4081C34.8367 38.1677 35.2155 37.9151 35.582 37.6532C35.975 37.4142 36.3129 37.0951 36.5736 36.717C36.8343 36.3388 37.012 35.9099 37.095 35.4585C37.1781 35.007 37.1646 34.543 37.0555 34.0968C36.9464 33.6506 36.7441 33.2322 36.4618 32.869L33.197 28.1232C32.9621 27.7373 32.6501 27.4035 32.2805 27.1426C31.9109 26.8817 31.4915 26.6992 31.0484 26.6065C30.5988 26.5348 30.1395 26.5534 29.6975 26.6611C29.2556 26.7689 28.8398 26.9636 28.4746 27.2339L25.641 29.1674C25.4443 28.9996 25.2382 28.844 25.0429 28.7061C24.8141 28.5387 24.5939 28.3599 24.3832 28.1703C22.3646 26.2499 20.6723 24.0156 19.3726 21.5548C18.7381 20.4145 18.2578 19.1956 17.9442 17.93C18.6773 17.4814 19.376 17.0001 20.0506 16.5266C20.2892 16.3579 20.5345 16.1905 20.7798 16.0231C21.1701 15.7794 21.5079 15.4608 21.7734 15.0858C22.039 14.7108 22.227 14.2869 22.3268 13.8386C22.398 13.3828 22.3763 12.9171 22.2631 12.4695C22.1499 12.0219 21.9474 11.6015 21.6677 11.2333L20.0491 8.88047C19.8586 8.60367 19.6805 8.33615 19.4999 8.06294C19.1437 7.52791 18.771 6.97757 18.3932 6.47347C18.1475 6.09819 17.8294 5.77529 17.4574 5.52362C17.0853 5.27194 16.6669 5.09652 16.2263 5.00758C15.3264 4.86113 14.4051 5.0718 13.6601 5.59443L10.7029 7.61676C9.64943 8.31973 8.88963 9.3815 8.56573 10.6034C8.1356 12.4066 8.11285 14.283 8.4991 16.0972C9.16288 19.7117 10.4561 23.1834 12.3203 26.3553ZM10.1665 11.0423C10.3909 10.1964 10.9189 9.46237 11.6504 8.97893L14.5953 6.97528C14.9766 6.69562 15.4522 6.57452 15.9218 6.63752C16.1489 6.6914 16.3628 6.79036 16.5508 6.9285C16.7387 7.06664 16.8969 7.24111 17.0156 7.44146C17.3862 7.93722 17.7259 8.44818 18.0945 8.9925C18.2781 9.26804 18.4686 9.54484 18.6564 9.8264L20.2821 12.1788C20.4349 12.3684 20.5485 12.5862 20.6164 12.8197C20.6842 13.0533 20.7048 13.2978 20.6772 13.5392C20.6158 13.7743 20.5082 13.9949 20.3607 14.1881C20.2131 14.3814 20.0285 14.5435 19.8176 14.6651C19.5722 14.8325 19.3256 15.0067 19.0803 15.1741C18.343 15.6831 17.651 16.1657 16.9043 16.6118L16.8641 16.6392C16.6263 16.781 16.4392 16.9936 16.3289 17.247C16.2186 17.5003 16.1907 17.7819 16.2492 18.0521C16.2454 18.0724 16.2565 18.0884 16.2598 18.1083C16.6007 19.5914 17.1531 21.0185 17.9 22.346C19.2854 24.9692 21.0934 27.3485 23.2519 29.3888C23.5046 29.6167 23.769 29.8313 24.0443 30.0315C24.2731 30.1989 24.4932 30.3778 24.7039 30.5673L24.7693 30.6215C24.948 30.7665 25.1595 30.866 25.3854 30.9114C25.5742 30.9406 25.767 30.932 25.9523 30.8862C26.1377 30.8404 26.3121 30.7583 26.4652 30.6447L29.417 28.6231C29.6038 28.4781 29.8176 28.3713 30.046 28.309C30.2745 28.2467 30.5131 28.23 30.7482 28.26C30.9736 28.3155 31.1853 28.4162 31.3704 28.5559C31.5555 28.6957 31.71 28.8716 31.8246 29.0729L35.1018 33.828C35.2612 34.0147 35.3765 34.2348 35.4389 34.4719C35.5014 34.709 35.5094 34.957 35.4625 35.1975C35.4155 35.4379 35.3148 35.6647 35.1677 35.8609C35.0207 36.0571 34.8311 36.2177 34.6131 36.3308C34.2775 36.5775 33.9292 36.8078 33.5593 37.0498C32.984 37.4145 32.4283 37.809 31.8944 38.2316C31.461 38.5633 30.9595 38.7959 30.4255 38.9127C29.8915 39.0296 29.3381 39.0278 28.8045 38.9076C28.6909 38.8864 28.5705 38.8639 28.4679 38.8308C26.4972 38.2486 24.6537 37.3017 23.0341 36.0395C19.2397 33.2469 16.0881 29.6779 13.7913 25.5726C12.0231 22.5628 10.7918 19.2708 10.1521 15.8432C9.79917 14.2612 9.80407 12.6212 10.1665 11.0423Z"
                                                                fill="#1f583a"></path>
                                                        </svg>
                                                        <span class="need-call-txt">Call Us<b>+91-1234567890</b></span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="containSocial-txt">
                                                <h5>Share On</h5>
                                                <div class="containSocial">
                                                    <a href="{{ $facebook->value }}">
                                                         <svg class="facebook-svg" xmlns="http://www.w3.org/2000/svg"
                                                        style="isolation:isolate" viewBox="0 0 400 400" width="400pt"
                                                        height="400pt">
                                                        <circle class="fb-logoCircle" vector-effect="non-scaling-stroke"
                                                            cx="200" cy="200" r="134.28405491"
                                                            fill="#3F51B5" />
                                                        <path
                                                            d="M213.47 304.118h39.881v-95.917h24.737l3.534-31.299h-28.271v-20.193c-.148-5.608 3.467-8.388 10.602-8.582h17.669v-30.29q-8.064-.052-28.271 0c-20.206.052-35.125 11.233-37.357 30.29v28.775h-23.727v31.299h21.203v95.917z"
                                                            fill="#FFF" style="transform: translateX(-30px);" />
                                                        <path class="fb-ring"
                                                            d="M49.716 200c0-82.944 67.34-150.284 150.284-150.284 82.944 0 150.284 67.34 150.284 150.284 0 82.944-67.34 150.284-150.284 150.284-82.944 0-150.284-67.34-150.284-150.284zm6 0c0-79.633 64.651-144.284 144.284-144.284S344.284 120.367 344.284 200 279.633 344.284 200 344.284 55.716 279.633 55.716 200z"
                                                            fill-rule="evenodd" fill="#3F51B5" />
                                                        </svg>
                                                    </a>
                                                   
                                                    <a href="{{ $instagram->value }}">
                                                        <svg class="instagram-svg" xmlns="http://www.w3.org/2000/svg"
                                                        style="isolation:isolate" viewBox="0 0 400 400" width="400pt"
                                                        height="400pt">
                                                        <circle class="ig-logoCircle" vector-effect="non-scaling-stroke"
                                                            cx="200" cy="200" r="134.28405491"
                                                            fill="#A779C6" />
                                                        <path class="ig-ring"
                                                            d="M49.716 200c0-82.944 67.34-150.284 150.284-150.284 82.944 0 150.284 67.34 150.284 150.284 0 82.944-67.34 150.284-150.284 150.284-82.944 0-150.284-67.34-150.284-150.284zm6 0c0-79.633 64.651-144.284 144.284-144.284S344.284 120.367 344.284 200 279.633 344.284 200 344.284 55.716 279.633 55.716 200z"
                                                            fill-rule="evenodd" fill="#A779C6" />
                                                        <path
                                                            d="M168.208 122.817c-24.916 0-45.391 20.447-45.391 45.391v63.584c0 24.916 20.447 45.391 45.391 45.391h63.584c24.916 0 45.391-20.447 45.391-45.391v-63.577c0-24.923-20.447-45.398-45.391-45.398h-63.584zm0 14.034h63.584c8.32-.012 16.302 3.289 22.185 9.172 5.883 5.883 9.184 13.865 9.172 22.185v63.584c.012 8.32-3.289 16.302-9.172 22.185-5.883 5.883-13.865 9.184-22.185 9.172h-63.577c-8.321.013-16.305-3.286-22.19-9.169-5.885-5.883-9.186-13.867-9.174-22.188v-63.577c-.013-8.321 3.286-16.305 9.169-22.19 5.883-5.885 13.867-9.186 22.188-9.174zm73.232 15.352c-1.688-.008-3.31.66-4.503 1.854-1.194 1.193-1.862 2.815-1.854 4.503 0 3.536 2.821 6.357 6.357 6.357 1.69.009 3.313-.657 4.508-1.851 1.195-1.194 1.864-2.817 1.856-4.506.008-1.69-.661-3.312-1.856-4.506-1.195-1.194-2.818-1.86-4.508-1.851zM200 157.9c-23.155 0-42.1 18.945-42.1 42.1s18.945 42.1 42.1 42.1 42.1-18.945 42.1-42.1-18.945-42.1-42.1-42.1zm0 14.034c15.598 0 28.066 12.468 28.066 28.066 0 15.598-12.468 28.066-28.066 28.066-15.598 0-28.066-12.468-28.066-28.066 0-15.598 12.468-28.066 28.066-28.066z"
                                                            fill="#FFF" />
                                                        </svg>    
                                                    </a>
                                                    
                                                    <a href="{{ $twitter->value }}">
                                                        <svg class="twitter-svg" xmlns="http://www.w3.org/2000/svg"
                                                        style="isolation:isolate" viewBox="0 0 400 400" width="400pt"
                                                        height="400pt">
                                                        <circle class="tw-logoCircle" vector-effect="non-scaling-stroke"
                                                            cx="200" cy="200" r="134.28405491"
                                                            fill="#03A9F4" />
                                                        <path
                                                            d="M283.063 148.923c-6.23 2.742-12.832 4.545-19.591 5.353 7.102-4.22 12.431-10.875 14.996-18.728-6.696 3.945-14.016 6.72-21.645 8.203-6.459-6.833-15.457-10.689-24.86-10.653-18.815 0-34.083 15.12-34.083 33.774 0 2.63.304 5.214.881 7.696-27.344-1.332-52.852-14.155-70.234-35.306-9.038 15.454-4.407 35.279 10.543 45.129-5.408-.178-10.699-1.622-15.447-4.217v.397c0 16.379 11.751 30.027 27.324 33.146-2.919.797-5.931 1.202-8.956 1.205-2.201 0-4.347-.249-6.414-.628 4.324 13.39 16.901 23.176 31.828 23.467-14.328 11.119-32.461 16.142-50.468 13.98 15.625 9.911 33.749 15.17 52.253 15.162 62.686 0 96.986-51.474 96.986-96.137 0-1.458-.055-2.921-.129-4.342 6.689-4.75 12.456-10.68 17.016-17.501z"
                                                            fill="#FFF" />
                                                        <path class="tw-ring"
                                                            d="M49.716 200c0-82.944 67.34-150.284 150.284-150.284 82.944 0 150.284 67.34 150.284 150.284 0 82.944-67.34 150.284-150.284 150.284-82.944 0-150.284-67.34-150.284-150.284zm6 0c0-79.633 64.651-144.284 144.284-144.284S344.284 120.367 344.284 200 279.633 344.284 200 344.284 55.716 279.633 55.716 200z"
                                                            fill-rule="evenodd" fill="#03A9F4" />
                                                        </svg>     
                                                    </a>
                                                    
                                                    <a href="{{ $youtube->value }}">
                                                        <svg class="youTube-svg" xmlns="http://www.w3.org/2000/svg"
                                                        style="isolation:isolate" viewBox="0 0 400 400" width="400pt"
                                                        height="400pt">
                                                        <circle class="yt-logoCircle" vector-effect="non-scaling-stroke"
                                                            cx="200" cy="200" r="134.28405491"
                                                            fill="#F4C276" />
                                                        <path class="yt-ring"
                                                            d="M49.716 200c0-82.944 67.34-150.284 150.284-150.284 82.944 0 150.284 67.34 150.284 150.284 0 82.944-67.34 150.284-150.284 150.284-82.944 0-150.284-67.34-150.284-150.284zm6 0c0-79.633 64.651-144.284 144.284-144.284S344.284 120.367 344.284 200 279.633 344.284 200 344.284 55.716 279.633 55.716 200z"
                                                            fill-rule="evenodd" fill="#F4C276" />
                                                        <path
                                                            d="M274.001 161.812c-1.447-8.001-8.35-13.82-16.366-15.639-11.988-2.546-34.18-4.364-58.191-4.364-23.993 0-46.539 1.818-58.545 4.364-8.001 1.819-14.918 7.274-16.366 15.639-1.466 9.092-2.913 21.822-2.913 38.188 0 16.366 1.447 29.096 3.266 38.188 1.466 8.001 8.369 13.82 16.366 15.639 12.73 2.546 34.551 4.364 58.563 4.364 24.011 0 45.832-1.818 58.562-4.364 7.997-1.819 14.9-7.274 16.366-15.639 1.448-9.092 3.266-22.193 3.637-38.188-.742-16.366-2.56-29.096-4.379-38.188zm-94.19 63.647v-50.918L224.182 200l-44.371 25.459z"
                                                            fill="#FFF" />
                                                        </svg>
                                                    </a>
                                                    
                                                    <a href="{{ $pinterst->value }}">
                                                        <svg class="pinterest-svg" xmlns="http://www.w3.org/2000/svg"
                                                        style="isolation:isolate" viewBox="0 0 400 400" width="400pt"
                                                        height="400pt">
                                                        <circle class="pt-logoCircle" vector-effect="non-scaling-stroke"
                                                            cx="200" cy="200" r="134.28405491"
                                                            fill="#FF4B4B" />
                                                        <path class="pt-ring"
                                                            d="M49.716 200c0-82.944 67.34-150.284 150.284-150.284 82.944 0 150.284 67.34 150.284 150.284 0 82.944-67.34 150.284-150.284 150.284-82.944 0-150.284-67.34-150.284-150.284zm6 0c0-79.633 64.651-144.284 144.284-144.284S344.284 120.367 344.284 200 279.633 344.284 200 344.284 55.716 279.633 55.716 200z"
                                                            fill-rule="evenodd" fill="#FF4B4B" />
                                                        <path
                                                            d="M157.254 305.505c-.197-4.003-.172-24.75 14.264-86.676 1.931-20.661-.772-27.984-.772-36.565 0-19.494 10.118-23.591 16.053-23.591 8.408 0 20.049 3.233 20.049 16.824 0 15.546-12.677 19.636-12.677 19.636s-.913 3.979-1.974 15.016c-1.037 11.086 3.374 23.06 21.419 23.06 28.97 0 33.424-40.192 33.424-51.253 0-15.281-11.178-46.294-45.954-46.294-46.361 0-54.338 41.543-54.338 52.623 0 4.732 1.321 13.091 2.215 16.657 8.748 1.419 7.835 13.424 4.096 16.823-4.17 3.733-25.54 8.193-25.54-38.754 0-44.702 39.828-67.738 74.82-67.738 33.282 0 69.551 22.968 69.551 67.232 0 39.501-28.415 70.587-58.225 70.587-17.903 0-27.397-14.744-27.397-14.744 0 13.8-25.374 61.278-28.625 67.306"
                                                            fill="#FFF" />
                                                        </svg>
                                                    </a>
                                                    

                                                    

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                 {{--  <div class="size-chart">
                                        <div class="modal fade" id="sizeModal">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <div class="modal-body p-lg-4">
                                                        <div class="tab-style">
                                                            <div class="tab-header">
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li role="presentation">
                                                                        <button class="active" data-bs-toggle="tab"
                                                                            data-bs-target="#slim" type="button"
                                                                            role="tab"
                                                                            aria-selected="true">Slim</button>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <button data-bs-toggle="tab"
                                                                            data-bs-target="#regular" type="button"
                                                                            role="tab"
                                                                            aria-selected="false">Regular</button>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <button data-bs-toggle="tab"
                                                                            data-bs-target="#measure" type="button"
                                                                            role="tab" aria-selected="false">How to
                                                                            measure</button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div id="slim" class="tab-pane fade show active">
                                                                    <p>Our sizes are engineered for Indian men. Every fit
                                                                        has been iterated &amp; perfected over years of
                                                                        testing,
                                                                        resulting in two base fits: Slim and Regular.</p>

                                                                    <ul class="nav nav-tabs border-0 justify-content-end"
                                                                        role="tablist">
                                                                        <li role="presentation">
                                                                            <button class="active" data-bs-toggle="tab"
                                                                                data-bs-target="#cm" type="button"
                                                                                role="tab"
                                                                                aria-selected="true">cm</button>
                                                                        </li>
                                                                        <li role="presentation">
                                                                            <button data-bs-toggle="tab"
                                                                                data-bs-target="#inches" type="button"
                                                                                role="tab"
                                                                                aria-selected="false">inches</button>
                                                                        </li>
                                                                    </ul>

                                                                    <div class="tab-content">
                                                                        <div id="cm"
                                                                            class="tab-pane fade show active">
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Size</td>
                                                                                        <td>S</td>
                                                                                        <td>M</td>
                                                                                        <td>L</td>
                                                                                        <td>XL</td>
                                                                                        <td>XXL</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Collar</td>
                                                                                        <td>39</td>
                                                                                        <td>40</td>
                                                                                        <td>42</td>
                                                                                        <td>44</td>
                                                                                        <td>45</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Shoulder</td>
                                                                                        <td>45</td>
                                                                                        <td>46</td>
                                                                                        <td>49</td>
                                                                                        <td>51</td>
                                                                                        <td>53</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Chest</td>
                                                                                        <td>95</td>
                                                                                        <td>99</td>
                                                                                        <td>105</td>
                                                                                        <td>111</td>
                                                                                        <td>117</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Waist</td>
                                                                                        <td>85</td>
                                                                                        <td>89</td>
                                                                                        <td>95</td>
                                                                                        <td>101</td>
                                                                                        <td>107</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Front Length</td>
                                                                                        <td>74</td>
                                                                                        <td>77</td>
                                                                                        <td>79</td>
                                                                                        <td>81</td>
                                                                                        <td>83</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div id="inches" class="tab-pane fade">
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Size</td>

                                                                                        <td>S</td>

                                                                                        <td>M</td>

                                                                                        <td>L</td>

                                                                                        <td>XL</td>

                                                                                        <td>XXL</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Collar</td>

                                                                                        <td>15.4</td>

                                                                                        <td>15.7</td>

                                                                                        <td>16.5</td>

                                                                                        <td>17.3</td>

                                                                                        <td>17.7</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Shoulder</td>

                                                                                        <td>17.7</td>

                                                                                        <td>18.1</td>

                                                                                        <td>19.3</td>

                                                                                        <td>20.1</td>

                                                                                        <td>20.9</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Chest</td>

                                                                                        <td>37.4</td>

                                                                                        <td>39</td>

                                                                                        <td>41.3</td>

                                                                                        <td>43.7</td>

                                                                                        <td>46.1</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Waist</td>

                                                                                        <td>33.5</td>

                                                                                        <td>35</td>

                                                                                        <td>37.4</td>

                                                                                        <td>39.8</td>

                                                                                        <td>42.1</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Front Length</td>

                                                                                        <td>29.1</td>

                                                                                        <td>30.3</td>

                                                                                        <td>31.1</td>

                                                                                        <td>31.9</td>

                                                                                        <td>32.7</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <p>
                                                                        All measurements are body measurements.<br>
                                                                        Incase you run between sizes, size up for a relaxed
                                                                        fit or a size down for a snug fit.
                                                                    </p>

                                                                </div>

                                                                <div id="regular" class="tab-pane fade">

                                                                    <p>Our sizes are engineered for Indian men. Every fit
                                                                        has been iterated &amp; perfected over years of
                                                                        testing,
                                                                        resulting in two base fits: Slim and Regular.</p>

                                                                    <ul class="nav nav-tabs border-0 justify-content-end"
                                                                        role="tablist">
                                                                        <li role="presentation">
                                                                            <button class="active" data-bs-toggle="tab"
                                                                                data-bs-target="#cm1" type="button"
                                                                                role="tab"
                                                                                aria-selected="true">cm</button>
                                                                        </li>
                                                                        <li role="presentation">
                                                                            <button data-bs-toggle="tab"
                                                                                data-bs-target="#inches1" type="button"
                                                                                role="tab"
                                                                                aria-selected="false">inches</button>
                                                                        </li>
                                                                    </ul>

                                                                    <div class="tab-content">
                                                                        <div id="cm1"
                                                                            class="tab-pane fade show active">
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Size</td>
                                                                                        <td>S</td>
                                                                                        <td>M</td>
                                                                                        <td>L</td>
                                                                                        <td>XL</td>
                                                                                        <td>XXL</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Collar</td>
                                                                                        <td>39</td>
                                                                                        <td>40</td>
                                                                                        <td>42</td>
                                                                                        <td>44</td>
                                                                                        <td>45</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Shoulder</td>
                                                                                        <td>45</td>
                                                                                        <td>46</td>
                                                                                        <td>49</td>
                                                                                        <td>51</td>
                                                                                        <td>53</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Chest</td>
                                                                                        <td>95</td>
                                                                                        <td>99</td>
                                                                                        <td>105</td>
                                                                                        <td>111</td>
                                                                                        <td>117</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Waist</td>
                                                                                        <td>85</td>
                                                                                        <td>89</td>
                                                                                        <td>95</td>
                                                                                        <td>101</td>
                                                                                        <td>107</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Front Length</td>
                                                                                        <td>74</td>
                                                                                        <td>77</td>
                                                                                        <td>79</td>
                                                                                        <td>81</td>
                                                                                        <td>83</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div id="inches1" class="tab-pane fade">
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Size</td>

                                                                                        <td>S</td>

                                                                                        <td>M</td>

                                                                                        <td>L</td>

                                                                                        <td>XL</td>

                                                                                        <td>XXL</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Collar</td>

                                                                                        <td>15.4</td>

                                                                                        <td>15.7</td>

                                                                                        <td>16.5</td>

                                                                                        <td>17.3</td>

                                                                                        <td>17.7</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Shoulder</td>

                                                                                        <td>17.7</td>

                                                                                        <td>18.1</td>

                                                                                        <td>19.3</td>

                                                                                        <td>20.1</td>

                                                                                        <td>20.9</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Chest</td>

                                                                                        <td>37.4</td>

                                                                                        <td>39</td>

                                                                                        <td>41.3</td>

                                                                                        <td>43.7</td>

                                                                                        <td>46.1</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Waist</td>

                                                                                        <td>33.5</td>

                                                                                        <td>35</td>

                                                                                        <td>37.4</td>

                                                                                        <td>39.8</td>

                                                                                        <td>42.1</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Front Length</td>

                                                                                        <td>29.1</td>

                                                                                        <td>30.3</td>

                                                                                        <td>31.1</td>

                                                                                        <td>31.9</td>

                                                                                        <td>32.7</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <p>
                                                                        All measurements are body measurements.<br>
                                                                        Incase you run between sizes, go a size up for a
                                                                        relaxed fit or a size down for a snug fit.
                                                                    </p>

                                                                </div>

                                                                <div id="measure" class="tab-pane fade">
                                                                    <p>Before you start, you'll need a few essential items:
                                                                    </p>
                                                                    <ol>
                                                                        <li>A flexible measuring tape</li>
                                                                        <li>A mirror and someone to assist you (optional but
                                                                            helpful)</li>
                                                                        <li>Comfortable, form-fitting clothing</li>
                                                                    </ol>
                                                                    <p>(Tap on the indicators below for specific
                                                                        instructions.)</p>
                                                                    <img src="{{ asset('assets/front/tejap/images/tops.webp') }}"
                                                                        alt="" width="300" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('front-user.addReview') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img src="{{ asset('uploads/products/' . $firstImage) }}" alt="{{ $product->name ?? '' }}"
                            class="default-image" style="display:none" />
                    </form>

                    <div class="product-float-section" style="display: none !important;">
                        <div class="container">
                            <div class="product-float-wrapper">
                                <div class="product-float-image">
                                    <img src="{{ asset('uploads/products/' . $firstImage) }}"
                                        alt="{{ $product->name ?? '' }}" />
                                </div>
                                <div class="product-float-title">
                                    {{ $product->name ?? '' }}
                                </div>
                                <div class="product-float-price">
                                    <del>₹ {{ $productVarientCom[0] ? floor($productVarientCom[0]->price) : '' }}</del>
                                    <ins>₹
                                        {{ $productVarientCom[0] ? floor($productVarientCom[0]->selling_price) : '' }}</ins>
                                    <span class="product-float-priceoff">20% OFF</span>
                                </div>
                                <div class="product-float-attribute">
                                    <ul>
                                        <li>Color : <strong class="ms-1">Brown</strong>,</li>
                                        <li>Size : <strong class="ms-1">S</strong></li>
                                    </ul>
                                </div>

                                <div class="product_float_view_list">
                                    <a href="javascript:void(0)" class="btn_view_list" id="cartToggle">
                                        Shopping Bag (1) <svg width="21" fill="#fff" viewBox="0 0 48 48"
                                            xmlns="http://www.w3.org/2000/svg" data-iconid="445596"
                                            data-svgname="Cart shopping">

                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="invisible_box" data-name="invisible box">
                                                    <rect width="48" height="48" fill="none"></rect>
                                                </g>
                                                <g id="icons_Q2" data-name="icons Q2">
                                                    <path
                                                        d="M44.3,10A3.3,3.3,0,0,0,42,9H11.5l-.4-3.4A3,3,0,0,0,8.1,3H5A2,2,0,0,0,5,7H7.2l3.2,26.9A5.9,5.9,0,0,0,7.5,39a6,6,0,0,0,6,6,6.2,6.2,0,0,0,5.7-4H29.8a6.2,6.2,0,0,0,5.7,4,6,6,0,0,0,0-12,6.2,6.2,0,0,0-5.7,4H19.2a6,6,0,0,0-4.9-3.9L14.1,31H39.4a3,3,0,0,0,2.9-2.6L45,12.6A3.6,3.6,0,0,0,44.3,10ZM37.5,39a2,2,0,1,1-2-2A2,2,0,0,1,37.5,39Zm-22,0a2,2,0,1,1-2-2A2,2,0,0,1,15.5,39Zm23-12H13.6L12,13H40.8Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                    <div id="cartPopup" class="cart-overlay">
                                        <div class="cart-modal">
                                            <span class="close-cart">&times;</span>
                                            <div class="widget-shopping-cart">
                                                <p>Shopping bag (<span class="center-main">1</span>)</p>
                                                <ul class="mini-cart productListContainer">
                                                    <li class="mini-cart-item" data-index="0">
                                                        <div class="mini-cart-image">
                                                            <a href="javascript:void(0)"><img
                                                                    src="https://furnishworlds.com/uploads/products/APR2026/variant_11_69db6cd95ba75.jpg"
                                                                    alt="outdoor furniture"></a>
                                                        </div>
                                                        <div class="mini-cart-summery">
                                                            <div class="mini-cart-summerydata">
                                                                <a href="javascript:void(0)"
                                                                    class="mini-cart-title">outdoor furniture</a>
                                                                <p>Quantity : 1</p>
                                                            </div>
                                                            <div class="mini-cart-summeryprice">
                                                                <span class="mini-cart-price">
                                                                    <del>₹ 1499.00</del>
                                                                    <ins>₹ 1499</ins>
                                                                </span>
                                                                <a href="javascript:void('0');" data-index="0"
                                                                    class="remove remove_from_cart_button trash-icon close-product">Remove</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="mini-cart-total">
                                                    <p><strong>Subtotal</strong> <span class="cartTotalPopup">1499</span>
                                                    </p>
                                                </div>
                                                <div class="mini-cart-buttons">
                                                    <a href="https://furnishworlds.com/cart/view"
                                                        class="btn btn-outline-primary">View cart</a>
                                                    <a href="https://furnishworlds.com/checkout"
                                                        class="btn btn-primary checkout">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-float-addtocart">
                                    <a href="{{ env('WEBSITE_URL') . 'cart/view' }}" class="btn btn-outline-primary">View
                                        cart</a>
                                    <a href="{{ env('WEBSITE_URL') . 'checkout' }}"
                                        class="btn btn-primary checkout">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-product-information">
                        <div class="single-product-description">
                            <div class="container">
                                <div class="single-product-tabs">
                                    <div class="product-tab-nav">
                                        @php 
                                            $i = 1;
                                            $tabNameArray = []; 
                                            $tabname="" ;   
                                        @endphp 
                                        @foreach($productDetailManager as $manager)
                                            @php 
                                               
                                                $tabname = Str::snake(str_replace('&', 'and', $manager->section_name)); 
                                            @endphp 
                                            @if($manager->section_name != "Specification")
                                                @php  $tabNameArray[] = $tabname; @endphp 
                                                <button class="product-tab-btn @if($i == 1) active @endif" data-tab="{{ $tabname }}">
                                                    {{ $manager->section_name }}
                                                </button>
                                                @php $i++ @endphp   
                                            @endif   
                                        @endforeach
                                    </div>

                                    <div class="product-tab-content active" id="{{ $tabNameArray[0] ?? ""}}">
                                       {!! $product->content_2 ?? "" !!}
                                    </div>

                                    <div class="product-tab-content" id="{{ $tabNameArray[1] ?? "" }}">
                                        {!! $product->content_3 ?? "" !!}

                                    </div>

                                    <div class="product-tab-content" id="{{ $tabNameArray[2] ?? "" }}">
                                        {!! $product->content_4 ?? "" !!}
                                    </div>

                                    <div class="product-tab-content" id="{{ $tabNameArray[3] ?? "" }}">
                                        {!! $product->content_5 ?? "" !!}

                                    </div>

                                    <div class="product-tab-content" id="{{ $tabNameArray[4] ?? "" }}">
                                        {!! $product->content_6 ?? "" !!}
                                    </div>

                                    <div class="product-tab-content" id="{{ $tabNameArray[5] ?? "" }}">
                                         {!! $product->content_7 ?? "" !!}
                                    </div>

                                    <div class="product-tab-content" id="reviews">
                                        <div class="single-product-review">
                                            <div class="single-pro-review-box">
                                                <h4 class="text-uppercase f-15"><strong>Customer Reviews</strong> </h4>
                                                <div class="review-button">
                                                    {{-- <div class="review-star-text">
                                                        <div class="review-star mb-1 me-2">
                                                            <span class="fa-regular fa-star"></span>
                                                            <span class="fa-regular fa-star"></span>
                                                            <span class="fa-regular fa-star"></span>
                                                            <span class="fa-regular fa-star"></span>
                                                            <span class="fa-regular fa-star"></span>
                                                        </div>
                                                        <div class="review-text mb-1">
                                                            Be the first to write a review
                                                        </div>
                                                    </div> --}}
                                                    <div class="review-top-rat">
                                                        <p class="review-top-rat-value">4.8</p>

                                                        <div class="review-top-star-rat">
                                                            <div class="star-val">
                                                                <p class="star-rating-value">
                                                                    <span class="flex" title="Star 4.8"><span><svg
                                                                                class="ml-0.5" stroke="#E27A34"
                                                                                fill="#E27a34" stroke-width="1"
                                                                                viewBox="0 0 24 24" width="16"
                                                                                height="16"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                </path>
                                                                            </svg></span><span><svg class="ml-0.5"
                                                                                stroke="#E27A34" fill="#E27a34"
                                                                                stroke-width="1" viewBox="0 0 24 24"
                                                                                width="16" height="16"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                </path>
                                                                            </svg></span><span><svg class="ml-0.5"
                                                                                stroke="#E27A34" fill="#E27a34"
                                                                                stroke-width="1" viewBox="0 0 24 24"
                                                                                width="16" height="16"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                </path>
                                                                            </svg></span><span><svg class="ml-0.5"
                                                                                stroke="#E27A34" fill="#E27a34"
                                                                                stroke-width="1" viewBox="0 0 24 24"
                                                                                width="16" height="16"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                </path>
                                                                            </svg></span><span><svg class="ml-0.5"
                                                                                width="16" height="16"
                                                                                viewBox="0 0 17 17" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M8.78843 12.6742L12.9837 15.2815L11.8704 10.3674L15.5769 7.06096L10.696 6.63456L8.78843 2L6.88088 6.63456L2 7.06096L5.70648 10.3674L4.59318 15.2815L8.78843 12.6742Z"
                                                                                    fill="#E27A34" stroke="#E27A34">
                                                                                </path>
                                                                                <path
                                                                                    d="M8.78843 12.6742L12.9837 15.2815L11.8704 10.3674L15.5769 7.06096L10.696 6.63456L8.78843 2L8.83789 7V7.5V9V10.3674L8.78843 12.6742Z"
                                                                                    fill="white"></path>
                                                                            </svg></span></span><span
                                                                        class="count-value-rating">(10)</span>
                                                                </p>
                                                            </div>
                                                            <p class="rating-reviw-full">48 Ratings &amp; 10 Reviews</p>
                                                        </div>

                                                    </div>
                                                    <div class="mb-1">
                                                        <button class="btn btn-primary collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#reviews"
                                                            aria-expanded="false" aria-controls="collapseExample">
                                                            <span class="review-btn-write">Write a review</span>
                                                            <span class="review-btn-cancel">Cancel review</span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div id="reviews" class="review-form-section collapse">
                                                    <div class="comments">
                                                        <p>There are no reviews for this product.</p>
                                                    </div>
                                                    <div class="review-form-wrapper">
                                                        <h5 class="comment-reply-title">Add a review </h5>
                                                        <form action="" method="post" id="commentform"
                                                            class="comment-form" novalidate="">
                                                            <div class="comment-form-rating">
                                                                <h4>Your Rating</h4>
                                                                <div class="stars-rating"> <span>Bad</span>
                                                                    <span class="rating">
                                                                        <input type="radio" id="star1"
                                                                            name="rating" value="1" />
                                                                        <label for="star1"
                                                                            title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="star2"
                                                                            name="rating" value="2" />
                                                                        <label for="star2"
                                                                            title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star3"
                                                                            name="rating" value="3" />
                                                                        <label for="star3"
                                                                            title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star4"
                                                                            name="rating" value="4" />
                                                                        <label for="star4"
                                                                            title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star5"
                                                                            name="rating" value="5" />
                                                                        <label for="star5"
                                                                            title="Awesome - 5 stars"></label>
                                                                    </span> <span>Good</span>
                                                                </div>
                                                            </div>
                                                            <div class="inner-reviews">
                                                                <div class="comment-form-comment form-group col-12">
                                                                    <label for="comment">Your Review <span
                                                                            class="required">*</span></label>
                                                                    <textarea class="form-control" id="comment" placeholder="Message" name="comment" cols="45" rows="8"
                                                                        aria-required="true" required=""></textarea>
                                                                </div>
                                                                <div
                                                                    class="comment-form-author form-group col-md-6 col-sm-6 col-12">
                                                                    <label for="author">Name <span
                                                                            class="required">*</span></label>
                                                                    <input class="form-control" id="author"
                                                                        name="author" value="" size="30"
                                                                        aria-required="true" required=""
                                                                        type="text" placeholder="Name">
                                                                </div>
                                                                <div
                                                                    class="comment-form-email form-group col-md-6 col-sm-6 col-12">
                                                                    <label for="email">Email <span
                                                                            class="required">*</span></label>
                                                                    <input class="form-control" id="email"
                                                                        name="email" value="" size="30"
                                                                        aria-required="true" required=""
                                                                        type="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="form-submit">
                                                                <input name="submit" id="submit"
                                                                    class="btn btn-primary submit" value="Submit"
                                                                    type="submit">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="review-main-bottom">
                                                    <div class="review-left-txt">
                                                        <div class="review-left-rating"><span
                                                                class="review-left-rating-inner">5 <svg class=""
                                                                    stroke="#E27A34" fill="#E27a34" stroke-width="1"
                                                                    viewBox="0 0 24 24" width="16" height="16"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                    </path>
                                                                </svg></span>
                                                            <div class="review-brd-left">
                                                                <div class="review-brd-left-inner"></div>
                                                            </div><span class="tracking-wide-per">80%</span>
                                                        </div>
                                                        <div class="review-left-rating"><span
                                                                class="review-left-rating-inner">4 <svg class=""
                                                                    stroke="#E27A34" fill="#E27a34" stroke-width="1"
                                                                    viewBox="0 0 24 24" width="16" height="16"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                    </path>
                                                                </svg></span>
                                                            <div class="review-brd-left">
                                                                <div class="review-brd-left-inner"></div>
                                                            </div><span class="tracking-wide-per">20%</span>
                                                        </div>
                                                        <div class="review-left-rating"><span
                                                                class="review-left-rating-inner">3 <svg class=""
                                                                    stroke="#E27A34" fill="#E27a34" stroke-width="1"
                                                                    viewBox="0 0 24 24" width="16" height="16"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                    </path>
                                                                </svg></span>
                                                            <div class="review-brd-left">
                                                                <div class="h-full w-full flex-1 bg-primary"></div>
                                                            </div><span class="tracking-wide-per">10%</span>
                                                        </div>
                                                        <div class="review-left-rating"><span
                                                                class="review-left-rating-inner">2 <svg class=""
                                                                    stroke="#E27A34" fill="#E27a34" stroke-width="1"
                                                                    viewBox="0 0 24 24" width="16" height="16"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                    </path>
                                                                </svg></span>
                                                            <div class="review-brd-left">
                                                                <div class="h-full w-full flex-1 bg-primary"></div>
                                                            </div><span class="tracking-wide-per">0%</span>
                                                        </div>
                                                        <div class="review-left-rating"><span
                                                                class="review-left-rating-inner">1 <svg class=""
                                                                    stroke="#E27A34" fill="#E27a34" stroke-width="1"
                                                                    viewBox="0 0 24 24" width="16" height="16"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                    </path>
                                                                </svg></span>
                                                            <div class="review-brd-left">
                                                                <div class="h-full w-full flex-1 bg-primary"></div>
                                                            </div><span class="tracking-wide-per">0%</span>
                                                        </div>

                                                    </div>
                                                    <div class="review-lists">
                                                        <ul>
                                                            <li>
                                                                <div class="review-lists-inner">
                                                                    <div class="review-lists-inner-left">
                                                                        <div class="review-lis-top">
                                                                            <div class="review-star-lis">
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                            </div>
                                                                            <span class="review-count">(5)</span>
                                                                        </div>
                                                                        <p class="review-txt-pra">Hanton set is perfect for
                                                                            small spaces, as it's compact and easy to store
                                                                            when
                                                                            not in use. The chairs are comfortable to sit on
                                                                            and
                                                                            have a good amount of support.</p>
                                                                        <div class="review-author-main">
                                                                            <span class="review-txt-author">Meena
                                                                                Kulkarni<span
                                                                                    class="review-txt-add">,Mumbai</span></span>
                                                                            <span class="review-txt-verified"><svg
                                                                                    width="17" height="17"
                                                                                    viewBox="0 0 17 17" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M8.51333 17.0021C8.20949 17.0025 7.90854 16.9444 7.62776 16.8311C7.34698 16.7178 7.0919 16.5515 6.87713 16.3417L6.0156 15.5003C5.911 15.3977 5.78659 15.3163 5.64955 15.2609C5.51252 15.2055 5.36558 15.1771 5.21724 15.1775H4.20804C3.5946 15.1769 3.00645 14.9388 2.57268 14.5155C2.1389 14.0923 1.89493 13.5184 1.89431 12.9198V11.9359C1.89477 11.7912 1.86583 11.6478 1.80917 11.5141C1.75252 11.3804 1.66926 11.259 1.56422 11.1569L0.701903 10.3162C0.26868 9.89241 0.0253906 9.31826 0.0253906 8.71967C0.0253906 8.12109 0.26868 7.54694 0.701903 7.12314L1.56422 6.28249C1.66941 6.18043 1.75281 6.05903 1.8096 5.92532C1.86639 5.79161 1.89545 5.64823 1.8951 5.50349V4.51876C1.89572 3.92018 2.13969 3.34629 2.57347 2.92303C3.00724 2.49978 3.59539 2.26172 4.20883 2.26111H5.21724C5.36553 2.26156 5.51243 2.23332 5.64946 2.17804C5.78649 2.12276 5.91094 2.04152 6.0156 1.93903L6.87713 1.09761C7.31147 0.674891 7.89988 0.4375 8.51333 0.4375C9.12679 0.4375 9.7152 0.674891 10.1495 1.09761L11.0111 1.93903C11.1157 2.04166 11.2401 2.12304 11.3771 2.17846C11.5141 2.23387 11.6611 2.26223 11.8094 2.26188H12.8186C13.4321 2.26249 14.0202 2.50055 14.454 2.9238C14.8878 3.34706 15.1317 3.92095 15.1324 4.51953V5.50349C15.1319 5.64818 15.1608 5.79152 15.2175 5.92523C15.2741 6.05894 15.3574 6.18037 15.4624 6.28249L16.324 7.12314C16.7572 7.54694 17.0005 8.12109 17.0005 8.71967C17.0005 9.31826 16.7572 9.89241 16.324 10.3162L15.4624 11.1569C15.3573 11.2589 15.2739 11.3803 15.2171 11.514C15.1603 11.6477 15.1312 11.7911 15.1316 11.9359V12.9206C15.1309 13.5192 14.887 14.0931 14.4532 14.5163C14.0194 14.9396 13.4313 15.1776 12.8178 15.1782H11.8094C11.6611 15.1779 11.5141 15.2062 11.3771 15.2617C11.2401 15.3171 11.1157 15.3985 11.0111 15.5011L10.1495 16.3417C9.93477 16.5515 9.67968 16.7178 9.39891 16.8311C9.11813 16.9444 8.81718 17.0025 8.51333 17.0021ZM4.20804 3.4169C3.90862 3.4171 3.62152 3.53326 3.40979 3.73985C3.19806 3.94645 3.07902 4.22659 3.07881 4.51876V5.50349C3.07991 5.80043 3.02051 6.09463 2.90406 6.36897C2.78761 6.64331 2.61643 6.89234 2.40049 7.10157L1.53974 7.94144C1.32815 8.14843 1.20932 8.42886 1.20932 8.72122C1.20932 9.01357 1.32815 9.294 1.53974 9.50099L2.40049 10.3409C2.61624 10.5499 2.78731 10.7987 2.90375 11.0727C3.0202 11.3468 3.0797 11.6407 3.07881 11.9374V12.9221C3.07902 13.2143 3.19806 13.4944 3.40979 13.701C3.62152 13.9076 3.90862 14.0238 4.20804 14.024H5.21724C5.52127 14.0233 5.82242 14.0814 6.10328 14.195C6.38413 14.3087 6.6391 14.4755 6.85344 14.6859L7.71419 15.5257C7.92632 15.7322 8.21371 15.8482 8.51333 15.8482C8.81296 15.8482 9.10035 15.7322 9.31248 15.5257L10.1732 14.6859C10.3876 14.4755 10.6425 14.3087 10.9234 14.195C11.2042 14.0814 11.5054 14.0233 11.8094 14.024H12.8186C13.118 14.0238 13.4052 13.9076 13.6169 13.701C13.8286 13.4944 13.9476 13.2143 13.9479 12.9221V11.9359C13.947 11.6392 14.0065 11.3453 14.1229 11.0712C14.2394 10.7971 14.4104 10.5484 14.6262 10.3393L15.4869 9.49945C15.6985 9.29246 15.8173 9.01203 15.8173 8.71967C15.8173 8.42732 15.6985 8.14689 15.4869 7.9399L14.6262 7.10157C14.4106 6.89242 14.2396 6.64362 14.1232 6.36958C14.0067 6.09554 13.9471 5.80169 13.9479 5.50503V4.51876C13.9476 4.22659 13.8286 3.94645 13.6169 3.73985C13.4052 3.53326 13.118 3.4171 12.8186 3.4169H11.8094C11.5051 3.41797 11.2036 3.36001 10.9224 3.24638C10.6413 3.13275 10.3861 2.96573 10.1716 2.75502L9.3109 1.91514C9.09877 1.70868 8.81138 1.59273 8.51175 1.59273C8.21213 1.59273 7.92474 1.70868 7.71261 1.91514L6.85502 2.75502C6.64078 2.96554 6.38583 3.13246 6.10496 3.24608C5.82408 3.3597 5.52288 3.41777 5.21882 3.4169H4.20804Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M3.66427 3.04155L2.45121 4.46193V5.17212V6.11904L1.72338 7.06596L0.75293 8.01288V8.72307L0.995541 9.66999L1.96599 10.8536L2.45121 11.5638V13.4577L3.17905 14.1679L3.90688 14.6413H5.84777L7.30344 15.825L8.5165 16.5352L9.48695 16.0617L11.4278 14.6413H13.3687L14.3392 13.9311L14.8244 11.0904L16.5227 8.48634L14.8244 6.35577L14.3392 3.98847L13.3687 3.04155H10.7L9.00172 1.14771H8.03128L5.60516 3.04155H3.66427Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M7.37615 11.8255C7.2641 11.8258 7.15312 11.8039 7.04963 11.7611C6.94615 11.7183 6.85223 11.6554 6.77332 11.5762L4.49848 9.30965C4.3478 9.14853 4.26576 8.93543 4.26966 8.71523C4.27356 8.49504 4.36309 8.28495 4.51939 8.12923C4.67568 7.9735 4.88654 7.8843 5.10755 7.88042C5.32855 7.87653 5.54243 7.95827 5.70414 8.1084L7.37615 9.77316L11.323 5.84189C11.4847 5.69175 11.6986 5.61002 11.9196 5.6139C12.1406 5.61779 12.3514 5.70699 12.5077 5.86271C12.664 6.01844 12.7536 6.22853 12.7575 6.44872C12.7614 6.66891 12.6793 6.88202 12.5286 7.04314L7.97898 11.5762C7.90006 11.6554 7.80614 11.7183 7.70266 11.7611C7.59917 11.8039 7.48819 11.8258 7.37615 11.8255Z"
                                                                                        fill="white"></path>
                                                                                </svg>Verified Buyer<span
                                                                                    class="review-txt-date">17 Jul
                                                                                    2024</span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-lists-inner-right">
                                                                        <div class="review-rig-img">
                                                                            <img src="http://127.0.0.1:8004/uploads/products/JUN2026/variant_1_6a23e19111c1c.webp"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="review-lists-inner">
                                                                    <div class="review-lists-inner-left">
                                                                        <div class="review-lis-top">
                                                                            <div class="review-star-lis">
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                            </div>
                                                                            <span class="review-count">(5)</span>
                                                                        </div>
                                                                        <p class="review-txt-pra">Hanton set is perfect for
                                                                            small spaces, as it's compact and easy to store
                                                                            when
                                                                            not in use. The chairs are comfortable to sit on
                                                                            and
                                                                            have a good amount of support.</p>
                                                                        <div class="review-author-main">
                                                                            <span class="review-txt-author">Meena
                                                                                Kulkarni<span
                                                                                    class="review-txt-add">,Mumbai</span></span>
                                                                            <span class="review-txt-verified"><svg
                                                                                    width="17" height="17"
                                                                                    viewBox="0 0 17 17" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M8.51333 17.0021C8.20949 17.0025 7.90854 16.9444 7.62776 16.8311C7.34698 16.7178 7.0919 16.5515 6.87713 16.3417L6.0156 15.5003C5.911 15.3977 5.78659 15.3163 5.64955 15.2609C5.51252 15.2055 5.36558 15.1771 5.21724 15.1775H4.20804C3.5946 15.1769 3.00645 14.9388 2.57268 14.5155C2.1389 14.0923 1.89493 13.5184 1.89431 12.9198V11.9359C1.89477 11.7912 1.86583 11.6478 1.80917 11.5141C1.75252 11.3804 1.66926 11.259 1.56422 11.1569L0.701903 10.3162C0.26868 9.89241 0.0253906 9.31826 0.0253906 8.71967C0.0253906 8.12109 0.26868 7.54694 0.701903 7.12314L1.56422 6.28249C1.66941 6.18043 1.75281 6.05903 1.8096 5.92532C1.86639 5.79161 1.89545 5.64823 1.8951 5.50349V4.51876C1.89572 3.92018 2.13969 3.34629 2.57347 2.92303C3.00724 2.49978 3.59539 2.26172 4.20883 2.26111H5.21724C5.36553 2.26156 5.51243 2.23332 5.64946 2.17804C5.78649 2.12276 5.91094 2.04152 6.0156 1.93903L6.87713 1.09761C7.31147 0.674891 7.89988 0.4375 8.51333 0.4375C9.12679 0.4375 9.7152 0.674891 10.1495 1.09761L11.0111 1.93903C11.1157 2.04166 11.2401 2.12304 11.3771 2.17846C11.5141 2.23387 11.6611 2.26223 11.8094 2.26188H12.8186C13.4321 2.26249 14.0202 2.50055 14.454 2.9238C14.8878 3.34706 15.1317 3.92095 15.1324 4.51953V5.50349C15.1319 5.64818 15.1608 5.79152 15.2175 5.92523C15.2741 6.05894 15.3574 6.18037 15.4624 6.28249L16.324 7.12314C16.7572 7.54694 17.0005 8.12109 17.0005 8.71967C17.0005 9.31826 16.7572 9.89241 16.324 10.3162L15.4624 11.1569C15.3573 11.2589 15.2739 11.3803 15.2171 11.514C15.1603 11.6477 15.1312 11.7911 15.1316 11.9359V12.9206C15.1309 13.5192 14.887 14.0931 14.4532 14.5163C14.0194 14.9396 13.4313 15.1776 12.8178 15.1782H11.8094C11.6611 15.1779 11.5141 15.2062 11.3771 15.2617C11.2401 15.3171 11.1157 15.3985 11.0111 15.5011L10.1495 16.3417C9.93477 16.5515 9.67968 16.7178 9.39891 16.8311C9.11813 16.9444 8.81718 17.0025 8.51333 17.0021ZM4.20804 3.4169C3.90862 3.4171 3.62152 3.53326 3.40979 3.73985C3.19806 3.94645 3.07902 4.22659 3.07881 4.51876V5.50349C3.07991 5.80043 3.02051 6.09463 2.90406 6.36897C2.78761 6.64331 2.61643 6.89234 2.40049 7.10157L1.53974 7.94144C1.32815 8.14843 1.20932 8.42886 1.20932 8.72122C1.20932 9.01357 1.32815 9.294 1.53974 9.50099L2.40049 10.3409C2.61624 10.5499 2.78731 10.7987 2.90375 11.0727C3.0202 11.3468 3.0797 11.6407 3.07881 11.9374V12.9221C3.07902 13.2143 3.19806 13.4944 3.40979 13.701C3.62152 13.9076 3.90862 14.0238 4.20804 14.024H5.21724C5.52127 14.0233 5.82242 14.0814 6.10328 14.195C6.38413 14.3087 6.6391 14.4755 6.85344 14.6859L7.71419 15.5257C7.92632 15.7322 8.21371 15.8482 8.51333 15.8482C8.81296 15.8482 9.10035 15.7322 9.31248 15.5257L10.1732 14.6859C10.3876 14.4755 10.6425 14.3087 10.9234 14.195C11.2042 14.0814 11.5054 14.0233 11.8094 14.024H12.8186C13.118 14.0238 13.4052 13.9076 13.6169 13.701C13.8286 13.4944 13.9476 13.2143 13.9479 12.9221V11.9359C13.947 11.6392 14.0065 11.3453 14.1229 11.0712C14.2394 10.7971 14.4104 10.5484 14.6262 10.3393L15.4869 9.49945C15.6985 9.29246 15.8173 9.01203 15.8173 8.71967C15.8173 8.42732 15.6985 8.14689 15.4869 7.9399L14.6262 7.10157C14.4106 6.89242 14.2396 6.64362 14.1232 6.36958C14.0067 6.09554 13.9471 5.80169 13.9479 5.50503V4.51876C13.9476 4.22659 13.8286 3.94645 13.6169 3.73985C13.4052 3.53326 13.118 3.4171 12.8186 3.4169H11.8094C11.5051 3.41797 11.2036 3.36001 10.9224 3.24638C10.6413 3.13275 10.3861 2.96573 10.1716 2.75502L9.3109 1.91514C9.09877 1.70868 8.81138 1.59273 8.51175 1.59273C8.21213 1.59273 7.92474 1.70868 7.71261 1.91514L6.85502 2.75502C6.64078 2.96554 6.38583 3.13246 6.10496 3.24608C5.82408 3.3597 5.52288 3.41777 5.21882 3.4169H4.20804Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M3.66427 3.04155L2.45121 4.46193V5.17212V6.11904L1.72338 7.06596L0.75293 8.01288V8.72307L0.995541 9.66999L1.96599 10.8536L2.45121 11.5638V13.4577L3.17905 14.1679L3.90688 14.6413H5.84777L7.30344 15.825L8.5165 16.5352L9.48695 16.0617L11.4278 14.6413H13.3687L14.3392 13.9311L14.8244 11.0904L16.5227 8.48634L14.8244 6.35577L14.3392 3.98847L13.3687 3.04155H10.7L9.00172 1.14771H8.03128L5.60516 3.04155H3.66427Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M7.37615 11.8255C7.2641 11.8258 7.15312 11.8039 7.04963 11.7611C6.94615 11.7183 6.85223 11.6554 6.77332 11.5762L4.49848 9.30965C4.3478 9.14853 4.26576 8.93543 4.26966 8.71523C4.27356 8.49504 4.36309 8.28495 4.51939 8.12923C4.67568 7.9735 4.88654 7.8843 5.10755 7.88042C5.32855 7.87653 5.54243 7.95827 5.70414 8.1084L7.37615 9.77316L11.323 5.84189C11.4847 5.69175 11.6986 5.61002 11.9196 5.6139C12.1406 5.61779 12.3514 5.70699 12.5077 5.86271C12.664 6.01844 12.7536 6.22853 12.7575 6.44872C12.7614 6.66891 12.6793 6.88202 12.5286 7.04314L7.97898 11.5762C7.90006 11.6554 7.80614 11.7183 7.70266 11.7611C7.59917 11.8039 7.48819 11.8258 7.37615 11.8255Z"
                                                                                        fill="white"></path>
                                                                                </svg>Verified Buyer<span
                                                                                    class="review-txt-date">17 Jul
                                                                                    2024</span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-lists-inner-right">
                                                                        <div class="review-rig-img">
                                                                            <img src="http://127.0.0.1:8004/uploads/products/JUN2026/variant_1_6a23e191126a5.webp"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="review-lists-inner">
                                                                    <div class="review-lists-inner-left">
                                                                        <div class="review-lis-top">
                                                                            <div class="review-star-lis">
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                                <svg class="" stroke="#E27A34"
                                                                                    fill="#E27a34" stroke-width="1"
                                                                                    viewBox="0 0 24 24" width="16"
                                                                                    height="16"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                                                    </path>
                                                                                </svg>
                                                                            </div>
                                                                            <span class="review-count">(5)</span>
                                                                        </div>
                                                                        <p class="review-txt-pra">Hanton set is perfect for
                                                                            small spaces, as it's compact and easy to store
                                                                            when
                                                                            not in use. The chairs are comfortable to sit on
                                                                            and
                                                                            have a good amount of support.</p>
                                                                        <div class="review-author-main">
                                                                            <span class="review-txt-author">Meena
                                                                                Kulkarni<span
                                                                                    class="review-txt-add">,Mumbai</span></span>
                                                                            <span class="review-txt-verified"><svg
                                                                                    width="17" height="17"
                                                                                    viewBox="0 0 17 17" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M8.51333 17.0021C8.20949 17.0025 7.90854 16.9444 7.62776 16.8311C7.34698 16.7178 7.0919 16.5515 6.87713 16.3417L6.0156 15.5003C5.911 15.3977 5.78659 15.3163 5.64955 15.2609C5.51252 15.2055 5.36558 15.1771 5.21724 15.1775H4.20804C3.5946 15.1769 3.00645 14.9388 2.57268 14.5155C2.1389 14.0923 1.89493 13.5184 1.89431 12.9198V11.9359C1.89477 11.7912 1.86583 11.6478 1.80917 11.5141C1.75252 11.3804 1.66926 11.259 1.56422 11.1569L0.701903 10.3162C0.26868 9.89241 0.0253906 9.31826 0.0253906 8.71967C0.0253906 8.12109 0.26868 7.54694 0.701903 7.12314L1.56422 6.28249C1.66941 6.18043 1.75281 6.05903 1.8096 5.92532C1.86639 5.79161 1.89545 5.64823 1.8951 5.50349V4.51876C1.89572 3.92018 2.13969 3.34629 2.57347 2.92303C3.00724 2.49978 3.59539 2.26172 4.20883 2.26111H5.21724C5.36553 2.26156 5.51243 2.23332 5.64946 2.17804C5.78649 2.12276 5.91094 2.04152 6.0156 1.93903L6.87713 1.09761C7.31147 0.674891 7.89988 0.4375 8.51333 0.4375C9.12679 0.4375 9.7152 0.674891 10.1495 1.09761L11.0111 1.93903C11.1157 2.04166 11.2401 2.12304 11.3771 2.17846C11.5141 2.23387 11.6611 2.26223 11.8094 2.26188H12.8186C13.4321 2.26249 14.0202 2.50055 14.454 2.9238C14.8878 3.34706 15.1317 3.92095 15.1324 4.51953V5.50349C15.1319 5.64818 15.1608 5.79152 15.2175 5.92523C15.2741 6.05894 15.3574 6.18037 15.4624 6.28249L16.324 7.12314C16.7572 7.54694 17.0005 8.12109 17.0005 8.71967C17.0005 9.31826 16.7572 9.89241 16.324 10.3162L15.4624 11.1569C15.3573 11.2589 15.2739 11.3803 15.2171 11.514C15.1603 11.6477 15.1312 11.7911 15.1316 11.9359V12.9206C15.1309 13.5192 14.887 14.0931 14.4532 14.5163C14.0194 14.9396 13.4313 15.1776 12.8178 15.1782H11.8094C11.6611 15.1779 11.5141 15.2062 11.3771 15.2617C11.2401 15.3171 11.1157 15.3985 11.0111 15.5011L10.1495 16.3417C9.93477 16.5515 9.67968 16.7178 9.39891 16.8311C9.11813 16.9444 8.81718 17.0025 8.51333 17.0021ZM4.20804 3.4169C3.90862 3.4171 3.62152 3.53326 3.40979 3.73985C3.19806 3.94645 3.07902 4.22659 3.07881 4.51876V5.50349C3.07991 5.80043 3.02051 6.09463 2.90406 6.36897C2.78761 6.64331 2.61643 6.89234 2.40049 7.10157L1.53974 7.94144C1.32815 8.14843 1.20932 8.42886 1.20932 8.72122C1.20932 9.01357 1.32815 9.294 1.53974 9.50099L2.40049 10.3409C2.61624 10.5499 2.78731 10.7987 2.90375 11.0727C3.0202 11.3468 3.0797 11.6407 3.07881 11.9374V12.9221C3.07902 13.2143 3.19806 13.4944 3.40979 13.701C3.62152 13.9076 3.90862 14.0238 4.20804 14.024H5.21724C5.52127 14.0233 5.82242 14.0814 6.10328 14.195C6.38413 14.3087 6.6391 14.4755 6.85344 14.6859L7.71419 15.5257C7.92632 15.7322 8.21371 15.8482 8.51333 15.8482C8.81296 15.8482 9.10035 15.7322 9.31248 15.5257L10.1732 14.6859C10.3876 14.4755 10.6425 14.3087 10.9234 14.195C11.2042 14.0814 11.5054 14.0233 11.8094 14.024H12.8186C13.118 14.0238 13.4052 13.9076 13.6169 13.701C13.8286 13.4944 13.9476 13.2143 13.9479 12.9221V11.9359C13.947 11.6392 14.0065 11.3453 14.1229 11.0712C14.2394 10.7971 14.4104 10.5484 14.6262 10.3393L15.4869 9.49945C15.6985 9.29246 15.8173 9.01203 15.8173 8.71967C15.8173 8.42732 15.6985 8.14689 15.4869 7.9399L14.6262 7.10157C14.4106 6.89242 14.2396 6.64362 14.1232 6.36958C14.0067 6.09554 13.9471 5.80169 13.9479 5.50503V4.51876C13.9476 4.22659 13.8286 3.94645 13.6169 3.73985C13.4052 3.53326 13.118 3.4171 12.8186 3.4169H11.8094C11.5051 3.41797 11.2036 3.36001 10.9224 3.24638C10.6413 3.13275 10.3861 2.96573 10.1716 2.75502L9.3109 1.91514C9.09877 1.70868 8.81138 1.59273 8.51175 1.59273C8.21213 1.59273 7.92474 1.70868 7.71261 1.91514L6.85502 2.75502C6.64078 2.96554 6.38583 3.13246 6.10496 3.24608C5.82408 3.3597 5.52288 3.41777 5.21882 3.4169H4.20804Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M3.66427 3.04155L2.45121 4.46193V5.17212V6.11904L1.72338 7.06596L0.75293 8.01288V8.72307L0.995541 9.66999L1.96599 10.8536L2.45121 11.5638V13.4577L3.17905 14.1679L3.90688 14.6413H5.84777L7.30344 15.825L8.5165 16.5352L9.48695 16.0617L11.4278 14.6413H13.3687L14.3392 13.9311L14.8244 11.0904L16.5227 8.48634L14.8244 6.35577L14.3392 3.98847L13.3687 3.04155H10.7L9.00172 1.14771H8.03128L5.60516 3.04155H3.66427Z"
                                                                                        fill="#333333"></path>
                                                                                    <path
                                                                                        d="M7.37615 11.8255C7.2641 11.8258 7.15312 11.8039 7.04963 11.7611C6.94615 11.7183 6.85223 11.6554 6.77332 11.5762L4.49848 9.30965C4.3478 9.14853 4.26576 8.93543 4.26966 8.71523C4.27356 8.49504 4.36309 8.28495 4.51939 8.12923C4.67568 7.9735 4.88654 7.8843 5.10755 7.88042C5.32855 7.87653 5.54243 7.95827 5.70414 8.1084L7.37615 9.77316L11.323 5.84189C11.4847 5.69175 11.6986 5.61002 11.9196 5.6139C12.1406 5.61779 12.3514 5.70699 12.5077 5.86271C12.664 6.01844 12.7536 6.22853 12.7575 6.44872C12.7614 6.66891 12.6793 6.88202 12.5286 7.04314L7.97898 11.5762C7.90006 11.6554 7.80614 11.7183 7.70266 11.7611C7.59917 11.8039 7.48819 11.8258 7.37615 11.8255Z"
                                                                                        fill="white"></path>
                                                                                </svg>Verified Buyer<span
                                                                                    class="review-txt-date">17 Jul
                                                                                    2024</span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="review-lists-inner-right">
                                                                        <div class="review-rig-img">
                                                                            <img src="http://127.0.0.1:8004/uploads/products/JUN2026/variant_1_6a23e19114fe6.webp"
                                                                                alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="single-product-review">
                            <div class="container">
                                <div class="single-pro-review-box">
                                    <h4 class="text-uppercase f-15"><strong>Customer Reviews</strong> </h4>
                                    <div class="review-button">
                                        <div class="review-star-text">
                                            <div class="review-star mb-1 me-2">
                                                <span class="fa-regular fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                            </div>
                                            <div class="review-text mb-1">
                                                Be the first to write a review
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <button class="btn btn-primary collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#reviews" aria-expanded="false"
                                                aria-controls="collapseExample">
                                                <span class="review-btn-write">Write a review</span>
                                                <span class="review-btn-cancel">Cancel review</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="reviews" class="review-form-section collapse">
                                        <div class="comments">
                                            <p>There are no reviews for this product.</p>
                                        </div>
                                        <div class="review-form-wrapper">
                                            <h5 class="comment-reply-title">Add a review </h5>
                                            <form action="" method="post" id="commentform" class="comment-form"
                                                novalidate="">
                                                <div class="comment-form-rating">
                                                    <h4>Your Rating</h4>
                                                    <div class="stars-rating"> <span>Bad</span>
                                                        <span class="rating">
                                                            <input type="radio" id="star1" name="rating"
                                                                value="1" />
                                                            <label for="star1" title="Sucks big time - 1 star"></label>
                                                            <input type="radio" id="star2" name="rating"
                                                                value="2" />
                                                            <label for="star2" title="Kinda bad - 2 stars"></label>
                                                            <input type="radio" id="star3" name="rating"
                                                                value="3" />
                                                            <label for="star3" title="Meh - 3 stars"></label>
                                                            <input type="radio" id="star4" name="rating"
                                                                value="4" />
                                                            <label for="star4" title="Pretty good - 4 stars"></label>
                                                            <input type="radio" id="star5" name="rating"
                                                                value="5" />
                                                            <label for="star5" title="Awesome - 5 stars"></label>
                                                        </span> <span>Good</span>
                                                    </div>
                                                </div>
                                                <div class="inner-reviews">
                                                    <div class="comment-form-comment form-group col-12">
                                                        <label for="comment">Your Review <span
                                                                class="required">*</span></label>
                                                        <textarea class="form-control" id="comment" placeholder="Message" name="comment" cols="45" rows="8"
                                                            aria-required="true" required=""></textarea>
                                                    </div>
                                                    <div class="comment-form-author form-group col-md-6 col-sm-6 col-12">
                                                        <label for="author">Name <span class="required">*</span></label>
                                                        <input class="form-control" id="author" name="author"
                                                            value="" size="30" aria-required="true"
                                                            required="" type="text" placeholder="Name">
                                                    </div>
                                                    <div class="comment-form-email form-group col-md-6 col-sm-6 col-12">
                                                        <label for="email">Email <span
                                                                class="required">*</span></label>
                                                        <input class="form-control" id="email" name="email"
                                                            value="" size="30" aria-required="true"
                                                            required="" type="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-submit">
                                                    <input name="submit" id="submit" class="btn btn-primary submit"
                                                        value="Submit" type="submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>


                {{--   @if (isset($related_products[0]))
                //     <div class="product-section section">
                //         <div class="container">
                //             <div class="section-header text-center">
                //                 <h2 class="section-title">Related Products</h2>
                //             </div>
                //             <div class="products-wrapper">
                //                 <div class="products-area">
                //                     <ul class="products product-carousel">
                //                         @foreach ($related_products as $products)
                //                             <?php
                //                             $graphics = $products->product_main_images->where('status', 1);
                //                             $frontImage = $graphics->firstWhere('is_front', 1);
                //                             $backImage = $graphics->firstWhere('is_back', 1);
                //                             $fallbackImages = $graphics->pluck('graphic')->take(2);
                
                //                             $firstImage = $frontImage ? $frontImage->graphic : $fallbackImages->get(0) ?? null;
                //                             $secondImage = $backImage ? $backImage->graphic : $fallbackImages->get(1) ?? $firstImage;
                //
                ?>
                //                             <li class="product-item product">
                //                                 <div class="product-wrap">
                //                                     <div class="product-image">
                //                                         <div class="onsale-trading">
                //                                             <span class="onsale-off">40% OFF</span>
                //                                         </div>
                //                                         <a href="product-detail.html">
                //                                             <div class="product-main-image">
                //                                                 <img src="{{ $firstImage ? asset('uploads/products/' . $firstImage) : asset('img/no-image.jpg') }}"
                //                                                     alt="{{ $products->name }}" class="default-image">
                //                                             </div>
                //                                             <div class="product-hover-image">
                //                                                 <img src="{{ $secondImage ? asset('uploads/products/' . $secondImage) : asset('img/no-image.jpg') }}"alt="{{ $products->name }} Hover"
                //                                                     class="hover-image">
                //                                             </div>
                //                                         </a>
                //                                         <div class="product-wishlist wishlist">
                //                                             <a href="#" class="add-to-wishlist">
                //                                                 <i class="far fa-heart"></i>
                //                                             </a>
                //                                         </div>

                //                                         <div class="product-options">
                //                                             <div class="product-option-item">
                //                                                 <div class="product-option-title">Size</div>
                //                                                 <div class="product-option-wrap">
                //                                                     <fieldset
                //                                                         class="product-option-list product-option-size">
                //                                                         <input id="xs" type="radio"
                //                                                             name="Size" value="XS"
                //                                                             form="product-form-1">
                //                                                         <label for="xs">XS</label>
                //                                                         <input id="s" type="radio"
                //                                                             name="Size" value="S"
                //                                                             form="product-form-1">
                //                                                         <label for="s">S</label>
                //                                                         <input id="m" type="radio"
                //                                                             name="Size" value="M/L"
                //                                                             form="product-form-1" checked="checked">
                //                                                         <label for="m">M</label>
                //                                                         <input id="l" type="radio"
                //                                                             name="Size" value="L"
                //                                                             form="product-form-1">
                //                                                         <label for="l">L</label>
                //                                                         <input id="xl" type="radio"
                //                                                             name="Size" value="XL"
                //                                                             form="product-form-1">
                //                                                         <label for="xl" class="disabled">XL</label>
                //                                                     </fieldset>
                //                                                 </div>
                //                                             </div>
                //                                         </div>
                //                                     </div>
                //                                     <div class="product-content">
                //                                         <h5 class="product-title">
                //                                             <a
                //                                                 href="{{ route('front-product.detail', ['product' => 'product', 'title' => productSlug($product->name) . '.html', 'sku' => productSlug($product->sku)]) }}">Burnished
                //                                                 Amber Pullover</a>
                //                                         </h5>
                //                                         <div class="product-price">
                //                                             @if ($products->discount > 0)
                //                                                 <del>₹ {{ floor($products->buying_price) }}</del>
                //                                             @endif
                //                                             <ins>₹ {{ floor($products->selling_price) }}</del>

                //                                         </div>
                //                                         <div class="product-addtocart-button">
                //                                             <a href="#" class="product-addtocart"> <svg
                //                                                     fill="#010101" height="20px" width="20px"
                //                                                     version="1.1" id="Capa_1"
                //                                                     xmlns="http://www.w3.org/2000/svg"
                //                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                //                                                     viewBox="0 0 483.1 483.1" xml:space="preserve">
                //                                                     <path
                //                                                         d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                //                                                                                                                                                                                                                                                                                                                                                         c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                //                                                                                                                                                                                                                                                                                                                                                         C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                //                                                                                                                                                                                                                                                                                                                                                             M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                //                                                                                                                                                                                                                                                                                                                                                         c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z" />

                //                                                 </svg></a>
                //                                         </div>
                //                                     </div>
                //                                 </div>
                //                             </li>
                //                         @endforeach
                //                     </ul>
                //                 </div>
                //             </div>
                //         </div>
                //     </div>
                // @endif --}}

                <!------ Related Products ------>
                <section class="fw_product_section product_related_inner pt-60">
                    <div class="container">

                        <div class="fw_section_head">
                            <h2>Related Products</h2>
                            <div class="fw_refresh_arrows">
                                <button class="fw_prev_05">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                </button>

                                <button class="fw_next_05">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                            </div>
                        </div>

                        <div class="best_seller">
                            <!-- Product -->
                            @foreach ($best_seller_products as $bestseller)
                                <div class="product-card">
                                    <div class="product-image">
                                        <img src="{{ $bestseller->images['first'] }}" class="default" alt="">
                                        <img src="{{ $bestseller->images['second'] }}" class="hover" alt="">

                                    </div>
                                    <div class="hover-panel">
                                        <div class="hover-content">
                                            <h3>
                                                {{ $bestseller->name }}
                                            </h3>
                                            <div class="price-wrap">
                                                <span class="price">₹{{ $bestseller->selling_price }}</span>
                                                <span class="old-price">₹{{ $bestseller->buying_price }}</span>
                                            </div>
                                            <div class="product-actions">
                                                <a href="{{ env('WEBSITE_URL') . 'product/product/' . productSlug($bestseller->name) . '.html/' . $bestseller->sku }}"
                                                    class="action-btn add_to_cart_btn">
                                                    Buy now
                                                </a>

                                                <button class="wishlist-btn">
                                                    <span class="material-symbols-outlined">favorite</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script>
            $(document).ready(function() {

                initProductSliders();
                /* =========================
                   PRODUCT MAIN SLIDER
                ========================= */

                $('.product-main-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    infinite: false,
                    asNavFor: '.product-thumb-slider'
                });

                /* =========================
                   PRODUCT THUMB SLIDER
                ========================= */

                $('.product-thumb-slider').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    arrows: false,
                    infinite: false,
                    focusOnSelect: true,
                    asNavFor: '.product-main-slider',

                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 3
                            }
                        }
                    ]
                });


                /* =========================
                   POPUP MAIN SLIDER
                ========================= */

                $('.popup-main-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,

                    arrows: true,
                    infinite: false,
                    fade: true,

                    asNavFor: '.popup-thumb-slider'
                });


                /* =========================
                   POPUP THUMB SLIDER
                ========================= */

                $('.popup-thumb-slider').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,

                    arrows: true,
                    infinite: false,

                    focusOnSelect: true,

                    asNavFor: '.popup-main-slider',

                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 3
                            }
                        }
                    ]
                });


                /* =========================
                   OPEN POPUP
                ========================= */

                $('.product-main-slider').on('click', '.product-slide', function() {

                    let index = $('.product-main-slider')
                        .slick('slickCurrentSlide');

                    $('.gallery-popup').addClass('active');

                    $('body').css('overflow', 'hidden');


                    /*
                     * Important because Slick popup
                     * was hidden using display:none
                     */

                    $('.popup-main-slider').slick('setPosition');
                    $('.popup-thumb-slider').slick('setPosition');


                    /*
                     * Open same image
                     */

                    $('.popup-main-slider')
                        .slick('slickGoTo', index, true);

                    $('.popup-thumb-slider')
                        .slick('slickGoTo', index, true);

                    resetZoom();

                });


                /* =========================
                   CLOSE POPUP
                ========================= */

                $('.gallery-close').on('click', function() {

                    closeGallery();

                });


                /* =========================
                   OUTSIDE CLICK
                ========================= */

                $('.gallery-popup').on('click', function(e) {

                    if ($(e.target).hasClass('gallery-popup')) {

                        closeGallery();

                    }

                });


                /* =========================
                   ESC CLOSE
                ========================= */

                $(document).on('keydown', function(e) {

                    if (e.key === 'Escape') {

                        closeGallery();

                    }

                });


                function closeGallery() {

                    $('.gallery-popup')
                        .removeClass('active');

                    $('body').css('overflow', '');

                    resetZoom();

                }


                /* =========================
                   ZOOM
                ========================= */

                let zoomLevel = 1;


                $('.zoom-plus').on('click', function() {

                    zoomLevel += 0.25;

                    if (zoomLevel > 3) {
                        zoomLevel = 3;
                    }

                    updateZoom();

                });


                $('.zoom-minus').on('click', function() {

                    zoomLevel -= 0.25;

                    if (zoomLevel < 1) {
                        zoomLevel = 1;
                    }

                    updateZoom();

                });


                function updateZoom() {

                    $('.popup-main-slider .slick-current img')
                        .css(
                            'transform',
                            'scale(' + zoomLevel + ')'
                        );

                }


                function resetZoom() {

                    zoomLevel = 1;

                    $('.popup-main-slider img')
                        .css(
                            'transform',
                            'scale(1)'
                        );

                }


                /* =========================
                   RESET ZOOM ON SLIDE CHANGE
                ========================= */

                $('.popup-main-slider').on(
                    'beforeChange',
                    function() {

                        resetZoom();

                    }
                );

            });
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.product-tab-btn').on('click', function() {
                    var tabId = $(this).data('tab');
                    $('.product-tab-btn').removeClass('active');
                    $(this).addClass('active');
                    $('.product-tab-content').removeClass('active');
                    $('#' + tabId).addClass('active');
                });

            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js"></script>
        <script>
            anime({
                targets: '.facebook-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 500
                    },
                ]
            });
            anime({
                targets: '.instagram-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 1000
                    },
                ]
            });
            anime({
                targets: '.twitter-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 1500
                    },
                ]
            });
            anime({
                targets: '.youTube-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 1000
                    },
                ]
            });
            anime({
                targets: '.pinterest-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 1500
                    },
                ]
            });
            anime({
                targets: '.codepen-svg',

                rotateX: [{
                        value: 0 + 'deg',
                        duration: 500
                    },
                    {
                        value: 360 + 'deg',
                        duration: 2500,
                        delay: 2000
                    },
                ]
            });

            let fblogoCircle = document.querySelector('.fb-logoCircle');
            let fbRing = document.querySelector('.fb-ring');
            let facebook = document.querySelector('.facebook-svg');

            facebook.addEventListener('mouseenter', function() {
                anime({
                    targets: fblogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .65,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            facebook.addEventListener('mouseenter', function() {
                anime({
                    targets: fbRing,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });

            let instaLogoCircle = document.querySelector('.ig-logoCircle');
            let igRing = document.querySelector('.ig-ring');
            let insta = document.querySelector('.instagram-svg');

            insta.addEventListener('mouseenter', function() {
                anime({
                    targets: instaLogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .80,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            insta.addEventListener('mouseenter', function() {
                anime({
                    targets: igRing,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });

            let twitterLogoCircle = document.querySelector('.tw-logoCircle');
            let twRing = document.querySelector('.tw-ring');
            let twitter = document.querySelector('.twitter-svg');

            twitter.addEventListener('mouseenter', function() {
                anime({
                    targets: twitterLogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .65,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            twitter.addEventListener('mouseenter', function() {
                anime({
                    targets: twRing,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });

            let youTubeLogoCircle = document.querySelector('.yt-logoCircle');
            let ytRing = document.querySelector('.yt-ring');
            let tube = document.querySelector('.youTube-svg');

            tube.addEventListener('mouseenter', function() {
                anime({
                    targets: youTubeLogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .75,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            tube.addEventListener('mouseenter', function() {
                anime({
                    targets: ytRing,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });

            let pinterestLogoCircle = document.querySelector('.pt-logoCircle');
            let ptRing = document.querySelector('.pt-ring');
            let pinterest = document.querySelector('.pinterest-svg');

            pinterest.addEventListener('mouseenter', function() {
                anime({
                    targets: pinterestLogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .75,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            pinterest.addEventListener('mouseenter', function() {
                anime({
                    targets: ptRing,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });

            let codepenLogoCircle = document.querySelector('.cp-logoCircle');
            let ring = document.querySelector('.cp-ring');
            let pen = document.querySelector('.codepen-svg');

            pen.addEventListener('mouseenter', function() {
                anime({
                    targets: codepenLogoCircle,
                    scale: [{
                            value: 1.1,
                            duration: 150
                        },
                        {
                            value: .75,
                            duration: 300
                        },
                        {
                            value: 1,
                            duration: 500
                        }
                    ],
                });
            });

            pen.addEventListener('mouseenter', function() {
                anime({
                    targets: ring,
                    scale: [{
                            value: 1,
                            duration: 100
                        },
                        {
                            value: .85,
                            duration: 250
                        },
                        {
                            value: 1,
                            duration: 600
                        }
                    ],
                });
            });
        </script>
        <!--content-wrapper -->
    </section>
@endsection
<!--=====================================================
                Site Section End
=========================================================-->
@push('scripts')
    @if ($activeVarientId)
        <script>
            const productVariantSpecification = @json($productVariantSpecification);
            const productDefaultSpecification = @json($product->content_1 ?? '');

            $(document).ready(function() {

                const activeVariant = document.querySelector(
                    '[data-vid="{{ $activeVarientId }}"]'
                );

                if (activeVariant) {
                    updateVariantSpecification(activeVariant);
                }
            });

            function updateVariantSpecification(element) {

                const variantValueId = $(element).data('vid');

                const specification = productVariantSpecification.find(
                    item => String(item.variant_value_id) === String(variantValueId)
                );

                // Default product specification
                let content = productDefaultSpecification || '';

                if (specification) {

                    const contentKey = 'content_' + variantValueId;
                    const variantContent = specification[contentKey] ?? '';

                    // Variant specification ko priority
                    if (
                        variantContent &&
                        String(variantContent)
                            .replace(/<[^>]*>/g, '')
                            .trim() !== ''
                    ) {
                        content = variantContent;
                    }
                }

                // Check final content
                const hasContent =
                    content &&
                    String(content)
                        .replace(/<[^>]*>/g, '')
                        .trim() !== '';

                if (hasContent) {

                    $('#productSpecificationContent').html(content);
                    $('#productSpecificationBox').show();

                } else {

                    $('#productSpecificationContent').html('');
                    $('#productSpecificationBox').hide();

                }
            }
            function updateVariantImages(variantId) {

                console.log('variant_id', variantId);

                const mainSlider = $('.product-main-slider');
                const thumbSlider = $('.product-thumb-slider');

                /*
                * IMPORTANT:
                * Existing Slick destroy karo
                */

                if (mainSlider.hasClass('slick-initialized')) {
                    mainSlider.slick('unslick');
                }

                if (thumbSlider.hasClass('slick-initialized')) {
                    thumbSlider.slick('unslick');
                }


                /*
                * Product ki saari images
                */

                const allImages = @json($product->product_main_images);


                /*
                * Selected variant ki images
                */

                const variantImages = allImages.filter(function (image) {

                    return String(image.variant_id) === String(variantId);

                });


                console.log('variant images', variantImages);


                /*
                * Main slider HTML
                */

                let slideRow = '';

                /*
                * Thumbnail HTML
                */

                let thumbnailRow = '';


                variantImages.forEach(function (image, index) {

                    const imageUrl =
                        "{{ asset('uploads/products') }}/" + image.graphic;


                    slideRow += `
                        <div class="product-slide">
                            <img src="${imageUrl}" alt="">
                        </div>
                    `;


                    thumbnailRow += `
                        <div class="thumb">
                            <img src="${imageUrl}" alt="${index}">
                        </div>
                    `;

                });


                console.log('thumbnailRow', thumbnailRow);
                console.log('slideRow', slideRow);


                /*
                * New HTML set karo
                */

                mainSlider.html(slideRow);
                thumbSlider.html(thumbnailRow);


                /*
                * Slick dobara initialize
                */

                initProductSliders();

            }
            function initProductSliders() {

                /* =========================
                PRODUCT MAIN SLIDER
                ========================= */

                $('.product-main-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    infinite: false,
                    asNavFor: '.product-thumb-slider'
                });


                /* =========================
                PRODUCT THUMB SLIDER
                ========================= */

                $('.product-thumb-slider').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    arrows: false,
                    infinite: false,
                    focusOnSelect: true,
                    asNavFor: '.product-main-slider',

                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 3
                            }
                        }
                    ]
                });
            }
        </script>
    @endif
    <script>
        var checkoutUrl = "{{ route('front-product.checkoutBag') }}";
        var goTocartUrl = "{{ route('product.viewBag') }}"; 
        $(document).ready(function() {
            $("#buy_now_auto_add_to_cart").click(function() {
                localStorage.setItem('oldCartItems', JSON.stringify([]));

                var oldCartItems = localStorage.getItem('cartItems') || '[]';
                console.log("---------my old cart--------", oldCartItems);
                localStorage.setItem('oldCartItems', oldCartItems);
                localStorage.setItem('isBuyNow', '1');
                localStorage.setItem('cartItems', JSON.stringify([]));

                setTimeout(() => {
                    $(".addToCartBtn").trigger("click");
                    window.location.href = checkoutUrl;
                }, 1000);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            restoreOldCartItems();
        });

        function restoreOldCartItems() {
            const oldCartItems = localStorage.getItem('oldCartItems');
            const isBuyNow = localStorage.getItem('isBuyNow');
            if (isBuyNow === '1' && oldCartItems) {
                let oldItems = JSON.parse(oldCartItems) || [];
                let currentItems = JSON.parse(
                    localStorage.getItem('cartItems') || '[]'
                )
                let mergedItems = [...oldItems, ...currentItems];

                localStorage.setItem(
                    'cartItems',
                    JSON.stringify(mergedItems)
                );
                localStorage.removeItem('oldCartItems');
                localStorage.setItem('isBuyNow', '0');
                console.log('Old Cart:', oldItems);
                console.log('Current Cart:', currentItems);
                console.log('Merged Cart:', mergedItems);
            }
        }
        $(document).on('click', '.search-category', function() {
            selectVariant($(this));
        });

        function checkVariantStock(el) {
            let productId = el.dataset.productid;
            let variantId = el.dataset.id;
            let variantValueId = el.dataset.vid;

            $.ajax({
                url: "{{ route('variant.stock.check') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    variant_id: variantId,
                    variant_value_id: variantValueId
                },
                success: function(res) {

                    let productOut = $('#variantOutOfStock').data('product-out');

                    // If whole product is out, never hide it
                    if (productOut == 1) {
                        $('#variantOutOfStock').removeClass('d-none');
                        $('.add-to-cart').addClass('disabled-action');
                        return;
                    }

                    // Variant-level logic only
                    $('.s-variant').removeClass('out-of-stock');

                    if (res.out_of_stock) {
                        $(el).addClass('out-of-stock');

                        $('#variantOutOfStock').removeClass('d-none');
                        $('.add-to-cart').addClass('disabled-action');
                    } else {
                        $('#variantOutOfStock').addClass('d-none');
                        $('.add-to-cart').removeClass('disabled-action');
                    }
                }

            });
        }
    </script>

@endpush
