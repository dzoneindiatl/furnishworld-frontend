@extends('front.layouts.app')
@section('content')

<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner">
            <div class="container">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{ Url('/') }}" rel="home"><span itemprop="name">Home</span></a></li>
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
                <h1 class="page-title">{{ ucwords($category->name) }}</h1>
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
                                                        <span>Sofas</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Beds</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Dining Sets</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Tv Cabinets</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Dressing Tables</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Shoe Racks</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Stools</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Laptop Tables</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-filter dropdown">
                                    <button class="product-filter-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Collection</button>
                                    <div class="product-filter-dropdown dropdown-menu">                                            
                                        <ul class="product-filter-menu">
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Modern</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Contemporary</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Traditional</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Industrial</span>
                                                        <span>(102)</span>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-filter dropdown">
                                    <button class="product-filter-title" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>
                                    <div class="product-filter-dropdown dropdown-menu">                                            
                                        <ul class="product-filter-menu">
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Name (A-Z)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Name (Z-A)</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Price Low to High</span>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>   
                                                <input class="product-filter-input" name="cat" id="cat_shirt" value="" type="checkbox">                                         
                                                <label class="product-filter-label" for="cat_shirt">  
                                                    <div class="product-filter-frame"></div>                                                        
                                                    <div class="product-filter-text">
                                                        <span>Price High to Low</span>
                                                     </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
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
                                            </ul>
                                        </div>
                                    </div>                                           
                                </div>
                                <div class="product-widget-item">
                                    <div class="product-widget-wrap">
                                        <p class="product-widget-title open">Availability  </p>  
                                        <div class="product-widget-dropdown">
                                            <ul class="product-filter-menu">
                                                <li class="product-filter-active">   
                                                    <input class="product-filter-input" name="off" id="off-20" value="" type="checkbox" checked="checked">                                         
                                                    <label class="product-filter-label" for="off-20">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>In stock</span>
                                                            <span>(4)</span>
                                                        </div>
                                                    </label>                                           
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="off-40" value="" type="checkbox">
                                                    <label class="product-filter-label" for="off-40">                                                  
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Out of stock</span>
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
                                                            <span>Sofas</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_shortseleve1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_shortseleve1">  
                                                        <div class="product-filter-frame"></div>                                                              
                                                        <div class="product-filter-text">
                                                            <span>Beds</span>
                                                            <span>(40)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_seleve_less1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_seleve_less1">    
                                                        <div class="product-filter-frame"></div>                                                             
                                                        <div class="product-filter-text">
                                                            <span>Dining Sets</span>
                                                            <span>(14)</span>
                                                        </div>
                                                    </label>
                                                </li>                                              
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_polo_neck1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_polo_neck1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Tv Cabinets</span>
                                                            <span>(18)</span>
                                                        </div>
                                                    </label>
                                                </li>  
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_strip1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_strip1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Dressing Tables</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_strip1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_strip1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Shoe Racks</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li> 
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_strip1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_strip1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Stools</span>
                                                            <span>(28)</span>
                                                        </div>
                                                    </label>
                                                </li> 
                                                <li>
                                                    <input class="product-filter-input" name="cat" id="cat_strip1" value="" type="checkbox">
                                                    <label class="product-filter-label" for="cat_strip1">  
                                                        <div class="product-filter-frame"></div>      
                                                        <div class="product-filter-text">
                                                            <span>Laptop Tables</span>
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
                                        <p class="product-widget-title">Color</p>    
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
                                        <p class="product-widget-title">Material</p>   
                                        <div class="product-widget-dropdown">                                   
                                            <ul class="product-filter-menu">
                                                <li>     
                                                    <input class="product-filter-input" name="off" id="pattern_1" value="" type="checkbox">                                       
                                                    <label class="product-filter-label" for="pattern_1">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Fabric</span>
                                                            <span>(102)</span>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_2" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_2">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Leather</span>
                                                            <span>(40)</span>
                                                        </div>
                                                    </label>
                                                </li> 
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_3" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_3">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Velvet</span>
                                                            <span>(14)</span>
                                                        </div>
                                                    </label>
                                                </li> 
                                                <li>
                                                    <input class="product-filter-input" name="off" id="pattern_3" value="" type="checkbox">
                                                    <label class="product-filter-label" for="pattern_3">   
                                                        <div class="product-filter-frame"></div>
                                                        <div class="product-filter-text">
                                                            <span>Performance Fabric</span>
                                                            <span>(14)</span>
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
                                                <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">
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
                                                    <a href="{{ route('front-product.detail', ['product' => 'product','title' =>productSlug($product->name).'.html', 'sku' => productSlug($product->sku)]). '?' . http_build_query(['colorArr' => $colorArr, 'sizeArr' => $sizeArr]) }}">{{$product->name }}</a>
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
                        </ul>
                        
                        <div class="pagination">
                            <!-- Pagination Links -->
                            <div class="mt-6">
                                {{ $results->links() }}
                            </div>

                            <!-- <ul class="page-numbers">
                                <li><a class="prev page-numbers" href=""><i class="fa-solid fa-angles-left"></i></a></li>
                                <li><a class="page-numbers" href="">1</a></li>
                                <li><span aria-current="page" class="page-numbers current">2</span></li>
                                <li><a class="page-numbers" href="">3</a></li>                                    
                                <li><a class="next page-numbers" href=""><i class="fa-solid fa-angles-right"></i></a></li>
                            </ul> -->
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
@endsection

<style>
    .pagination svg {
        width: 20px; /* Forces icons to a normal size */
        height: 20px;
        display: inline-block;
    }

    nav[role="navigation"] div:last-child {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    .text-sm, .text-gray-700, .leading-5, .dark:text-gray-400{
        padding:20px;
    }
</style>

