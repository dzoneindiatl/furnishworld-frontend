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
    <nav class="main-nav">
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
                    <a href="{{ route('category.show', ['path' => $cat->slug]) }}">
                        {{ $cat->name }}
                        <span class="material-symbols-outlined">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                    <div class="mega-menu mega-menu-inner" bis_skin_checked="1">
                        @foreach ($subCategories->where('parent_id', $cat->id)->where('show_on_menu', 1) as $subcat)
                            @php
                                $subChildCategories = $childCategories
                                    ->where('parent_id', $subcat->id)
                                    ->where('show_on_menu', 1);
                            @endphp
                            <div class="mega-col" bis_skin_checked="1">
                                <h4>
                                    <a href="{{ route('category.show', ['path' => $cat->slug . '/' . $subcat->slug ]) }}">{{ $subcat->name }} 
                                        @if ($subChildCategories->isNotEmpty())
                                            <span class="material-symbols-outlined">
                                                chevron_right
                                            </span>
                                        @endif
                                    </a>
                                </h4>
                                        @foreach ($childCategories->where('parent_id', $subcat->id)->where('show_on_menu', 1) as $childcat)
                                <div class="mega-menu-inner-list">
                                        <a href="{{ route('category.show', [ 'path' => $cat->slug . '/' . $subcat->slug . '/' . $childcat->slug]) }}">
                                            {{ $childcat->name }}
                                        </a>
                                </div>
                                   @endforeach 
                            </div>
                        @endforeach     
                    </div>
                </li>
            @endforeach     
        </ul>
    </nav>

    <div class="header_right">
        <button class="mobile_menu">
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>
        <div class="search_icon">
            <button class="search_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#377856" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m20 20-4-4"/>
                    </svg>
            </button>
        </div>
        <span class="divider">|</span>
        <div class="user-actions">
            @if (Auth::guard('customer')->check())
                <button class="login_button" onclick="window.location.href='{{ route('user.dashboard') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#1F2926" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="8" r="3.2"/>
  <path d="M5.5 20c.7-3.4 3-5.2 6.5-5.2s5.8 1.8 6.5 5.2"/>
</svg>
                    Dashboard
                </button>
            @else
                <button class="login_button" onclick="window.location.href='{{ url('/login') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#1F2926" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="8" r="3.2"/>
  <path d="M5.5 20c.7-3.4 3-5.2 6.5-5.2s5.8 1.8 6.5 5.2"/>
</svg>
                    Login
                </button>
            @endif
            <div class="cart-wrapper">
                <button class="cart_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#1F2926" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 8h14l-1 11H6L5 8Z"/>
                        <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
                        </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="#1F2926" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M20.8 8.8c0 5.5-8.8 10.2-8.8 10.2S3.2 14.3 3.2 8.8A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.7Z"/>
</svg>
                    Wishlist
                </button>
            @else
                <button class="wishlist_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="#1F2926" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
  <path d="M20.8 8.8c0 5.5-8.8 10.2-8.8 10.2S3.2 14.3 3.2 8.8A4.7 4.7 0 0 1 12 6.1a4.7 4.7 0 0 1 8.8 2.7Z"/>
</svg>
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
