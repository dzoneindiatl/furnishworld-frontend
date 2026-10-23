@php 
    $minSellingQty = 1;
    $maxSellingQty = 10;
    if(!empty($cartItems[0]['product'])){
        $getMinMaxOrderQty = getMinMaxOrderQty($cartItems[0]['product']->id);
        if(!empty($getMinMaxOrderQty)){
            $minSellingQty = $getMinMaxOrderQty['minSellQty'];
            $maxSellingQty = $getMinMaxOrderQty['maxSellQty'];
        }
    }
@endphp
<script>
    var minSellingQty = '<?php echo $minSellingQty; ?>';
    var maxSellingQty = '<?php echo $maxSellingQty; ?>';
    var maxSellingQtyNew = 10;
    var notRequiredQtyAjaxClickonQtyBtn = true;
    console.log('header notRequiredQtyAjaxClickonQtyBtn : ',notRequiredQtyAjaxClickonQtyBtn);
    var getVarientReaminingQty = "{{ route('get-variant-remaining-qty') }}";
    var isOutOfStock = "{{ route('is-outofstock') }}";
    var emptyCartImg = `<img  src="<?php echo  env('WEBSITE_URL').'assets/front/img/cart-empty.png'; ?>" width="200" height="200" alt="cart empty" /><div class="proceed-to-checkout text-center">
  <p><a href="<?php echo env('WEBSITE_URL'); ?>" class="btn btn-primary w-100"> Continue Shopping</a></p></div>`;
