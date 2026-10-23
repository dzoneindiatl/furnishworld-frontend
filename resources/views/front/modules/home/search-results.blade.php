@extends('front.layouts.app')
@section('content')

<section class="banner-section">

    <div class="banner-inner">
        <div class="shape1"><img src="{{ Url('/assets/front/img/breadcumb-shape1_1.png') }}" alt="shape" /></div>
        <div class="shape2"><img src="{{ Url('assets/front/img/breadcumb-shape1_2.png') }}" alt="shape" /></div>
        <div class="shape3"><img src="{{ Url('assets/front/img/breadcumb-shape1_3.png') }}" alt="shape" /></div>
        <div class="shape4"><img src="{{ Url('assets/front/img/breadcumb-shape1_4.png') }}" alt="shape" /></div>
        <div class="container">
            <div class="banner-text">
                <h2>Search Results for "{{ $query }}  " {{ $categoryName }} </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

</section>
        <div class="productData">
            @if($products->count())
          <div class="product-sec women-seller women-seller-slider">
    <div class="container">
        <div class="row">
            @forelse($products  as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <figure class="item-single">
                            <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                                <img src="{{ $product->images['first'] }}" alt="{{ $product->name }}" class="default-image">
                                <img src="{{ $product->images['second'] }}" alt="{{ $product->name }} Hover" class="hover-image">
                            </a>
                            
                             <span class="icon-top addtoWishList" data-product-id="{{ $product->id }}">
                                                    @if(isset($isWishlisteddata[0]))
                                                    <i class="{{ in_array($product->id, $isWishlisteddata) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                                    @else
                                                    <i class="fa-regular fa-heart"></i>
                                                    @endif
                                                </span>
                                                 @if(count($product->color_options) > 0)
                                <div class="color-choose">
                                    @foreach($product->color_options as $color)
                                        <div>
                                            <input type="radio" id="{{ strtolower($color->name) }}" name="color_{{ $product->id }}" checked>
                                            <label for="color_{{ strtolower($color->name) }}_{{ $loop->index }}"><span></span></label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </figure>

                        <div class="bottom-content">
                            <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                                <p>{{$product->name }}</p>
                            </a>

                            <div class="price-btn-sec d-flex">
                                <div class="product-color">
                                    <ul>
                                        <li class="price">₹{{ floor($product->selling_price) }}</li>
                                        @if($product->discount>0)
                                            <li class="full-price">₹{{ floor($product->buying_price) }}</li>
                                        @endif
                                    </ul>
                                     {!! \App\Helpers\Attributes::productDiscountMsg($product) !!}
                                </div>

                                <div class="add-cart-btn ms-4">
                                    <button type="button" 
                                        class="boost-pfs-quickview-cart-btn"
                                        onclick="window.location.href='{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}'">
                                        Add To Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
    <i class="fa-solid fa-box-open" style="font-size: 48px; color: #ccc;"></i>
    <p class="mt-3 fs-5">No products found</p>
</div>
            @endforelse
        </div>
         <div id="loading" class="text-center my-4" style="display:none;">
                <img src="https://vasvi.in/assets/front/img/favi_vasvi.png" width="40" alt="Loading...">
            </div>
    </div>
</div>
           @else
            <div class="noresults-row text-center">
                <h6>No Products found.</h6>
            </div>
            @endif
          </div>

@endsection


