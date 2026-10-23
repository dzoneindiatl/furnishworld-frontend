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
<script src="{{ asset('assets/front/js/product-details.js') }}"></script>


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
            <div id="product-[]" class="single-product-details">
                <div class="single-product-imagesummery">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="product-gallery">
                                    <div class="product-gallery-area product-gallery-with-images">
                                        <div class="onsale-trading">
                                            <!-- <div class="onsale-off">20% OFF</div> -->
                                        </div>
                                        <div class="product-gallery-wrapper product-gallery-slider">
                                            @php
                                            $colorArr = json_decode(request()->query('colorArr'));
                                            $sizeArr = json_decode(request()->query('sizeArr'));
                                            
                                            $frontImages = $product->product_main_images->where('is_front', 1)->sortBy('updated_at');
                                            $backImages = $product->product_main_images->where('is_back', 1);
                                            $otherImages = $product->product_main_images
                                                ->where('is_front', '!=', 1)
                                                ->where('is_back', '!=', 1);

                                            $orderedImages = $frontImages->merge($backImages)->merge($otherImages);
                                            $prod = $product->toArray();
                                            $availableVariants = $prod['product_variants'] ?? [];
                                            if(!empty($availableVariants)){
                                                $updateVariantImages = [];
                                                foreach($availableVariants as $vkey => $variant){
                                                    $variantValues = !empty($variant['variant_values']) ? $variant['variant_values'] : [];                                        
                                                    foreach($variantValues as $vvkey => $variantValue){
                                                        if(!empty($variantValue['variant_value_id'])){
                                                            $updateVariantImages[] = $variantValue['variant_value_id'];
                                                        }
                                                    }
                                                }
                                                if(!empty($updateVariantImages)){
                                                    $updateVariantImages = updateDeletedVariantImages($prod['id'], $updateVariantImages);
                                                }
                                            }
                                        @endphp

                                        @php $i = 0; @endphp
                                        @foreach ($orderedImages as $image)
                                            @if (!$colorArr || $image['variant_id'] == @$colorArr[0])
                                                    @if ($image['graphic_type'] == 'image')
                                                        <div class="product-gallery-image">
                                                            <a data-fancybox="gallery" href="#">
                                                                <img src="{{ asset('uploads/products/' . $image['graphic']) }}" alt="{{ $product->name }}">
                                                            </a>
                                                        </div>
                                                    @endif
                                                @php $i++; @endphp
                                            @endif
                                        @endforeach
                                            
                                        </div>
                                        <ol class="product-gallery-thumbs">
                                            @php $i = 0; @endphp
                                            @foreach ($orderedImages as $image)
                                                @if (!$colorArr || $image['variant_id'] == @$colorArr[0])
                                                    @if ($image['graphic_type'] == 'image')
                                                        <li><img src="{{ asset('uploads/products/' . $image['graphic']) }}" alt="{{ $product->name }}"></li>
                                                    @endif
                                                    @php $i++;  $default_img = asset('uploads/products/' . $image['graphic']); @endphp
                                                @endif
                                            @endforeach
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

                                    @if($product->product_type==1)
                                        <div class="single-product-price">
                                        <del>₹ {{ $product ? floor($product->buying_price) : '' }}</del>
                                        <ins>₹ {{ $product ? floor($product->selling_price) : '' }}</ins>
                                        <span class="single-product-priceoff">{{ $product ? $product->discount : '' }} <?php if(@$product->discount_type=='flat'){ echo "₹"; } else { echo "%"; } ?></span>
                                        </div>
                                    @else 
                                    <div class="single-product-price">
                                        <del>₹ {{ $productVarientCom[0] ? floor($productVarientCom[0]->price) : '' }}</del>
                                        <ins>₹ {{ $productVarientCom[0] ? floor($productVarientCom[0]->selling_price) : '' }}</ins>
                                        <span class="single-product-priceoff">{{ $productVarientCom[0] ? $productVarientCom[0]->discount : '' }} <?php if(@$productVarientCom[0]->discount_type=='flat'){ echo "₹"; } else { echo "%"; } ?></span>
                                    </div>
                                    @endif

                                    <div class="single-product-summarycart">
                                        <form class="variations-form addcart" action="#" method="post">
                                            <div class="single-product-attribute">
                                                @if($productvariants)
                                                @foreach($productvariants as $variant)
                                                <div class="attribute-item">
                                                    <div class="attribute-title">
                                                        <p>{{  $variant['variant_name'] }}</p>
                                                    </div>
                                                    <div class="attribute-wrap">
                                                        <ul class="attribute-menu attribute-color">
                                                            @foreach($variant['variant_values'] as $variantValue)
                                                            @php
                                                                $isActive = false;
                                                                $image = '';
                                                                if($colorArr && in_array($variantValue['id'], $colorArr)){
                                                                    $isActive = true;
                                                                    $variantImage = $product->product_main_images->where('variant_id', $variantValue['id'])->first();
                                                                    if($variantImage){
                                                                        $image = asset('uploads/products/' . $variantImage->graphic);
                                                                    }
                                                                }
                                                                $type = $variant['variant_type'];
                                                            @endphp
                                                            <li data-productId = "{{  $variant['product_id'] }}"
                                                                    data-id="{{ $variantValue['id'] }}" data-type="{{ $variantValue['name'] }}"
                                                                    data-value="{{ $variantValue['name'] }}"
                                                                    data-vid="{{ $variantValue['variant_value_id'] }}"
                                                                    onclick="selectVariant(this); checkVariantStock(this);"
                                                                    class="s-variant 
                                                                {{ in_array($type, [3]) ? 's-variant-round' : '' }} 
                                                                {{ $isActive ? 'active' : '' }} mx-1"
                                                                    style="
                                                                    {{ in_array($type, [3, 6]) ? 'background-image:url(' . $image . '); background-size:cover;' : '' }}
                                                                    padding:3px; cursor: pointer; border: 2px solid #ccc;
                                                                ">   
                                                                <input class="attribute-input" name="color" id="color_brown1" value="{{ $variantValue['id'] }}" type="radio">                                         
                                                                <label class="attribute-label" for="color_brown1" title="{{ $variantValue['name'] }}" style="background: #964b00;">
                                                                </label>
                                                                <p style="margin-top:10px">{{ $variantValue['name'] }}</p>
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
                                                @if($product->in_stock == '1')
                                                    <button type="button" name="add" class="btn btn-primary detail-cart-btn me-3 addToCartBtn addToCartText"
                                                        data-id="{{ $product->id }}" 
                                                        data-name="{{ $product->name }}"
                                                        data-producttype="{{ $product->product_type }}"
                                                        data-sku="{{ $product->sku }}"
                                                        data-price="{{ $productVarientCom[0]->price }}"
                                                        data-salePrice="{{ $productVarientCom[0]->selling_price }}"
                                                        data-discountType="{{ $productVarientCom[0]->discount_type }}"
                                                        data-discount="{{ $productVarientCom[0]->discount }}"
                                                        data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                                        Add To Bag
                                                    </button>
                                                @endif 
                                                @if($product->in_stock == '1')
                                                    <button type="button" class="buy_now_button btn btn-primary buy-now-btn me-3" id="buy_now_auto_add_to_cart">Buy Now</button>
                                                </a>
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
                                                <a class="facebook" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                                <a class="twitter" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                                <a class="whatsapp" href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a class="envelope" href="#" target="_blank"><i class="far fa-envelope"></i></a>
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
                    <img src="{{ $default_img }}" alt="Product 1" class="default-image" style="display:none"/>
                </form>

                <div class="product-float-section">
                    <div class="container">
                        <div class="product-float-wrapper">
                            <div class="product-float-image">
                                <img src="{{ asset('assets/front/tejap/images/product-1.jpg') }}" alt="" />
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
                            <div class="product-float-addtocart">
                                <button class="btn btn-primary px-md-5">Add to bag</button>
                                <button type="button" name="add" class="btn btn-primary px-md-5"
                                data-id="{{ $product->id }}" 
                                data-name="{{ $product->name }}"
                                data-sku="{{ $product->sku }}"
                                data-price="{{ $productVarientCom[0]->price }}"
                                data-salePrice="{{ $productVarientCom[0]->selling_price }}"
                                data-discountType="{{ $productVarientCom[0]->discount_type }}"
                                data-discount="{{ $productVarientCom[0]->discount }}"
                                data-tax-arr="{{ e(json_encode($categoryTaxes)) }}">
                                Add To Bag
                            </button>
                            <a href="#" class="product-float-wishlist btn btn-primary"><i class="fa-regular fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="single-product-information">                           
                    <div class="single-product-description">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="single-product-content">
                                        <h5>Description</h5>
                                        <p>{!! $product->product_details !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 d-flex justify-content-md-center">
                                    <div class="product-fetaure-row">
                                        <div class="product-fetaure-item">
                                            <div class="product-fetaure-wrap">
                                                <div class="product-fetaure-icon">
                                                    <img src="{{ asset('assets/front/tejap/images/icon-material.svg') }}" alt="">
                                                </div>
                                                <div class="product-fetaure-summery">
                                                    <h4 class="product-fetaure-title">Material</h4>  
                                                    <p>100% Cotton</p>                                              
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-fetaure-item">
                                            <div class="product-fetaure-wrap">
                                                <div class="product-fetaure-icon">
                                                    <img src="{{ asset('assets/front/tejap/images/icon-weight.svg') }}" alt="">
                                                </div>
                                                <div class="product-fetaure-summery">
                                                    <h4 class="product-fetaure-title">Weight</h4>       
                                                    <p>Medium Weight Fabric</p>                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-fetaure-item">
                                            <div class="product-fetaure-wrap">
                                                <div class="product-fetaure-icon">
                                                    <img src="{{ asset('assets/front/tejap/images/icon-style.svg') }}" alt="featur-icon" />
                                                </div>
                                                <div class="product-fetaure-summery">
                                                    <h4 class="product-fetaure-title">Style</h4>   
                                                    <p>Unique Style</p>                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-fetaure-item">
                                            <div class="product-fetaure-wrap">
                                                <div class="product-fetaure-icon">
                                                    <img src="{{ asset('assets/front/tejap/images/icon-country.svg') }}" alt="county-svg" />
                                                </div>
                                                <div class="product-fetaure-summery">
                                                    <h4 class="product-fetaure-title">Country of Origin</h4>  
                                                    <p>India</p>                                              
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="single-product-content">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>{!! $product->specification !!}</li>
                                        </ul>
                                    </div>
                                    <div class="single-product-content">
                                        <h5>Wash Care</h5>
                                        <ul>
                                            <li>{!! $product->wash_care !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 pt-md-2">
                                <div class="col-md-12 col-12">                                            
                                    <div  class="single-product-content ">  
                                        <h5 class="collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#Returns_Exchanges">
                                            <i class="fa-solid fa-plus me-1"></i> 
                                            <i class="fa-solid fa-minus me-1"></i> 
                                            Returns & Exchanges
                                        </h5>
                                        <div id="Returns_Exchanges" class="collapse">
                                            <div class="pt-3 pt-lg-4">
                                                <h5>RISK FREE SHOPPING</h5>
                                                <p>You can return or exchange any product if you are not satisfied with the fit or size, within 60 days from the date of delivery.</p>
                                                <h5>ELIGIBILITY</h5>
                                                <p>Products must be unused, unwashed, undamaged and should have all the original tags and packaging. Once your return is processed, the full product price, including taxes, will be returned to you. Any additional shipping charges, if paid, are not returned.</p>
                                                <h5>PROCESS</h5>
                                                <p>To initiate a return/exchange, create a request here. Alternatively, you can also contact us with your order details.</p>
                                                <p>Our warehouse team typically takes around 48-72 hours to inspect all items due for returns or exchanges. Once approved, it’ll take upto 7 business days for the amount to reflect in your back account in case of a refund.</p>
                                                <p>For an exchange, we’ll ship out your new size/product once the pickup is completed.</p>
                                            </div>                                                    
                                        </div>
                                    </div>
                                </div>
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
<script>
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


