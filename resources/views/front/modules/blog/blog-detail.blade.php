@extends('front.layouts.app')
@section('content')
      <section class="banner-section">
         <!--  <div class="shape shape-three"><span><img src="assets/img/curved-arrow.png" alt=""></span></div>
            <div class="shape shape-four"><span><img src="assets/img/stars.png" alt=""></span></div> -->
         <div class="banner-inner">
           <div class="shape1"><img src="{{asset("assets/front/img/breadcumb-shape1_1.png")}}" alt="shape" /></div>
            <div class="shape2"><img src="{{asset("assets/front/img/breadcumb-shape1_2.png")}}" alt="shape" /></div>
            <div class="shape3"><img src="{{asset("assets/front/img/breadcumb-shape1_3.png")}}" alt="shape" /></div>
            <div class="shape4"><img src="{{asset("assets/front/img/breadcumb-shape1_4.png")}}" alt="shape" /></div>
            <div class="container">
               <div class="banner-text">
                  <h1>Blog Detail</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Detail</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
    
      </section>
      <section class="blog-detail-sec section-space">
         <div class="container">
            <figure class="banner-img"><img src="{{ asset('uploads/banners/'.$details->media) }}"></figure>
            <div class="blog-detail-content">
               <h3>{{ $details->title }}</h3>
               <div class="blog-detail-contain">
                  <p>{!! $details->short_description !!}
                  </p>
                  <p>
                     {!! $details->long_description !!}
                  </p>
               
                  <div class="post-share-icon">
                     <div class="share-title">Share On</div>
                     <div class="share-icon">
                        <a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="twitter" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a class="whatsapp" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a class="instagram" href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                     </div>
                  </div>
               </div>
            </div>
          </div>
      </section>
      
      <!-- Blogs -->

