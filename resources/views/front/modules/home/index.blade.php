@extends('front.layouts.app')
@section('content')
    <!-- HERO -->
    <section class="hero">
        <div class="hero_slider">
            <div class="slides">
                @foreach ($homeSlider as $slider)
                    <div class="slide">
                        <img src="{{ url('uploads/banners/' . ($slider->media_url ?? '')) }}" alt="Hero Slide 1">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- OFFER -->
    <div class="pt-60">
        <section class="fw_offer_strip">
            <div class="container">

                <div class="fw_offer_grid">

                    <div class="left-column">
                        <!-- Countdown  $ActiveCoupon->end_date-->
                        <div class="fw_offer_box fw_countdown_box">
                            <span class="fw_offer_label">FLASH <span>SALE</span></span>

                            <div class="fw_timer">
                                <div><strong id="days">00</strong><span>Days</span></div>
                                <div><strong id="hours">00</strong><span>Hrs</span></div>
                                <div><strong id="minutes">00</strong><span>Mins</span></div>
                                <div><strong id="seconds">00</strong><span>Secs</span></div>
                            </div>
                        </div>
                        <div class="right-column">
                            <!-- Features -->
                            <div class="fw_offer_box fw_features">
                                <div class="fw_feature">
                                    <div class="feature_icon">
                                        <span class="material-symbols-outlined">local_shipping</span>
                                    </div>
                                    <p>Free Delivery</p>
                                </div>
                                <div class="fw_feature">
                                    <div class="feature_icon">
                                        <span class="material-symbols-outlined">verified_user</span>
                                    </div>
                                    <p>Warranty</p>
                                </div>
                                <div class="fw_feature">
                                    <div class="feature_icon">
                                        <span class="material-symbols-outlined">workspace_premium</span>
                                    </div>
                                    <p>Premium Quality</p>
                                </div>
                                <div class="fw_feature">
                                    <div class="feature_icon">
                                        <span class="material-symbols-outlined">support_agent</span>
                                    </div>
                                    <p>24/7 Support</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Animated Ads -->
                    @php
                        $images = json_decode($ActiveCoupon->image, true);
                    @endphp

                    @if (!empty($images))
                        @foreach ($images as $image)
                            <div class="fw_ads_one">
                                <img src="{{ url('uploads/coupon/' . $image) }}" alt="">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </div>

    <!-- category -->
    <section class="fw_categories pt-60">
        <div class="container">

            <div class="fw_category_grid">
                @if (!empty($featureSubCategory))
                    @foreach ($featureSubCategory->take(14) as $category)
                        <a href="{{ route('category.show', ['path' => $category->parentCategory->slug.'/'.$category->slug]) }}" class="fw_category_card">
                            <div class="fw_category_image">
                                <img src="{{ url('uploads/categories/' . ($category->getAttributes()['image'] ?? '')) }}"
                                    alt="{{ $category->name }}{{ $category->image }}">
                            </div>
                            <h4 style="color: #000000">{{ $category->name }}</h4>
                        </a>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    <!-- SHOP BY Category -->
    <section class="fw_refresh_room pt-60">
        <div class="container-fluid">
            <div class="fw_refresh_wrap">
                <!-- Left Content -->
                <div class="fw_refresh_content">
                    <span class="fw_subtitle">Curated Collections</span>
                    <h2 class="fw_title">
                        Refresh <br>
                        Your Room
                    </h2>
                    <p class="fw_content">
                        Discover handcrafted furniture collections
                        designed to elevate every corner of your home.
                    </p>
                    <div class="fw_refresh_arrows">
                        <button class="fw_prev_01">
                            <span class="material-symbols-outlined">arrow_back</span>
                        </button>

                        <button class="fw_next_01">
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>

                </div>

                <!-- Slider -->
                <div class="fw_refresh_slider">
                    @if (!empty($refreshYourRoom))
                        @foreach ($refreshYourRoom as $category)
                            <div class="fw_collection_card">
                                <div class="image">
                                    <a href="{{ route('category.show',['path' => $category->parentCategory->slug.'/'.$category->slug]) }}">
                                        <img src="{{ $category->image ?? asset('assets/front/images/collection_01.png') }}"
                                            alt="{{ $category->name }}">
                                    </a>
                                </div>
                                <h3>{{ $category->name }}</h3>
                                <a href="{{ route('category.show', $category->slug) }}" class="btn">
                                    Shop Now
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- BEST SELLER -->
    <section class="fw_product_section pt-60">
        <div class="container-fluid">

            <div class="fw_section_head">
                <h2>Best Seller</h2>
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
                                <div class="product-options">
                                    <div class="product-option-item">
                                         
                                        <div class="product-addtocart-button">
                                            <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($bestseller->name).'.html', 'sku' => $bestseller->sku]) }}" class="product-addtocart">
                                                 <div class="icon-cart-pro">
                                                    <svg fill="#fff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">
                                                         <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path>
                                                     </svg>
                                                </div> Add To Cart
                                             </a>
                                        </div>
                                    
                                        <div class="product-option-colors">
                                            @foreach($bestseller->productVariants as $productVariant)
                                                @if($productVariant->variant_id == 1)
                                                    @foreach($productVariant->variantValues as $variantValue)
                                                        @if($variantValue->variant_image)
                                                            <span
                                                                class="product-color-option {{ $variantValue->is_main == 1 ? 'active' : '' }}"
                                                                data-variant-value-id="{{ $variantValue->variant_value_id }}"
                                                                style="
                                                                    background-image: url('{{ asset('uploads/products/' . $variantValue->variant_image) }}');
                                                                    background-size: cover;
                                                                    background-position: center;
                                                                    background-repeat: no-repeat;
                                                                "
                                                            ></span>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="hover-content-inner">
                                    <h3>
                                        {{ $bestseller->name }}
                                    </h3>
                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                                <div class="price-wrap">
                                    <span class="price">₹{{ $bestseller->selling_price }}</span>
                                    <span class="old-price">₹{{ $bestseller->buying_price }}</span>
                                </div>
                                <!--div class="product-actions">
                                    <a href="{{ env('WEBSITE_URL') . 'product/product/' . productSlug($bestseller->name) . '.html/' . $bestseller->sku }}"
                                        class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                </div-->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
   
    <section class="fw_subcategories pt-60">
        <div class="container-fluid">
            <div class="text-center">
                <span class="fw_subtitle">Sub Category</span>
                <h2 class="fw_title">
                    Crafted For Modern Living
                </h2>
                <p class="fw_content">
                    Discover handcrafted furniture collections
                    designed to elevate every corner of your home.
                </p>
            </div>

            <div class="fw_subcategory_grid">
                <div class="fw_subcategory_grid_left">
                    @foreach ($modernLiving1 as $liv)
                        <div class="border">
                            <a href="{{ route('category.show',['path'=> $liv->slug]) }}" class="fw_subcat_card fw_subcat_large">
                                <img src="{{ $liv->image }}" alt="">
                                <div class="fw_subcat_content">
                                    <h3>{{ $liv->name }}</h3>
                                    <span>Explore Collection</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


                <!-- Wide -->
                <div class="fw_subcategory_grid_center">
                    @foreach ($modernLiving2 as $liv2)
                        <div class="border">
                            <a href="{{ route('category.show', ['path'=> $liv2->slug]) }}" class="fw_subcat_card fw_subcat_wide">
                                <img src="{{ $liv2->image }}" alt="">
                                <div class="fw_subcat_content">
                                    <h3>{{ $liv2->name }}</h3>
                                    <span>View Collection</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Row 3 -->
                <div class="fw_subcategory_grid_right">
                    @foreach ($modernLiving3 as $liv3)
                        <div class="border">
                            <a href="{{ route('category.show', ['path'=> $liv3->slug]) }}" class="fw_subcat_card">
                                <img src="{{ $liv3->image }}" alt="">
                                <div class="fw_subcat_content">
                                    <h3>{{ $liv3->name }}</h3>
                                    <span>Explore Collection</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- HOME DECOR -->


    <section class="fw_home_furnishing pt-60">
        <div class="container-fluid">
            <div class="text-center">
                <span class="fw_subtitle">Sub Category</span>
                <h2 class="fw_title">
                    Crafted For Home Living
                </h2>
                <p class="fw_content">
                    Discover handcrafted furniture collections
                    designed to elevate every corner of your home.
                </p>
            </div>
            <div class="fw_home_frunishing_grid">
                <div class="fw_home_frunishing_grid_banner_image">
                    <h3 class="tittle_new">Home Decor</h3>
                    <div class="border"></div>
                    <img src="{{ asset('assets/images/home_furnishing.jpg') }}" alt="">
                </div>
                <div class="fw_home_frunishing_product_grid">
                    @foreach ($childCategory->take(11) as $home)
                        @if (!is_null($home->productName))
                            <div class="product_card">
                                <div class="product_card_image">
                                    <a href="{{ route('category.show',['path'=>$home->parentCategory->parentCategory->slug.'/'.$home->parentCategory->slug.'/'.$home->slug] ) }}">
                                        <img src="{{ $home->image }}" alt="">
                                    </a>
                                </div>
                                <div class="product_content">
                                    <div class="product_title">
                                        <h4>{{ $home->name }}</h4>
                                    </div>
                                    <div class="product_price">
                                        <a href="{{ route('category.show', $home->slug) }}"
                                            style="text-decoration: none;color:#000000"><span>Starting Price - ₹
                                                {{ $home->lowest_selling_price }}</span> <span
                                                class="strikethrouh"></span></a>
                                    </div>
                                    <div class="btn-explore-now">
                                        <a href="#">Explore Now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT LISTING -->
    <section class="fw_product_section pt-60">
        <div class="container-fluid">

            <div class="fw_section_head">
                <h2>Trending Products</h2>
                <div class="fw_refresh_arrows">
                    <button class="fw_prev">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>

                    <button class="fw_next">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>

            <div class="fw_product_grid">
                @foreach ($trendingProduct as $trending)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $trending->images['first'] }}" class="default" alt="">
                            <img src="{{ $trending->images['second'] }}" class="hover" alt="">

                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <div class="product-options">
                                    <div class="product-option-item">
                                         
                                        <div class="product-addtocart-button">
                                            <a href="{{ env('WEBSITE_URL') . 'product/product' . productSlug($trending->name) . '.html/' .$trending->sku }}" class="product-addtocart">
                                                 <div class="icon-cart-pro">
                                                    <svg fill="#fff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">
                                                         <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path>
                                                     </svg>
                                                </div> Add To Cart
                                             </a>
                                        </div>
                                    
                                        <div class="product-option-colors">
                                           @foreach($trending->productVariants as $productVariant)
                                                @if($productVariant->variant_id == 1)
                                                    @foreach($productVariant->variantValues as $variantValue)
                                                        @if($variantValue->variant_image)
                                                            <span
                                                                class="product-color-option {{ $variantValue->is_main == 1 ? 'active' : '' }}"
                                                                data-variant-value-id="{{ $variantValue->variant_value_id }}"
                                                                style="
                                                                    background-image: url('{{ asset('uploads/products/' . $variantValue->variant_image) }}');
                                                                    background-size: cover;
                                                                    background-position: center;
                                                                    background-repeat: no-repeat;
                                                                "
                                                            ></span>

                                                        @endif

                                                    @endforeach

                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="hover-content-inner">
                                    <h3>
                                        {{ $trending->name }}
                                    </h3>
                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                                <div class="price-wrap">
                                    <span class="price">₹{{ $trending->selling_price }}</span>
                                    <span class="old-price">₹{{ $trending->buying_price }}</span>
                                </div>
                                <!--div class="product-actions">
                                    <a href="{{ env('WEBSITE_URL') . 'product/product/' . productSlug($bestseller->name) . '.html/' . $bestseller->sku }}"
                                        class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                </div-->
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- CATEGORY LISTING  -->
    <section class="fw_category_section py-60">
        <div class="container-fluid">
            <section>
                <div class="room-layout">
                    <div class="room-content">
                        <div class="nav_btn_container">
                            <button class="nav-btn prev">
                                <span class="material-symbols-outlined">
                                    arrow_back
                                </span>
                            </button>

                            <button class="nav-btn next">
                                <span class="material-symbols-outlined">
                                    arrow_forward
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="room-showcase">
                        <div class="cube-scene">
                            <div class="room-carousel" id="roomCarousel">
                            </div>
                        </div>

                        @php
                            $icons = ['weekend','bed','table_restaurant','desk','deck','toys','wall_lamp','kitchen',];
                        @endphp

                        <div class="room-categories">
                            @foreach ($MainCategory as $index => $cate)
                                <a href="" data-index="{{ $index }}"
                                    class="{{ $index == 0 ? 'active' : '' }}">
                                    <span class="material-symbols-outlined">
                                        {{ $icons[$index] ?? 'category' }}
                                    </span>
                                    {{ $cate->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <section class="fw_product_gallery">
        <div class="text-center">
            <span class="fw_subtitle">our product range</span>
            <h2 class="fw_title">
                Product Gallery
            </h2>
            <p class="fw_content">
                Discover handcrafted furniture collections
                designed to elevate every corner of your home.
            </p>
            <div class="nav_btn_container">
                <button class="nav-btn prev">
                    <span class="material-symbols-outlined">
                        arrow_back
                    </span>
                </button>

                <button class="nav-btn next">
                    <span class="material-symbols-outlined">
                        arrow_forward
                    </span>
                </button>
            </div>
        </div>
        <div class="product_card_swiper">
            <div class="swiper-wrapper">
                @forelse($productGallery as $gal)
                    <div class="swiper-slide"
                        style="background-image:url('{{ url('uploads/categories/' . ($gal->getAttributes()['image'] ?? '')) }}')">

                        <div class="info">
                            <span>
                                <i class="material-symbols-outlined">chair</i>
                                {{ $gal->name }}
                            </span>

                            @if (!empty($gal->description))
                                <span>{{ Str::limit($gal->description, 40) }}</span>
                            @else
                                {{-- <span>Explore our latest collection</span> --}}
                            @endif

                            <a href="{{ route('category.show',['path'=>$gal->parentCategory->slug.'/'.$gal->slug] ) }}" class="btn-accent">
                                Explore
                                <i class="material-symbols-outlined">arrow_outward</i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide"
                        style="background-image:url('{{ asset('assets/front/images/collection_01.png') }}')">
                        <div class="info">
                            <span>No Categories Found</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- INSTA SECTION -->
    <section class="instagram-section py-60">
        <div class="container">
            <div class="text-center ">
                <span class="fw_subtitle">FOLLOW US</span>
                <h2 class="fw_title">
                    @FurnitureWord
                </h2>
                <p class="fw_content">
                    Discover beautiful spaces, styling ideas and furniture inspiration.
                </p>
            </div>
            <div class="fw_refresh_arrows" style="justify-content: center;">
                <button class="fw_prev_insta slick-arrow">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>

                <button class="fw_next_insta slick-arrow">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>

        </div>

        <div class="instagram-slider">

            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_01.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_02.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_03.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_04.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_01.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_02.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{ url('assets/front/images/collection_03.png') }}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>

        </div>

    </section>

    <!-- CLIENT TESTIMONIAL -->
    @if (!empty($testimonials) and count($testimonials) > 0)
        <section class="fw_testimonials">
            <div class="container-fluid">
                <div class="section-head">
                    <span>Customer Stories</span>
                    <h2>What Our Customers Say</h2>
                </div>
                <div class="testimonial-slider">
                    @php
                        $classes = ['card-1', 'card-2', 'card-3', 'card-active', 'card-5'];
                    @endphp
                    @foreach ($testimonials->chunk(5) as $group)
                        <div class="slide-item">
                            <div class="testimonial-stack">
                                @foreach ($group->values() as $index => $row)
                                    <div class="testimonial-card {{ $classes[$index] }}">
                                        <div class="stars">
                                            {{ str_repeat('★', $row->rating) }}{{ str_repeat('☆', 5 - $row->rating) }}
                                        </div>

                                        <p>{{ $row->description }}</p>

                                        <div class="user">
                                            <img src="{{ asset('uploads/testimonials/' . $row->image) }}"
                                                alt="{{ $row->name }}">
                                            <div>
                                                <h4>{{ $row->name }}</h4>
                                                <span>{{ $row->city }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="fw_refresh_arrows">
                    <button class="fw_prev_02">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>

                    <button class="fw_next_02">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>
        </section>
    @endif
    <style>
        .room-carousel {
            position: relative;
            height: 450px;
            overflow: hidden;
        }

        .room-card {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 260px;
            transition: all 0.6s ease;
            opacity: 0;
            transform: translate(-50%, -50%) scale(.8);
            pointer-events: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .15);
            aspect-ratio: 6 / 8;
        }

        /* CENTER */
        .room-card.center {
            transform: translate(-50%, -50%) scale(1.25);
            opacity: 1;
            z-index: 5;
            pointer-events: auto;
        }

        /* LEFT */
        .room-card.left {
            transform: translate(-155%, -50%) scale(1.1);
            opacity: 1;
            z-index: 4;
            pointer-events: auto;
        }

        /* RIGHT */
        .room-card.right {
            transform: translate(55%, -50%) scale(1.1);
            opacity: 1;
            z-index: 4;
            pointer-events: auto;
        }

        /* FAR LEFT */
        .room-card.far-left {
            transform: translate(-255%, -50%) scale(1);
            opacity: .8;
            z-index: 3;
            pointer-events: auto;
        }

        /* FAR RIGHT */
        .room-card.far-right {
            transform: translate(155%, -50%) scale(1);
            opacity: .8;
            z-index: 3;
            pointer-events: auto;
        }

        /* HIDDEN CARDS */
        .room-card.hidden {
            opacity: 0;
            transform: translate(-50%, -50%) scale(.8);
            z-index: 0;
        }
    </style>


    <script>
        window.mainCategories = @json($MainCategory);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const mainCategories = window.mainCategories || [];
            const roomCarousel = document.getElementById('roomCarousel');
            const categoryTabs = document.querySelectorAll('.room-categories a');
            const nextButton = document.querySelector('.nav-btn.next');
            const prevButton = document.querySelector('.nav-btn.prev');

            let currentCategory = 0;

            let currentSlide = 0;

            function loadCategory(categoryIndex) {
                const category = mainCategories[categoryIndex];
                if (!category) {
                    return;
                }
                currentCategory = categoryIndex;
                currentSlide = 0;
                const subCategories = category.sub_category || category.subCategory || [];
                roomCarousel.innerHTML = '';
                subCategories.forEach(function(subCategory) {
                const slugUrl = `${category.slug}/${subCategory.slug}`;
                    roomCarousel.insertAdjacentHTML(
                        'beforeend',
                        `
                    <div class="room-card">
                        <a href="/${slugUrl}" style="text-decoration:none;">
                            <img src="${subCategory.image || ''}" alt="${subCategory.name || ''}">
                        </a>  
                        <div class="overlay">
                            <h3><a href="/${slugUrl}" style="text-decoration:none;">${subCategory.name || ''}</a></h3>
                        </div>
                    </div>
                      `
                    );
                });
                console.log(
                    'Total room cards:',
                    roomCarousel.querySelectorAll('.room-card').length
                );
                categoryTabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });

                if (categoryTabs[categoryIndex]) {
                    categoryTabs[categoryIndex].classList.add('active');
                }
                updateCarousel();
            }
            function updateCarousel() {
                const cards = roomCarousel.querySelectorAll('.room-card');
                const total = cards.length;

                if (total === 0) return;

                cards.forEach(function(card) {
                    card.className = 'room-card';
                });

                if (total === 1) {
                    cards[0].classList.add('center');
                    return;
                }

                const center = currentSlide;

                const left = (currentSlide - 1 + total) % total;
                const farLeft = (currentSlide - 2 + total) % total;

                const right = (currentSlide + 1) % total;
                const farRight = (currentSlide + 2) % total;

                cards[center].classList.add('center');

                if (total > 1) {
                    cards[left].classList.add('left');
                    cards[right].classList.add('right');
                }

                if (total > 3) {
                    cards[farLeft].classList.add('far-left');
                    cards[farRight].classList.add('far-right');
                }

                cards.forEach(function(card, index) {
                    if (
                        index !== center &&
                        index !== left &&
                        index !== right &&
                        index !== farLeft &&
                        index !== farRight
                    ) {
                        card.classList.add('hidden');
                    }
                });
            }
            if (nextButton) {
                nextButton.addEventListener('click', function() {
                    const cards =
                        roomCarousel.querySelectorAll('.room-card');
                    const total = cards.length;
                    if (total <= 1) {
                        return;
                    }
                    currentSlide =
                        (currentSlide + 1) % total;
                    updateCarousel();
                });
            }
            if (prevButton) {
                prevButton.addEventListener('click', function() {
                    const cards =
                        roomCarousel.querySelectorAll('.room-card');
                    const total = cards.length;
                    if (total <= 1) {
                        return;
                    }
                    currentSlide =
                        (currentSlide - 1 + total) % total;
                    updateCarousel();
                });
            }
            categoryTabs.forEach(function(categoryTab) {
                categoryTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryIndex =
                        parseInt(this.dataset.index);
                    loadCategory(categoryIndex);
                });
            });
            if (mainCategories.length > 0) {
                loadCategory(0);
            }
        });
    </script>
@endsection
