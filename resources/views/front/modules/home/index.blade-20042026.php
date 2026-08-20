@extends('front.layouts.app')
@section('content')
<section class="home-site-content">
    <!-- Banner Section -->
    @if(!empty($homeBanner))
    <div class="slider-section">
        <div class="slider-carousel"> 
            @foreach($homeBanner as $banner)
            <?php $banner_url = asset('uploads/banners/'.$banner->image);  ?>
            <div class="slider-item slider-summery-right">
                <div class="slider-wrap">
                    <div class="slider-image">
                        <img src="{{ $banner_url }}" alt="{{ $banner->title }}" />
                    </div>
                    <div class="slider-summery">
                        <div class="slider-container wow animate__animated animate__fadeInRight" data-wow-delay="0.4s">
                            <!-- <p class="slider-subheading">Up to 40% Off</p> -->
                            <h4 class="slider-heading">{{ $banner->title }}</h4>
                            <p class="slider-description"><?php echo  @$banner->description; ?></p>
                            <div class="slider-button">
                                <a href="{{ @$banner->url }}" class="btn btn-outline-primary">Shop Now </a>
                            </div>  
                        </div>
                                                        
                    </div>
                </div>                       
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <!-- Banner Section -->
    

    <!-- Category Section -->
     @if(!empty($category))
    <div class="product-category-section section">
        <div class="container">
            <div class="section-header text-center">                      
                <h2 class="section-title">Shop By Category</h2>
            </div>
            <div class="product-category-wrapper">
                <div class="row justify-content-center">
                    @foreach($category as $cat)
                    <?php 
                        $cat_main_img_url = asset('uploads/categories/'. $cat->getAttributes()['image']); 
                        $cat_hover_img_url = asset('uploads/categories/'. $cat->getAttributes()['thumbnail_image']);
                    ?>
                    <div class="product-category-item col-lg-2 col-md-3 col-sm-4 col-4 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                        <div class="product-category-wrap">
                            <a href="{{ env('WEBSITE_URL').$cat->slug }}">
                                <div class="product-category-image">                                      
                                    <img src="{{   @$cat_main_img_url }}" alt="{{  $cat->name }}" />                                     
                                </div>
                                <div class="product-category-title">
                                    {{  $cat->name }}
                                </div>    
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Category Section -->
    <!--=====================================================
                        Product Category Section End
    =========================================================-->

    <div class="product-section section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Featured Products</h2>                       
            </div>
            <div class="products-wrapper">
                <div class="products-area">
                    <ul class="products product-carousel">
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_2" type="radio" name="Size_2" value="XS" form="product-form-1" >
                                                <label for="xs_2">XS</label>                                                      
                                                <input id="s_2" type="radio" name="Size_2" value="S" form="product-form-1">
                                                <label for="s_2">S</label>                                                   
                                                <input id="m_2" type="radio" name="Size_2" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_2">M</label>                                                   
                                                <input id="l_2" type="radio" name="Size_2" value="L" form="product-form-1">
                                                <label for="l_2">L</label>                                                     
                                                <input id="xl_2" type="radio" name="Size_2" value="XL" form="product-form-1">
                                                <label for="xl_2" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_3" type="radio" name="Size_3" value="XS" form="product-form-1" >
                                                <label for="xs_3">XS</label>                                                      
                                                <input id="s_3" type="radio" name="Size_3" value="S" form="product-form-1">
                                                <label for="s_3">S</label>                                                   
                                                <input id="m_3" type="radio" name="Size_3" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_3">M</label>                                                   
                                                <input id="l_3" type="radio" name="Size_3" value="L" form="product-form-1">
                                                <label for="l_3">L</label>                                                     
                                                <input id="xl_3" type="radio" name="Size_3" value="XL" form="product-form-1">
                                                <label for="xl_3" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_4" type="radio" name="Size_4" value="XS" form="product-form-1" >
                                                <label for="xs_4">XS</label>                                                      
                                                <input id="s_4" type="radio" name="Size_4" value="S" form="product-form-1">
                                                <label for="s_4">S</label>                                                   
                                                <input id="m_4" type="radio" name="Size_4" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_4">M</label>                                                   
                                                <input id="l_4" type="radio" name="Size_4" value="L" form="product-form-1">
                                                <label for="l_4">L</label>                                                     
                                                <input id="xl_4" type="radio" name="Size_4" value="XL" form="product-form-1">
                                                <label for="xl_4" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_5" type="radio" name="Size_5" value="XS" form="product-form-1" >
                                                <label for="xs_5">XS</label>                                                      
                                                <input id="s_5" type="radio" name="Size_5" value="S" form="product-form-1">
                                                <label for="s_5">S</label>                                                   
                                                <input id="m_5" type="radio" name="Size_5" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_5">M</label>                                                   
                                                <input id="l_5" type="radio" name="Size_5" value="L" form="product-form-1">
                                                <label for="l_5">L</label>                                                     
                                                <input id="xl_5" type="radio" name="Size_5" value="XL" form="product-form-1">
                                                <label for="xl_5" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_5" type="radio" name="Size_5" value="XS" form="product-form-1" >
                                                <label for="xs_5">XS</label>                                                      
                                                <input id="s_5" type="radio" name="Size_5" value="S" form="product-form-1">
                                                <label for="s_5">S</label>                                                   
                                                <input id="m_5" type="radio" name="Size_5" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_5">M</label>                                                   
                                                <input id="l_5" type="radio" name="Size_5" value="L" form="product-form-1">
                                                <label for="l_5">L</label>                                                     
                                                <input id="xl_5" type="radio" name="Size_5" value="XL" form="product-form-1">
                                                <label for="xl_5" class="disabled" >XL</label>  
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
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Product Section End
    =========================================================-->

    <div class="product-highlight-section section">
        <div class="container">
            <div class="product-highlight-wrapper">
                <div class="product-highlight-item">
                    <div class="product-highlight-wrap">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 pe-md-0 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
                                <div class="product-highlight-image">
                                    <img src="{{asset('assets/front/tejap/images/product-highlight.jpg') }}" alt="..">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 wow animate__animated animate__fadeInRight" data-wow-delay="0.4s">
                                <div class="product-highlight-summery">
                                    <div class="product-highlight-subtitle">FLASH SALE </div>
                                    <div class="product-highlight-title">-70% </div>
                                    <div class="product-highlight-desc"> Great deals for black friday. Hurry up and get your products</div>
                                    <div class="product-highlight-button">
                                        <a href="#" target="_blank" class="product-banner-link btn btn-outline-primary px-5">Discover More</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="product-highlight-item">
                    <div class="product-highlight-wrap">
                        <div class="row flex-row-reverse align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 ps-md-0 wow animate__animated animate__fadeInRight data-wow-delay="0.4s">
                                <div class="product-highlight-image">
                                    <img src="{{asset('assets/front/tejap/images/product-highlight-2.jpg') }}" alt="..">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
                                <div class="product-highlight-summery">
                                    <div class="product-highlight-subtitle">WINTER SALE </div>
                                    <div class="product-highlight-title">-50% </div>
                                    <div class="product-highlight-desc"> Great deals for black friday. Hurry up and get your products</div>
                                    <div class="product-highlight-button">
                                        <a href="#" target="_blank" class="product-banner-link btn btn-outline-primary px-5">Discover More</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>                                 
        </div>
    </div>
    <!--=====================================================
                        Product banner Section End
    =========================================================-->

    <div class="product-twocolumn-section section">
        <div class="container">
            <div class="product-twocolumn-wrapper">
                <div class="row align-items-center">
                    <div class="product-twocolumn-item col-lg-6 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
                        <div class="product-twocolumn-wrap">
                            <div class="product-twocolumn-image">
                                <img src="{{asset('assets/front/tejap/images/product-twocolumn-1.jpg') }}" alt="..">
                            </div>
                            <div class="product-twocolumn-summery">   
                                <!-- <div class="product-twocolumn-subtitle">New Collection</div>                                -->
                                <div class="product-twocolumn-title">Buy 1 Get 1 Deal </div>
                                <div class="product-twocolumn-desc"> Buy any items for you and your beloved one</div>
                                <div class="product-twocolumn-button">
                                    <a href="#" class="btn-url">Discover More</a>
                                </div>
                            </div>
                        </div>                               
                    </div>
                    <div class="product-twocolumn-item col-lg-6 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeInRight" data-wow-delay="0.4s">
                        <div class="product-twocolumn-wrap">
                            <div class="product-twocolumn-image">
                                <img src="{{asset('assets/front/tejap/images/product-twocolumn-2.jpg') }}" alt="..">
                            </div>
                            <div class="product-twocolumn-summery">     
                                <!-- <div class="product-twocolumn-subtitle">Winter Collection</div>                              -->
                                <div class="product-twocolumn-title">Winter's Hight</div>
                                <div class="product-twocolumn-desc">Buy any items for you and your beloved one</div>
                                <div class="product-twocolumn-button">
                                    <a href="#" class="btn-url">Discover More</a>
                                </div>
                            </div>
                        </div>                              
                    </div>
                </div>  
            </div>                                 
        </div>
    </div>
    <!--=====================================================
                        Product banner Section End
    =========================================================-->
    
    <div class="product-section section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Latest Arrival</h2>                       
            </div>
            <div class="products-wrapper">
                <div class="products-area">
                    <ul class="products product-carousel">
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_2" type="radio" name="Size_2" value="XS" form="product-form-1" >
                                                <label for="xs_2">XS</label>                                                      
                                                <input id="s_2" type="radio" name="Size_2" value="S" form="product-form-1">
                                                <label for="s_2">S</label>                                                   
                                                <input id="m_2" type="radio" name="Size_2" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_2">M</label>                                                   
                                                <input id="l_2" type="radio" name="Size_2" value="L" form="product-form-1">
                                                <label for="l_2">L</label>                                                     
                                                <input id="xl_2" type="radio" name="Size_2" value="XL" form="product-form-1">
                                                <label for="xl_2" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_3" type="radio" name="Size_3" value="XS" form="product-form-1" >
                                                <label for="xs_3">XS</label>                                                      
                                                <input id="s_3" type="radio" name="Size_3" value="S" form="product-form-1">
                                                <label for="s_3">S</label>                                                   
                                                <input id="m_3" type="radio" name="Size_3" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_3">M</label>                                                   
                                                <input id="l_3" type="radio" name="Size_3" value="L" form="product-form-1">
                                                <label for="l_3">L</label>                                                     
                                                <input id="xl_3" type="radio" name="Size_3" value="XL" form="product-form-1">
                                                <label for="xl_3" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_4" type="radio" name="Size_4" value="XS" form="product-form-1" >
                                                <label for="xs_4">XS</label>                                                      
                                                <input id="s_4" type="radio" name="Size_4" value="S" form="product-form-1">
                                                <label for="s_4">S</label>                                                   
                                                <input id="m_4" type="radio" name="Size_4" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_4">M</label>                                                   
                                                <input id="l_4" type="radio" name="Size_4" value="L" form="product-form-1">
                                                <label for="l_4">L</label>                                                     
                                                <input id="xl_4" type="radio" name="Size_4" value="XL" form="product-form-1">
                                                <label for="xl_4" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_5" type="radio" name="Size_5" value="XS" form="product-form-1" >
                                                <label for="xs_5">XS</label>                                                      
                                                <input id="s_5" type="radio" name="Size_5" value="S" form="product-form-1">
                                                <label for="s_5">S</label>                                                   
                                                <input id="m_5" type="radio" name="Size_5" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_5">M</label>                                                   
                                                <input id="l_5" type="radio" name="Size_5" value="L" form="product-form-1">
                                                <label for="l_5">L</label>                                                     
                                                <input id="xl_5" type="radio" name="Size_5" value="XL" form="product-form-1">
                                                <label for="xl_5" class="disabled" >XL</label>  
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
                        <li class="product-item product">
                            <div class="product-wrap">
                                <div class="product-image">
                                    <div class="onsale-trading">
                                        <!-- <span class="tranding">New</span> -->
                                        <span class="onsale-off">40% OFF</span>
                                    </div>
                                    <a href="product-detail.html">
                                        <div class="product-main-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1.jpg') }}" alt="" class="main-image">
                                        </div>
                                        <div class="product-hover-image">
                                            <img src="{{asset('assets/front/tejap/images/product-1-hover.jpg') }}" alt="" class="hover-image">
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
                                                <input id="xs_5" type="radio" name="Size_5" value="XS" form="product-form-1" >
                                                <label for="xs_5">XS</label>                                                      
                                                <input id="s_5" type="radio" name="Size_5" value="S" form="product-form-1">
                                                <label for="s_5">S</label>                                                   
                                                <input id="m_5" type="radio" name="Size_5" value="M/L" form="product-form-1" checked="checked">
                                                <label for="m_5">M</label>                                                   
                                                <input id="l_5" type="radio" name="Size_5" value="L" form="product-form-1">
                                                <label for="l_5">L</label>                                                     
                                                <input id="xl_5" type="radio" name="Size_5" value="XL" form="product-form-1">
                                                <label for="xl_5" class="disabled" >XL</label>  
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
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Product Section End
    ========================================================= -->

    <div class="product-banner-section section">
        <div class="container">
            <div class="product-banner-wrapper">
                <div class="product-banner-image">
                    <img src="{{asset('assets/front/tejap/images/product-banner.jpg') }}" alt="..">
                </div>
                <div class="product-banner-summery wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="product-banner-title">Become Our Ambassadar </div>
                    <div class="product-banner-desc"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                    <div class="product-banner-button">
                        <a href="ambassadar.html" target="_blank" class="product-banner-link btn btn-outline-white px-5">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Product banner Section End
    =========================================================-->

    <div class="product-cat-section section">
        <div class="container">
            <div class="section-header text-center">                      
                <h2 class="section-title">Our Other Lines</h2>
            </div>
            <div class="product-cat-wrapper">
                <div class="row">
                    <div class="product-cat-item col-lg-4 col-md-4 col-sm-6 col-12 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                        <div class="product-cat-wrap">
                            <a href="#">
                                <div class="product-cat-image">                                      
                                    <img src="{{asset('assets/front/tejap/images/women.jpg') }}" alt="" />                                     
                                </div>
                                <div class="product-cat-summery">
                                    <div class="product-cat-title">
                                        Women
                                    </div>  
                                    <div class="product-cat-button">
                                        <button class="btn-url">Discover More</button>
                                    </div>      
                                </div>                                        
                            </a>
                        </div>
                    </div>
                    <div class="product-cat-item col-lg-4 col-md-4 col-sm-6 col-12 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                        <div class="product-cat-wrap">
                            <a href="#">
                                <div class="product-cat-image">                                      
                                    <img src="{{asset('assets/front/tejap/images/men.jpg') }}" alt="" />                                     
                                </div>                                        
                                <div class="product-cat-summery">
                                    <div class="product-cat-title">
                                        Men
                                    </div>  
                                    <div class="product-cat-button">
                                        <button class="btn-url">Discover More</button>
                                    </div>      
                                </div>
                            </a>
                        </div>                               
                    </div>                          
                    <div class="product-cat-item col-lg-4 col-md-4 col-sm-6 col-12 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                        <div class="product-cat-wrap">
                            <a href="#">
                                <div class="product-cat-image">                                      
                                    <img src="{{asset('assets/front/tejap/images/kids.jpg') }}" alt="" />                                     
                                </div>                                        
                                <div class="product-cat-summery">
                                    <div class="product-cat-title">
                                        Kids
                                    </div>  
                                    <div class="product-cat-button">
                                        <button class="btn-url">Discover More</button>
                                    </div>      
                                </div>
                            </a>
                        </div>
                    </div>                           
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Product Category Section End
    =========================================================-->

    <div class="benefit-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-9 col-sm-12 col-12 wow animate__animated animate__fadeInLeft" data-wow-delay="0.4s">
                    <div class="benefit-outer">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="section-header">
                                    <h2 class="section-title">TJAP GUARANTEE</h2>
                                    <p class="section-description">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                </div>                                    
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="benefit-wrapper">
                                    <div class="benefit-row row">
                                        <div class="benefit-item col-lg-6 col-md-6 col-sm-6 col-6 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                                            <div class="benefit-wrap">
                                                <div class="benefit-icon">
                                                    <img src="{{asset('assets/front/tejap/images/icon-free-shipping.svg') }}" alt="" />
                                                </div>
                                                <div class="benefit-summery">
                                                    <h4 class="benefit-title">Free Shipping</h4>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="benefit-item col-lg-6 col-md-6 col-sm-6 col-6 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                                            <div class="benefit-wrap">
                                                <div class="benefit-icon">
                                                    <img src="{{asset('assets/front/tejap/images/icon-money-bag.svg') }}" alt="" />
                                                </div>
                                                <div class="benefit-summery">
                                                    <h4 class="benefit-title">Money Guarantee</h4>                                               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="benefit-item col-lg-6 col-md-6 col-sm-6 col-6 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                                            <div class="benefit-wrap">
                                                <div class="benefit-icon">
                                                    <img src="{{asset('assets/front/tejap/images/icon-return.svg') }}" alt="" />
                                                </div>
                                                <div class="benefit-summery">
                                                    <h4 class="benefit-title">60 Days Returns</h4>                                               
                                                </div>
                                            </div>
                                        </div>
                                        <div class="benefit-item col-lg-6 col-md-6 col-sm-6 col-6 wow animate__animated animate__zoomIn" data-wow-delay="0.4s">
                                            <div class="benefit-wrap">
                                                <div class="benefit-icon">
                                                    <img src="{{asset('assets/front/tejap/images/icon-payment.svg') }}" alt="" />
                                                </div>
                                                <div class="benefit-summery">
                                                    <h4 class="benefit-title">Flexible Payment</h4>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                        </div>
                    </div>
                </div> 
                <div class="col-lg-2 col-md-3 col-sm-12 col-12 wow animate__animated animate__fadeInRight" data-wow-delay="0.4s">
                    <div class="benefit-image">
                        <a href="#"><img src="{{asset('assets/front/tejap/images/Ecommerce.png') }}" alt="" /></a>
                    </div>
                </div>   
            </div>                  
        </div>
    </div>
    <!--=====================================================
                        benefit Section End
    =========================================================-->

    <div class="newsletter-section section">
        <div class="container">
            <div class="newsletter-outer">
                <div class="newsletter-image">
                    <img src="{{asset('assets/front/tejap/images/product-banner.jpg') }}" alt="" />
                </div>
                <div class="newsletter-summery">
                    <div class="newsletter-content">
                        <h4>Join the TJAP community </h4>
                        <p>Sign up now to get all the latest updates delivered to your inbox with new product launches, discounts, collaborations, blogs, and more.</p>
                    </div>
                    <div class="newsletter-form">
                        <form method="post">
                            <div class="newsletter-fields">
                                <span class="newsletter-icon"><i class="fa-regular fa-envelope-open"></i></span>
                                <input type="email" name="EMAIL" placeholder="Your email address" required="">
                                <button type="submit" class="btn btn-secondary btn-radius px-4" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================================================
                        Newsletter Section End
    =========================================================-->

<!-- <div class="container">
    <div class="row g-4 align-items-center justify-content-between">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            <div class="indo-western-left-img">
                <img src="{{ asset('assets/assets/front/img/indo-western.webp') }}" class="indo-western-layer-img1" />
                <img src="{{ asset('assets/assets/front/img/indo-western-1.webp') }}" class="indo-western-layer-img" />
            </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            <div class="right-content">
                <p>NEW LAUNCH</p>
                <h3 class="h3">Moroccan Edit</h3>
                <div class="rte">
                    <p>
                        Moroccan culture and arts have a look of their own despite having emerged through a wide set
                        of influences from Arab, Africa to Europe.<br />
                        <br />
                        Enjoy our Moroccan journey that traverses through vibrant colors flowing luminous fabrics
                        and intricate patterns that incorporate our take on traditional Motifs like geometric and
                        mosaic.<br />
                        <br />
                        Embroidered details and silhouettes that draw inspiration from traditional takshitas capture
                        the essence of Morocco in each piece becoming an amalgamation of Cultural inspiration and
                        Modern
                        sophistication.
                    </p>
                </div>
                <a class="button" href="#" role="button" title="View Collection">View Collection</a>
            </div>
        </div>
    </div>
</div> -->

</section>
@endsection
     