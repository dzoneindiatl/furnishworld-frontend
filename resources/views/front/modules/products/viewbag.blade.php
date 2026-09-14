@extends('front.layouts.app')
@section('content')
<!--  Cart Section -->
    <section class="site-content">
        <div class="page-banner-section">
            <div class="page-banner">
                <div class="container">
                    <div class="page-banner-wrap">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb-items">
                                <li class="breadcrumb-item trail-begin"><a href="{{ Url('/') }}" rel="home"><span
                                            itemprop="name">Home</span></a></li>
                                <li class="breadcrumb-item trail-end"><span itemprop="name">Cart</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-banner-section -->
        <div class="content-wrapper page-check-cart">
            <div class="container">
                <div class="page-header text-center">
                    <h1 class="page-title">Cart</h1>
                </div>
                <div class="content-area">
                    <div class="cart-main-inner">
                        <div class="cart-main-inner-left">
                            <div class="cart-form-wrapper">
                                <form class="cart-form" action="cart" method="post">
                                    @if (Auth::guard('customer')->check() && count($cartItems) > 0)
                                        <div class="cart-items">
                                            @foreach ($cartItems as $key => $item)
                                                <div class="cart-item">
                                                    <div class="cart-image">
                                                        <a href="javascript:void(0)"><img
                                                                src="{{ $item['product']['images']['first'] }}"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-summery">
                                                        <div class="cart-summerydata">
                                                            <a href="javascript:void(0)"
                                                                class="cart-title">{{ $item['product']['name'] }}</a>
                                                            <div class="cart-quantity">
                                                                <div class="quantity-group">
                                                                    <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                                    <input type="text" id="quantity"
                                                                        class="input-text qty" name="quantity"
                                                                        value="{{ $item['quantity'] }}" maxlength="50">
                                                                    <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="cart-summeryprice">
                                                            <span class="cart-price">
                                                                <del>₹ {{ $item['product']['buying_price'] }}</del>
                                                                <ins>₹ {{ $item['product']['selling_price'] }}</ins>
                                                            </span>
                                                            <a href="#" data-index="{{ $key }}" class="remove remove_from_cart_button trash-icon close-product" data-cartid ="{{ $item['card_id'] }}">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="cart-items productListCartPageContainer"> </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="cart-main-inner-right">
                            <div class="cart-collaterals">
                                <div class="cart-totals">
                                    <h4>Order Summary</h4>
                                    <div class="coupon">
                                        <label for="coupon_code">Apply Coupon Code</label>
                                        <!-- <span class="coupon_error" style="color:red;font-size:16px;font-weight:bold"></span>
                                                                    <span class="coupon_success" style="color:green;font-size:16px;font-weight:bold"></span> -->
                                        <div class="coupon-group">
                                            <input type="text" name="coupon_code" class="form-control"
                                                id="coupon_code_input" value="" placeholder="Enter Your Coupon Code">
                                            <button type="submit" class="btn btn-primary btn_apply_coup"
                                                id="apply-coupon-btn" name="apply_coupon"
                                                value="Apply coupon">Apply</button>
                                        </div>
                                        <div class="view-more-link">
                                            {{-- <button class="offer_coupon_btn" id="openCoupon">
                                                🎁 Offers & Coupons Codes
                                            </button> --}}

                                            <!-- Overlay -->
                                            <div class="coupon_overlay" id="couponOverlay"></div>

                                            <!-- Right Side Coupon Drawer -->
                                            <div class="coupon_drawer" id="couponDrawer">

                                                <div class="coupon_header">
                                                    <div>
                                                        <span class="small_title">SAVE MORE</span>
                                                        <h3>Offers & Coupons</h3>
                                                    </div>

                                                    <button class="coupon_close" id="closeCoupon">
                                                        &times;
                                                    </button>
                                                </div>

                                                <div class="coupon_body">

                                                    <!-- Coupon 1 -->
                                                    <div class="coupon_card">
                                                        <div class="coupon_top">
                                                            <div class="coupon_icon">10%</div>

                                                            <div class="coupon_info">
                                                                <h4>Flat 20% OFF</h4>
                                                                <p>Get flat 20% off on your first order.</p>
                                                            </div>
                                                        </div>

                                                        <div class="coupon_bottom">
                                                            <div class="coupon_code">WELCOME20</div>

                                                            <button class="copy_coupon" data-code="WELCOME20">
                                                                COPY
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Coupon 2 -->
                                                    <div class="coupon_card">
                                                        <div class="coupon_top">
                                                            <div class="coupon_icon">220₹</div>

                                                            <div class="coupon_info">
                                                                <h4>₹500 OFF</h4>
                                                                <p>Save ₹500 on orders above ₹2999.</p>
                                                            </div>
                                                        </div>

                                                        <div class="coupon_bottom">
                                                            <div class="coupon_code">SAVE500</div>

                                                            <button class="copy_coupon" data-code="SAVE500">
                                                                COPY
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Coupon 3 -->
                                                    <div class="coupon_card">
                                                        <div class="coupon_top">
                                                            <div class="coupon_icon">🚚</div>

                                                            <div class="coupon_info">
                                                                <h4>Free Delivery</h4>
                                                                <p>Enjoy free delivery on selected products.</p>
                                                            </div>
                                                        </div>

                                                        <div class="coupon_bottom">
                                                            <div class="coupon_code">FREESHIP</div>

                                                            <button class="copy_coupon" data-code="FREESHIP">
                                                                COPY
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-totals-table">
                                        <table class="shop-table">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Total MRP</th>
                                                    <td data-title="Subtotal" class="text-end"><strong
                                                            id="totalMrp"></strong> </td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Discount</td>
                                                    <td data-title="Shipping" class="text-end text-green"
                                                        id="totalDiscount"></td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Sub Total</td>
                                                    <td data-title="Shipping" class="text-end" id="subTotal"></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Coupon Discount</th>
                                                    <td data-title="Total" class="text-end"><strong
                                                            id="couponDiscount"></strong></td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Grand Total</th>
                                                    <td data-title="Subtotal" class="text-end"><strong
                                                            id="grandTotal"></strong></td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Taxable Amount</td>
                                                    <td data-title="Shipping" class="text-end text-green"
                                                        id="taxableAmount"></td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Total GST(Tax)</td>
                                                    <td data-title="Shipping" class="text-end" id="taxPrice"></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th><b>Total Payable</b> (Tax Included)</th>
                                                    <td data-title="Total" class="text-end"><strong class="finalAmount"
                                                            id="finalAmount"></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="proceed-to-checkout text-center">
                                        <p><a href="javascript:void('0')"
                                                class="btn btn-primary w-100 checkoutButton btn_place_order"> Checkout</a>
                                        </p>
                                        <small>15-Day Hassle Free Returns</small>
                                    </div>
                                    <div class="text-center mt-4">
                                        <img src="{{ env('WEBSITE_URL') . 'tjap-images/payments.webp' }}"
                                            alt="payments method" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--content-area-->
                </div>
            </div>
    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
