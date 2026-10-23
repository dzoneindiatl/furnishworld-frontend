<div class="Search-suggestions">
                        <div class="Search-suggestions-l">
                            <h4>Search Suggestions</h4>
                            <ul class="search-suggestions-list">
                                @forelse($categorys as $categorydata)
                                <li class="search-category" data-id="{{ $categorydata->id }}"><a href="javascript:void(0);">{{$categorydata->name}}</a></li>
                                @empty
                                <li>No Categoryes</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="Search-suggestions-r">
                            <h3>Search Results</h3>
                            <div class="women-seller women-seller-slider">
                                <div class="row">
                              @forelse($products as $product)
<div class="col-md-6">
    <div class="product-card">
        <div>
            <figure class="item-single">
                <a  
                    href="{{ route('front-product.detail',['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                    <img src="{{ $product->images['first'] }}" alt="{{ $product->name }}" class="default-image">
                    <img src="{{ $product->images['second'] }}" alt="{{ $product->name }} Hover" class="hover-image">
                </a>
                <span class="icon-top addtoWishList" data-product-id="{{ $product->id }}">
                    <i class="fa-regular fa-heart {{ productWishlist($product->id) ? 'wishlist-icon' : '' }}"></i>
                </span>
            </figure>

            @if(count($product->color_options) > 0)
            <div class="color-choose">
                @foreach($product->color_options as $color)
                <div>
                    <input type="radio" id="{{ strtolower($color->name) }}" name="color" checked />
                    <label for="{{ strtolower($color->name) }}"><span></span></label>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="bottom-content">
            <a
                href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                <p>{{ $product->name }}</p>
            </a>
            <div class="price-btn-sec d-flex">
                <div class="product-color">
                    <ul>
                        <li class="price">₹{{ floor($product->selling_price) }}</li>
                        @if ($product->discount_type == 'flat' || $product->discount_type == 'percentage')
                        <li class="full-price">₹{{ floor($product->buying_price) }}</li>
                        @endif
                    </ul>
                    {!! \App\Helpers\Attributes::productDiscountMsg($product) !!}
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
                            </div>
                        </div>
                    </div>
                    <div class="serch-bottom">
                        <a href="{{ route('search.viewall', ['q' => $query]) }}" class="search-view-all">View All <i
                                class="fa-solid fa-arrow-right"></i></a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
