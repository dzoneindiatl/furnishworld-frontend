@if(count($new_arrivals_product) > 0)
<div class="owl-carousel owl-theme" id="best-men-seller">
    @foreach($new_arrivals_product as $new_arrivals_products)
        @php
        
      
            $graphics = $new_arrivals_products->product_main_images->where('status', 1);
            $frontImage = $graphics->firstWhere('is_front', 1);
            $backImage = $graphics->firstWhere('is_back', 1);
            $fallbackImages = $graphics->pluck('graphic')->take(2);

            $firstImage = $frontImage ? $frontImage->graphic : ($fallbackImages->get(0) ?? null);
            $secondImage = $backImage ? $backImage->graphic : ($fallbackImages->get(1) ?? $firstImage);
        @endphp
        <div class="item">
            <div class="product-card">
                <figure>
                    <a href="{{ route('front-product.detail',['product' => 'product','title' =>productSlug($new_arrivals_products->name).'.html', 'sku' => productSlug($new_arrivals_products->sku)])}}">
                        <img src="{{ $firstImage ? asset('uploads/products/' . $firstImage) : asset('img/no-image.jpg') }}"
                             alt="{{ $new_arrivals_products->name }}" class="default-image">
                        <img src="{{ $secondImage ? asset('uploads/products/' . $secondImage) : asset('img/no-image.jpg') }}"
                             alt="{{ $new_arrivals_products->name }} Hover" class="hover-image">
                    </a>
                    <span class="icon-top addtoWishList" data-product-id="{{ $new_arrivals_products->id }}">
                                                    @if(isset($isWishlisteddata[0]))
                                                    <i class="{{ in_array($new_arrivals_products->id, $isWishlisteddata) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                                    @else
                                                    <i class="fa-regular fa-heart"></i>
                                                    @endif
                                                </span>
                </figure>

                {{-- Colors --}}
                @if(isset($new_arrivals_products->productVariants))
                    <div class="color-choose">
                        @foreach($new_arrivals_products->productVariants as $productVariantsValue)
                            @foreach($productVariantsValue->variantValues as $variantValue)
                                @if($variantValue->variant_value->variant_id == 1)
                                    <div>
                                        <input data-image="{{ strtolower($variantValue->variant_value->name) }}"
                                               type="radio"
                                               id="{{ strtolower($variantValue->variant_value->name) }}"
                                               name="color"
                                               value="{{ strtolower($variantValue->variant_value->name) }}" checked />
                                        <label for="{{ strtolower($variantValue->variant_value->name) }}"><span></span></label>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Bottom content --}}
            <div class="bottom-content">  
                <a href="{{ route('front-product.detail',['product' => 'product','title' =>productSlug($new_arrivals_products->name).'.html', 'sku' => productSlug($new_arrivals_products->sku)])}}">
                    <p>{{$new_arrivals_products->name}}</p>
                </a>
                <div class="price-btn-sec d-flex ">
                    <div class="product-color">
                        <ul>
                            <li class="price">₹{{ floor($new_arrivals_products->selling_price) }}</li>
                            @if($new_arrivals_products->discount>0)
                                <li class="full-price">₹{{ floor($new_arrivals_products->buying_price) }}</li>
                            @endif
                        </ul>
                        {!! \App\Helpers\Attributes::productDiscountMsg($new_arrivals_products) !!}
                    </div>
                    <div class="add-cart-btn ms-4">
                        <a href="{{ route('front-product.detail',['product' => 'product','title' =>productSlug($new_arrivals_products->name).'.html', 'sku' => productSlug($new_arrivals_products->sku)])}}">
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
