                             @php
                                $filteredColors = [];
                                $i= 0;
                            @endphp
                            @if($results->isNotEmpty())
                                @foreach($results as $product)
                                    <?php
                                    $activeVarientID = 0;
                                    $firstImage ='';
                                    $secondImage = '';
                                    if($product->product_type==1){
                                        $activeVarientId = $product->id;
                                        $buying_price = $product->buying_price;
                                        $selling_price = $product->selling_price;
                                        $discount_product = $buying_price - $selling_price;
                                    } else {
                                        $activeVarientId = activeVarientByProductId($product->id);
                                        $priceData = getPriceByActiveVarientId($product->id,$activeVarientId);
                                        $buying_price = $priceData['buying_price'] ?? 0;
                                        $selling_price = $priceData['selling_price'] ?? 0;
                                        $discount_product = $buying_price - $selling_price;
                                    }
                                    if(!empty($activeVarientId)){
                                        $firstImage = getActiveFrontImg($product->id,$activeVarientId);
                                        $secondImage  = getActiveBackImg($product->id,$activeVarientId);
                                    }
                                    ?>
                                    <li class="product-item product">
                                        <div class="product-wrap">
                                            <div class="product-image">
                                                <div class="onsale-trading">
                                                    @if($discount_product > 0)
                                                    <span class="onsale-off">{{ $discount_product }} Rs OFF</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => $product->sku]) }}">
                                                    <div class="product-main-image">
                                                        <img src="{{ asset('uploads/products/' . $firstImage) }}" alt="" class="main-image" >
                                                    </div>
                                                    <div class="product-hover-image">
                                                        <img src="{{ asset('uploads/products/' . $secondImage) }}" alt="" class="hover-image" >
                                                    </div>    
                                                </a>                                           
                                                <div class="product-wishlist wishlist">
                                                    <span class="icon-top addtoWishList" data-product-id="{{ $product->id }}">
                                                        @if(isset($isWishlisteddata))
                                                        <i class="{{ in_array($product->id, $isWishlisteddata) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                                        @else
                                                        <i class="fa-regular fa-heart"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                            
                                                <div class="product-options">                                             
                                                    <div class="product-option-item">
                                                    <div class="product-option-title">Size</div>
                                                    <div class="product-option-wrap">
                                                        <fieldset class="product-option-list product-option-size"> 
                                                            @foreach($filteredColors as $colorsingle)
                                                                <input id="{{ strtolower($colorsingle->id) }}" type="radio" name="Size" value="{{ strtolower($colorsingle->name) }}" form="product-form-1" >
                                                                <label for="{{ strtolower($colorsingle->id) }}">{{ strtolower($colorsingle->name) }}</label> 
                                                            @endforeach                                                     
                                                        </fieldset>
                                                    </div>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h5 class="product-title">
                                                    <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => $product->sku]) }}">{{$product->name }}</a>
                                                </h5>
                                                <div class="product-price">
                                                    @if($discount_product > 0)
                                                    <del>₹ {{ floor($buying_price) }}</del>
                                                    @endif
                                                    <ins>₹ {{ floor($selling_price) }}</ins>
                                                </div>   
                                                <div class="product-addtocart-button">
                                                    <a href="#" class="product-addtocart"> <svg fill="#010101" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 483.1 483.1" xml:space="preserve">                                          
                                                        <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6
                                                            c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3
                                                            C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z
                                                            M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1
                                                            c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/>
                                                
                                                    </svg></a>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        
