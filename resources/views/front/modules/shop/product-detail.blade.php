@extends('front.layouts.app')
@section('content')


<script>
    var getVarient = "{{ route('variant.combination.prices') }}";
    window.csrfToken = "{{ csrf_token() }}";
    const maxSellingUnits = {{ $product?->max_selling_units ?? 10 }};
    const minSellingUnit = {{ $product?->min_selling_units ?? 1 }};
    const minStockLimit = {{ $product?->min_stock_limit ?? 1 }};
    let maxQtyLimit = maxSellingUnits;
</script>

<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner">
            <div class="container">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                            @if (!empty($productcat))
                                <li class="breadcrumb-item"><a href="{{ route('category.show', ['slug' => $productcat->slug]) }}">{{ $productcat->name }}</a></li>
                            @endif
                            @if (!empty($productSubCat))
                                <li class="breadcrumb-item"><a href="{{ route('category.show', ['slug' => $productSubCat->slug]) }}">{{ $productSubCat->name }}</a></li>
                            @endif
                            @if (!empty($productChildCat))
                                <li class="breadcrumb-item"><a href="{{ route('category.show', ['slug' => $productChildCat->slug]) }}">{{ $productChildCat->name }}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="content-area">
            <div id="{{ $product->id }}" class="single-product-details">
                <div class="single-product-imagesummery">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <?php 
                                if($product->product_type==1){
                                    $firstImage = getActiveFrontImg($product->id,$product->id);
                                    $secondImage  = getActiveBackImg($product->id,$product->id);
                                } else {
                                    $activeVarientId = activeVarientByProductId($product->id);
                                    $firstImage = getActiveFrontImg($product->id,$activeVarientId);
                                    $secondImage  = getActiveBackImg($product->id,$activeVarientId);
                                }
                                
                                if($product->product_type==2){
                                    $priceData = getPriceByActiveVarientId($product->id,$activeVarientId);
                                    $buying_price = $priceData['buying_price'];
                                    $selling_price = $priceData['selling_price'];
                                    $discount_product = $buying_price - $selling_price;
                                    $productImages = getActiveVarientImg($product->id, $activeVarientId);
                                } else {
                                    $buying_price = $product->buying_price;
                                    $selling_price = $product->selling_price;
                                    $discount_product = $buying_price - $selling_price;
                                    $productImages = getActiveVarientImg($product->id, $product->id);
                                }
                                 
                                $discountText = "" ;
                               
                                if(!empty($product->discount) && !empty($product->discount_type)){
                                    if($product->discount_type == "percentage"){
                                        $discountText =  $product->discount . "% Off"; 
                                    }
                                    if($product->discount_type == "flat"){
                                        $discountText = '₹'.$product->discount . 'Off'; 
                                    }
                                }
                                
                                ?>
                                <div class="product-gallery">
                                    <div class="product-gallery-area product-gallery-with-images">
                                        <div class="onsale-trading">
                                            <div class="onsale-off">{{ $discountText }}</div>                                                   
                                        </div>
                                        <div class="product-gallery-wrapper product-gallery-slider">
                                            @if($firstImage)
                                                <div class="product-gallery-image">
                                                    <a data-fancybox="gallery" href="javascript:void(0)"><img src="{{ asset('uploads/products/' . $firstImage) }}" alt=""></a>
                                                </div>
                                            @endif
                                            @if(!empty($productImages))
                                                @foreach($productImages as $image)
                                                    <div class="product-gallery-image">
                                                        <a data-fancybox="gallery" href="javascript:void(0)"><img src="{{ asset('uploads/products/' . $image) }}" alt=""></a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <ol class="product-gallery-thumbs">
                                            @if(!empty($productImages))
                                                @foreach($productImages as $image)
                                                    <li><img src="{{ asset('uploads/products/' . $image) }}" alt=""></li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 pl-xl-5">
                                <div class="summary single-product-summary">
                                    <div class="single-product-headwishlist">
                                        <div class="single-product-head">
                                            <h1 class="single-product-title">{{ $product->name ?? '' }}</h1>
                                            <p class="single-product-subtitle">{{ $product->short_description ?? '' }}</p>
                                        </div>
                                        <div class="single-wishlist-btn">
                                            <span class="icon-top addtoWishList" data-product-id="{{ $product->id }}">
                                                @if(isset($isWishlisteddata))
                                                <i class="{{ in_array($product->id, $isWishlisteddata) ? 'fa-solid':'fa-regular' }} fa-heart"></i>
                                                @else
                                                <i class="fa-regular fa-heart"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                   
                                    <div class="single-product-price">
                                    <del id="pdpStrikedMrp">₹ {{ floor($buying_price)  }}</del>
                                    <ins id="productPrice">₹ {{ floor($selling_price) }}</ins>
                                    <span class="single-product-priceoff" id="discountShow">{{ $discountText }}</span>
                                    </div>
                                    
                                    <div class="single-product-summarycart">
                                        <form class="variations-form addcart" action="#" method="post">
                                            <div class="single-product-attribute">
                                                @if($productvariants)
                                                @foreach($productvariants as $variant)
                                                
                                                    @php
                                                        $hasMain = collect($variant['variant_values'])->where('is_main', 1)->isNotEmpty();
                                                        $activeValue = collect($variant['variant_values'])->first(fn($val) => $val['is_main'] == 1) ?? ($variant['variant_values'][0] ?? null);
                                                    @endphp

                                                <div class="attribute-item">
                                                    <div class="attribute-title">
                                                        <p>{{  $variant['variant_name'] }}</p>
                                                    </div>
                                                    <div class="attribute-wrap">
                                                        <ul class="attribute-menu attribute-color">
                                                            @foreach($variant['variant_values'] as $k => $variantValue)
                                                            @php
                                                                $isActive = false;
                                                                $image = $variantValue['image'] ? asset('uploads/products/' . $variantValue['image']): asset('img/no-image.jpg');
                                                                $type = $variant['variant_type'];
                                                                $color = $variantValue['color_code'];
                                                                $name = $variantValue['name'];
                                                                $variantName = $variant['variant_name'];
                                                                $isActive = ($hasMain && $variantValue['is_main'] == 1) || (!$hasMain && $k == 0);
                                                                info("------variantvalue--------",[$variantValue]);
                                                            @endphp
                                                            <li data-productId = "{{  $variant['product_id'] }}"
                                                                    data-id="{{ $variantValue['id'] }}" 
                                                                    data-type="{{ $variant['variant_name'] }}"
                                                                    data-value="{{ $variantValue['name'] }}"
                                                                    data-vid="{{ $variantValue['variant_value_id'] }}"
                                                                    onclick="selectVariant(this); checkVariantStock(this);updateVariantSpecification(this);"
                                                                    class="s-variant activeVarientLi {{ $isActive ? 'active' : '' }}"
                                                                    style="padding:5px; cursor: pointer;">   
                                                                <input class="attribute-input" name="color" id="color_brown{{  $variantValue['id'] }}" value="{{ $variantValue['id'] }}" type="radio">                                         
                                                                <div class="pro_img">
                                                                 <img src="{{ $image }}" alt="{{ $variantValue['name'] }}">
                                                                </div>
                                                                <p style="margin-top:5px;margin-bottom:5px">{{ $variantValue['name'] }}</p>
                                                            </li>
                                                            @endforeach
                                                        </ul> 
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>

                                            <div class="quantity-addcart-button">
                                                <div class="quantity">
                                                    <label for="quantity"><strong>Qty :</strong></label>
                                                    <div class="quantity-group">
                                                        <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                        <input type="text" id="quantity" class="input-text qty" name="quantity" value="1" maxlength="50">
                                                        <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                    </div>
                                                </div>                                                        
                                            </div>
                                            <div class="product-summary-button">  
                                                <span class="varient_less_than_min_qty_notice"></span>   
                                                @if($product->in_stock == '1')
                                                    <button type="button" name="add" class="btn btn-primary detail-cart-btn me-3 addToCartBtn addToCartText"
                                                        data-id="{{ $product->id }}" 
                                                        data-name="{{ $product->name }}"
                                                        data-producttype="{{ $product->product_type }}"
                                                        data-sku="{{ $product->sku }}"
                                                        data-price="{{ $buying_price }}"
                                                        data-salePrice="{{ $selling_price }}"
                                                        data-discountType="Flat"
                                                        data-discount="{{ $discount_product }}"
                                                        data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                                        Add To Cart
                                                    </button>
                                                @endif 
                                                @if($product->in_stock == '1')
                                                    <button type="button" class="buy_now_button btn btn-primary buy-now-btn me-3 checkoutButton btn_place_order" id="buy_now_auto_add_to_cart" data-id="{{ $product->id }}" 
                                                        data-name="{{ $product->name }}"
                                                        data-producttype="{{ $product->product_type }}"
                                                        data-sku="{{ $product->sku }}"
                                                        data-price="{{ $buying_price }}"
                                                        data-salePrice="{{ $selling_price }}"
                                                        data-discountType="Flat"
                                                        data-discount="{{ $discount_product }}"
                                                        data-image = "{{ $product->images['first'] }}"
                                                        data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">Buy Now</button>
                                                @endif                                                
                                            </div>
                                        </form>
                                        <div class="product-benefit-summery">
                                            <ul class="product-benefit-items">
                                                <li>
                                                    <div class="product-benefit-wrap">
                                                        <div class="product-benefit-icon"><img src="{{ asset('assets/front/tejap/images/icon-return.svg') }}" alt="" /></div>
                                                        <p class="product-benefit-title">15 Day Returns</p>
                                                    </div>
                                                </li>
                                                <li><span class="product-benefit-wrap">
                                                        <div class="product-benefit-icon"><img src="{{ asset('assets/front/tejap/images/icon-free-shipping.svg') }}" alt=""></div>
                                                        <p class="product-benefit-title">Free Shipping</p>
                                                    </span></li>
                                                <li>
                                                    <div class="product-benefit-wrap">
                                                        <div class="product-benefit-icon"><img src="{{ asset('assets/front/tejap/images/icon-money-bag.svg') }}" alt=""></div>
                                                        <p class="product-benefit-title">Money Guarantee</p>
                                                    </div>
                                                </li>
                                            </ul>                                              
                                        </div>

                                        <div class="product-share">
                                            <p>Share On : </p>
                                            <div class="product-share-icon">
                                                <a class="facebook" href="{{ $facebook->value }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                <a class="twitter" href="{{ $instagram->value }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                                <a class="whatsapp" href="{{ $pinterst->value }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a class="envelope" href="{{ $youtube->value }}" target="_blank"><i class="far fa-envelope"></i></a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="size-chart">                                                           
                                    <div class="modal fade" id="sizeModal">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <div class="modal-body p-lg-4">
                                                    <div class="tab-style">
                                                        <div class="tab-header">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation">
                                                                <button class="active" data-bs-toggle="tab" data-bs-target="#slim" type="button" role="tab" aria-selected="true">Slim</button>
                                                            </li>
                                                            <li role="presentation">
                                                                <button data-bs-toggle="tab" data-bs-target="#regular" type="button" role="tab" aria-selected="false">Regular</button>
                                                            </li>
                                                            <li role="presentation">
                                                                <button data-bs-toggle="tab" data-bs-target="#measure" type="button" role="tab" aria-selected="false">How to measure</button>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">                                                              
                                                            <div id="slim" class="tab-pane fade show active">
                                                            <p>Our sizes are engineered for Indian men. Every fit has been iterated &amp; perfected over years of testing,
                                                                resulting in two base fits: Slim and Regular.</p>
                                                        
                                                            <ul class="nav nav-tabs border-0 justify-content-end" role="tablist">
                                                                <li role="presentation">
                                                                <button class="active" data-bs-toggle="tab" data-bs-target="#cm" type="button" role="tab" aria-selected="true">cm</button>
                                                                </li>
                                                                <li role="presentation">
                                                                <button data-bs-toggle="tab" data-bs-target="#inches" type="button" role="tab"  aria-selected="false">inches</button>
                                                                </li>
                                                            </ul>
                                                        
                                                            <div class="tab-content">
                                                                <div id="cm" class="tab-pane fade show active">
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>Size</td>
                                                                        <td>S</td>
                                                                        <td>M</td>
                                                                        <td>L</td>
                                                                        <td>XL</td>
                                                                        <td>XXL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Collar</td>
                                                                        <td>39</td>
                                                                        <td>40</td>
                                                                        <td>42</td>
                                                                        <td>44</td>
                                                                        <td>45</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shoulder</td>
                                                                        <td>45</td>
                                                                        <td>46</td>
                                                                        <td>49</td>
                                                                        <td>51</td>
                                                                        <td>53</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Chest</td>
                                                                        <td>95</td>
                                                                        <td>99</td>
                                                                        <td>105</td>
                                                                        <td>111</td>
                                                                        <td>117</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Waist</td>
                                                                        <td>85</td>
                                                                        <td>89</td>
                                                                        <td>95</td>
                                                                        <td>101</td>
                                                                        <td>107</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Front Length</td>
                                                                        <td>74</td>
                                                                        <td>77</td>
                                                                        <td>79</td>
                                                                        <td>81</td>
                                                                        <td>83</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                                <div id="inches" class="tab-pane fade">
                                                                <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Size</td>
                                                        
                                                                    <td>S</td>
                                                        
                                                                    <td>M</td>
                                                        
                                                                    <td>L</td>
                                                        
                                                                    <td>XL</td>
                                                        
                                                                    <td>XXL</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Collar</td>
                                                        
                                                                    <td>15.4</td>
                                                        
                                                                    <td>15.7</td>
                                                        
                                                                    <td>16.5</td>
                                                        
                                                                    <td>17.3</td>
                                                        
                                                                    <td>17.7</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shoulder</td>
                                                        
                                                                    <td>17.7</td>
                                                        
                                                                    <td>18.1</td>
                                                        
                                                                    <td>19.3</td>
                                                        
                                                                    <td>20.1</td>
                                                        
                                                                    <td>20.9</td>
                                                                    </tr>
                                                                <tr>
                                                                    <td>Chest</td>
                                                        
                                                                    <td>37.4</td>
                                                        
                                                                    <td>39</td>
                                                        
                                                                    <td>41.3</td>
                                                        
                                                                    <td>43.7</td>
                                                        
                                                                    <td>46.1</td>
                                                                    </tr>
                                                                <tr>
                                                                    <td>Waist</td>
                                                        
                                                                    <td>33.5</td>
                                                        
                                                                    <td>35</td>
                                                        
                                                                    <td>37.4</td>
                                                        
                                                                        <td>39.8</td>
                                                        
                                                                        <td>42.1</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Front Length</td>
                                                            
                                                                        <td>29.1</td>
                                                            
                                                                        <td>30.3</td>
                                                            
                                                                        <td>31.1</td>
                                                            
                                                                        <td>31.9</td>
                                                        
                                                                        <td>32.7</td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                All measurements are body measurements.<br>
                                                                Incase you run between sizes, size up for a relaxed fit or a size down for a snug fit.
                                                            </p>
                                                        
                                                            </div>
                                                        
                                                            <div id="regular" class="tab-pane fade">
                                                        
                                                            <p>Our sizes are engineered for Indian men. Every fit has been iterated &amp; perfected over years of testing,
                                                                resulting in two base fits: Slim and Regular.</p>
                                                        
                                                            <ul class="nav nav-tabs border-0 justify-content-end" role="tablist">
                                                                <li role="presentation">
                                                                <button class="active" data-bs-toggle="tab" data-bs-target="#cm1" type="button" role="tab" aria-selected="true">cm</button>
                                                                </li>
                                                                <li role="presentation">
                                                                <button data-bs-toggle="tab" data-bs-target="#inches1" type="button" role="tab"  aria-selected="false">inches</button>
                                                                </li>
                                                            </ul>
                                                        
                                                            <div class="tab-content">
                                                                <div id="cm1" class="tab-pane fade show active">
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>Size</td>
                                                                        <td>S</td>
                                                                        <td>M</td>
                                                                        <td>L</td>
                                                                        <td>XL</td>
                                                                        <td>XXL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Collar</td>
                                                                        <td>39</td>
                                                                        <td>40</td>
                                                                        <td>42</td>
                                                                        <td>44</td>
                                                                        <td>45</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shoulder</td>
                                                                        <td>45</td>
                                                                        <td>46</td>
                                                                        <td>49</td>
                                                                        <td>51</td>
                                                                        <td>53</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Chest</td>
                                                                        <td>95</td>
                                                                        <td>99</td>
                                                                        <td>105</td>
                                                                        <td>111</td>
                                                                        <td>117</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Waist</td>
                                                                        <td>85</td>
                                                                        <td>89</td>
                                                                        <td>95</td>
                                                                        <td>101</td>
                                                                        <td>107</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Front Length</td>
                                                                        <td>74</td>
                                                                        <td>77</td>
                                                                        <td>79</td>
                                                                        <td>81</td>
                                                                        <td>83</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                                <div id="inches1" class="tab-pane fade">
                                                                <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                    <td>Size</td>
                                                        
                                                                    <td>S</td>
                                                        
                                                                    <td>M</td>
                                                        
                                                                    <td>L</td>
                                                        
                                                                    <td>XL</td>
                                                        
                                                                    <td>XXL</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Collar</td>
                                                        
                                                                    <td>15.4</td>
                                                        
                                                                    <td>15.7</td>
                                                        
                                                                    <td>16.5</td>
                                                        
                                                                    <td>17.3</td>
                                                        
                                                                    <td>17.7</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Shoulder</td>
                                                        
                                                                    <td>17.7</td>
                                                        
                                                                    <td>18.1</td>
                                                        
                                                                    <td>19.3</td>
                                                        
                                                                    <td>20.1</td>
                                                        
                                                                    <td>20.9</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Chest</td>
                                                        
                                                                    <td>37.4</td>
                                                        
                                                                    <td>39</td>
                                                        
                                                                    <td>41.3</td>
                                                        
                                                                    <td>43.7</td>
                                                        
                                                                    <td>46.1</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Waist</td>
                                                        
                                                                    <td>33.5</td>
                                                        
                                                                    <td>35</td>
                                                        
                                                                    <td>37.4</td>
                                                        
                                                                        <td>39.8</td>
                                                        
                                                                        <td>42.1</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Front Length</td>
                                                        
                                                                    <td>29.1</td>
                                                        
                                                                    <td>30.3</td>
                                                        
                                                                    <td>31.1</td>
                                                        
                                                                    <td>31.9</td>
                                                        
                                                                        <td>32.7</td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                All measurements are body measurements.<br>
                                                                Incase you run between sizes, go a size up for a relaxed fit or a size down for a snug fit. 
                                                            </p>
                                                        
                                                            </div>
                                                        
                                                            <div id="measure" class="tab-pane fade">
                                                            <p>Before you start, you'll need a few essential items:</p>
                                                            <ol>
                                                                <li>A flexible measuring tape</li>
                                                                <li>A mirror and someone to assist you (optional but helpful)</li>
                                                                <li>Comfortable, form-fitting clothing</li>
                                                            </ol>
                                                            <p>(Tap on the indicators below for specific instructions.)</p>
                                                            <img src="{{ asset('assets/front/tejap/images/tops.webp') }}" alt="" width="300" />                                                                  
                                                        
                                                            </div>                                                              
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('front-user.addReview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ asset('uploads/products/' . $firstImage) }}" alt="{{ $product->name ?? '' }}" class="default-image" style="display:none"/>
                </form>

                <div class="product-float-section">
                    <div class="container">
                        <div class="product-float-wrapper">
                            <div class="product-float-image">
                                <img src="{{ asset('uploads/products/' . $firstImage) }}" alt="{{ $product->name ?? '' }}" />
                            </div>
                            <div class="product-float-title">
                                {{ $product->name ?? '' }}
                            </div>
                            <div class="product-float-price">
                                <del>₹ {{ $productVarientCom[0] ? floor($productVarientCom[0]->price) : '' }}</del>
                                <ins>₹ {{ $productVarientCom[0] ? floor($productVarientCom[0]->selling_price) : '' }}</ins>
                                <span class="product-float-priceoff">20% OFF</span>
                            </div>
                            <div class="product-float-attribute">
                                <ul>
                                    <li>Color : <strong class="ms-1">Brown</strong>,</li>
                                    <li>Size : <strong class="ms-1">S</strong></li>
                                </ul>
                            </div>
                            <!-- view cart list -->
                            <div class="product_float_view_list">
                            <a href="javascript:void(0)" class="btn_view_list" id="cartToggle">
                                Shopping Bag (1) <svg width="21" fill="#fff" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" data-iconid="445596" data-svgname="Cart shopping">
                                
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="invisible_box" data-name="invisible box">
                                    <rect width="48" height="48" fill="none"></rect>
                                    </g>
                                    <g id="icons_Q2" data-name="icons Q2">
                                    <path d="M44.3,10A3.3,3.3,0,0,0,42,9H11.5l-.4-3.4A3,3,0,0,0,8.1,3H5A2,2,0,0,0,5,7H7.2l3.2,26.9A5.9,5.9,0,0,0,7.5,39a6,6,0,0,0,6,6,6.2,6.2,0,0,0,5.7-4H29.8a6.2,6.2,0,0,0,5.7,4,6,6,0,0,0,0-12,6.2,6.2,0,0,0-5.7,4H19.2a6,6,0,0,0-4.9-3.9L14.1,31H39.4a3,3,0,0,0,2.9-2.6L45,12.6A3.6,3.6,0,0,0,44.3,10ZM37.5,39a2,2,0,1,1-2-2A2,2,0,0,1,37.5,39Zm-22,0a2,2,0,1,1-2-2A2,2,0,0,1,15.5,39Zm23-12H13.6L12,13H40.8Z"></path>
                                    </g>
                                </g>
                                </svg>
                            </a>

                            <div id="cartPopup" class="cart-overlay">
                                <div class="cart-modal">
                                    <span class="close-cart">&times;</span>
                                    <div class="widget-shopping-cart">   
                                        <p>Shopping bag (<span class="center-main">1</span>)</p>                                             
                                        <ul class="mini-cart productListContainer">
                                            <li class="mini-cart-item" data-index="0">  
                                                <div class="mini-cart-image">
                                                    <a href="javascript:void(0)"><img src="https://furnishworlds.com/uploads/products/APR2026/variant_11_69db6cd95ba75.jpg" alt="outdoor furniture"></a>
                                                </div>    
                                                <div class="mini-cart-summery"> 
                                                    <div class="mini-cart-summerydata">
                                                        <a href="javascript:void(0)" class="mini-cart-title">outdoor furniture</a>
                                                        <p>Quantity : 1</p>
                                                    </div> 
                                                    <div class="mini-cart-summeryprice">
                                                        <span class="mini-cart-price">
                                                            <del>₹ 1499.00</del>
                                                            <ins>₹ 1499</ins>
                                                        </span>
                                                        <a href="javascript:void('0');" data-index="0" class="remove remove_from_cart_button trash-icon close-product">Remove</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mini-cart-total">
                                            <p><strong>Subtotal</strong> <span class="cartTotalPopup">1499</span></p> 
                                        </div>
                                        <div class="mini-cart-buttons">
                                            <a href="https://furnishworlds.com/cart/view" class="btn btn-outline-primary">View cart</a>
                                            <a href="https://furnishworlds.com/checkout" class="btn btn-primary checkout">Checkout</a>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- view cart list -->
                            <div class="product-float-addtocart">
                                <a href="{{ env('WEBSITE_URL').'cart/view' }}" class="btn btn-outline-primary">View cart</a>
                                <a href="{{ env('WEBSITE_URL').'checkout' }}" class="btn btn-primary checkout">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="single-product-information">                           
                    <div class="single-product-description">
                        <div class="container">
                            <div class="row">
                                @php
                                    $k = 1;
                                @endphp
                                @foreach($productDetailManager as $detailManager)
                                    @php
                                        $contentKey = 'content_' . $k;
                                    @endphp
                                    @if($detailManager->section_name == 'Specification')
                                        <div class="col-lg-4 col-md-4 col-12" id="productSpecificationBox"
                                            style="display: none;">
                                            <div class="single-product-content">
                                                <h5>{{ $detailManager->section_name }}</h5>
                                                <div id="productSpecificationContent"></div>
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $sectionContent = $product->$contentKey ?? '';
                                        @endphp

                                        @if(!empty(trim(strip_tags($sectionContent))))
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="single-product-content">
                                                    <h5>{{ $detailManager->section_name }}</h5>
                                                    {!! $sectionContent !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @php
                                        $k++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>    
                    </div>
                    <div class="single-product-review">
                        <div class="container">
                            <h4 class="text-uppercase f-15"><strong>Customer Reviews</strong> </h4>
                            <div class="review-button">
                                <div class="review-star-text">
                                    <div class="review-star mb-1 me-2">
                                        <span class="fa-regular fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                    </div>
                                    <div class="review-text mb-1">
                                        Be the first to write a review
                                    </div>                                           
                                </div>
                                <div class="mb-1">
                                <button class="btn btn-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reviews" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="review-btn-write">Write a review</span>
                                    <span class="review-btn-cancel">Cancel review</span>
                                </button>
                                </div>                                       
                            </div>
                            <div id="reviews" class="review-form-section collapse">                                        
                                <div class="comments">
                                    <p>There are no reviews for this product.</p>
                                </div>
                                <div class="review-form-wrapper">
                                    <h5 class="comment-reply-title">Add a review </h5>
                                    <form action="" method="post" id="commentform"
                                        class="comment-form" novalidate="">
                                        <div class="comment-form-rating">
                                            <h4>Your Rating</h4>
                                            <div class="stars-rating"> <span>Bad</span>
                                                <span class="rating">
                                                    <input type="radio" id="star1"
                                                        name="rating" value="1" />
                                                    <label for="star1"
                                                        title="Sucks big time - 1 star"></label>
                                                    <input type="radio" id="star2"
                                                        name="rating" value="2" />
                                                    <label for="star2"
                                                        title="Kinda bad - 2 stars"></label>
                                                    <input type="radio" id="star3"
                                                        name="rating" value="3" />
                                                    <label for="star3"
                                                        title="Meh - 3 stars"></label>
                                                    <input type="radio" id="star4"
                                                        name="rating" value="4" />
                                                    <label for="star4"
                                                        title="Pretty good - 4 stars"></label>
                                                    <input type="radio" id="star5"
                                                        name="rating" value="5" />
                                                    <label for="star5"
                                                        title="Awesome - 5 stars"></label>
                                                </span> <span>Good</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div
                                                class="comment-form-comment form-group col-12">
                                                <label for="comment">Your Review <span
                                                        class="required">*</span></label>
                                                <textarea class="form-control" id="comment"
                                                    name="comment" cols="45" rows="8"
                                                    aria-required="true"
                                                    required=""></textarea>
                                            </div>
                                            <div
                                                class="comment-form-author form-group col-md-6 col-sm-6 col-12">
                                                <label for="author">Name <span
                                                        class="required">*</span></label>
                                                <input class="form-control" id="author"
                                                    name="author" value="" size="30"
                                                    aria-required="true" required=""
                                                    type="text" placeholder="Name">
                                            </div>
                                            <div
                                                class="comment-form-email form-group col-md-6 col-sm-6 col-12">
                                                <label for="email">Email <span
                                                        class="required">*</span></label>
                                                <input class="form-control" id="email"
                                                    name="email" value="" size="30"
                                                    aria-required="true" required=""
                                                    type="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-submit">
                                            <input name="submit" id="submit"
                                                class="btn btn-primary submit"
                                                value="Submit" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                            
                </div>

            </div>    
            <!--=====================================================
                            single-product-details End
            =========================================================-->
            @if (isset($related_products[0]))
            <div class="product-section section">
                <div class="container">
                    <div class="section-header text-center">
                        <h2 class="section-title">Related Products</h2>                       
                    </div>
                    <div class="products-wrapper">
                        <div class="products-area">
                            <ul class="products product-carousel">
                                @foreach ($related_products as $products)
                                <?php
                                $graphics = $products->product_main_images->where('status', 1);
                                $frontImage = $graphics->firstWhere('is_front', 1);
                                $backImage = $graphics->firstWhere('is_back', 1);
                                $fallbackImages = $graphics->pluck('graphic')->take(2);
                                
                                $firstImage = $frontImage ? $frontImage->graphic : $fallbackImages->get(0) ?? null;
                                $secondImage = $backImage ? $backImage->graphic : $fallbackImages->get(1) ?? $firstImage;
                                ?>
                                <li class="product-item product">
                                    <div class="product-wrap">
                                        <div class="product-image">
                                            <div class="onsale-trading">                                                              
                                                <span class="onsale-off">40% OFF</span>
                                            </div>
                                            <a href="product-detail.html">
                                                <div class="product-main-image">
                                                    <img src="{{ $firstImage ? asset('uploads/products/' . $firstImage) : asset('img/no-image.jpg') }}"
                                                        alt="{{ $products->name }}" class="default-image">
                                                </div>
                                                <div class="product-hover-image">
                                                    <img src="{{ $secondImage ? asset('uploads/products/' . $secondImage) : asset('img/no-image.jpg') }}"alt="{{ $products->name }} Hover" class="hover-image">
                                                </div>    
                                            </a>                                           
                                            <div class="product-wishlist wishlist">
                                                <a href="#" class="add-to-wishlist">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </div>
                                            
                                            <div class="product-options">                                             
                                                <div class="product-option-item">
                                                    <div class="product-option-title">Size</div>
                                                    <div class="product-option-wrap">
                                                    <fieldset class="product-option-list product-option-size">                                                    
                                                        <input id="xs" type="radio" name="Size" value="XS" form="product-form-1" >
                                                        <label for="xs">XS</label>                                                      
                                                        <input id="s" type="radio" name="Size" value="S" form="product-form-1">
                                                        <label for="s">S</label>                                                   
                                                        <input id="m" type="radio" name="Size" value="M/L" form="product-form-1" checked="checked">
                                                        <label for="m">M</label>                                                   
                                                        <input id="l" type="radio" name="Size" value="L" form="product-form-1">
                                                        <label for="l">L</label>                                                     
                                                        <input id="xl" type="radio" name="Size" value="XL" form="product-form-1">
                                                        <label for="xl" class="disabled" >XL</label>  
                                                    </fieldset>
                                                    </div>
                                                </div>                                                
                                                </div>
                                        </div>
                                        <div class="product-content">
                                            <h5 class="product-title">
                                                <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}">Burnished Amber Pullover</a>
                                            </h5>
                                            <div class="product-price">
                                                @if ($products->discount > 0)
                                                <del>₹ {{ floor($products->buying_price) }}</del>
                                                @endif
                                                <ins>₹ {{ floor($products->selling_price) }}</del>
                                                
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--=====================================================
                            Related Products Section End
            =========================================================-->
            
                
            
        </div>
    </div>
    <!--content-wrapper -->           
</section>
@endsection
<!--=====================================================
                Site Section End
=========================================================-->
@push('scripts')

@if($activeVarientId)
<script>
    const productVariantSpecification = @json($productVariantSpecification);
    const productDefaultSpecification = @json($product->content_1 ?? '');

    $(document).ready(function () {

        const activeVariant = document.querySelector(
            '[data-vid="{{ $activeVarientId }}"]'
        );

        if (activeVariant) {
            updateVariantSpecification(activeVariant);
        }
    });

    function updateVariantSpecification(element) {

        const variantValueId = $(element).data('vid');

        // Find selected variant specification
        const specification = productVariantSpecification.find(
            item => String(item.variant_value_id) === String(variantValueId)
        );

        let content = productDefaultSpecification || '';

        if (specification) {

            // Example:
            // variantValueId = 1  => content_1
            // variantValueId = 14 => content_14
            const contentKey = 'content_' + variantValueId;

            const variantContent = specification[contentKey] ?? '';

            // Variant content has priority
            if (
                variantContent &&
                String(variantContent).replace(/<[^>]*>/g, '').trim() !== ''
            ) {
                content = variantContent;
            }
        }

        if (
            content &&
            String(content).replace(/<[^>]*>/g, '').trim() !== ''
        ) {
            $('#productSpecificationContent').html(content);
            $('#productSpecificationBox').show();
        } else {
            $('#productSpecificationContent').html('');
            $('#productSpecificationBox').hide();
        }
    }
</script>
@endif
<script>
     var checkoutUrl = "{{ route('front-product.checkoutBag') }}";
        $(document).ready(function() {
            $("#buy_now_auto_add_to_cart").click(function() {
                localStorage.setItem('oldCartItems', JSON.stringify([]));

                var oldCartItems = localStorage.getItem('cartItems') || '[]';
                console.log("---------my old cart--------",oldCartItems); 
                localStorage.setItem('oldCartItems', oldCartItems);
                localStorage.setItem('isBuyNow', '1');
                localStorage.setItem('cartItems', JSON.stringify([]));
                
                setTimeout(() => {
                    $(".addToCartBtn").trigger("click");
                    window.location.href = checkoutUrl;
                }, 1000);
            });
        });
    </script>
<script>
    $(document).ready(function () { 
        restoreOldCartItems();
    });

        function restoreOldCartItems() {
            const oldCartItems = localStorage.getItem('oldCartItems');
            const isBuyNow = localStorage.getItem('isBuyNow');
            if (isBuyNow === '1' && oldCartItems) {
                let oldItems = JSON.parse(oldCartItems) || [];
                let currentItems = JSON.parse(
                    localStorage.getItem('cartItems') || '[]'
                )
                let mergedItems = [...oldItems, ...currentItems];

                localStorage.setItem(
                    'cartItems',
                    JSON.stringify(mergedItems)
                );
                localStorage.removeItem('oldCartItems');
                localStorage.setItem('isBuyNow', '0');
                console.log('Old Cart:', oldItems);
                console.log('Current Cart:', currentItems);
                console.log('Merged Cart:', mergedItems);
            }
        }
    $(document).on('click', '.search-category', function () {
        selectVariant($(this));
    });
    function checkVariantStock(el) {
        let productId = el.dataset.productid;
        let variantId = el.dataset.id;
        let variantValueId = el.dataset.vid;

        $.ajax({
            url: "{{ route('variant.stock.check') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                variant_id: variantId,
                variant_value_id: variantValueId
            },
            success: function (res) {

                let productOut = $('#variantOutOfStock').data('product-out');

                // If whole product is out, never hide it
                if (productOut == 1) {
                    $('#variantOutOfStock').removeClass('d-none');
                    $('.add-to-cart').addClass('disabled-action');
                    return;
                }

                // Variant-level logic only
                $('.s-variant').removeClass('out-of-stock');

                if (res.out_of_stock) {
                    $(el).addClass('out-of-stock');

                    $('#variantOutOfStock').removeClass('d-none');
                    $('.add-to-cart').addClass('disabled-action');
                } else {
                    $('#variantOutOfStock').addClass('d-none');
                    $('.add-to-cart').removeClass('disabled-action');
                }
            }

        });
    }
</script>
@endpush


