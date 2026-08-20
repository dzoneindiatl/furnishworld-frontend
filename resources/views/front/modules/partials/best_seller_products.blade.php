@if(count($products) > 0)
    <div class="owl-carousel owl-theme" id="women-seller-slider">
        @foreach($products as $product)
        <div class="item">
            <div class="product-card">
                <figure>
                    <a href="{{ route('front-product.detail',['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)])}}">
                        <img src="{{ $product->images['first']}}" alt="{{ $product->name }}" class="default-image">
                        <img src="{{ $product->images['second']}}" alt="{{ $product->name }} Hover" class="hover-image">
                    </a>
                    <span class="icon-top addtoWishList" data-product-id="{{ $product->id }}">
                                                    @if(isset($isWishlisteddata[0]))
                                                    <i class="{{ in_array($product->id, $isWishlisteddata) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                                    @else
                                                    <i class="fa-regular fa-heart"></i>
                                                    @endif
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
                <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                    <p>{{ $product->name }}</p>
                </a>
                <div class="price-btn-sec d-flex ">
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
                        <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">
                            <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <p class="text-center mt-4">No product found</p>
@endif
