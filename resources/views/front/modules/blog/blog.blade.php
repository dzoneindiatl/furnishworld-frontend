@extends('front.layouts.app')
@section('content')

      <section class="banner-section">
         <!--  <div class="shape shape-three"><span><img src="assets/img/curved-arrow.png" alt=""></span></div>
            <div class="shape shape-four"><span><img src="assets/img/stars.png" alt=""></span></div> -->
         <div class="banner-inner">
            <div class="shape1"><img src="assets/front/img/breadcumb-shape1_1.png" alt="shape" /></div>
            <div class="shape2"><img src="assets/front/img/breadcumb-shape1_2.png" alt="shape" /></div>
            <div class="shape3"><img src="assets/front/img/breadcumb-shape1_3.png" alt="shape" /></div>
            <div class="shape4"><img src="assets/front/img/breadcumb-shape1_4.png" alt="shape" /></div>
            <div class="container">
               <div class="banner-text">
                  <h1>Blog</h1>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
     
      </section>
      <section class="blog-page section-space">
         <div class="container">
            <div class="row">
               @foreach ($blogs as $bloge)
               
               
               <div class="col-md-4">
                  <div class="blog-inner">
                     <figure><a href="{{ route('blog.detail',$bloge->blog_slug) }}"><img src="{{ asset('uploads/banners/'.$bloge->media) }}"></a></figure>
                     <div class="blog-contain">
                        <a href="{{ route('blog.detail',$bloge->blog_slug) }}">
                           <h3>{{ $bloge->title }}
                           </h3>
                        </a>
                        <div class="blog-label"><span class="time"><i class="fa-regular fa-clock"></i><span>{{ $bloge->created_at->format('d M Y') }}</span></span></div>
                        <p><a href="{{ route('blog.detail',$bloge->blog_slug) }}">{!!  \Illuminate\Support\Str::words($bloge->short_description, 30, '...') !!}</a></p>
                        
                        <a class="blog-button" href="{{ route('blog.detail',$bloge->blog_slug) }}">
                        Read
                        More <i class="fa-solid fa-arrow-up"></i></a>
                     </div>
                  </div>
               </div>
              @endforeach
            </div>
            <!--<div class="pagignation-box mt-5 mb-5">-->
            <!--   <ul class="pagination">-->
            <!--      {{ $blogs->links() }}-->
            <!--   </ul>-->
            <!--</div>-->
         </div>
      </section>

   @endsection