@dd("t2");
@extends('front.layouts.app')
<link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
@section('content')
<style>
   .accordion-body::-webkit-scrollbar {
      width: 5px;
   }
   .accordion-body::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 5px;
   }
</style>
<section class="inner-banner ">
         <figure><img src="{{ asset('assets/front/img/shop-banner.jpg') }}"></figure>
         <div class="inner-banner-content text-center">
            <h1>Shop Filters Top</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-row">
               <ul class="breadcrumb d-flex justify-content-center">
                  <li class="breadcrumb-item"><a href="index.html"> Home</a></li>
                  <li class="breadcrumb-item">Shop Filters Top</li>
               </ul>
            </nav>
         </div>
      </section>
      <section class="shop-page  inner-section-space pb-0">
         <div class="container">
            <div class="row shop-page-row">
               <div class="col-md-3 shop-page-l">
                  <div class="shop-side-bar">
                     <div class="Filters-head">
                        <h3>Filters</h3>
                     </div>
                     <div class="filters-body">
                        <div class="accordion coustom-accordian" id="accordionExample">
                           <div class="accordion-item">
                              <h2 class="accordion-header">
                                 <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 Size
                                 </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                 <div class="accordion-body" style="max-height: 200px; overflow-y: auto;">
                                    <ul class="check-list">
                                       @foreach($size as $s)
                                          <li>
                                             <div class="form-check coustom-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $s->id }}" id="size-{{ $loop->index }}" name="size[]">
                                                <label class="form-check-label" for="size-{{ $loop->index }}">{{ $s->name }}</label>
                                             </div>
                                          </li>
                                       @endforeach
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- Add Code By Mohit -->
                           <div class="accordion-item">
                              <h2 class="accordion-header">
                                 <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="true" aria-controls="collapsePrice">
                                    Price Range
                                 </button>
                              </h2>
                              <div id="collapsePrice" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                 <div class="accordion-body mt-2">
                                    <div id="price-slider"></div>
                                    <div class="d-flex justify-content-between mt-2">
                                       <span>₹<span id="min-price">0</span></span>
                                       <span>₹<span id="max-price">10000</span></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- End Code by Mohit -->
                           <div class="accordion-body" style="max-height: 200px; overflow-y: auto;">
                              <ul class="check-list">
                                 @foreach($color as $c)
                                    <li>
                                       <div class="form-check coustom-check">
                                          <input class="form-check-input" name="color[]" type="checkbox" value="{{ $c->id }}" id="color-{{ $loop->index }}">
                                          <label class="form-check-label" for="color-{{ $loop->index }}">{{ $c->name }}</label>
                                       </div>
                                    </li>
                                 @endforeach
                              </ul>
                           </div>
                           <div class="accordion-item">
                              <h2 class="accordion-header">
                                 <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePattern" aria-expanded="true" aria-controls="collapsePattern">
                                    Pattern
                                 </button>
                              </h2>
                              <div id="collapsePattern" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                 <div class="accordion-body" style="max-height: 200px; overflow-y: auto;">
                                    <ul class="check-list">
                                       @foreach($pattern as $p)
                                          <li>
                                             <div class="form-check coustom-check">
                                                <input class="form-check-input" name="pattern[]" type="checkbox" value="{{ $p->id }}" id="pattern-{{ $loop->index }}">
                                                <label class="form-check-label" for="pattern-{{ $loop->index }}">{{ $p->name }}</label>
                                             </div>
                                          </li>
                                       @endforeach
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="accordion-item">
                              <h2 class="accordion-header">
                                 <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                 Availability
                                 </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                 <div class="accordion-body">
                                    <ul class="check-list">
                                       <li>
                                          <div class="form-check coustom-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                             <label class="form-check-label" for="flexCheckChecked">
                                             In stock (18)
                                             </label>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="form-check coustom-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                             <label class="form-check-label" for="flexCheckChecked">
                                             Out of stock (7)
                                             </label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div> -->
                           <!-- <div class="accordion-item">
                              <h2 class="accordion-header">
                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                 Brand
                                 </button>
                              </h2>
                              <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                 <div class="accordion-body">
                                    <ul class="check-list">
                                       <li>
                                          <div class="form-check coustom-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                             <label class="form-check-label" for="flexCheckChecked">
                                             Fashion Store Clean 9 (13)
                                             </label>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="form-check coustom-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                             <label class="form-check-label" for="flexCheckChecked">
                                             zenon3 (6)
                                             </label>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div> -->
                        </div>
                        <!-- <div class="filter-box">
                           <h4>Sort order</h4>
                           <ul class="check-list">
                              <li>
                                 <div class="form-check coustom-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Most Poular
                                    </label>
                                 </div>
                              </li>
                              <li>
                                 <div class="form-check coustom-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Best Rating
                                    </label>
                                 </div>
                              </li>
                              <li>
                                 <div class="form-check coustom-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Newest
                                    </label>
                                 </div>
                              </li>
                              <li>
                                 <div class="form-check coustom-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Price Low - hight
                                    </label>
                                 </div>
                              </li>
                              <li>
                                 <div class="form-check coustom-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Price hight - Low
                                    </label>
                                 </div>
                              </li>
                           </ul>
                        </div> -->
                     </div>
                  </div>
               </div>
               <div class="col-md-9 shop-page-r">
                  <div class="filters-box-top d-flex justify-content-between mb-4">
                     <div class="filters-select">
                        <div class="button-filter ms-2">
                           <select class="form-select short-by" aria-label="Default select example">
                              <option selected=""> Sort By </option>
                              <option value="1"> Featured</option>
                           </select>
                        </div>
                     </div>
                     <div class="list-view-filter ms-2">
                        <a class="four-grid">
                           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0" viewBox="0 0 512 512" style="enable-background: new 0 0 512 512;" xml:space="preserve" class="">
                              <g>
                                 <path d="M187.628 0H43.707C19.607 0 0 19.607 0 43.707v143.921c0 24.1 19.607 43.707 43.707 43.707h143.921c24.1 0 43.707-19.607 43.707-43.707V43.707c0-24.1-19.607-43.707-43.707-43.707zM468.293 0H324.372c-24.1 0-43.707 19.607-43.707 43.707v143.921c0 24.1 19.607 43.707 43.707 43.707h143.921c24.1 0 43.707-19.607 43.707-43.707V43.707C512 19.607 492.393 0 468.293 0zM187.628 280.665H43.707C19.607 280.665 0 300.272 0 324.372v143.921C0 492.393 19.607 512 43.707 512h143.921c24.1 0 43.707-19.607 43.707-43.707V324.372c0-24.1-19.607-43.707-43.707-43.707zM468.293 280.665H324.372c-24.1 0-43.707 19.607-43.707 43.707v143.921c0 24.1 19.607 43.707 43.707 43.707h143.921c24.1 0 43.707-19.607 43.707-43.707V324.372c0-24.1-19.607-43.707-43.707-43.707z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                              </g>
                           </svg>
                        </a>
                        <a class="ms-2 six-grid">
                           <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="22" x="0" y="0" viewBox="0 0 24 24" style="enable-background: new 0 0 512 512;" xml:space="preserve" class="">
                              <g>
                                 <path d="M7 2H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM14 2h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM21 2h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM7 16H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zM14 16h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zM21 16h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zM7 9H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zM14 9h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zM21 9h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path>
                              </g>
                           </svg>
                        </a>
                     </div>
                  </div>

                  <div id="product-list">
                     @include('front.modules.products._list')
                  <!-- </div>  This div move to end of pagination section-->

                     {{-- Pagination --}}
                     <!-- @if($products->hasPages())
                        <div class="pagignation-box mt-5 mb-5">
                           <ul class="pagination">
                              {{-- Previous Page Link --}}
                              @if ($products->onFirstPage())
                                 <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-left"></i></span></li>
                              @else
                                 <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                              @endif

                              {{-- Pagination Elements --}}
                              @foreach ($products->links()->elements[0] as $page => $url)
                                 <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                                       <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                 </li>
                              @endforeach

                              {{-- Next Page Link --}}
                              @if ($products->hasMorePages())
                                 <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                              @else
                                 <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-right"></i></span></li>
                              @endif
                           </ul>
                        </div>
                     @endif -->
                  </div>

               </div>
            </div>
         </div>
      </section>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
         $(document).ready(function () {
            function fetchFilteredProducts() {
               let selectedSizes = [];
               let selectedColors = [];
               let selectedPatterns = [];
               
               $('input[id^="size-"]:checked').each(function () {
                  selectedSizes.push($(this).val());
               });

               $('input[id^="color-"]:checked').each(function () {
                  selectedColors.push($(this).val());
               });

               $('input[id^="pattern-"]:checked').each(function () {
                  selectedPatterns.push($(this).val());
               });

               // Get min and max price
               let minPrice = $('#min-price').text();
               let maxPrice = $('#max-price').text();

               $.ajax({
                  url: window.location.href,
                  type: 'GET',
                  data: {
                        size: selectedSizes,
                        color: selectedColors,
                        pattern: selectedPatterns,
                        min_price: minPrice,
                        max_price: maxPrice
                  },
                  beforeSend: function () {
                        // Optional: Add loader or overlay here
                  },
                  success: function (response) {
                        $('#product-list').html(response.products);
                        $('html, body').animate({
                           scrollTop: $("#product-list").offset().top
                        }, 500);
                  },
                  error: function () {
                        alert('Something went wrong while fetching products.');
                  }
               });
            }

            $('input[type="checkbox"]').on('change', fetchFilteredProducts);
            var priceSlider = document.getElementById('price-slider');
            priceSlider.noUiSlider.on('change', fetchFilteredProducts);
         });

         document.addEventListener("DOMContentLoaded", function () {
            var priceSlider = document.getElementById('price-slider');

            noUiSlider.create(priceSlider, {
               start: [0, 10000],
               connect: true,
               range: {
                  'min': 0,
                  'max': 10000
               },
               // tooltips: [true, true],
               tooltips: false,
               format: {
                  to: function (value) {
                     return Math.round(value);
                  },
                  from: function (value) {
                     return Number(value);
                  }
               }
            });

            const minPrice = document.getElementById('min-price');
            const maxPrice = document.getElementById('max-price');

            priceSlider.noUiSlider.on('update', function (values, handle) {
               minPrice.textContent = values[0];
               maxPrice.textContent = values[1];
            });
         });
      </script>

@endsection