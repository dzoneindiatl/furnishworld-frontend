@extends('front.layouts.app')
@section('content')
   <section class="banner-section">
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
         <input type="hidden" id="ajax_total" value="{{ $totalResults }}">
         <div class="blogData">
            <div class="blog-sec women-seller women-seller-slider" data-total-count="{{ $totalResults }}">
               <div class="container">
                  <div class="row" id="blog_list">
                     @if($results->isNotEmpty())
                        @include('front.modules.blog.load-more-data', ['results' => $results])
                     @else
                        <div class="noresults-row text-center">
                           <h6>No Blogs found.</h6>
                        </div>
                     @endif
                  </div>
               </div>
               <div id="loading" class="text-center my-4" style="display:none;">
                  <img src="https://vasvi.in/assets/front/img/favi_vasvi.png" width="40" alt="Loading...">
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection
@push('scripts')
<script>
function fetchProducts() {
   let url = "{{ route('blog.blog') }}";
   $.ajax({
      url: url,
      type: 'GET',
      data: {
         ajax: 1,
      },
      success: function(res) {
         if (res.html) {
            $('#blog_list').html(res.html);
            totalCount = res.totalResults; // ✅ reset totalCount on filter
            offset = limit; // ✅ reset offset
         }
      },
      error: function(xhr) {
            console.log(xhr.responseText);
      }
   });
}

let offset = {{ $limit }};
let limit = {{ $limit }};
let totalCount = {{ $totalResults }};
let url   = "{{ route('blog.blog') }}";
let loading = false;

function onScrollHandler() {
   if (loading) return;
   if (offset >= totalCount) {
      window.removeEventListener('scroll', onScrollHandler);
      return;
   }
   let threshold = window.innerWidth <= 768 ? 1200 : 800;
   if (window.innerHeight + window.scrollY >= document.body.offsetHeight - threshold) {
      loadMore();
   }
}

window.addEventListener('scroll', onScrollHandler);
fetchProducts();
function loadMore() {
   loading = true;
   document.getElementById('loading').style.display = 'block';

   $.ajax({
      url: url,
      data: '&offset=' + offset + '&limit=' + limit + '&ajax=1',
      success: function (res) {
         if (!res.html || $.trim(res.html) === '') {
            window.removeEventListener('scroll', onScrollHandler);
            document.getElementById('loading').innerHTML = '<p>No more records</p>';
         } else {
            $('#blog_list').append(res.html);
            offset += limit;
            totalCount = res.totalResults; // ✅ update filtered count
            document.getElementById('loading').style.display = 'none';

            if (offset >= totalCount) {
               window.removeEventListener('scroll', onScrollHandler);
               document.getElementById('loading').innerHTML = '<p>No more records</p>';
            }
         }
      },
      error: function () {
         document.getElementById('loading').innerHTML = '<p>Error loading data</p>';
      },
      complete: function () {
         loading = false;
      }
   });
}
</script>
@endpush