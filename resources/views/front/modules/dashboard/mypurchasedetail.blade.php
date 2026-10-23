@extends('front.layouts.app')
@section('content')
    <!-- page-banner-section -->
    <section class="site-content myaccount-site-content">
        <div class="page-banner-section">
            <div class="page-banner">
                <div class="container">
                    <div class="page-banner-wrap">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb-items">
                                <li class="breadcrumb-item trail-begin"><a href="{{ env('WEBSITE_URL') }}"
                                        rel="home"><span itemprop="name">Home</span></a></li>
                                <li class="breadcrumb-item trail-end"><span itemprop="name">My Purchase</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-banner-section -->
        <div class="content-wrapper">
            <div class="container">
                <div class="content-area">
                    <div class="myaccout-section">
                        <div class="dashboard-inner-row">
                            <!-- sidebar-section -->
                            @include('front.modules.dashboard.sidebar')
                            <!-- sidebar-section -->
                            <div class="myaccout-content-area col-md-9 col-sm-12 col-12">
                                <div class="page-header">
                                    <h1 class="page-title">My Purchase Details</h1>
                                </div>
                                <div class="myaccout-content-wrapper">
                                    <div class="order-detail-item">
                                        <div class="order-place-main-txt row justify-content-between">
                                            <div class="order-place-main-txt1 col-lg-8 col-md-8 col-12">
                                                <p>
                                                    Order #<mark
                                                        class="order-number">{{ $orderDetails->order_number }}</mark> was
                                                    placed on <mark
                                                        class="order-date">{{ \Carbon\Carbon::parse($orderDetails->updated_at)->format('d M Y at h:i A') }}</mark>.
                                                </p>
                                            </div>
                                            <div class="order-place-main-txt2 col-lg-4 col-md-4 col-12 text-end">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-primary btn-download-invoice">Download
                                                    Invoice</a>
                                            </div>
                                        </div>
                                        <hr class="border-secondary">
                                        <div class="inner-cont-deliv-txt">
                                            <div class="inner-cont-deliv-txt1 col-lg-6 col-md-6 col-12">
                                                <?php $shippingAddress = json_decode($orderDetails->shipping_address); ?>
                                                <p><strong>Delivery Address</strong></p>
                                                {{ @$shippingAddress->shipping_customer_name }}<br>
                                                {{ @$shippingAddress->shipping_address }} ,
                                                {{ @$shippingAddress->shipping_city }} ,
                                                {{ @$shippingAddress->shipping_state }},
                                                {{ @$shippingAddress->shipping_country }},
                                                {{ @$shippingAddress->shipping_pincode }}
                                                </br>Phone number : {{ @$shippingAddress->shipping_phone }}
                                                </br>Eamil : {{ @$shippingAddress->shipping_email }}
                                            </div>
                                            <div class="inner-cont-deliv-txt2 col-lg-6 col-md-6 col-12">
                                                <p><strong>Your Rewards</strong></p>
                                                <!-- <p>28 Points Cashback</p>
                                                      <p><small>Use it to save on your next order</small></p> -->
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-primary btn-sm btn-view-all">View
                                                    All</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-detail-item mb-0 p-0">
                                        @if ($orderDetails->items->count() > 0)
                                            @foreach ($orderDetails->items as $item)
                                                <?php $productDetail = getProductDetail($item->product_id); ?>
                                                <div class="tabel-row">
                                                    <div class="table-cell order-img"><a href="product-detail.html"><img
                                                                src="{{ env('WEBSITE_URL') . 'uploads/products/' . @$item->productGraphics->graphic }}"
                                                                width="75" height="75"></a></div>
                                                    <div class="table-cell">
                                                        <p class="order-title"><a
                                                                href="product-detail.html">{{ $productDetail->name ?? '' }}</a>
                                                        </p>
                                                        <?php $productVariants = json_decode($item->combination); 
                                        foreach($productVariants as $key=>$value){
                                        ?>
                                                        <p class="f-12 mb-0">{{ $key }} : {{ $value }}</p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="table-cell text-end order-total">
                                                        <p class="order-price">₹
                                                            {{ number_format($item->selling_price, 2) }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                    <div class="order-detail-item p-2">
                                        <table class="shop-table table table-borderless mb-0">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td data-title="Subtotal" class="text-end"><strong>₹
                                                            {{ number_format($orderDetails->sub_total, 2) }}</strong> </td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Coupon Discount</td>
                                                    <td data-title="Shipping" class="text-end text-green">
                                                        -₹{{ number_format($orderDetails->coupon_discount, 2) }}</td>
                                                </tr>
                                                <tr class="shipping-totals shipping">
                                                    <td>Shipping</td>
                                                    <td data-title="Shipping" class="text-end">
                                                        {{ number_format($orderDetails->shippingcharge, 2) }}</td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td data-title="Total" class="text-end">
                                                        <strong>{{ number_format($orderDetails->total, 2) }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- <div class="order-progerss-bar">
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Order Confirmed</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Shipped</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Out For Delivery</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Sun, 7th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-end order-progerss-sucess">
                          <div class="order-progerss-title"><span>Delivered</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-time"><span>Sun, 7th Jan</span></div>
                        </div>
                      </div>                      
                      
                      <div class="order-progerss-bar">
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Order Confirmed</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Shipped</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item">
                          <div class="order-progerss-title"><span>Out For Delivery</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span></span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-end">
                          <div class="order-progerss-title"><span>Delivered</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-time"><span></span></div>
                        </div>
                      </div>
                      
                      <div class="order-progerss-bar">
                        <div class="order-progerss-item order-progerss-sucess">
                          <div class="order-progerss-title"><span>Order Confirmed</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-end order-progerss-cancelled">
                          <div class="order-progerss-title"><span>Cancelled</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-time"><span></span></div>
                        </div>
                      </div>                      
                      
                      <div class="order-progerss-bar">
                        <div class="order-progerss-item order-progerss-returnrefund">
                          <div class="order-progerss-title"><span>Return</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-line"></div>
                          <div class="order-progerss-time"><span>Fri, 5th Jan</span></div>
                        </div>
                        <div class="order-progerss-item order-progerss-end order-progerss-returnrefund">
                          <div class="order-progerss-title"><span>Refund</span></div>
                          <div class="order-progerss-circle"></div>
                          <div class="order-progerss-time"><span>Sun, 7th Jan</span></div>
                        </div>
                      </div> --}}

                                    <div class="order-detail-item order-detail-button">
                                        <a href="{{ env('WEBSITE_URL') . 'rateing-review' }}" class="btn-url">Rate & Review
                                            Product</a>
                                        <a class="btn-url" href="{{ env('WEBSITE_URL') . 'contactwithus' }}">Need help?</a>
                                    </div>

                                    {{-- <div class="order-alerts">
                        <div class="order-alert order-success">
                          <div class="order-alert-icon">
                            <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            
                              <g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> <path d="M21 7.5L17 9.5M12 12L3 7.5M12 12V21.5M12 12C12 12 14.7426 10.6287 16.5 9.75C16.6953 9.65237 17 9.5 17 9.5M17 9.5V13M17 9.5L7.5 4.5" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> </g>
                            </svg>
                          </div>
                          <div class="order-alert-text">
                            <p>Delivered</p>
                            <small> On Tue, 26 Jan 2024</small>
                          </div> 
                        </div>
                        <div class="order-alert order-processing">
                          <div class="order-alert-icon">
                            <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            
                              <g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> <path d="M21 7.5L17 9.5M12 12L3 7.5M12 12V21.5M12 12C12 12 14.7426 10.6287 16.5 9.75C16.6953 9.65237 17 9.5 17 9.5M17 9.5V13M17 9.5L7.5 4.5" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> </g>
                            </svg>
                          </div>
                          <div class="order-alert-text">
                            <p>Processing</p>
                            <small> Will dilliver On Tue, 26 Jan 2024</small>
                          </div> 
                        </div>
                        <div class="order-alert order-canceled">
                          <div class="order-alert-icon">
                            <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            
                              <g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> <path d="M21 7.5L17 9.5M12 12L3 7.5M12 12V21.5M12 12C12 12 14.7426 10.6287 16.5 9.75C16.6953 9.65237 17 9.5 17 9.5M17 9.5V13M17 9.5L7.5 4.5" stroke="#010101" stroke-width="1.5" stroke-linecap="round"/> </g>
                            </svg>
                          </div>
                          <div class="order-alert-text">
                            <p>Canceled</p>
                            <small> On Tue, 26 Jan 2024</small>
                          </div> 
                        </div>
                      </div> --}}

                                    <div class="order-detail-item">
                                        <button class="btn-url" href="#"
                                            @if ($orderDetails->payment_status == 'paid') data-bs-target="#order-return-form" data-bs-toggle="collapse" @else data-bs-toggle="modal" data-bs-target="#returnMessage" @endif>Cancel/Return
                                            Order</button>
                                        <div id="order-return-form" class="collapse" style="display: none;">
                                            <div class="order-return-form pt-3">
                                                <form action="{{ route('front-refund.submit') }}" method="post"
                                                    autocomplete="off">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Cancel order with reason <span
                                                                class="required">*</span></label>
                                                        <select name="return_type" class="form-control">
                                                            <option>Return/Refund</option>
                                                            <option>Looking Exchange</option>
                                                        </select>
                                                    </div>
                                                    <h4><strong>Exchange</strong></h4>
                                                    <div class="form-group">
                                                        <label>Refund/Return Reason<span class="required">*</span></label>
                                                        <textarea name="refund_reason" class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Upload Photo/Video <span class="required">*</span></label>
                                                        <input name="file" type="file" class="form-control">
                                                    </div>
                                                    <h4><strong>Refund</strong></h4>
                                                    <div class="form-group">
                                                        <p>Refund in <span class="required">*</span></p>
                                                        <div class="mb-3">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="refund_type"
                                                                    type="radio" name="refund" id="refundwallet">
                                                                <label class="form-check-label" for="refundwallet">
                                                                    Wallet
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="refund_type"
                                                                    type="radio" name="refund" id="refundaccount"
                                                                    checked>
                                                                <label class="form-check-label" for="refundaccount">
                                                                    Account
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account Number <span class="required">*</span></label>
                                                        <input name="account_number" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Account Number <span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>IFSC code <span class="required">*</span></label>
                                                        <input name="ifsc_code" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Saving/Current <span class="required">*</span></label>
                                                        <select class="form-control">
                                                            <option>Saving</option>
                                                            <option>Current</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bank Name<span class="required">*</span></label>
                                                        <input name="bank_name" type="text" class="form-control">
                                                    </div>
                                                    <input type="hidden" value="{{ $orderDetails->order_number }}"
                                                        name="order_number">
                                                    @foreach ($orderDetails->items as $itm)
                                                        <input type="hidden" value="{{ $itm->id }}"
                                                            name="order_item_id[]">
                                                    @endforeach
                                                    <div class="form-button">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- myaccout-content-area -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- myaccout-section -->
                </div>
                <!--content-area  -->
            </div>
            <!--container-->
        </div>
        <!--content-wrapper-->
    </section>
    <!-- page main wrapper end -->

    <div class="modal fade" id="returnMessage" tabindex="-1" aria-labelledby="returnMessageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="returnMessageLabel">Cancelation Reason</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Cancelation Reason</label>
                        <textarea name="cancel_reason" id="" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/front/js/dashboard.js') }}"></script>

    <script>
        // your custome placeholder goes here!
        var ph = "Search for style",
            searchBar = $("#search"),
            // placeholder loop counter
            phCount = 0;

        // function to return random number between
        // with min/max range
        function randDelay(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

        // function to print placeholder text in a
        // 'typing' effect
        function printLetter(string, el) {
            // split string into character seperated array
            var arr = string.split(""),
                input = el,
                // store full placeholder
                origString = string,
                // get current placeholder value
                curPlace = $(input).attr("placeholder"),
                // append next letter to current placeholder
                placeholder = curPlace + arr[phCount];

            setTimeout(function() {
                // print placeholder text
                $(input).attr("placeholder", placeholder);
                // increase loop count
                phCount++;
                // run loop until placeholder is fully printed
                if (phCount < arr.length) {
                    printLetter(origString, input);
                }
                // use random speed to simulate
                // 'human' typing
            }, randDelay(50, 90));
        }

        // function to init animation
        function placeholder() {
            $(searchBar).attr("placeholder", "");
            printLetter(ph, searchBar);
        }

        placeholder();
        $(".submit").click(function(e) {
            phCount = 0;
            e.preventDefault();
            placeholder();
        });
    </script>
    <script>
        function updateImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update the image source
                    $('#profilePic').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);


            }
        }
        $(document).on('submit', '#editProfileForm', function(e) {
            e.preventDefault();
            $btnName = $(this).find('button[type=submit]').html();
            $(this).find('button[type=submit]').prop('disabled', true);
            $(this).find('button[type=submit]').html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ' +
                $btnName);
            const that = this;
            var formData = new FormData($('#editProfileForm')[0]);
            const attributes = {
                hasButton: true,
                btnSelector: '.saveBtn',
                btnText: $btnName,
                handleSuccess: function() {
                    localStorage.setItem('flashMessage', datas['msg']);
                    window.location.href = "{{ route('user.dashboard') }}";
                }
            };
            const ajaxOptions = {
                url: "{{ route('front-user.updateProfile') }}",
                method: 'post',
                data: formData
            };

            makeAjaxRequest(ajaxOptions, attributes);
        });
        $(document).on('submit', '#changePasswordForm', function(e) {
            e.preventDefault();
            $btnName = $(this).find('button[type=submit]').html();
            $(this).find('button[type=submit]').prop('disabled', true);
            $(this).find('button[type=submit]').html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> ' +
                $btnName);
            const that = this;
            var formData = new FormData($('#changePasswordForm')[0]);
            const attributes = {
                hasButton: true,
                btnSelector: '.changePasswordBtn',
                btnText: $btnName,
                handleSuccess: function() {
                    localStorage.setItem('flashMessage', datas['msg']);
                    window.location.href = "{{ route('user.dashboard') }}";
                }
            };
            const ajaxOptions = {
                url: "{{ route('front-user.changePassword') }}",
                method: 'post',
                data: formData
            };

            makeAjaxRequest(ajaxOptions, attributes);
        });

        $(document).on('click', '#current_order_back', function(e) {
            $('.tab').show();
        });

        $('.arrow-redirect').on('click', function() {
            let orderId = $(this).data('orderid');
            $('.tab').hide();

            $.ajax({
                type: "GET",
                url: `${window.location.origin}/order-details/${orderId}`,
                success: function(response) {
                    $('#current_order_item').hide();
                    $('#order-details-page').fadeIn();
                    $('#order-details-page').html(response.html);
                    $(`#status_list_${orderId}`).html($(`#order_status_${orderId}`).html());

                },
                error: function(err) {
                    console.error("AJAX error:", err);
                }
            });
        });

        wishhlist();

        function wishhlist() {
            $.ajax({
                type: "GET",
                url: "{{ route('front-user.wishlist') }}",
                success: function(response) {
                    $('.wishlist-data').html(response.wishlistData);
                },
                error: function(xhr) {
                    if (xhr.status === 401 || xhr.status === 302) {
                        window.location.href = '/login'; // or your customer login route
                    } else {
                        console.error("AJAX error:", xhr);
                    }
                }
            })
        }


        $(document).on('click', '#current_order_back', function() {
            $('#current_order_item').fadeIn();
            $('#order-details-page').fadeOut();
        });
        $(document).on('click', '.wishlistBtn', function() {
            let that = $(this);
            let pid = $(this).data('product-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                type: "POST",
                url: "{{ route('front-addwish') }}",
                data: {
                    product_id: pid
                },
                dataType: "json",
                success: function(response) {
                    that.parents('.product-card').parent().remove();
                    wishlistItemCount();
                },
                error: function(xhr) {
                    if (xhr.status === 401 || xhr.status === 302) {
                        window.location.href = '/login'; // or your customer login route
                    } else {
                        console.error("AJAX error:", xhr);
                    }
                }
            })
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#update-dashboard').on('submit', function(e) {
                e.preventDefault();

                let phoneNumber = $.trim($('#phone_number').val()); // get and trim value

                // ✅ Client-side validation
                if (phoneNumber === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Phone number is required.',
                    });
                    return; // stop the form submission
                }

                let formData = new FormData(this); // captures all form data including files

                $.ajax({
                    url: "{{ route('front-user.updateProfile') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = response.redirect_url;
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let firstError = Object.values(errors)[0][0];

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: firstError,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong. Please try again later.',
                            });
                        }
                    }
                });
            });
        });


        const img = document.getElementById('preview-image');
        document.getElementById('image').onchange = e => {
            const file = e.target.files[0];
            if (!file) return img.style.display = 'none';
            img.src = URL.createObjectURL(file);
            img.style.display = 'block';
        };

        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('change', '.print-checkbox-select-all', function() {
                if ($(this).prop('checked')) {
                    $(document).find('.print-checkbox').prop('checked', true);
                } else {
                    $(document).find('.print-checkbox').prop('checked', false);
                }
            });
            $(document).on('change', '.print-checkbox', function() {
                if ($('.print-checkbox:checked').length) {
                    if ($(document).find('.print-checkbox:checked').length < $(
                            '.print-checkbox').length) {
                        $(document).find('.print-checkbox-select-all').prop('indeterminate',
                            true);
                    } else {
                        $(document).find('.print-checkbox-select-all').prop('indeterminate',
                            false);
                        $(document).find('.print-checkbox-select-all').prop('checked', true);
                    }
                } else {
                    $(document).find('.print-checkbox-select-all').prop('indeterminate', false);
                    $(document).find('.print-checkbox-select-all').prop('checked', false);
                }
            });


        });
        $(document).on('click', '.print-invoice-btn', function() {
            if ($(document).find('.print-checkbox:checked').length) {
                var itemIds = [];
                var orderId = $(this).data('id');
                $(document).find('.print-checkbox:checked').each(function(i, e) {
                    id = $(e).data('id');
                    itemIds.push(id);

                });
                $.ajax({
                    url: '{{ route('front-orders.generate.items.invoice') }}',
                    data: {
                        ids: itemIds,
                        id: orderId
                    },
                    dataType: 'json',
                    method: 'post',
                    success: function(res) {

                        let byteChars = atob(res.file);
                        let byteNumbers = new Array(byteChars.length);
                        for (let i = 0; i < byteChars.length; i++) {
                            byteNumbers[i] = byteChars.charCodeAt(i);
                        }
                        let byteArray = new Uint8Array(byteNumbers);
                        let blob = new Blob([byteArray], {
                            type: "application/pdf"
                        });

                        let link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = res.filename;
                        link.click();

                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Something went wrong', 'error');
                    }
                });
            } else {
                Swal.fire('Error!', 'Please select item', 'error');
            }
        });
    </script>

    <!-- Tabing Order panel -->
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            /* border: 1px solid #ccc; */
            /* background-color: #f1f1f1; */
            padding: 3px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: #ccc;
            float: left;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            border-radius: 10px;
            border: 1px solid #red;
            border-color: 1 px solid #ffffff;
            padding: 10px;
            marging-left: 5px;
            margin-left: 10px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #f3eeae;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            /* border: 1px solid #ccc; */
            /* border-top: none; */
        }
    </style>
    <script>
        function openOrder(evt, OrderName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(OrderName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <!-- Tabing Order panel -->
@endsection