@if(count($blogs) > 0)
<section class="women-seller wedding-invite recent_sing_blog">
    <div class="container-fluid">
        <div class="section-text-headung">
            <div class="heading-flower-image">
                <img src="{{asset("assets/front/img/favi_vasvi.png")}}" class="floating-flower">
            </div>
            <span class="section-text-headung-line-before"></span>
            <h2 class="main-heading">Vasvi Trending Blogs</h2>
            <span class="section-text-headung-line-after"></span>
        </div>
        <div class="owl-carousel owl-theme" id="productRandom">
            @foreach ($blogs as $blog)
          
            <div class="item">
                <div class="row align-items-center">
                    <div class="col col-md-6">
                        <div class="feature-row__item">
                            <div class="img-border">
                                <div class="border-1">
                                    <div class="border-2">
                                        <div class="img">
                                            <img class="feature-row__image lazyload entered loaded"
                                                src="{{ asset('uploads/banners/'.$blog->media) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="feature-row">
                            <h2 class="h2">{{ $blog->title }}</h2>
                            <p>{!!  \Illuminate\Support\Str::words($blog->short_description, 45, '...') !!}</p>
                            <a href="{{ route('blog.detail',$blog->blog_slug) }}" class="text_link">
                                Know More
                                <!--<svg width="16" height="16" viewBox="0 0 16 16" fill="#000" xmlns="http://www.w3.org/2000/svg">-->
                                <!--   <path-->
                                <!--      d="M15.8278 8.72354L15.8278 7.27554C11.6638 6.42621 8.16116 0.27154 8.16116 0.27154L6.2085 1.91087C7.92983 5.53021 12.8585 7.71087 12.8585 7.71087C12.8585 7.71087 8.96716 7.16954 6.93917 7.16954H0.027832L0.027832 8.82954H6.93917C8.9665 8.82954 12.8585 8.28821 12.8585 8.28821C12.8585 8.28821 7.92916 10.4695 6.2085 14.0882L8.1665 15.7275C8.1665 15.7275 11.6672 9.57287 15.8278 8.72354Z"></path>-->
                                <!--</svg>-->
                            </a>
                            <div class="icon-head">
                                <svg xmlns="http://www.w3.org/2000/svg" width="131" height="127" viewBox="0 0 131 127"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M46.0851 24.016C45.9143 24.5552 46.0888 25.4902 46.4494 26.0954C47.3313 27.4836 52.732 33.335 53.2471 33.4654C54.4706 33.7752 53.8728 31.6709 51.5894 27.5639C49.5868 23.8363 48.9848 23.1015 48.0833 22.8732C46.7714 22.5067 46.4082 22.7231 46.0821 24.011L46.0851 24.016Z"
                                        fill="#090510"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.6292 61.2031C7.37689 62.0642 9.21447 64.4139 10.4938 64.9091C12.618 65.7211 16.8937 66.2897 17.1288 65.7668C17.5014 65.1074 16.3121 64.1211 12.42 61.9022C9.31613 60.0884 7.95529 59.9152 7.6292 61.2031Z"
                                        fill="#090510"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M95.3521 23.4105C95.4588 25.4247 96.4433 30.1964 96.9001 30.963C97.5012 31.9718 98.3425 30.8143 98.6393 28.5597C99.0433 25.4757 98.8327 23.1955 97.9671 21.7429C97.3659 20.7342 97.0843 20.6286 96.237 21.1335C95.551 21.5423 95.2833 22.1939 95.3521 23.4105Z"
                                        fill="#090510"></path>
                                    <path
                                        d="M60.3625 52.742L60.3625 52.742C61.6067 56.6941 62.2505 61.0095 62.2946 64.9705C62.3386 68.9188 61.7874 72.5734 60.5928 75.1757C59.271 78.085 57.4475 80.1141 55.0668 81.1633C52.6922 82.2098 49.8601 82.2385 46.6018 81.3437C42.5948 80.2928 37.1777 77.2372 31.2243 72.8452L31.2228 72.8441C30.2502 72.1221 29.4435 71.5697 28.7748 71.1739C28.099 70.774 27.5991 70.5552 27.2346 70.4698C26.878 70.3861 26.7345 70.4473 26.6696 70.4929C26.586 70.5516 26.4607 70.7051 26.3584 71.1031C26.32 71.2855 26.3136 71.3926 26.3241 71.4802C26.3341 71.5639 26.3646 71.6714 26.4623 71.8398C26.6788 72.2126 27.134 72.7402 28.0648 73.7424C29.8484 75.6458 32.7188 80.0568 35.7522 85.3304C38.7986 90.6267 42.0462 96.8583 44.5828 102.45C46.7017 107.111 47.9154 109.661 48.7738 111.013C49.2055 111.693 49.4988 111.988 49.7065 112.114C49.8644 112.21 50.0032 112.228 50.2622 112.172L50.7052 112.075L50.8712 112.353C50.9721 112.377 51.1399 112.397 51.3883 112.402C51.8871 112.412 52.598 112.359 53.4888 112.247C55.2634 112.023 57.6646 111.574 60.3236 110.984C65.6426 109.802 71.9282 108.067 76.1858 106.478L76.1933 106.476L76.1933 106.476C80.0406 105.095 82.4506 103.772 95.5693 95.8453L95.571 95.8443C102.117 91.9159 105.878 89.6335 108.068 88.1999C109.164 87.4819 109.845 86.9905 110.278 86.6215C110.708 86.2555 110.857 86.0406 110.932 85.8841L110.936 85.8746L110.936 85.8747C111.067 85.6123 111.145 85.2863 111.161 84.9803C111.177 84.6555 111.119 84.4518 111.078 84.3831C110.767 83.8601 110.326 82.7911 109.796 81.3495C109.26 79.887 108.613 77.9872 107.893 75.7612C106.452 71.3083 104.708 65.5344 102.943 59.3113L102.942 59.3111C100.562 50.9078 99.291 46.4685 98.4853 44.0809C98.0795 42.8783 97.8086 42.2493 97.5964 41.904C97.4953 41.7395 97.4214 41.6631 97.3724 41.6231C97.3284 41.5872 97.2815 41.5616 97.1981 41.5319C96.8507 41.4155 96.6368 41.4138 96.5042 41.4489C96.3917 41.4786 96.2646 41.5535 96.1252 41.7761C95.9765 42.0136 95.8335 42.3909 95.7121 42.9647C95.5919 43.5325 95.5001 44.2551 95.432 45.1574L95.4316 45.1625C95.0786 49.3795 93.94 53.5358 92.2972 57.0031C90.6607 60.4571 88.4926 63.2919 86.0376 64.784L86.0329 64.7868C84.3537 65.7874 82.8679 66.3285 81.0396 66.4861L81.0388 66.4861C80.0291 66.5718 79.1043 66.5371 78.1872 66.284C77.2683 66.0305 76.3943 65.5682 75.4695 64.8474C73.6465 63.4264 71.5575 60.9419 68.4663 56.8984L60.3625 52.742ZM60.3625 52.742L60.3602 52.735M60.3625 52.742L60.3602 52.735M60.3602 52.735C59.9972 51.6269 59.6829 50.5334 59.4693 49.6689C59.3623 49.2359 59.2824 48.8676 59.234 48.5873C59.2098 48.4468 59.1949 48.3361 59.1878 48.2547C59.1863 48.2373 59.1852 48.2226 59.1845 48.2104L59.1922 48.1625M60.3602 52.735L59.1922 48.1625M59.1922 48.1625C59.2411 47.854 59.4591 47.5852 59.7649 47.4391C60.0724 47.2922 60.3875 47.3055 60.6112 47.4488L60.6112 47.4489M59.1922 48.1625L60.6112 47.4489M60.6112 47.4489L60.6197 47.4542M60.6112 47.4489L60.6197 47.4542M60.6197 47.4542C61.0901 47.7451 61.618 48.218 62.7648 49.5947M60.6197 47.4542L62.7648 49.5947M62.7648 49.5947C63.9071 50.9658 65.6207 53.1794 68.4661 56.8982L62.7648 49.5947ZM50.8029 112.332C50.8032 112.332 50.8073 112.333 50.8142 112.337C50.806 112.334 50.8025 112.332 50.8029 112.332Z"
                                        fill="#F2ECA2" stroke="#090510" stroke-width="1.25819"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
@endif


      
  @endsection