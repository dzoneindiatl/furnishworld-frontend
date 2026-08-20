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
                            <li class="breadcrumb-item trail-begin"><a href="{{ env('WEBSITE_URL') }}" rel="home"><span itemprop="name">Home</span></a></li>                          
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
              <div class="row">
                <!-- sidebar-section -->
                @include('front.modules.dashboard.sidebar')
                <!-- sidebar-section -->

                <div class="myaccout-content-area col-md-9 col-sm-12 col-12">                 
                    <div class="page-header">
                      <h1 class="page-title">Account Setting</h1>
                    </div>
                    <div class="myaccout-content-wrapper">

                      <div class="account-section">
                        <div class="account-header">
                          <div class="account-title">
                            My Details
                          </div> 
                          @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul class="mt-2 mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif 
                          <div class="enable-disable-value"> 
                            <a class="enable-value" href="javascript:;">Edit</a> 
                            <a class="disable-value d-none" href="javascript:;">Cancel</a> 
                          </div>
                        </div>                       
                        <div class="account-body">
                          <div class="account-content">
                            <p>Hello {{ $user->name }}!</p>
                            <p><strong>Your Name : </strong>{{ $user->name }}</p>
                            <p><strong>Email : </strong>{{ $user->email }}</p>
                            <p><strong>Phone : </strong>{{ $user->phone_number }}</p>
                            <p><strong>Gender : </strong>{{ $user->gender }}</p>
                          </div>

                          <div class="account-form">
                            <form action="{{ route('front-user.updateProfile') }}" method="post" role="form"> 
                              @csrf                              
                              <h4 class="font-weight-semibold">Personal Information</h4>
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Phone No.</label>
                                <input type="tel" name="phone_number" value="{{ $user->phone_number }}" class="form-control" required>
                              </div> 
                              <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control" required>
                                  <option value="">Select Gender</option> 
                                  <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                  <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                  <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>                             
                              <h4 class="font-weight-semibold">Password</h4>                              
                              <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" value="" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name="confirm_password" value="" class="form-control" required>
                              </div>
                              <div class="form-submit">
                                <input type="submit" value="Submit" class="btn btn-primary">
                              </div>                             
                            </form>
                          </div>
                        </div>
                      </div>
                     
                      <div class="shipping-section">
                        <!-- Billing - section -->
                        <div class="shipping-address">
                            <p class="f-16 font-medium mb-3">Billing Addrress</p>
                            <div class="shipping-address-items">
                            @if($userBillingAddress->count() > 0)
                                @foreach($userBillingAddress as $billingAddress)
                                <div class="shipping-address-item {{ ($billingAddress->is_default == 1) ? 'selected-item' : 'not-selected-item' }}">
                                    <!-- <input class="shipping-address-input select_billing_address" id="add{{ $billingAddress->id }}" type="radio" value="{{ $billingAddress->id }}" name="billaddress" {{ ($billingAddress->is_primary == 1) ? 'checked' : '' }} > -->
                                    <label class="shipping-address-label" for="add{{ $billingAddress->id }}">
                                    <p>{{ $billingAddress->name }} <span class="ml-3">{{ $billingAddress->phone_number }}</span> <span class="edit-address-btn" data-id="{{ $billingAddress->id }}" style="float: right;color: blue;pointer:cursor;">Edit</span></p>
                                    <p>{{ $billingAddress->address }}, {{ $billingAddress->landmark }}, {{ $billingAddress->city?->name }}, {{ $billingAddress->state?->name }},{{ $billingAddress->country?->name }} - <span>{{ $billingAddress->postal_code }}</span></p>
                                    <?php if($billingAddress->is_primary == 1) { echo '<span style="float: left;color: #c2a188;pointer:cursor;">Primary</span>'; } ?>
                                    <span id="removeAddressBtn" class="remove-address-btn" data-adddressId="{{ $billingAddress->id }}" style="float: right;color: red;pointer:cursor;">Remove</span>
                                    </label>                           
                                </div>
                                @endforeach
                            @else 
                                <p>No billing address found. Please add a billing address.</p>
                            @endif
                            </div>
                        </div>
                        <!-- Billing - section -->
                        
                        <!-- shipping-section -->
                        <div class="shipping-address">
                            <p class="f-16 font-medium mb-3">Shipping Addrress</p>
                            <div class="shipping-address-items">
                            @if($usershippingAddress->count() > 0)
                                @foreach($usershippingAddress as $shippingAddress)
                                <div class="shipping-address-item {{ ($shippingAddress->is_default == 1) ? 'selected-item' : 'not-selected-item' }}">
                                    <!-- <input class="shipping-address-input select_shipping_address" id="add{{ $shippingAddress->id }}" type="radio" value="{{ $shippingAddress->id }}" name="shipaddress" {{ ($shippingAddress->is_primary == 1) ? 'checked' : '' }} > -->
                                    <label class="shipping-address-label" for="add{{ $shippingAddress->id }}">
                                    <p>{{ $shippingAddress->name }} <span class="ml-3">{{ $shippingAddress->phone_number }}</span> <span class="edit-address-btn" data-id="{{ $shippingAddress->id }}"  style="float: right;color: blue;pointer:cursor;">Edit</span></p>
                                    <p>{{ $shippingAddress->address }}, {{ $shippingAddress->landmark }}, {{ $shippingAddress->city?->name }}, {{ $shippingAddress->state?->name }},{{ $shippingAddress->country?->name }} - <span>{{ $shippingAddress->postal_code }}</span></p>
                                    <?php if($shippingAddress->is_primary == 1) { echo '<span style="float: left;color: #c2a188;pointer:cursor;">Primary</span>'; } ?>
                                    <span id="removeAddressBtn" class="remove-address-btn" data-adddressId="{{ $shippingAddress->id }}" style="float: right;color: red;pointer:cursor;">Remove</span>
                                    </label>                           
                                </div>
                                @endforeach
                            @else 
                                <p>No shipping address found. Please add a shipping address.</p>
                            @endif
                            </div>
                        </div>
                        <!-- shipping-section -->

                        <div class="shipping-address p-0">
                            <button id="add-new-address" class="btn btn-white text-start w-100" data-bs-toggle="collapse" data-bs-target="#new-address">+ Add A New Address</button>
                        </div>                      
                        <div id="new-address" class="collapse shipping-address mt-3">
                            <p class="f-16 font-medium mb-3">Add/Update Address</p> 
                            <span class="error-msg text-danger"></span>
                            <form method="post" id="editAddressForm">
                            <input type="hidden" name="addressId" id="addressId" value="">
                            <div class="row">
                                <div class="form-group half-right col-sm-6 col-12">
                                <label>Country/Region <span class="required">*</span></label>
                                <select class="form-select selectcommon requiredField" name="country" id="country" aria-label="Default select example" required>
                                    <option>Country/Region</option>
                                    <option value="101" selected="">India</option>
                                </select>
                                </div>
                                <div class="form-group half-left col-sm-6 col-12">
                                <label>First Name <span class="required">*</span></label>
                                <input type="text" class="form-control requiredField" name="firstname" placeholder="First name"  />
                                </div>
                                <div class="form-group half-right col-sm-6 col-12">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" class="form-control requiredField" name="lastname" placeholder="Last name"  />
                                </div>
                                <div class="form-group half-left col-sm-6 col-12">
                                <label>Address <span class="required">*</span></label>
                                <input type="text" name="address" class="form-control requiredField" placeholder="Address" required />
                                </div>
                                <div class="form-group half-right col-sm-6 col-12">
                                <label>landmark</label>
                                <input type="text" name="landmark" class="form-control" placeholder="Apartment, suite, etc. (optional)" />
                                </div>
                                <div class="form-group half-left col-sm-6 col-12">
                                <label>State <span class="required">*</span></label>
                                <select class="form-select selectcommon editState requiredField" id="state" name="state" required>
                                    <option value="">State</option>
                                    @if (isset($states))
                                        @foreach ($states as $key => $state)
                                            <option value="{{ $key }}">{{ $state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </div>
                                <div class="form-group half-right col-sm-6 col-12">
                                <label>City <span class="required">*</span></label>
                                <select class="form-select selectcommon editCity requiredField" name="city"   required>
                                    <option value="">City</option>
                                </select>
                                </div>
                                <div class="form-group half-left col-sm-6 col-12">
                                <label>Postal Code <span class="required">*</span></label>
                                <input type="text" name="pinCode" class="form-control" placeholder="PIN code"  required />
                                </div>
                                <div class="form-group col-sm-12 col-12">
                                <label>Contact Number <span class="required">*</span></label>
                                <input type="text" name="phone" class="form-control requiredField" placeholder="Phone" value="{{ Auth::guard('customer')->user()->phone_number }}" required />
                                </div>
                                <div class="form-group half-right col-sm-6 col-12">
                                <label>Type <span class="required">*</span></label>
                                <select class="form-select requiredField" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="shipping">Shipping</option>
                                    <option value="billing">Billing</option>
                                </select>
                                </div>
                                <div class="form-group col-sm-12 col-12">
                                <label> Address Type <span class="required">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="address_place_type" id="home" value="1" checked>
                                    <label class="form-check-label" for="home">
                                        <div class="sp-content">
                                            <h6>Home</h6>
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="address_place_type" id="office" value="2">
                                    <label class="form-check-label" for="office">
                                        <div class="sp-content">
                                            <h6>Office</h6>
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="address_place_type" id="Others" value="3">
                                    <label class="form-check-label" for="Others">
                                        <div class="sp-content">
                                            <h6>Others</h6>
                                        </div>
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="form-button">
                                <button type="button" class="btn btn-primary" id="updateAddressBtn">Save</button>
                                <button type="button" class="cancel btn btn-secondary">Cancel</button>
                            </div>
                            </form>
                        </div>
                        </div>
                        <!-- shipping-section -->

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
                data:{product_id:pid},
                dataType:"json",
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
