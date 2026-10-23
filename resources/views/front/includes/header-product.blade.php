@foreach($products->take(12) as $product)
                        <div class="product-card">
                            <div class="product-image" data-product-id="{{ $product->id }}">
                                <div class="product-main-image">
                                    <img src="{{$product->images['first']}}" class="main-image" alt="">
                                </div>
                                <div class="product-hover-image">
                                    <img src="{{ $product->images['second'] }}" class="hover-image" alt="">
                                </div>
                            </div>
                            <div class="hover-panel">
                                <div class="hover-content">
                                    <div class="product-options">
                                        <div class="product-option-item">
                                             
                                            <div class="product-addtocart-button">
                                                <a href="@if(!empty($product->sku)){{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => $product->sku]) }}@endif" class="product-addtocart">
                                                     <div class="icon-cart-pro">
                                                        <svg fill="#fff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">
                                                             <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"></path>
                                                         </svg>
                                                    </div>
                                                 </a>
                                            </div>
                                        
                                            <div class="product-option-colors">
                                               @foreach($product->productVariants as $productVariant)
                                                    @if($productVariant->variant_id == 1)
                                                        @foreach($productVariant->variantValues as $variantValue)
                                                            @if($variantValue->variant_image)
                                                                <span
                                                                    class="product-color-option {{ $variantValue->is_main == 1 ? 'active' : '' }}"
                                                                    data-variant-value-id="{{ $variantValue->variant_value_id }}"
                                                                    style="
                                                                    background-image: url('{{ asset('uploads/products/' . $variantValue->variant_image) }}');
                                                                    background-size: cover;
                                                                    background-position: center;
                                                                    background-repeat: no-repeat;
                                                                "
                                                                ></span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hover-content-inner">
                                        <h3>
                                            {{ $product->name }}
                                        </h3>
                                        <button class="wishlist-btn">
                                            <span class="material-symbols-outlined">favorite</span>
                                        </button>
                                    </div>
                                    @php 
                                    if(isset($priceDrop) && !empty($priceDrop)){
                                        $productId = $priceDrop->product_id;
                                        $discountAmount = $priceDrop->amount;
                                        if($priceDrop->gain_type == "drop"){
                                            if($productId == "all"){
                                                if($priceDrop->drop_type == "percentage"){
                                                    $mainPrice =$product->selling_price - (($discountAmount/100) * $product->selling_price) ; 
                                                }
                                                if($priceDrop->drop_type == "flat"){
                                                    $mainPrice = $product->selling_price - $discountAmount ; 
                                                }
                                            }
                                            else{
                                                $productIdArray = explode(",",$productId); 
                                                if(in_array($product->id,$productIdArray)){
                                                    if ($priceDrop->drop_type == "percentage") {
                                                        $mainPrice = $product->selling_price - (($priceDrop->amount / 100) * $product->selling_price);
                                                    } elseif ($priceDrop->drop_type == "flat") {
                                                        $mainPrice = $product->selling_price - $priceDrop->amount;
                                                    }
                                                }
                                            }
                                        }
                                        if($priceDrop->gain_type == "gain"){
                                            if($productId == "all"){
                                                if($priceDrop->drop_type == "percentage"){
                                                    $mainPrice =$product->selling_price + (($discountAmount/100) * $product->selling_price) ; 
                                                }
                                                if($priceDrop->drop_type == "flat"){
                                                    $mainPrice = $product->selling_price + $discountAmount ; 
                                                }
                                            }
                                            else{
                                                $productIdArray = explode(",",$productId); 
                                                if(in_array($product->id,$productIdArray)){
                                                    if ($priceDrop->drop_type == "percentage") {
                                                        $mainPrice = $product->selling_price + (($priceDrop->amount / 100) * $product->selling_price);
                                                    } elseif ($priceDrop->drop_type == "flat") {
                                                        $mainPrice = $product->selling_price + $priceDrop->amount;
                                                    }
                                                }
                                            }
                                        }    
                                    }
                                @endphp 
                                    <div class="price-wrap">
                                        <span class="price">₹ @if(isset($priceDrop) && !empty($priceDrop) && $mainPrice > 0) {{ $mainPrice }} @else {{ $product->selling_price }} @endif</span>
                                        <span class="old-price">₹{{ $product->buying_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach