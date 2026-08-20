<div class="row">
    @foreach($wishlistData as $wishlist)
    <?php
            $product = $wishlist->getProduct;
           ?>
     <div class="col-md-4">
         <div class="product-card">
             <div>
                 <figure class="item-single">
                      <a
                        href="{{ route('front-product.detail',['sku' =>$product->sku, 'slug' => productSlug($product->short_description)])}}">
                        <img src="{{ $product->images['first']}}"
                            alt="{{ $product->name }}" class="default-image">
                        <img src="{{ $product->images['second']}}"
                            alt="{{ $product->name }} Hover" class="hover-image">
                        </a>
                    <span class="icon-top" data-product-id="{{ $product->id }}">
                        <i class="fa-solid fa-heart" style="color: red;"></i>   
                    </span>
                      @if(count($product->color_options) > 0)
                        <div class="color-choose">
                            @foreach($product->color_options as $color)
                            <div>
                                <input type="radio" id="{{ strtolower($color->name) }}" name="color"  checked />
                                <label for="{{ strtolower($color->name) }}"><span></span></label>
                            </div>
                            @endforeach
                        </div>
                        @endif
                 </figure>
             </div>
             <div class="bottom-content">
                    <a
                        href="{{ route('front-product.detail',['sku' =>$product->sku, 'slug' => productSlug($product->short_description)])}}">
                        <p>{{ $product->name }}</p>
                    </a>
                    <div class="price-btn-sec d-flex ">
                        <div class="product-color">
                            <ul>
                                <li class="price">{{ floor($product->selling_price)}}</li>
                                @if ($product->discount_type == 'flat' ||
                                $product->discount_type == 'percentage')
                                <li class="full-price">{{ floor($product->buying_price) }}</li>
                                @endif
                            </ul>
                        </div>

                        <div class="add-cart-btn ms-4">
                            <a>
                                <button type="submit" name="add" class="boost-pfs-quickview-cart-btn">Add To Cart</button>
                            </a>
                        </div>
                    </div>
                </div>
         </div>
     </div>
    @endforeach
</div>