@extends('front.layouts.app')
@section('content')

    <!-- CSS Files -->
    <link rel="shortcut icon" href="{{ asset('assets/front/cartdesign/img/favicon.png') }}" type="image/x-icon" />
    <link href="{{ asset('assets/front/cartdesign/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/cartdesign/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/cartdesign/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/cartdesign/css/helper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/cartdesign/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/cartdesign/css/style.css') }}" rel="stylesheet">

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
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">Cart</h1>
          </div>        
          <div class="content-area">          
            <div class="row">
              <div class="col-lg-8 col-md-8 col-12">
                <div class="cart-form-wrapper">
                  <form class="cart-form" action="cart" method="post">
                    @if(Auth::guard('customer')->check())
                        <div class="cart-items">
                            @foreach($cartItems as $key => $item)
                                <div class="cart-item">
                                    <div class="cart-image">
                                        <a href="javascript:void(0)"><img src="{{ $item['product']['images']['first'] }}" alt=""></a>
                                    </div>
                                    <div class="cart-summery">
                                        <div class="cart-summerydata">
                                            <a href="javascript:void(0)" class="cart-title">{{ $item['product']['name'] }}</a>                               
                                            <div class="cart-quantity">
                                                <div class="quantity-group">
                                                    <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                    <input type="text" id="quantity" class="input-text qty" name="quantity" value="{{ $item['quantity'] }}" maxlength="50">
                                                    <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-summeryprice">
                                            <span class="cart-price">
                                                <del>₹ {{ $item['product']['buying_price'] }}</del>
                                                <ins>₹ {{ $item['product']['selling_price'] }}</ins>
                                            </span>
                                            <a href="#" data-index="{{ $key }}" class="remove remove_from_cart_button trash-icon close-product">Remove</a>
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
              <div class="col-lg-4 col-md-8 col-12">
                <div class="cart-collaterals">                    
                  <div class="cart-totals">
                        <h4>Order Summary</h4>
                        <div class="coupon">
                        <label for="coupon_code">Apply Coupon Code</label> 
                        <!-- <span class="coupon_error" style="color:red;font-size:16px;font-weight:bold"></span>
                        <span class="coupon_success" style="color:green;font-size:16px;font-weight:bold"></span> -->
                        <div class="coupon-group">
                            <input type="text" name="coupon_code" class="form-control" id="coupon_code_input" value="" placeholder="Enter Your Coupon Code">
                            <button type="submit" class="btn btn-primary btn_apply_coup" id="apply-coupon-btn"  name="apply_coupon" value="Apply coupon">Apply</button>
                        </div>
                    </div>
                    <div class="cart-totals-table">
                      <table class="shop-table">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Total MRP</th>
                                <td data-title="Subtotal" class="text-end"><strong id="totalMrp"></strong> </td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <td>Discount</td>
                                <td data-title="Shipping" class="text-end text-green" id="totalDiscount"></td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <td>Sub Total</td>
                                <td data-title="Shipping" class="text-end" id="subTotal"></td>
                            </tr>
                            <tr class="order-total">
                                <th>Coupon Discount</th>
                                <td data-title="Total" class="text-end"><strong id="couponDiscount"></strong></td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Grand Total</th>
                                <td data-title="Subtotal" class="text-end"><strong id="grandTotal"></strong></td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <td>Taxable Amount</td>
                                <td data-title="Shipping" class="text-end text-green" id="taxableAmount"></td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <td>Total GST(Tax)</td>
                                <td data-title="Shipping" class="text-end" id="taxPrice"></td>
                            </tr>
                            <tr class="order-total">
                                <th><b>Total Payable</b> (Tax Included)</th>
                                <td data-title="Total" class="text-end"><strong id="finalAmount"></strong></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="proceed-to-checkout text-center">
                      <p><a href="javascript:void('0')" class="btn btn-primary w-100 checkoutButton btn_place_order"> Checkout</a></p>
                      <small>15-Day Hassle Free Returns</small>
                    </div>
                    <div class="text-center mt-4">
                      <img src="{{  env('WEBSITE_URL').'tjap-images/payments.webp' }}" alt="payments method" />
                    </div>
                  </div>
                {{-- </div> --}}
              </div>
            </div>          
          </div>
          <!--content-area-->        
        </div>
      </div>
      <!--content-wrapper -->  
      @if(!empty($bestproduct) && count($bestproduct) > 0)  
      <div class="product-section section">
          <div class="container">
              <div class="section-header text-center">
                  <h2 class="section-title">Best Product</h2>                       
              </div>
              <div class="products-wrapper">
                  <div class="products-area">
                      <ul class="products product-carousel">
                        @foreach($bestproduct as $pro => $best)
                          <li class="product-item product">
                              <div class="product-wrap">
                                  <div class="product-image">
                                      <div class="onsale-trading">                                                              
                                        @php 
                                            $discount = ""; 
                                            if(!empty($best->discount_type) && !is_null($best->discount_type)){
                                                if($best->discount_type == "percentage"){
                                                    $discount = $best->discount." OFF" ; 
                                                }
                                                if($best->discount_type == "flat"){
                                                    $discount = "₹ ".$best->discount. "OFF"; 
                                                }
                                            }
                                        @endphp 
                                          <span class="onsale-off">{{ $discount }}</span>
                                      </div>
                                      <a href="product-detail.html">
                                          <div class="product-main-image">
                                              <img src="{{  $best->images['first'] }}" alt="" class="main-image">
                                          </div>
                                          <div class="product-hover-image">
                                              <img src="{{  $best->images['second'] }}" alt="" class="hover-image">
                                          </div>    
                                      </a>                                           
                                      <div class="product-wishlist wishlist">
                                          <a href="#" class="add-to-wishlist">
                                              <i class="far fa-heart"></i>
                                          </a>
                                      </div>
                                      
                                      <div class="product-options">                                             
                                          <div class="product-option-item">
                                              <div class="product-option-title">Size</div>
                                              <div class="product-option-wrap">
                                              <fieldset class="product-option-list product-option-size">                                                    
                                                  <input id="xs" type="radio" name="Size" value="XS" form="product-form-1" >
                                                  <label for="xs">XS</label>                                                      
                                                  <input id="s" type="radio" name="Size" value="S" form="product-form-1">
                                                  <label for="s">S</label>                                                   
                                                  <input id="m" type="radio" name="Size" value="M/L" form="product-form-1" checked="checked">
                                                  <label for="m">M</label>                                                   
                                                  <input id="l" type="radio" name="Size" value="L" form="product-form-1">
                                                  <label for="l">L</label>                                                     
                                                  <input id="xl" type="radio" name="Size" value="XL" form="product-form-1">
                                                  <label for="xl" class="disabled" >XL</label>  
                                              </fieldset>
                                              </div>
                                          </div>                                                
                                          </div>
                                  </div>
                                  <div class="product-content">
                                      <h5 class="product-title">
                                          <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($best->name).'.html', 'sku' => productSlug($best->sku)]) }}">{{ $best->name }}</a>
                                      </h5>
                                      <div class="product-price">
                                          <del>₹ {{ $best->buying_price }}</del>
                                          <ins>₹ {{ $best->selling_price }}</ins>
                                      </div>   
                                      <div class="product-addtocart-button">
                                          <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($best->name).'.html', 'sku' => productSlug($best->sku)]) }}" class="product-addtocart"> <svg fill="#010101" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">                                          
                                              <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                                                  c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                                                  C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                                                      M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                                                  c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                                          
                                          </svg></a>
                                      </div>                                        
                                  </div>
                              </div>
                          </li>
                        @endforeach   
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      @endif 
      <!--=====================================================
                      Related Products Section End
      =========================================================-->
      @if(!empty($recentViewproduct) && count($recentViewproduct) > 0)
      <div class="product-section section">
          <div class="container">
              <div class="section-header text-center">
                  <h2 class="section-title">Recent Viewed</h2>                       
              </div>
              <div class="products-wrapper">
                  <div class="products-area">
                      <ul class="products product-carousel">
                        @foreach($recentViewproduct as $recent)
                          <li class="product-item product">
                              <div class="product-wrap">
                                  <div class="product-image">
                                      <div class="onsale-trading">   
                                         @php 
                                            $discount = ""; 
                                            if(!empty($recent->discount_type) && !is_null($recent->discount_type)){
                                                if($recent->discount_type == "percentage"){
                                                    $discount = $recent->discount." OFF" ; 
                                                }
                                                if($recent->discount_type == "flat"){
                                                    $discount = "₹ ".$recent->discount. "OFF"; 
                                                }
                                            }
                                        @endphp                                                            
                                          <span class="onsale-off">{{ $discount }}</span>
                                      </div>
                                      <a href="product-detail.html">
                                          <div class="product-main-image">
                                              <img src="{{ $recent->product->images['first'] }}" alt="" class="main-image">
                                          </div>
                                          <div class="product-hover-image">
                                              <img src="{{ $recent->product->images['second'] }}" alt="" class="hover-image">
                                          </div>    
                                      </a>                                           
                                      <div class="product-wishlist wishlist">
                                          <a href="#" class="add-to-wishlist">
                                              <i class="far fa-heart"></i>
                                          </a>
                                      </div>
                                      
                                      <div class="product-options">                                             
                                          <div class="product-option-item">
                                              <div class="product-option-title">Size</div>
                                              <div class="product-option-wrap">
                                              <fieldset class="product-option-list product-option-size">                                                    
                                                  <input id="xs" type="radio" name="Size" value="XS" form="product-form-1" >
                                                  <label for="xs">XS</label>                                                      
                                                  <input id="s" type="radio" name="Size" value="S" form="product-form-1">
                                                  <label for="s">S</label>                                                   
                                                  <input id="m" type="radio" name="Size" value="M/L" form="product-form-1" checked="checked">
                                                  <label for="m">M</label>                                                   
                                                  <input id="l" type="radio" name="Size" value="L" form="product-form-1">
                                                  <label for="l">L</label>                                                     
                                                  <input id="xl" type="radio" name="Size" value="XL" form="product-form-1">
                                                  <label for="xl" class="disabled" >XL</label>  
                                              </fieldset>
                                              </div>
                                          </div>                                                
                                          </div>
                                  </div>
                                  <div class="product-content">
                                      <h5 class="product-title">
                                          <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($recent->name).'.html', 'sku' => productSlug($recent->product->sku)]) }}">{{ $recent->product->name }}</a>
                                      </h5>
                                      <div class="product-price">
                                          <del>₹ {{ $recent->product->buying_price }}</del>
                                          <ins>₹ {{ $recent->product->selling_price }}</ins>
                                      </div>   
                                      <div class="product-addtocart-button">
                                          <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($recent->name).'.html', 'sku' => productSlug($recent->product->sku)]) }}" class="product-addtocart"> <svg fill="#010101" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">                                          
                                              <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                                                  c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                                                  C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                                                      M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                                                  c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                                          
                                          </svg></a>
                                      </div>                                        
                                  </div>
                              </div>
                          </li>
                        @endforeach   
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      @endif 
      <!--=====================================================
                              Also View Section End
      =========================================================-->
      
    </section>
	
	<!--  Cart Section -->
