@php
    $minSellingQty = 1;
    $maxSellingQty = 10;
    if (!empty($cartItems[0]['product'])) {
        $getMinMaxOrderQty = getMinMaxOrderQty($cartItems[0]['product']->id);
        if (!empty($getMinMaxOrderQty)) {
            $minSellingQty = $getMinMaxOrderQty['minSellQty'];
            $maxSellingQty = $getMinMaxOrderQty['maxSellQty'];
        }
    }
@endphp
<script>
    var minSellingQty = '{{ $minSellingQty }}';
    var maxSellingQty = '{{ $maxSellingQty }}';
    var maxSellingQtyNew = 10;
    var notRequiredQtyAjaxClickonQtyBtn = true;
    var getShippingAddress = "{{ route('front-get.shipping.address') }}";
    var getVarientReaminingQty = "{{ route('get-variant-remaining-qty') }}";
    var isOutOfStock = "{{ route('is-outofstock') }}";
    var emptyCartImg = `<img  src="<?php echo env('WEBSITE_URL') . 'assets/front/img/cart-empty.png'; ?>" width="200" height="200" alt="cart empty" /><div class="proceed-to-checkout text-center">
  <p><a href="<?php echo env('WEBSITE_URL'); ?>" class="btn btn-primary w-100"> Continue Shopping</a></p></div>`;
