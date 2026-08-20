@extends('front.layouts.app')
@section('content')
<section class="banner-section">
         <!--  <div class="shape shape-three"><span><img src="assets/img/curved-arrow.png" alt=""></span></div>
            <div class="shape shape-four"><span><img src="assets/img/stars.png" alt=""></span></div> -->
         <div class="banner-inner">
               <div class="shape1"><img src="{{ Url('/assets/front/img/breadcumb-shape1_1.png') }}" alt="shape" /></div>
        <div class="shape2"><img src="{{ Url('assets/front/img/breadcumb-shape1_2.png') }}" alt="shape" /></div>
        <div class="shape3"><img src="{{ Url('assets/front/img/breadcumb-shape1_3.png') }}" alt="shape" /></div>
        <div class="shape4"><img src="{{ Url('assets/front/img/breadcumb-shape1_4.png') }}" alt="shape" /></div>
            <div class="container">
               <div class="banner-text">
                  <h1>Contact Us</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <!--      <svg class="page-svg" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.1742 33.0065C14.029 35.2507 7.5486 39.0636 0 40.7339V86H1937V64.9942C1933.1 60.1623 1912.65 65.1777 1904.51 62.6581C1894.22 59.4678 1884.93 55.0079 1873.77 52.7742C1861.2 50.2585 1823.41 36.3854 1811.99 39.9252C1805.05 42.0727 1796.94 37.6189 1789.36 36.6007C1769.18 33.8879 1747.19 31.1848 1726.71 29.7718C1703.81 28.1919 1678.28 27.0012 1657.53 34.4442C1636.45 42.005 1606.07 60.856 1579.5 55.9191C1561.6 52.5906 1543.41 47.0959 1528.45 56.9075C1510.85 68.4592 1485.74 74.2518 1460.44 76.136C1432.32 78.2297 1408.53 70.6879 1384.73 62.2987C1339.52 46.361 1298.19 27.1677 1255.08 9.28534C1242.58 4.10111 1214.68 15.4762 1200.55 16.6533C1189.77 17.5509 1181.74 15.4508 1172.12 12.8795C1152.74 7.70033 1133.23 2.88525 1111.79 2.63621C1088.85 2.36971 1073.94 7.88289 1056.53 15.8446C1040.01 23.3996 1027.48 26.1777 1007.8 26.1777C993.757 26.1777 975.854 25.6887 962.844 28.9632C941.935 34.2258 932.059 38.7874 914.839 28.6037C901.654 20.8061 866.261 -2.56499 844.356 7.12886C831.264 12.9222 820.932 21.5146 807.663 27.5255C798.74 31.5679 779.299 42.0561 766.33 39.1166C758.156 37.2637 751.815 31.6349 745.591 28.2443C730.967 20.2774 715.218 13.2948 695.846 10.723C676.168 8.11038 658.554 23.1787 641.606 27.4357C617.564 33.4742 602.283 27.7951 579.244 27.7951C568.142 27.7951 548.414 30.4002 541.681 23.6618C535.297 17.2722 530.162 9.74921 523.263 3.71444C517.855 -1.01577 505.798 -0.852017 498.318 2.09709C479.032 9.7007 453.07 10.0516 431.025 9.64475C407.556 9.21163 368.679 1.61612 346.618 10.3636C319.648 21.0575 291.717 53.8338 254.67 45.2266C236.134 40.9201 225.134 37.5813 204.78 40.7339C186.008 43.6415 171.665 50.7785 156.051 57.3567C146.567 61.3523 152.335 52.6281 151.12 47.9222C149.535 41.7853 139.994 34.5585 132.991 30.4008C120.206 22.8098 90.2848 24.3246 74.2546 24.6502C55.5552 25.0301 37.9201 27.747 21.1742 33.0065Z" fill="#FFFAF3"></path>
            </svg> -->
      </section>
      <section class="section-space contact-us pb-0">
         <div class="container">
            <div class="contact-us-row">
               <div class="row">
                  <div class="col-md-8 contact-us-row-left">
                     <div class="contact-us-form-head mb-4">
                        <h3>Drop Us a Line</h3>
                        <p>Your email address will not be published. Required fields are marked *</p>
                     </div>
                     
                     <div class="row contact-us-form">
                         <form id="contact">
                            @csrf
                            <div class="row">
                        <div class="form-group col-md-6 mb-4">
                           <input type="text" class="form-control"name="name" id="name" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6 mb-4">
                           <input type="text" class="form-control" name="email" id="email" placeholder="Your Email">
                        </div>
                        </div>
                         <div class="row">
                        <div class="form-group col-md-6 mb-4">
                           <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone">
                        </div>
                        <div class="form-group col-md-6 mb-4">
                           <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        </div>
                        </div>
                        <div class="form-group col-md-12"> 
                        <textarea class="form-control" name="message" id="message" placeholder="Message">
                        </textarea>
                        </div>
                        <div class="col-md-12">
                             <button type="submit" class="btn submit-btn">Send Message</button></div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-4 contact-us-img">
                     <figure><img src="{{ Url('assets/front/img/contact-2.png')}}"></figure>
                  </div>
               </div>
            </div>
            <?php
 $address = App\Models\Setting::where(['key' => 'Contact.address'])->first();
 $contact_number = App\Models\Setting::where(['key' => 'Contact.contact_number'])->first();
 $email = App\Models\Setting::where(['key' => 'Contact.contact_email'])->first();
  $whatsapp_number = App\Models\Setting::where(['key' => 'Contact.whatsapp_number'])->first();

?>
            <ul class="contact-info-list">
               <li>
                  <figure><i class="fa-solid fa-house"></i></figure>
                  <figcaption>
                     <h4>Address</h4>
                     <p>{!! $address->value !!}</p>
                  </figcaption>
               </li>
               <li>
                  <figure><i class="fa-solid fa-envelope"></i></figure>
                  <figcaption>
                     <h4>Email</h4>
                     <a href="mailto:{{$email->value}}">{{$email->value}}</a>
                  </figcaption>
               </li>
               <li>
                  <figure><i class="fa-solid fa-phone"></i></figure>
                  <figcaption>
                     <h4>Contact</h4>
                     <a href="tel:{{$contact_number->value}}">{{$contact_number->value}}</a><br>
                     <a href="tel:{{$whatsapp_number->value}}">{{$whatsapp_number->value}}</a>
                  </figcaption>
               </li>
            </ul>
         </div>
         <div class="map-box mt-4">
<iframe width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?q=https%3A%2F%2Fwww.google.com%2Fmaps%2Fplace%2FVASVI%2BBy%2BPyramid%2BExports%2F%4026.777173%2C75.8415658%2C970m%2Fdata%3D!3m1!1e3!4m14!1m7!3m6!1s0x396dc99406d359db%3A0xf67be7a13f4f2898!2sVASVI%2BBy%2BPyramid%2BExports!8m2!3d26.777173!4d75.8415658!16s%252Fg%252F11x2xc8ct5!3m5!1s0x396dc99406d359db%3A0xf67be7a13f4f2898!8m2!3d26.777173!4d75.8415658!16s%252Fg%252F11x2xc8ct5%3Fentry%3Dttu%26g_ep%3DEgoyMDI1MDkwMi4wIKXMDSoASAFQAw%253D%253D&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>         </div>
      </section>
      
      @endsection
      
      @push("scripts")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#contact').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('contact') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
        window.location.href = response.redirect_url; // back ho jayega
    });

            },
            error: function (xhr) {
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
</script>
@endpush