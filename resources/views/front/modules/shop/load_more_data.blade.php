            @php
                $filteredColors = [];
                $i= 0;
            @endphp
            @forelse($results as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <figure class="item-single">
                            @php
                            //if($i==2){
                            $activeVarientId = activeVarientByProductId($product->id);
                                $activeVarientID = 0;
                                $firstImage ='';
                                $secondImage = '';
                                if(!empty($activeVarientId)){
                                    $firstImage = getActiveFrontImg($product->id,$activeVarientId);
                                    $secondImage  = getActiveBackImg($product->id,$activeVarientId);
                                }
                            // }
                            @endphp

                            <!-- <a href="{{ route('front-product.detail', ['sku' => $product->sku, 'slug' => productSlug($product->short_description)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">
                                <img src="{{ $product->images['first'] }}" alt="{{ $product->name }}" class="default-image">
                                <img src="{{ $product->images['second'] }}" alt="{{ $product->name }} Hover" class="hover-image">
                            </a> -->

                            <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">
                                <img src="{{ asset('uploads/products/' . $firstImage) }}" alt="{{ $product->name }}" class="default-image">
                                <img src="{{ asset('uploads/products/' . $secondImage) }}" alt="{{ $product->name }} Hover" class="hover-image">
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
                                    <!--@foreach($product->color_options as $color)-->
                                    <!--    <div>-->
                                    <!--        <input type="radio" id="{{ strtolower($color->name) }}" name="color_{{ $product->id }}" checked>-->
                                    <!--        <label for="color_{{ strtolower($color->name) }}_{{ $loop->index }}"><span></span></label>-->
                                    <!--    </div>-->
                                    <!--@endforeach-->
                                    @if($colorArr)
                                        @php
                                            $filteredColors = collect(@json_decode($colorArr)[0])->map(function($id) use ($product) {
                                                return $product->color_options->firstWhere('id', $id);
                                            })->filter(); // Remove any nulls in case an ID doesn't exist
                                        @endphp
                                    @endif
                                    @foreach($filteredColors as $colorsingle)
                                        <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">
                                            <div>
                                                <input type="radio" id="{{ strtolower($colorsingle->name) }}" name="color_{{ $product->id }}" checked>
                                                <label for="color_{{ strtolower($colorsingle->name) }}_{{ $loop->index }}"><span></span></label>
                                            </div>
                                        </a>
                                    @endforeach
                                    @foreach($product->color_options as $color)
                                        @if($color->id != @json_decode($colorArr)[0])
                                            <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">
                                                <div>
                                                    <input type="radio" id="{{ strtolower($color->name) }}" name="color_{{ $product->id }}" checked>
                                                    <label for="color_{{ strtolower($color->name) }}_{{ $loop->index }}"><span></span></label>
                                                </div>
                                            </a>
                                        @endif
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
                                    @if($product->in_stock == '0')
                                    <button type="button" class="btn_coupon_code m-0"> Out Of Stock </button>
                                    @else
                                    <button type="button" 
                                        class="boost-pfs-quickview-cart-btn"
                                        onclick="window.location.href='{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]) }}'">
                                        Add To Cart
                                    </button>
                                    @endif
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


<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner">
            <div class="container">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span itemprop="name">Home</span></a></li>
                            <li class="breadcrumb-item trail-end"><span itemprop="name">Product List</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper product-cat-content-wrapper">
        <div class="container">
            <div class="page-header text-center">
                <h1 class="page-title">All Shirts</h1>
            </div>
            <div class="content-area">
                <div class="product-cat-page">
                    <!-- <div class="product-cat-banner">
                        <img src="images/product-banner.jpg" alt="">
                    </div> -->
                    <!-- product-cat-banner -->
                    <div class="product-filter-outer">                           
                        <div class="product-filter-area">
                            <div class="product-filters">
                                <div class="product-filter">
                                    <button class="filter-toggle"><i class="fa-solid fa-sliders"></i> Filters </button>     
                                </div>
                                <div class="product-filter dropdown">
                                    <button class="product-filter-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
                                    <div class="product-filter-dropdown dropdown-menu">                                            
                                        <ul class="product-filter-menu">
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Shirt</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input class="product-filter-input" name="cat" id="cat_shortseleve" value="" type="checkbox">
                                                <label class="product-filter-label" for="cat_shortseleve">  
                                                    <div class="product-filter-frame"></div>                                                              
                                                    <div class="product-filter-text">
                                                        <span>Short Seleve</span>
                                                        <span>(40)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input class="product-filter-input" name="cat" id="cat_seleve_less" value="" type="checkbox">
                                                <label class="product-filter-label" for="cat_seleve_less">    
                                                    <div class="product-filter-frame"></div>                                                             
                                                    <div class="product-filter-text">
                                                        <span>Seleve Less</span>
                                                        <span>(14)</span>
                                                    </div>
                                                </label>
                                            </li>                                              
                                            <li>
                                                <input class="product-filter-input" name="cat" id="cat_polo_neck" value="" type="checkbox">
                                                <label class="product-filter-label" for="cat_polo_neck">  
                                                    <div class="product-filter-frame"></div>      
                                                    <div class="product-filter-text">
                                                        <span>Polo Neck</span>
                                                        <span>(18)</span>
                                                    </div>
                                                </label>
                                            </li>    
                                            <li>
                                                <input class="product-filter-input" name="cat" id="cat_strip" value="" type="checkbox">
                                                <label class="product-filter-label" for="cat_strip">  
                                                    <div class="product-filter-frame"></div>      
                                                    <div class="product-filter-text">
                                                        <span>Strip</span>
                                                        <span>(28)</span>
                                                    </div>
                                                </label>
                                            </li>                                      
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-filter dropdown">
                                    <button class="product-filter-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Color</button>
                                    <div class="product-filter-dropdown dropdown-menu">
                                        <ul class="product-filter-menu product-filter-color">
                                            <li>   
                                                <input class="product-filter-input" name="color" id="color_brown" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="color_brown">
                                                    <div class="product-filter-frame" style="background: #964b00;"></div>                                                              
                                                    <div class="product-filter-text">
                                                        <span>Brown</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input class="product-filter-input" name="color" id="color_yellow" value="" type="checkbox">
                                                <label class="product-filter-label" for="color_yellow">  
                                                    <div class="product-filter-frame" style="background: #f1c40f;"></div>                                                              
                                                    <div class="product-filter-text">
                                                        <span>Yellow</span>
                                                        <span>(40)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input class="product-filter-input" name="color" id="color_blue" value="" type="checkbox">
                                                <label class="product-filter-label" for="color_blue" >   
                                                    <div class="product-filter-frame" style="background: #310ff1;"></div>                                                              
                                                    <div class="product-filter-text">
                                                        <span>Blue</span>
                                                        <span>(14)</span>
                                                    </div>
                                                </label>
                                            </li>                                              
                                            <li>
                                                <input class="product-filter-input" name="color" id="color_red" value="" type="checkbox">
                                                <label class="product-filter-label" for="color_red">  
                                                    <div class="product-filter-frame" style="background: #ff0000;"></div>      
                                                    <div class="product-filter-text">
                                                        <span>Red</span>
                                                        <span>(18)</span>
                                                    </div>
                                                </label>
                                            </li>    
                                            <li>
                                                <input class="product-filter-input" name="color" id="color_black" value="" type="checkbox">
                                                <label class="product-filter-label" for="color_black">  
                                                    <div class="product-filter-frame" style="background: #000000;"></div>      
                                                    <div class="product-filter-text">
                                                        <span>Black</span>
                                                        <span>(28)</span>
                                                    </div>
                                                </label>
                                            </li>                                      
                                        </ul>                                           
                                    </div>
                                </div>
                                <div class="product-filter dropdown">
                                    <button class="product-filter-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Size</button>
                                    <div class="product-filter-dropdown dropdown-menu">
                                        <ul class="product-filter-menu">                                                
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_xs" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_xs">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>XS</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_s" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_s">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>S</span>
                                                        <span>(122)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_m" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_m">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>M</span>
                                                        <span>(312)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_l" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_l">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>L</span>
                                                        <span>(212)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_xl" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_xl">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>XL</span>
                                                        <span>(92)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="size" id="size_cxl" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="size_cxl">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>XXL</span>
                                                        <span>(12)</span>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                                                              
                            </div>                   
                            <div class="product-sortby">   
                                <div class="product-filter dropdown">
                                    <button class="filter-dropdown-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By : Latest</button>
                                    <div class="product-filter-dropdown dropdown-menu dropdown-menu-end">
                                        <ul class="product-filter-menu">
                                            <li class="product-filter-active">   
                                                <input class="product-filter-input" name="orderby" id="popularity" type="radio" checked="checked">                                         
                                                <label class="product-filter-label" for="popularity">   
                                                    <div class="product-filter-frame"></div>
                                                    <div class="product-filter-text">
                                                        <span>Popularity</span>                                                           
                                                    </div>
                                                </label>                                           
                                            </li>
                                            <li class="product-filter-active">   
                                                <input class="product-filter-input" name="orderby" id="date" type="radio" checked="checked">                                         
                                                <label class="product-filter-label" for="date">   
                                                    <div class="product-filter-frame"></div>
                                                    <div class="product-filter-text">
                                                        <span>Latest</span>                                                           
                                                    </div>
                                                </label>                                           
                                            </li>
                                            <li class="product-filter-active">   
                                                <input class="product-filter-input" name="orderby" id="price" type="radio" checked="checked">                                         
                                                <label class="product-filter-label" for="price">   
                                                    <div class="product-filter-frame"></div>
                                                    <div class="product-filter-text">
                                                        <span>Price: low to high</span>                                                           
                                                    </div>
                                                </label>                                           
                                            </li>
                                            <li class="product-filter-active">   
                                                <input class="product-filter-input" name="orderby" id="price-desc" type="radio" checked="checked">                                         
                                                <label class="product-filter-label" for="price-desc">   
                                                    <div class="product-filter-frame"></div>
                                                    <div class="product-filter-text">
                                                        <span>Price: high to low</span>                                                           
                                                    </div>
                                                </label>                                           
                                            </li>
                                        </ul>
                                    </div>
                                </div>  
                                <div class="product-display-mode">                                        
                                    <div id="grid" class=""><a href="javascript:void(0);" title="3 Column"><span></span><span></span><span></span></a></div>
                                    <div id="grid_large" class="active"><a href="javascript:void(0);" title="4 Column"><span></span><span></span><span></span><span></span></a></div>                                       
                                </div>    
                            </div>
                        </div>
                        <!-- product-sortby-filter -->                                    
                        <div class="product-sidebar-filter product-sidebar-area">
                            <h3 class="product-sidebar-heading">
                                Filter By
                                <button class="filter-close"><i class="fas fa-times"></i></button>
                            </h3>
                            <div class="product-widget-items">
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <h4 class="product-widget-title">Price </h4>
                                        <div class="product-widget-dropdown price-filter">
                                            <div id="slider-range"></div>
                                            <div class="price-range">
                                                <label for="amount">Range:</label>
                                                <input type="text" id="amount" readonly>
                                            </div>
                                        </div>
                                    </div>                                           
                                    <div class="product-widget-wrap">                                               
                                        <h4 class="product-widget-title">Sort By </h4>
                                        <div class="product-widget-dropdown">
                                            <ul class="product-filter-menu">
                                                <li>   
                                                    <input class="product-filter-input" name="orderby1" id="popularity1" type="radio" checked="checked">                                         
                                                    <label class="product-filter-label" for="popularity1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Popularity</span>                                                           
                                                        </div>
                                                    </label>                                           
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="orderby1" id="date1" type="radio" checked="checked">                                         
                                                    <label class="product-filter-label" for="date1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Latest</span>                                                           
                                                        </div>
                                                    </label>                                           
                                                </li>
                                                <li class="product-filter-active">   
                                                    <input class="product-filter-input" name="orderby1" id="price1" type="radio" checked="checked">                                         
                                                    <label class="product-filter-label" for="price1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Price: low to high</span>                                                           
                                                        </div>
                                                    </label>                                           
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="orderby1" id="price-desc1" type="radio" checked="checked">                                         
                                                    <label class="product-filter-label" for="price-desc1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Price: high to low</span>                                                           
                                                        </div>
                                                    </label>                                           
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                                           
                                </div>
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title open">By Discount  </p>  
                                        <div class="product-widget-dropdown">
                                            <ul class="product-filter-menu">
                                                <li class="product-filter-active">   
                                                    <input class="product-filter-input" name="off" id="off-20" value="" type="checkbox" checked="checked">                                         
                                                    <label class="product-filter-label" for="off-20">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>20% OFF</span>
                                                            <span>(4)</span>
                                                        </div>
                                                    </label>                                           
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="off-40" value="" type="checkbox">
                                                    <label class="product-filter-label" for="off-40">                                                  
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>40% OFF</span>
                                                            <span>(4)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="off-60" value="" type="checkbox">
                                                    <label class="product-filter-label" for="off-60">                                                   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>60% OFF</span>
                                                            <span>(4)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="off-80" value="" type="checkbox">
                                                    <label class="product-filter-label" for="off-80">  
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>80% OFF</span>
                                                            <span>(4)</span>
                                                        </div>
                                                    </label>
                                                </li>                                        
                                            </ul>
                                        </div> 
                                    </div>                                            
                                </div>
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title">Category</p> 
                                        <div class="product-widget-dropdown">
                                            <ul class="product-filter-menu">
                                                <li>   
                                                    <input class="product-filter-input" name="cat" id="cat_shirt1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="cat_shirt1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>Shirt</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_shortseleve1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_shortseleve1">  
                                                        <div class="product-filter-frame"></div>                                                              
                                                        <div class="product-filter-text">
                                                            <span>Short Seleve</span>
                                                            <span>(40)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_seleve_less1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_seleve_less1">    
                                                        <div class="product-filter-frame"></div>                                                             
                                                        <div class="product-filter-text">
                                                            <span>Seleve Less</span>
                                                            <span>(14)</span>
                                                        </div>
                                                    </label>
                                                </li>                                              
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_polo_neck1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_polo_neck1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Polo Neck</span>
                                                            <span>(18)</span>
                                                        </div>
                                                    </label>
                                                </li>    
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_strip1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_strip1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Strip</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li>                                      
                                            </ul>
                                        </div> 
                                    </div>                                             
                                </div> 
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title">By Size</p>   
                                        <div class="product-widget-dropdown">                                 
                                            <ul class="product-filter-menu">                                                
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_xs1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_xs1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>XS</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_s1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_s1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>S</span>
                                                            <span>(122)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_m1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_m1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>M</span>
                                                            <span>(312)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_l1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_l1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>L</span>
                                                            <span>(212)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_xl1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_xl1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>XL</span>
                                                            <span>(92)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>   
                                                    <input class="product-filter-input" name="size" id="size_cxl1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="size_cxl1">  
                                                        <div class="product-filter-frame"></div>                                                        
                                                        <div class="product-filter-text">
                                                            <span>XXL</span>
                                                            <span>(12)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                                            
                                </div>  
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title">By Color</p>    
                                        <div class="product-widget-dropdown">                                  
                                            <ul class="product-filter-menu product-filter-color">
                                                <li>   
                                                    <input class="product-filter-input" name="color" id="color_brown1" value="" type="checkbox">                                         
                                                    <label class="product-filter-label" for="color_brown1">
                                                        <div class="product-filter-frame" style="background: #964b00;"></div>                                                              
                                                        <div class="product-filter-text">
                                                            <span>Brown</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="color" id="color_yellow2" value="" type="checkbox">
                                                    <label class="product-filter-label" for="color_yellow2">  
                                                        <div class="product-filter-frame" style="background: #f1c40f;"></div>                                                              
                                                        <div class="product-filter-text">
                                                            <span>Yellow</span>
                                                            <span>(40)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="color" id="color_blue3" value="" type="checkbox">
                                                    <label class="product-filter-label" for="color_blue3">   
                                                        <div class="product-filter-frame" style="background: #310ff1;"></div>                                                              
                                                        <div class="product-filter-text">
                                                            <span>Blue</span>
                                                            <span>(14)</span>
                                                        </div>
                                                    </label>
                                                </li>                                              
                                                <li>
                                                    <input class="product-filter-input" name="color" id="color_red4" value="" type="checkbox">
                                                    <label class="product-filter-label" for="color_red4">  
                                                        <div class="product-filter-frame" style="background: #ff0000;"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Red</span>
                                                            <span>(18)</span>
                                                        </div>
                                                    </label>
                                                </li>    
                                                <li>
                                                    <input class="product-filter-input" name="color" id="color_black5" value="" type="checkbox">
                                                    <label class="product-filter-label" for="color_black5">  
                                                        <div class="product-filter-frame" style="background: #000000;"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Black</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li>                                      
                                            </ul> 
                                        </div>
                                    </div>                                            
                                </div>  
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title">By Pattern</p>   
                                        <div class="product-widget-dropdown">                                   
                                            <ul class="product-filter-menu">
                                                <li>     
                                                    <input class="product-filter-input" name="off" id="pattern_1" value="" type="checkbox">                                       
                                                    <label class="product-filter-label" for="pattern_1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Stripe</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_2" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_2">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Solid</span>
                                                            <span>(40)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_3" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_3">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Check</span>
                                                            <span>(14)</span>
                                                        </div>
                                                    </label>
                                                </li>                                              
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_4" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_4">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Cream</span>
                                                            <span>(18)</span>
                                                        </div>
                                                    </label>
                                                </li>    
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_5" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_5">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Dotted</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li>                                      
                                            </ul>
                                        </div>
                                    </div>                                           
                                </div>  
                            </div>                           
                        </div>
                        
                    </div>
                    <div class="product-filter-overlay"></div> 
                    <!--sidebar-section-->
                    <div class="products-area">
                        <ul class="products column-4">
                            <li class="product-item product">
                                <div class="product-wrap">
                                    <div class="product-image">
                                        <div class="onsale-trading">
                                            <span class="onsale-off">40% OFF</span>
                                        </div>
                                        <a href="product-detail.html">
                                            <div class="product-main-image">
                                                <img src="images/product-1.jpg" alt="" class="main-image">
                                            </div>
                                            <div class="product-hover-image">
                                                <img src="images/product-1-hover.jpg" alt="" class="hover-image">
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
                                            <a href="#">Burnished Amber Pullover</a>
                                        </h5>
                                        <div class="product-price">
                                            <del>₹ 4,990</del>
                                            <ins>₹ 2,994</ins>
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
                        </ul>
                        <div class="pagination">
                            <ul class="page-numbers">
                                <li><a class="prev page-numbers" href=""><i class="fa-solid fa-angles-left"></i></a></li>
                                <li><a class="page-numbers" href="">1</a></li>
                                <li><span aria-current="page" class="page-numbers current">2</span></li>
                                <li><a class="page-numbers" href="">3</a></li>                                    
                                <li><a class="next page-numbers" href=""><i class="fa-solid fa-angles-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- products-are  -->
                </div>
            </div>
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>
<!--=====================================================
                Site Section End
    =========================================================-->
        
         
   