</script>
<header class="header_container">
    <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ env('WEBSITE_URL') . 'uploads/settings/' . @$siteLogo->value }}"
                alt="Logo"></a>
    </div>
    {{-- <nav class="main-nav">
            <button class="nav-close">
                <span class="material-symbols-outlined">
                    close_small
                </span>
            </button>
            <ul>
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                @foreach ($categories->whereNull('parent_id')->where('show_on_menu', 1) as $cat)
                    <li class="has-mega">
                        <a href="{{ url($cat->slug) }}">
                            {{ $cat->name }}
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </a>
                        <div class="mega-menu">
                            @foreach ($subCategories->where('parent_id', $cat->id)->where('show_on_menu', 1) as $subcat)
                                <div class="mega-col">
                                    <h4><a href="{{ route('category.show', $subcat->slug) }}">{{ $subcat->name }}</a></h4>
                                    @foreach ($childCategories->where('parent_id', $subcat->id)->where('show_on_menu', 1) as $childcat)
                                        <a href="{{ route('category.show', $childcat->slug) }}">
                                            {{ $childcat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </nav> --}}

    <nav class="main-nav">
        <button class="nav-close">
            <span class="material-symbols-outlined">
                close_small
            </span>
        </button>
        <ul>
            <li>
                <a href="http://127.0.0.1:8004">Home</a>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/living-room">
                    Living Room
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu mega-menu-inner" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/sofas">Sofas <span class="material-symbols-outlined">
                                    chevron_right
                                </span></a></h4>
                        <div class="mega-menu-inner-list">
                            <a href="http://127.0.0.1:8004/1-seater-sofa">
                                1 Seater Sofa
                            </a>
                            <a href="http://127.0.0.1:8004/3-seater-sofa">
                                3 Seater Sofa
                            </a>
                            <a href="http://127.0.0.1:8004/5-seater-sofa">
                                5 Seater Sofa
                            </a>
                        </div>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/tv-units">TV Units</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/coffee-table">Coffee Table</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/console-table">Console Table</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/sideboard">Sideboard</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/shoe-rack">Shoe Rack</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/bookshelf">Bookshelf</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/chest-of-drawers">Chest Of Drawers</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/side-end-table">Side End Table</a></h4>
                    </div>
                </div>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/bedroom">
                    Bedroom
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu mega-menu-inner" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/beds">Beds <span class="material-symbols-outlined">
                                    chevron_right
                                </span></a></h4>
                        <div class="mega-menu-inner-list">
                            <a href="http://127.0.0.1:8004/king-size-bed">
                                King Size Bed
                            </a>
                            <a href="http://127.0.0.1:8004/queen-size-bed">
                                Queen Size Bed
                            </a>
                            <a href="http://127.0.0.1:8004/single-bed">
                                Single Bed
                            </a>
                            <a href="http://127.0.0.1:8004/poster-bed">
                                Poster Bed
                            </a>
                            <a href="http://127.0.0.1:8004/bunk-bed">
                                Bunk Bed
                            </a>
                        </div>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/bedside-table">Bedside Table</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/wardrobes">Wardrobes</a></h4>
                    </div>
                </div>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/dining-and-kitchen">
                    Dining and Kitchen
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu mega-menu-inner" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/dining-sets">Dining Sets <span
                                    class="material-symbols-outlined">
                                    chevron_right
                                </span></a></h4>
                        <div class="mega-menu-inner-list">
                            <a href="http://127.0.0.1:8004/2-seater-dining-sets">
                                2 Seater Dining Sets
                            </a>
                            <a href="http://127.0.0.1:8004/4-seater-dining-sets">
                                4 Seater Dining Sets
                            </a>
                            <a href="http://127.0.0.1:8004/6-seater-dining-sets">
                                6 Seater Dining Sets
                            </a>
                            <a href="http://127.0.0.1:8004/8-seater-dining-sets">
                                8 Seater Dining Sets
                            </a>
                        </div>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/dining-chairs">Dining Chairs</a></h4>
                    </div>
                </div>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/study-and-office">
                    Study and Office
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu main-menu-cats" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/study-table">Study Table</a></h4>
                    </div>
                </div>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/storage">
                    Storage
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu main-menu-cats" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/tv-units-2">TV Units</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/sideboard-2">Sideboard</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/shoe-rack-2">Shoe Rack</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/bookshelf-2">Bookshelf</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/chest-of-drawers-2">Chest Of Drawers</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/wardrobe">wardrobe</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/bedside-table-2">Bedside Table</a></h4>
                    </div>
                </div>
            </li>
            <li class="has-mega">
                <a href="http://127.0.0.1:8004/decor-furnishing">
                    Decor &amp; Furnishing
                    <span class="material-symbols-outlined">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <div class="mega-menu main-menu-cats" bis_skin_checked="1">
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/home-temples">Home Temples</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/pooja-chouki">Pooja chouki</a></h4>
                    </div>
                    <div class="mega-col" bis_skin_checked="1">
                        <h4><a href="http://127.0.0.1:8004/wall-mirror-2">Wall Mirror</a></h4>
                    </div>
                </div>
            </li>

        </ul>
    </nav>

    <div class="header_right">
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
            @if (Auth::guard('customer')->check())
                <button class="login_button" onclick="window.location.href='{{ route('user.dashboard') }}'">
                    <span class="material-symbols-outlined">person</span>
                    Dashboard
                </button>
            @else
                <button class="login_button" onclick="window.location.href='{{ url('/login') }}'">
                    <span class="material-symbols-outlined">person</span>
                    Login
                </button>
            @endif
            <div class="cart-wrapper">
                <button class="cart_button">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    Cart
                    @if (Auth::guard('customer')->check() && $cartTotal != 0 && !empty($cartTotal))
                        <span class="cart-count">{{ $cartTotal }}</span>
                    @else
                        <span class="cart-count" id="cartCount"></span>
                    @endif
                </button>
                <div class="cart-dropdown">
                    @if (Auth::guard('customer')->check())
                        <div id="headerCartItems">
                            @foreach ($carts->take(4) as $index => $cart)
                                <div class="cart-item" data-cartid = "{{ $cart->id }}">
                                    <a
                                        href="{{ route('front-product.detail', ['product' => 'product', 'title' => productSlug($cart->product->name) . '.html', 'sku' => $cart->product->sku]) }}"><img
                                            src="{{ $cart->product->images['first'] }}" alt=""></a>
                                    <div class="cart-info">
                                        <h5>{{ $cart->product->name }}</h5>
                                        <span>Qty: {{ $cart->quantity }}</span>
                                        <strong>
                                            ₹{{ $cart->product->selling_price }}
                                        </strong>
                                    </div>
                                    <button type="button" class="remove-item close-product"
                                        data-index="{{ $index }}" data-cartid ="{{ $cart->id }}">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="headerCartItems"></div>
                    @endif

                    <div class="cart-footer">
                        <div class="cart-total">
                            <span>Total</span>
                            <strong id="cartTotal">₹{{ $totalPrice }}</strong>
                        </div>
                        <a href="{{ route('product.viewBag') }}" class="view-cart-btn">View Cart</a>
                    </div>
                </div>
            </div>
            @if (!empty(Auth::guard('customer')->user()->id))
                <button class="wishlist_button">
                    <span class="material-symbols-outlined">favorite</span>
                    Wishlist
                </button>
            @else
                <button class="wishlist_button">
                    <span class="material-symbols-outlined">favorite</span>
                    Wishlist
                </button>
            @endif
        </div>
    </div>
    <div class="search-overlay">
        <div class="search-header">
            <input type="text" id="searchingproducts" placeholder="Search products...">

            <button class="close-search">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="search-content">
            <div class="popular-searches">
                <h4>POPULAR CHOICES</h4>
                @foreach ($subCategories->take(12) as $subcat)
                    <a href="{{ url($subcat->slug) }}">{{ $subcat->name }}</a>
                @endforeach
            </div>
            <div class="search-products" id="searching-product">
                @include('front.includes.header-product')
            </div>
        </div>
    </div>
</header>
