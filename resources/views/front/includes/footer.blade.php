<section class="footer_sec_top">
    <?php
    // Footer content Dynamic
    ?>
    <!-- FOOTER --------------------------------------------- -->
    <footer class="site-footer">
        <!-- Newsletter -->
        <div class="footer-newsletter">
            <div class="newsletter-content">
                <span class="footer-tag">
                    STAY INSPIRED
                </span>
                <h2>
                    Get Design Inspiration & Exclusive Offers
                </h2>
                <p>
                    Subscribe to receive furniture trends, décor ideas,
                    new arrivals and special promotions directly in your inbox.
                </p>
            </div>

            <form class="newsletter-form" action="{{ route('create-subscriber') }}" method="POST">
                @csrf
                <input type="email" placeholder="Enter your email address" name="email">
                <button type="submit">
                    Subscribe
                </button>
            </form>
        </div>

        <div class="container">
            <div class="footer-grid">
                <!-- About -->
                <div class="footer-about">
                    <img src="{{ env('WEBSITE_URL') . 'uploads/settings/' . @$siteLogo->value }}"
                        alt="Furniture Store" class="footer-logo">

                    @if (!empty($fifthCategory))
                        {!! $fifthCategory->description !!}
                    @endif
                    <div class="footer-social">
                        <a href="{{ $facebook->value }}">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="{{ $instagram->value }}">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="{{ $pinterst->value }}">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>

                        <a href="{{ $youtube->value }}">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>


                <!-- Shop -->
                <div>
                    <h4>{{ $firstCategory->name }}</h4>
                    <ul>
                        @if ($firstCategory && $firstCategory->subcategories->count())
                            @foreach ($firstCategory->subcategories as $subcategory)
                                <li>
                                    <a href="{{ url('page/' . $subcategory->slug) }}">{{ $subcategory->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4>{{ $secondCategory->name }}</h4>
                    <ul>
                        @if ($secondCategory && $secondCategory->subcategories->count())
                            @foreach ($secondCategory->subcategories as $subcategory)
                                <li>
                                    <a href="{{ url('page/' . $subcategory->slug) }}">{{ $subcategory->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4>{{ $thirdCategory->name }}</h4>
                    {!! $thirdCategory->description !!}
                </div>
            </div>
            <div class="footer-bottom" style="padding-top: 0; border-top: 0;">
                <div class="payemnt-strip">
                    <img src="{{ 'assets/front/images/Payment_Icons.svg' }}" alt="">
                </div>
                {{-- <div class="footer-links">
                    @if ($fourthCategory && $fourthCategory->subcategories->count())
                        @foreach ($fourthCategory->subcategories as $subcategory)
                            <a href="{{ url('page/'.$subcategory->slug) }}">{{ $subcategory->title }}</a> 
                        @endforeach
                    @endif
                </div> --}}
            </div>
            <!-- Bottom -->
            <div class="footer-bottom">
                <p>
                    &copy; 2026 Furniture Store. All Rights Reserved.
                </p>
                <p>
                    Development and Marketing By: Dzone India Software Pvt. Ltd.
                </p>
            </div>
        </div>
    </footer>

    <a href="#" class="whatsapp-chat" target="_blank" aria-label="Chat with us">

        <span class="whatsapp-text">Chat With Us</span>

        <span class="whatsapp-icon">
            <i class="fa-brands fa-whatsapp whatsapp-logo"></i>

            <span class="dot-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </span>

    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @if (url()->current() == url('/'))
    @else
        <script src="{{ 'assets/front/homepage/js/main.js' }}"></script>
    @endif

    @if (!empty($settings?->value))
        <div class="seo_description">
            <div class="container">
                {!! $settings->value !!}
            </div>
        </div>
    @elseif(!empty($categorySeoValue))
        <div class="seo_description">
            <div class="container">
                {!! $categorySeoValue !!}
            </div>
        </div>
    @endif
    <script>
       $(document).ready(function() {
            window.isCustomerLoggedIn = @json(Auth::guard('customer')->check());
            console.log('========== CART INIT ==========');
            console.log('Customer logged in:', window.isCustomerLoggedIn);
            console.log('Local cart:', JSON.parse(localStorage.getItem('cartItems') || '[]'));
            if (window.isCustomerLoggedIn) {
                updateCartData();
            } else {
                displayGuestCart();
            }

            setLoginCartItems();
        });
        $('#loginForm').on('submit', function() {
            setLoginCartItems();
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            $('#loginCartItems').val(
                JSON.stringify(cartItems)
            );
        });

        function removeProductCartFromDB(cartId) {
            if (!window.isCustomerLoggedIn) {
                return;
            }

            $.ajax({
                url: "{{ route('front-remove-cart-product') }}",
                type: "POST",
                data: {
                    cartId: cartId
                },
                success: function(response) {
                    console.log('Remove cart response:', response);

                    if (response.success) {
                        $('.close-product[data-cartid="' + cartId + '"]') .closest('.cart-item') .remove();

                        let count = parseInt($('#cartCount').text()) || 0;
                        $('#cartCount').text(Math.max(0, count - 1));

                        showFlashMessage("Product removed from cart", "warning");
                    }
                },
                error: function(error) {
                    console.log('Remove cart error:', error);
                }
            });
        }

        function setLoginCartItems() {
            let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

            $('#loginCartItems').val(JSON.stringify(cartItems));
        }

        setLoginCartItems();
        window.isCustomerLoggedIn = @json(Auth::guard('customer')->check());
        if (!window.isCustomerLoggedIn) {     
            displayGuestCart();
        }
       

        function updateCartTotal(cartItems) {
            let total = 0;

            cartItems.forEach(function(item) {
                let price = parseFloat(item.sellingPrice) || 0;
                let quantity = parseInt(item.quantity) || 0;

                total += price * quantity;
            });

            $('#cartTotal').text('₹' + total);
        }
        function displayGuestCart() {
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            console.log('Guest cart:', cartItems);

            let cartCount = cartItems.length;
            let container = $('#headerCartItems');

            container.empty();

            $('#cartCount').text(cartCount);

            if (cartItems.length === 0) {
                container.html(`
                    <div class="empty-cart">
                        Your cart is empty.
                    </div>
                `);

                $('#cartTotal').text('₹0');

                return;
            }

            cartItems.slice(0, 4).forEach(function(item, index) {
                container.append(`
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">

                        <div class="cart-info">
                            <h5>${item.name}</h5>

                            <span>
                                Qty: ${item.quantity}
                            </span>

                            <strong>
                                ₹${item.sellingPrice}
                            </strong>
                        </div>

                        <button
                            type="button"
                            class="remove-item close-product"
                            data-index="${index}">

                            <span class="material-symbols-outlined">
                                close
                            </span>

                        </button>
                    </div>
                `);
            });

            updateCartTotal(cartItems);
        }
        function updateCartData() {
            if (!window.isCustomerLoggedIn) {
                return;
            }

            let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

            if (!cartItems.length) {
                console.log('No guest cart items to migrate.');
                return;
            }

            console.log('Guest cart items to migrate:', cartItems);

            migrateGuestCart(cartItems);
        }
        function migrateGuestCart(cartItems) {
            let requests = [];

            cartItems.forEach(function(item) {
                requests.push(
                    $.ajax({
                        url: addToCart,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            product_id: item.productId,
                            quantity: item.quantity,
                            selected_variants: item.selectedVariants || {},
                            addType: null
                        }
                    })
                );
            });

            $.when.apply($, requests)
                .done(function() {
                    console.log('All guest cart products migrated successfully.');

                    localStorage.removeItem('cartItems');

                    localStorage.removeItem('applied_coupon');
                    localStorage.removeItem('coupon_discount');

                    console.log('Guest cartItems cleared from localStorage.');
                })
                .fail(function(error) {
                    console.log('Guest cart migration failed:', error);
                });
        }
        function isLoginUser(productId, quantity, selectedVariants, type = null) {
            if (isLoggedIn) {
                $.ajax({
                    url: addToCart,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product_id: productId,
                        quantity: quantity,
                        selected_variants: selectedVariants,
                        addType: type
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

        }
    </script>
    <script>
        document.addEventListener('click', function(e) {
        let button = e.target.closest('.close-product');

        if (!button) {
            return;
        }

        e.preventDefault();

        console.log('🔥 CLOSE PRODUCT CLICKED');
        console.log('Button:', button);
        console.log('Cart ID:', button.dataset.cartid);
        console.log('Index:', button.dataset.index);

        if (!window.isCustomerLoggedIn) {
            let index = parseInt(button.dataset.index);
            let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

            if (cartItems[index]) {
                cartItems.splice(index, 1);

                localStorage.setItem('cartItems', JSON.stringify(cartItems));

                displayGuestCart();

                showFlashMessage("Product removed from cart", "warning");
            }

            return;
        }

        let cartId = button.dataset.cartid;

        if (cartId) {
            console.log('Removing DB cart:', cartId);
            removeProductCartFromDB(cartId);
        }
    }, true);
</script>
    </body>

    </html>