</script>
    <header class="header_container">
        <div class="logo">
            <img src="{{ env('WEBSITE_URL').'uploads/settings/'.@$siteLogo->value }}" alt="Logo">
        </div>
        <!-- Navigation start Here -->
        <nav class="main-nav">
            <button class="nav-close">
                <span class="material-symbols-outlined">
                    close_small
                </span>
            </button>
            <ul>
                <li>
                    <a href="{{ env('WEBSITE_URL') }}">Home</a>
                </li>

                @if(!empty($all_menu_categories))
                    @foreach ($all_menu_categories as $category)
                        @php
                            $subcategories = $category->subcategories;
                        @endphp
                        @if($category->style_type == 1)
                        <!-- MEGA MENU -->
                        <li class="has-mega">
                            <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}<span class="material-symbols-outlined">expand_more</span></a>
                            <div class="mega-menu">
                                @foreach ($subcategories as $rowsub)
                                    @php
                                        $child_categories = $rowsub->childrenmenu;
                                    @endphp
                                    <div class="mega-col">
                                        <h4>{{ $rowsub->name }}</h4>
                                        @foreach ($child_categories as $child)
                                            <a href="{{ route('category.show', $sub->slug) }}">{{ $child->name }}</a>
                                        @endforeach
                                    </div>
                                @endforeach
                                <div class="mega-banner">
                                    <img src="{{ url('uploads/categories/' . ($rowsub->getAttributes()['image'] ?? '')) }}" alt="{{ $rowsub->name }}{{ $rowsub->image }}">
                                    <div class="mega-banner-content">
                                        <h3>Luxury Living Collection</h3>
                                        <a href="{{ route('category.show', $rowsub->slug) }}">
                                            {{ $rowsub->name }}
                                        </a>
                                </div>
                            </div>
                        </li>
                        @elseif($category->style_type == 2)
                            <!-- NORMAL DROPDOWN -->
                            <li class="has-dropdown">
                                <a href="{{ route('category.show', $category->slug) }}">{{$category->name }}<span class="material-symbols-outlined">expand_more</span></a>
                                <ul class="dropdown-menu">
                                    @foreach ($subcategories as $sub)
                                        <li><a href="{{ route('category.show', $sub->slug) }}">{{ $sub->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                        @elseif ($category->style_type == 3)
                        
                        <!-- MEGA MENU -->
                        <li class="has-mega">
                            <a href="{{ route('category.show', $category->slug) }}">{{$category->name }}<span class="material-symbols-outlined">expand_more</span></a>
                            <div class="mega-menu">
                                @foreach ($subcategories as $sub)
                                    <div class="menu-product-grid">
                                        <!-- card -->
                                        <a href="" class="menu_product_card">
                                            <div class="menu_product_image">
                                                <img src="{{ url('uploads/categories/' . ($sub->getAttributes()['image'] ?? '')) }}" alt="{{ $sub->name }}{{ $sub->image }}">
                                            </div>
                                            <h5>{{ $sub->name }}</h5>
                                        </a>  
                                    </div>
                                 @endforeach
                            </div>
                        </li>
                        @endif
                    @endforeach
                @endif

                <li>
                    <a href="#">Office</a>
                </li>
                <li>
                    <a href="contact-us">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- ICONS  -->
        <div class="header_right">
            <!-- mobile button -->
            <button class="mobile_menu">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </button>
            <div class="search_icon">
                <button class="search_button"><span class="material-symbols-outlined">
                        search
                    </span>
                </button>
            </div>
            <span class="divider">|</span>
            <div class="user-actions">
                <button class="login_button" onclick="window.location.href='/login'">
                    <span class="material-symbols-outlined">person</span>
                    Login
                </button>
                <div class="cart-wrapper">
                    <button class="cart_button">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Cart
                        <span class="cart-count">2</span>
                    </button>

                    <div class="cart-dropdown">
                        <div class="cart-item">
                            <img src="{{('assets/front/images/img-1.jpg')}}" alt="">

                            <div class="cart-info">
                                <h5>Solid Wood TV Unit</h5>
                                <span>Qty: 1</span>
                                <strong>₹23,999</strong>
                            </div>

                            <button class="remove-item">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <div class="cart-item">
                            <img src="{{('assets/front/images/img-2.jpg')}}" alt="">
                            <div class="cart-info">
                                <h5>Luxury Sofa Set</h5>
                                <span>Qty: 1</span>
                                <strong>₹18,999</strong>
                            </div>

                            <button class="remove-item">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="cart-footer">
                            <div class="cart-total">
                                <span>Total</span>
                                <strong>₹42,998</strong>
                            </div>
                            <a href="#" class="view-cart-btn">View Cart</a>
                        </div>

                    </div>

                </div>

                <button class="wishlist_button">
                    <span class="material-symbols-outlined">favorite</span>
                    Wishlist
                </button>

            </div>

        </div>

        <!-- Search Overlay------------------------------------------------------------------------------------ -->
        <div class="search-overlay">
            <div class="search-header">
                <input type="text" placeholder="Search products...">

                <button class="close-search">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="search-content">
                <div class="popular-searches">
                    <h4>POPULAR CHOICES</h4>
                    <a href="#">office table</a>
                    <a href="#">sofa</a>
                    <a href="#">office chair</a>
                    <a href="#">reception table</a>
                    <a href="#">director table</a>
                </div>

                <div class="search-products">
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/tv-unit.jpg')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/collection_01.png')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/collection_02.png')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/collection_03.png')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/collection_04.png')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/subcat-01.jpg" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                    <a href="#" class="action-btn icon-btn">
                                        <span class="material-symbols-outlined">
                                            shopping_bag
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/subcat-02.jpg" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/subcat-04.jpg')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/subcat-05.jpg')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/img-7.jpg')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>
                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{('assets/front/images/img-5.jpg')}}" alt="">
                        </div>
                        <div class="hover-panel">
                            <div class="hover-content">
                                <h3>
                                    Solid Wood TV Unit In White Finish
                                </h3>
                                <div class="price-wrap">
                                    <span class="price">₹23,999</span>
                                    <span class="old-price">₹39,299</span>
                                </div>
                                <div class="product-actions">
                                    <a href="#" class="action-btn add_to_cart_btn">
                                        Buy now
                                    </a>

                                    <button class="wishlist-btn">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- ===================================================== -->


