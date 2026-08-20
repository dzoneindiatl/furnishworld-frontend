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
                
                <div class="content-wrapper">
                    <div class="container">
                    <div class="page-header text-center">
                        <h1 class="page-title">Contact Us</h1>
                    </div>
                    <div class="content-area">
                        <div class="contact-info-section">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 col-sm-12 col-12 mb-4 mb-md-0">
                            <div class="contact-info">
                                <h4 class="contact-info-title">Corporate Office/ Address for Store Pickup</h4>
                                <ul>
                                <li class="col-md-12 col-sm-12 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-regular fa-map"></i> </div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Address</h5>
                                        <p>Jaipur, Rajasthan 302033, India</p>
                                    </div>
                                    </div>
                                </li>
                                <li class="col-md-4 col-sm-6 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-solid fa-phone"></i> </div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Phone</h5>
                                        <p><a href="tel:+91 9876543210">+91 9876543210</a></p>
                                    </div>
                                    </div>
                                </li>
                                <li class="col-md-4 col-sm-6 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-solid fa-mobile-screen-button"></i></div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Mobile</h5>
                                        <p><a href="tel:+91 9876543210">+91 9876543210</a></p>
                                    </div>
                                    </div>
                                </li>
                                <li class="col-md-4 col-sm-6 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-brands fa-whatsapp"></i> </div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Whatsapp</h5>
                                        <p>
                                        <span class="d-none d-md-block">
                                            <a target="_blank" href="https://web.whatsapp.com/send?phone=+91-9876543210&amp;text=Hi, I had some queries.">+91-98765-43210</a>
                                        </span>
                                        <span class="d-md-none">
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=+91-9876543210&amp;text=Hi, I had some queries.">+91-98765-43210</a>
                                        </span>
                                        </p>
                                    </div>
                                    </div>
                                </li>
                                <!-- <li class="col-md-4 col-6 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-regular fa-envelope"></i> </div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Email</h5>
                                        <p><a href="mailto:contact@shoptjap.com">contact@shoptjap.com</a></p>
                                    </div>
                                    </div>
                                </li> -->
                                <!-- <li class="col-md-4 col-6 col-12">
                                    <div class="contact-wrap">
                                    <div class="contact-icon"> <i class="fa-regular fa-clock"></i></div>
                                    <div class="contact-text">
                                        <h5 class="contact-title">Working Hour</h5>
                                        <p>Mon-Fri | 10:00 AM - 06:30 PM (IST)</p>
                                    </div>
                                    </div>
                                </li> -->
                                </ul>
                            </div>
                            <!--contact-info-->
                            <div class="contact-page-map">
                                <iframe title="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113874.36215608017!2d75.63466729188981!3d26.88527834347104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1703757829792!5m2!1sen!2sin" width="100%" height="365" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-12 col-12 ps-lg-5">
                            <div class="contact-page-form">
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
                                <h4 class="contact-form-title">Get in Touch With us!</h4>
                                <div class="form">
                                <form action="{{route('front-user.contactSuggestionSave')}}" method="post" autocomplete="off">  
                                    @csrf
                                    <input type="hidden" name="type" value="contact">
                                    <div class="row">
                                    <div class="form-group col-sm-12 col-12">
                                        <label>Name</label><input type="text" name="name" value="" size="40" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-12">
                                        <label>Email</label><input type="email" name="email" value="" size="40"
                                        class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-12">
                                        <label>Phone</label><input type="tel" name="phone_number" value="" size="40" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-12">
                                        <label>Subject</label><input type="text" name="subject" value="" size="40"
                                        class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-12">
                                        <label>Message</label><textarea name="message" cols="40" rows="10"
                                        class="form-control"></textarea>
                                    </div>
                                    <div class="form-submit col-sm-12 col-12">
                                        <input type="submit" value="Submit" class="btn btn-secondary">
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>                
                        </div>
                        </div>            
                    </div>
                    <!--content-area-->
                    </div>
                      
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
        $(document).on('click', '.removewishlistBtn', function() {   
           // Delay for 2 seconds (2000 milliseconds)
            setTimeout(function() {
            location.reload();
            }, 2000);
        });

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