@endsection

@push('scripts')
    <script>
        console.log('sixth');
        var notRequiredQtyAjaxClickonQtyBtn = true;
        displayCartItems(notRequiredQtyAjaxClickonQtyBtn);
        $(document).on('click', '#apply-coupon-btn', function(e) { 
            var couponCode = $('#coupon_code_input').val();
            applyCoupon(couponCode);
}       );

        $(document).on('click', '.checkoutButton', function() {
            if (isLoggedIn) {
                window.location.href = "{{ route('front-product.checkoutBag') }}";
            } else {
                window.location.href= "{{ route('front-user.login') }}"; 
            }
        });

        localStorage.removeItem('coupon_id');
        localStorage.removeItem('coupon_discount');
        getCoupon();

        function applyCoupon(couponCode) {
            if(couponCode==''){
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

        // document.getElementById('pincodeInput').addEventListener('input', function() {
        //     // Allow only numbers
        //     this.value = this.value.replace(/\D/g, '');
        //     if (this.value.length === 6) {
        //         calculateDelivery();
        //     }
        // });


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

        // const options = {
        //     weekday: 'short',
        //     day: 'numeric',
        //     month: 'short'
        // };
        // const formattedDate = today.toLocaleDateString('en-US', options);

        //     const svgImage = `<svg
    //     class="me-2"
    //     xmlns="http://www.w3.org/2000/svg"
    //     width="20"
    //     height="20"
    //     viewBox="0 0 512 512"
    //     style="enable-background: new 0 0 512 512;"
    //     xml:space="preserve">
    //     <g>
    //         <path d="M386.689 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269c0 17.797-14.473 32.269-32.269 32.269zM166.185 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269c17.791 0 32.269 14.473 32.269 32.269 0 17.797-14.473 32.269-32.269 32.269zM430.15 119.675a16.143 16.143 0 0 0-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"
    //             fill="#fc2424"></path>
    //         <path d="M216.202 353.345h122.084v32.269H216.202zM117.781 353.345H61.849c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134 0-8.912-7.223-16.134-16.135-16.134zM508.612 254.709l-31.736-40.874a16.112 16.112 0 0 0-12.741-6.239H346.891V94.655c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.773V223.73c0 8.912 7.223 16.134 16.134 16.134h125.478l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134V264.605c0-3.582-1.194-7.067-3.388-9.896zM116.706 271.597H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.133-16.134zM153.815 208.134H16.134C7.223 208.134 0 215.357 0 224.269s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135z"
    //             fill="#fc2424"></path>
    //         <path d="M180.168 144.672H42.487c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134.001-8.911-7.222-16.134-16.134-16.134z"
    //             fill="#fc2424"></path>
    //     </g>
    // </svg>`;

        //     // Set the content
        //     deliveryTimeEl.innerHTML = `${svgImage} Get it by <b>9:00 PM on ${formattedDate}</b>`;
        // }


        $(function() { // Best Sellers Products
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