window.dbCartItems = @json($cart ?? []); 
</script>

<script>
    $(document).ready(function() {

        // Open
        $('#openCoupon').on('click', function() {

            $('#couponDrawer').addClass('active');
            $('#couponOverlay').addClass('active');

            $('body').css('overflow', 'hidden');
        });


        // Close
        $('#closeCoupon, #couponOverlay').on('click', function() {

            $('#couponDrawer').removeClass('active');
            $('#couponOverlay').removeClass('active');

            $('body').css('overflow', '');
        });


        // ESC Key Close
        $(document).on('keydown', function(e) {

            if (e.key === 'Escape') {

                $('#couponDrawer').removeClass('active');
                $('#couponOverlay').removeClass('active');

                $('body').css('overflow', '');
            }

        });


        // Copy Coupon
        $('.copy_coupon').on('click', function() {

            let btn = $(this);
            let code = btn.data('code');

            navigator.clipboard.writeText(code)
                .then(function() {

                    let oldText = btn.text();

                    btn.text('COPIED ✓');

                    setTimeout(function() {
                        btn.text(oldText);
                    }, 1800);

                });

        });

    });
</script>

@push('scripts')
    <script>
        console.log('sixth');
        var notRequiredQtyAjaxClickonQtyBtn = true;
        displayCartItems(notRequiredQtyAjaxClickonQtyBtn);
        $(document).on('click', '#apply-coupon-btn', function(e) {
            var couponCode = $('#coupon_code_input').val();
            applyCoupon(couponCode);
        });

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

        $(document).on('click', '.checkoutButton', function() {
            if (isLoggedIn) {
                window.location.href = "{{ route('front-product.checkoutBag') }}";
            } else {
                window.location.href = "{{ route('front-user.login') }}";
            }
        });

        localStorage.removeItem('coupon_id');
        localStorage.removeItem('coupon_discount');
        getCoupon();

        function applyCoupon(couponCode) {
            if (couponCode == '') {
                showFlashMessage('Please enter coupon code!!!');
            }

            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            let subTotal = 0;
            cartItems.forEach(function(item) {
                subTotal += item.price * item.quantity;
            });

            $.post("{{ route('apply.coupon') }}", {
                coupon_code: couponCode,
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
                    localStorage.setItem('coupon_discount', response.discount);
                    $('#view-coupon').modal('hide');
                    priceCalculation();
                } else {
                    showFlashMessage(response.message, 'error');
                    $(".coupon_error").html(response.message)
                    setTimeout(() => {
                        $(".coupon_error").html("")
                    }, 3000);
                }
            });
        }

        function calculateDelivery() {
            const pincode = document.getElementById('pincodeInput').value.trim();
            const deliveryTimeEl = document.getElementById('delivery_time');

            if (!pincode) {
                deliveryTimeEl.innerHTML = "<span style='color:red;'>Please enter a valid pincode.</span>";
                return;
            }

            $.ajax({
                url: '/check-delevery',
                method: 'POST',
                data: {
                    pincode: pincode
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        const data = response.data;
                        deliveryTimeEl.innerHTML = `<span>${data.message}</span>`;
                    } else {
                        deliveryTimeEl.innerHTML = `<span style="color:red;">${response.message}</span>`;
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    deliveryTimeEl.innerHTML =
                        `<span style="color:red;">Invalid Pincode.</span>`;
                }
            });
        }
        $(function() { 
            const $s = $("#best-seller-slider"),
                c = $s.find(".item").length > 4;
            if ($s.find(".item").length > 4) {
                $('#best-seller').removeClass('custom-seller-slider');
            }

            $s.owlCarousel({
                loop: c,
                nav: c,
                margin: 10,
                autoplay: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: c ? 4 : $s.find(".item").length
                    }
                }
            });
        });
    </script>
@endpush
