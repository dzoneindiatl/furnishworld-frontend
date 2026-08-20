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

<header class="header-section">
    <div class="header sticky">
        <div class="header-announcement">
            <div class="header-announcement-carousel">
                <p class="announcement-item"><a href="#">Shipping Flat $30 for all International Orders -  Explore</a></p>
                <p class="announcement-item"><a href="#">Wild Iris & Himalayan Poppy - Dinnerware Collection -  Shop Now</a></p>
            </div>
        </div>
        <div class="header-outer header-sticky">
            <div class="container-fluid">
                <div class="header-row">
                    <div class="header-search"> 
                        <div class="searchForm">
                            <form action="#" method="get">
                                <button class="searchicon" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <input type="search" name="s" class="serach-input" placeholder="Search Products">                                       
                            </form>
                        </div>
                    </div>
                    <div class="header-menu navbar-expand-xl">                                
                        <nav class="nav-menu">
                            <div id="navbar" class="collapse navbar-collapse">
                                <div class="menu-header">
                                    <div class="menu-logo">Menu</div>
                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="true" aria-label="Toggle navigation">
                                        <span class="menu-bar-one"></span> <span class="menu-bar-two"></span><span class="menu-bar-three"></span>
                                    </button>
                                </div>
                                <ul class="navbar-nav">                                           
                                    <li class="has-children"><a href="#">Shop</a>
                                        <div class="mega-menu">
                                            <div class="mega-menu-area">                         
                                                <div class="mega-menu-items">                              
                                                    <ul class="mega-menu-item">
                                                    <li class="has-children mega-menu-highlight"><a href="#">Sale 30% Off</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="product-list.html">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                                
                                                        </div>
                                                    </li>
                                                    <li class="has-children"><a href="#">Kurta Sets</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women2</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection2</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                            
                                                        </div>
                                                    </li>
                                                    <li class="has-children"><a href="#">Lehenga</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women3</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection3</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                             
                                                        </div>
                                                    </li>
                                                    <li class="has-children"><a href="#">Coordinated Sets</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women4</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection4</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                           
                                                        </div>
                                                    </li>
                                                    <li class="mega-menu-link"><a href="#">Gift Guide <sup>New!</sup></a> </li>
                                                    <li class="has-children"><a href="#">Night Wear</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women6</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection6</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                            
                                                        </div>
                                                    </li>
                                                    <li class="has-children"><a href="#">Bags</a>
                                                        <div class="mega-submenu">
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Women7</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-submenu-column">
                                                            <p class="mega-submenu-title">Collection7</p>
                                                            <ul class="mega-submenu-item">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Kurta Sets</a></li>
                                                            <li><a href="#">Lehenga</a></li>
                                                            <li><a href="#">Coordinated Sets</a></li>
                                                            <li><a href="#">Night Wear</a> </li>
                                                            <li><a href="#">Home Textile</a></li>
                                                            <li><a href="#">Bags</a></li>
                                                            </ul>
                                                        </div>                                                              
                                                        </div>
                                                    </li>
                                                    </ul>
                                                </div>  
                                                <div class="mega-menu-column-image">
                                                    <a href="#"><img src="{{asset('assets/front/tejap/images/product-1.jpg')}}" alt=""></a>
                                                </div>                         
                                            </div>
                                            </div>
                                    </li>
                                    <li><a href="#">Sale</a></li>
                                    <li><a href="#">New In</a></li>
                                    <li><a href="#">Fusion</a></li>
                                    <li><a href="{{ env('WEBSITE_URL').'page/about-us' }}"> About Us</a></li>                                           
                                </ul>                                          
                            </div>
                            <div class="menu-overlay"></div>
                        </nav>
                    </div>
                    <div class="header-logo navbar-expand-xl">
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                            <span class="menu-bar-one"></span><span class="menu-bar-two"></span><span class="menu-bar-three"></span>
                        </button>
                        <!-- <a class="logo-link" href="index.html"><img class="logo" src="{{ asset('assets/front/tejap/images/tjap-logo.png') }}" alt="logo"></a>
                        <a class="logo-link" href="index.html"><img class="logo" src="{{ asset('assets/front/tejap/images/furnishworld-black-logo.jpeg') }}" alt="logo"></a> 
                        <a class="logo-link" href="index.html"><img class="logo" src="{{ asset('assets/front/tejap/images/furnishworld-white-logo.jpeg') }}" alt="logo"></a>--> 
                        <a class="logo-link" href="{{ env('WEBSITE_URL') }}"><img class="logo" src="{{ env('WEBSITE_URL').'uploads/settings/'.@$siteLogo->value }}" alt="logo"></a>
                    </div>
                    <div class="header-shop-menu navbar-expand-xl navbar-light">
                        <ul class="header-shop-link">                                  
                            <li>
                                <a class="search-icon" href="javascript:void(0);">
                                    <span class="shop-icon">
                                        <svg fill="#010101" width="32px" height="32px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"><path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path></svg>
                                    </span>
                                    <span class="shop-text">Search</span>
                                </a>
                                <a class="search-cancel d-none" href="javascript:void(0);">
                                    <span class="shop-icon">
                                        <svg width="64px" height="64px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" stroke-width="6.4" stroke="#000000" fill="none"><line x1="8.06" y1="8.06" x2="55.41" y2="55.94"></line><line x1="55.94" y1="8.06" x2="8.59" y2="55.94"></line></svg>
                                    </span>
                                    <span class="shop-text">Cancel</span>
                                </a>
                                
                            </li>
                            <li class="acoount-icon dropdown">
                                <a class="account-toggle" href="javascript:void(0);">
                                        <span class="shop-icon">                                              
                                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.01557 21.4673L2.75667 21.5824L2.01557 21.4673ZM21.9844 21.4673L21.2433 21.5824L21.9844 21.4673ZM2.75667 21.5824C3.44504 17.1525 7.31691 13.75 12 13.75V12.25C6.57737 12.25 2.07637 16.1915 1.27446 21.3521L2.75667 21.5824ZM12 13.75C16.6831 13.75 20.555 17.1525 21.2433 21.5824L22.7255 21.3521C21.9236 16.1915 17.4226 12.25 12 12.25V13.75ZM20.5481 22.25H3.45185V23.75H20.5481V22.25ZM1.27446 21.3521C1.05985 22.7332 2.22557 23.75 3.45185 23.75V22.25C2.96139 22.25 2.71029 21.8809 2.75667 21.5824L1.27446 21.3521ZM21.2433 21.5824C21.2897 21.8809 21.0386 22.25 20.5481 22.25V23.75C21.7744 23.75 22.9402 22.7332 22.7255 21.3521L21.2433 21.5824Z" fill="#010101"></path> <path d="M16.25 6C16.25 8.34721 14.3472 10.25 12 10.25V11.75C15.1756 11.75 17.75 9.17564 17.75 6H16.25ZM12 10.25C9.65279 10.25 7.75 8.34721 7.75 6H6.25C6.25 9.17564 8.82436 11.75 12 11.75V10.25ZM7.75 6C7.75 3.65279 9.65279 1.75 12 1.75V0.25C8.82436 0.25 6.25 2.82436 6.25 6H7.75ZM12 1.75C14.3472 1.75 16.25 3.65279 16.25 6H17.75C17.75 2.82436 15.1756 0.25 12 0.25V1.75Z" fill="#010101"></path></svg>
                                        </span>
                                        <span class="shop-text">Sign In</span>
                                </a>                                       
                                <div class="account-dropdown">
                                    <div class="account-dropdown-wrap">
                                        <p><a href="{{ route('front-user.login') }}" class="btn btn-primary w-100">Sign In</a></p> 
                                        <p>Don't have an account? <a href="{{ route('front-user.signup') }}" class="ms-2 text-decoration-underline">Register</a></p>
                                    </div>
                                </div>
                                <div class="account-menu dropdown-menu dropdown-menu-right">
                                    <p class="pl-3 m-2">Hi Arjun!</p>
                                    <ul class="account-menu-list">
                                        <li><a href="{{ env('WEBSITE_URL') }}"><i class="fa fa-user"></i>My Account </a></li>
                                        <li><a href="{{ env('WEBSITE_URL') }}"><i class="fa fa-address-book"></i>My Address </a> </li>
                                        <li><a href="{{ env('WEBSITE_URL') }}"><i class="fa fa-shopping-basket"></i>My Orders </a> </li>
                                        <li><a href="{{ env('WEBSITE_URL') }}"><i class="far fa-heart"></i>My Wishlist </a> </li>
                                        <li><a href="{{ env('WEBSITE_URL') }}"><i class="fa fa-tags"></i>My Coupons </a></li>
                                        <li class="logout"><a href="#"><i class="fa fa-sign-out"></i>Log out</a> </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="shoping-icon">
                                <a href="my-wishlist.html">
                                    <span class="shop-icon">
                                        <svg width="32px" height="32px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#010101" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M4 16 C1 12 2 6 7 4 12 2 15 6 16 8 17 6 21 2 26 4 31 6 31 12 28 16 25 20 16 28 16 28 16 28 7 20 4 16 Z"></path> </svg>
                                        <span class="shop-number wishlist-number ">0</span></span>
                                        <span class="shop-text">Wishlist</span>
                                    </a>
                            </li>
                            <li class="cart-menu dropdown">
                                <a href="javascript:void(0)" title="View your shopping cart" class="cart-contents cartOpen">
                                    <span class="cart-icon">
                                        <svg fill="#010101" height="32px" width="32px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">                                          
                                        <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                                            c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                                            C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                                            M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                                            c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                                    
                                    </svg>
                                    <span class="cart-count cart-number-items center-main"></span>
                                    <span class="shop-text">Shopping Cart</span>    
                                </a>
                                <!--  Shoping cart Model -->
                                <div class="cart-arrow"></div>
                                <div class="cart-dropdown">
                                    <div class="widget-shopping-cart">   
                                        <p>Shopping bag (<span class="center-main"></span>)</p>                                             
                                        <ul class="mini-cart productListContainer">
                                            <!-- <li class="mini-cart-item">  
                                                <div class="mini-cart-image">
                                                    <a href="#"><img src="{{  env('WEBSITE_URL').'tjap-images/product-1.jpg' }}" alt=""></a>
                                                </div>    
                                                <div class="mini-cart-summery"> 
                                                    <div class="mini-cart-summerydata">
                                                        <a href="#" class="mini-cart-title">Desert Eagle Hoodie</a>
                                                        <p>Quantity : 1</p>
                                                        <p>Size : 46</p>
                                                        <p>Navy</p>
                                                    </div> 
                                                    <div class="mini-cart-summeryprice">
                                                        <span class="mini-cart-price">
                                                            <del>₹ 4,990</del>
                                                            <ins>₹ 2,994</ins>
                                                        </span>
                                                        <a href="#" class="remove remove_from_cart_button">Remove</a>
                                                    </div>
                                                </div>
                                            </li> -->
                                        </ul>
                                        <div class="mini-cart-total">
                                            <p><strong>Subtotal</strong> <span class="cartTotalPopup"></span></p> 
                                        </div>
                                        <div class="mini-cart-buttons">
                                            <a href="{{ env('WEBSITE_URL').'cart/view' }}" class="btn btn-outline-primary">View cart</a>
                                            <a href="{{ env('WEBSITE_URL').'checkout' }}" class="btn btn-primary checkout">Checkout</a>
                                        </div>                                                
                                    </div>
                                </div>
                                <!--  Shoping cart Model -->
                            </li>
                        </ul>                              
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ===================================================== -->


