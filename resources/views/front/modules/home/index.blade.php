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

                    @if(!empty($images))
                        @foreach($images as $image)
                            <div class="fw_ads_one">
                                <img src="{{ url('uploads/coupon/'.$image) }}" alt="">
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
                @if(!empty($featureSubCategory))
                    @foreach ($featureSubCategory->take(14) as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="fw_category_card">
                            <div class="fw_category_image">
                                <img src="{{ url('uploads/categories/' . ($category->getAttributes()['image'] ?? '')) }}" alt="{{ $category->name }}{{ $category->image }}">
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
                    @if(!empty($refreshYourRoom))
                        @foreach($refreshYourRoom as $category)
                                <div class="fw_collection_card">
                                    <div class="image">
                                        <a href="{{ route('category.show', $category->slug) }}">
                                            <img src="{{ $category->image ?? asset('assets/front/images/collection_01.png') }}" alt="{{ $category->name }}">
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
                       <img src="{{$bestseller->images['first']}}" class="default" alt="">
                       <img src="{{$bestseller->images['second']}}" class="hover" alt="">

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
                                <a href="{{ env('WEBSITE_URL') .'product/'. productSlug($bestseller->name) . '.html/' . productSlug($bestseller->sku) }}" class="action-btn add_to_cart_btn">
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
                    @foreach($modernLiving1 as $liv)
                    <div class="border">
                        <a href="{{ route('category.show', $liv->slug) }}" class="fw_subcat_card fw_subcat_large">
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
                    @foreach($modernLiving2 as $liv2)
                    <div class="border">
                        <a href="{{ route('category.show', $liv2->slug) }}" class="fw_subcat_card fw_subcat_wide">
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
                    @foreach($modernLiving3 as $liv3)
                    <div class="border">
                        <a href="{{ route('category.show', $liv3->slug) }}" class="fw_subcat_card">
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

                    <!-- product card -->
                    @foreach($childCategory->take(11) as $home)
                        @if(!is_null($home->productName))
                    <div class="product_card">
                        <div class="product_card_image">
                            <a href="{{ route('category.show', $home->slug) }}">
                                <img src="{{$home->image}}" alt="">
                            </a>
                        </div>
                        <div class="product_content">
                            <div class="product_title">
                                <h4>{{ $home->name }}</h4>
                            </div>
                            <div class="product_price">
                                <a href="{{ route('category.show', $home->slug) }}" style="text-decoration: none;color:#000000"><span>Starting Price - ₹ {{ $home->lowest_selling_price }}</span> <span class="strikethrouh"></span></a>
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
                @foreach ($new_arrivals_product as $arrivals)
                    <div class="product-card">
                        <div class="product-image">
                            <img class="default" src="{{ $arrivals->images['first'] }}" alt="">
                            <img src="{{ $arrivals->images['second'] }}" class="hover" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>{{ $arrivals->name }}</h3>
                                <div class="price-wrap">
                                    <span class="price">₹{{ $arrivals->selling_price }}</span>
                                    <span class="old-price">₹{{ $arrivals->buying_price  }}</span>
                                </div>
                                <div class="product-actions">
                                    <a href="{{ env('WEBSITE_URL') .'product/'. productSlug($arrivals->name) . '.html/' . productSlug($arrivals->sku) }}" class="action-btn add_to_cart_btn">
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

    <!-- CATEGORY LISTING  -->
    <section class="fw_category_section py-60">
        <div class="container-fluid">
            <section>
                <div class="room-layout">
                    <div class="room-content">
                        <div class="nav_btn_container">
                            <button class="nav-btn prev">
                                <span class="material-symbols-outlined">
                                    arrow_back_ios_new
                                </span>
                            </button>

                            <button class="nav-btn next">
                                <span class="material-symbols-outlined">
                                    arrow_forward_ios
                                </span>
                            </button>
                        </div>
                        <span class="section-tag">
                            DESIGN YOUR SPACE
                        </span>
                       
                        <h2 id="catName"></h2>
                        <p class="fw_content" id="catDescription">
                            {{-- Explore complete room collections designed to help
                            you create beautiful and harmonious living
                            environments. --}}
                        </p>
                        <a href="#" class="btn-primary" id="catUrl">
                            <span>Explore Collection</span>
                        </a>
                    </div>

                    <div class="room-showcase">
                        <div class="cube-scene">
                            <div class="room-carousel" id="roomCarousel">
                            </div>
                        </div>

                        @php
                        $icons = ['weekend','bed', 'table_restaurant', 'desk', 'deck', 'toys', 'wall_lamp', 'kitchen'];
                        @endphp

                        <div class="room-categories">
                            @foreach($MainCategory as $index => $cate)
                                <a href="" data-index="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}">
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
                        arrow_back_ios_new
                    </span>
                </button>

                <button class="nav-btn next">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
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

                        @if(!empty($gal->description))
                            <span>{{ Str::limit($gal->description, 40) }}</span>
                        @else
                            <span>Explore our latest collection</span>
                        @endif

                        <a href="{{ route('category.show', $gal->slug) }}" class="btn-accent">
                            Explore Now
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
                    <img src="{{url('assets/front/images/collection_01.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_02.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_03.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_04.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_01.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_02.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="insta-card">
                    <img src="{{url('assets/front/images/collection_03.png')}}" alt="">
                    <div class="insta-overlay">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                </a>
            </div>

        </div>

    </section>

    <!-- CLIENT TESTIMONIAL -->
    @if(!empty($testimonials) and count($testimonials) > 0)
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
                @foreach($testimonials->chunk(5) as $group)
                    <div class="slide-item">
                        <div class="testimonial-stack">
                            @foreach($group->values() as $index => $row)
                                <div class="testimonial-card {{ $classes[$index] }}">
                                    <div class="stars">{{ str_repeat('★', $row->rating) }}{{ str_repeat('☆', 5 - $row->rating) }}</div>

                                    <p>{{ $row->description }}</p>

                                    <div class="user">
                                        <img src="{{ asset('uploads/testimonials/'.$row->image) }}" alt="{{ $row->name }}">
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
<script>
    window.mainCategories = @json($MainCategory);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const mainCategories = window.mainCategories || [];
        const catName = document.getElementById('catName');
        const catDescription = document.getElementById('catDescription');
        const catUrl = document.getElementById('catUrl');
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
            catName.innerHTML = category.name || '';
            catDescription.innerHTML = category.description || '';

            if (catUrl) {
                catUrl.href = category.url || '#';
            }

            const subCategories = category.sub_category || category.subCategory ||[];
            roomCarousel.innerHTML = '';
          
            subCategories.forEach(function (subCategory) {
                const slugUrl = `${subCategory.slug}`;
                roomCarousel.insertAdjacentHTML(
                    'beforeend',
                    `
                    <div class="room-card">
                        <img
                            src="${subCategory.image || ''}"
                            alt="${subCategory.name || ''}"
                       

                        <div class="overlay">

                           <a href="/${slugUrl}" style="text-decoration:none;">  
                            <h3>
                                ${subCategory.name || ''}
                            </h3>
                            </a>  

                        </div>

                    </div>
                      `
                );
            });
            console.log(
                'Total room cards:',
                roomCarousel.querySelectorAll('.room-card').length
            );
             categoryTabs.forEach(function (tab) {
                tab.classList.remove('active');
            });

            if (categoryTabs[categoryIndex]) {
                categoryTabs[categoryIndex].classList.add('active');
            }
             updateCarousel();
        }
        function updateCarousel() {
            const cards =
                roomCarousel.querySelectorAll('.room-card');
            const total = cards.length;
            if (total === 0) {
                return;
            }
            if (total === 1) {

                cards[0].className = 'room-card center';

                return;
            }
            cards.forEach(function (card) {
                card.className = 'room-card';
            });
            const prev =
                (currentSlide - 1 + total) % total;

            const next =
                (currentSlide + 1) % total;
            cards[currentSlide].classList.add('center');
            cards[prev].classList.add('left');
            cards[next].classList.add('right');
            cards.forEach(function (card, index) {
                if (
                    index !== currentSlide &&
                    index !== prev &&
                    index !== next
                ) {
                    if (index < currentSlide) {
                        card.classList.add('hidden-left');
                    } else {
                        card.classList.add('hidden-right');
                    }
                }
            });
        }
        if (nextButton) {
            nextButton.addEventListener('click', function () {
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
            prevButton.addEventListener('click', function () {
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
        categoryTabs.forEach(function (categoryTab) {
            categoryTab.addEventListener('click', function (e) {
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
     