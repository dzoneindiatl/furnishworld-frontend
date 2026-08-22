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
                    <img src="https://furnishworlds.com/uploads/settings/JUL2026/1783430878-settings.png" alt="Furniture Store" class="footer-logo">
                    
                    @if(!empty($fifthCategory))
                        {!! $fifthCategory->description !!}
                    @endif
                    <div class="footer-social">
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>

                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
               

                <!-- Shop -->
                <div>
                    <h4>{{ $firstCategory->name }}</h4>
                    <ul>
                        @if($firstCategory && $firstCategory->subcategories->count())
                            @foreach($firstCategory->subcategories as $subcategory)
                                <li>
                                     <a href="{{ url($subcategory->slug) }}">{{ $subcategory->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4>{{ $secondCategory->name }}</h4>
                    <ul>
                        @if($secondCategory && $secondCategory->subcategories->count())
                            @foreach($secondCategory->subcategories as $subcategory)
                                <li>
                                    <a href="{{url('page/'.$subcategory->slug) }}">{{ $subcategory->title }}</a>
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
                    <img src="{{('assets/front/images/Payment_Icons.svg') }}" alt="">
                </div>
                {{-- <div class="footer-links">
                    @if($fourthCategory && $fourthCategory->subcategories->count())
                        @foreach($fourthCategory->subcategories as $subcategory)
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    @if(request()->route()->getName() == 'front-home.index' || request()->route()->getName() == 'home.index')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>     
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @else  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @endif 
    
   


    @if (url()->current() == url('/'))

    @else
    <script src="{{('assets/front/homepage/js/main.js') }}"></script>
    @endif

@if(!empty($settings?->value))
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

    $('#loginForm').on('submit', function () {
        setLoginCartItems();
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        $('#loginCartItems').val(
            JSON.stringify(cartItems)
        );
    });
    function setLoginCartItems() {
        let cartItems =
            JSON.parse(localStorage.getItem('cartItems')) || [];

        $('#loginCartItems').val(
            JSON.stringify(cartItems)
        );
    }
    setLoginCartItems(); 


    window.isCustomerLoggedIn = @json(Auth::guard('customer')->check());
    if (!window.isCustomerLoggedIn) {
        displayGuestCart();
    }

    $('.close-product').on('click', function () {
        var button = $(this);
        var index = $(this).data('index'); 
        var cartId = button.data('cartid');

        console.log("-------index-------",index); 
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        console.log("---------cartItem------",cartItems)
        if (cartItems[index]) {
            var productId = cartItems[index].productId;
            var quantity = cartItems[index].quantity; 
            var selectedVariants = cartItems[index].selectedVariants || {};
     
            isLoginUser(productId, quantity, selectedVariants, 'remove');
            cartItems.splice(index, 1);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            button.closest('.cart-item').remove();
            updateCartTotal(cartItems);
            displayGuestCart(); 
            localStorage.setItem('applied_coupon', []);
            localStorage.setItem('coupon_discount', 0);
            showFlashMessage("Product removed from cart", "warning");
        }
    });
    function updateCartTotal(cartItems) {
        let total = 0;
         cartItems.forEach(function (item) {
            let price = parseFloat(item.sellingPrice) || 0;
            let quantity = parseInt(item.quantity) || 0;

            total += price * quantity;
        });
        $('#cartTotal').text('₹' + total);
    }

    function displayGuestCart() {

        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        let cartCount = cartItems.length; 
        let container = $('#headerCartItems');
        container.empty();
        $("#cartCount").text(cartCount); 
        if (cartItems.length === 0) {
            container.html(`
                <div class="empty-cart">
                    Your cart is empty.
                </div>
            `);

            $('#cartTotal').text('₹0');
            return;
        }
        cartItems.slice(0, 4).forEach(function (item, index) {
            container.append(`
                <div class="cart-item">
                    <img src="${item.image}"alt="${item.name}">
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
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
              console.log(error); 
            }
        });
    }

}
</script>
</body>
</html>
    

 



