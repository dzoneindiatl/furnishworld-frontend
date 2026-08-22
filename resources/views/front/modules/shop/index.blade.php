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
                        <ul class="products column-4" id="product-list">
                            @include("front.modules.shop.load_more_data")
                        </ul>
                        <div id="productLoader" style="display:none; text-align:center;"></div>
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
<script>

let offset = 8;
let loading = false;
let hasMore = true;

window.addEventListener('scroll', function () {

    if (loading || !hasMore) {
        return;
    }

    const scrollTop = window.scrollY;
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;

    console.log(
        'scrollTop:', scrollTop,
        'windowHeight:', windowHeight,
        'documentHeight:', documentHeight
    );

    if (scrollTop + windowHeight >= documentHeight - 500) {
        loading = true;
        $.ajax({
            url: window.location.href,
            type: 'GET',
            data: {
                offset: offset,
                limit: 8,
                ajax: 1
            },

            beforeSend: function () {
                $('#productLoader').show();
            },
            success: function (response) {
                console.log('AJAX RESPONSE:', response);
                if (response.html && response.html.trim() !== '') {
                    $('#product-list').append(response.html);
                    offset += response.totalResults;
                    hasMore = response.hasMore;
                } else {
                    hasMore = false;
                }

                // if (!hasMore) {
                //     $('#productLoader')
                //         .html('No more products')
                //         .show();
                // }
            },
            error: function (xhr) {
                console.log('AJAX ERROR:', xhr.status);
                console.log(xhr.responseText);
            },

            complete: function () {
                loading = false;
                if (hasMore) {
                    $('#productLoader').hide();
                }
            }
        });
    }

});

</script>

