<section class="footer_sec_top">
    <?php 
       // Footer content Dynamic   
        $data = footerCategoryContent();
        $firstCategory = @$data['firstCategory'];
        $secondCategory = @$data['secondCategory'];
        $thirdCategory = @$data['thirdCategory'];
        $fourthCategory = @$data['fourthCategory'];
    ?>
    <footer class="footer-section" id="footer-section">
            <div class="footer">                
                <div class="footer-top">
                    <div class="container">                       
                        <div class="footer-widget-outer">
                            <div class="row">
                                <div class="footer-column footer-1 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn" data-wow-delay="0.3">
                                    <div class="footer-widget">
                                        <h4 class="footer-widget-title">{{   ucwords(@$firstCategory->name) }}</h4>
                                        <div class="footer-widget-menu">
                                            <ul class="menu">
                                                @if(!empty($firstCategory->subcategories))
                                                    @foreach($firstCategory->subcategories as $subcategories)
                                                        @if($subcategories->type=='url')
                                                        <li><a href="{{  @$subcategories->url }}">{{  @$subcategories->title }}</a></li>
                                                        @else
                                                        <li><a href="{{ env('WEBSITE_URL').'page/'.  @$subcategories->slug }}">{{  @$subcategories->title }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <!-- <li><hr></li>
                                                <li><a href="contact-us.html">Contact Us</a></li>
                                                <li><a href="about.html">About Us</a></li>                                                
                                                <li><a href="career.html">We Are Hiring</a></li>
                                                <li><a href="blog.html">Blog</a></li> -->
                                            </ul>
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="footer-column footer-2 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn" data-wow-delay="0.5s">
                                    <div class="footer-widget">
                                        <h4 class="footer-widget-title">{{  ucwords(@$secondCategory->name) }}</h4>
                                        <div class="footer-widget-menu">
                                            <ul class="menu">
                                                @if(!empty($secondCategory->subcategories))
                                                    @foreach($secondCategory->subcategories as $subcategories)
                                                        @if($subcategories->type=='url')
                                                        <li><a href="{{  @$subcategories->url }}">{{  @$subcategories->title }}</a></li>
                                                        @else
                                                        <li><a href="{{ env('WEBSITE_URL').'page/'.  @$subcategories->slug }}">{{  @$subcategories->title }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <!-- <li><hr></li>
                                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                                <li><a href="term-conditions.html">Terms &amp; Conditions</a></li>
                                                <li><a href="exchange-return-policy.html">Exchange &#038; Return Policy</a></li>
                                                <li><a href="shipping-policy.html">Shipping Policy</a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer-column footer-3  col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn" data-wow-delay="0.7s">
                                    <div class="footer-widget widget_nav_menu">
                                        <h4 class="footer-widget-title">{{  ucwords(@$thirdCategory->name) }}</h4>
                                        <div class="footer-widget-menu">
                                            <ul class="menu">
                                                @if(!empty($thirdCategory->subcategories))
                                                    @foreach($thirdCategory->subcategories as $subcategories)
                                                        @if($subcategories->type=='url')
                                                        <li><a href="{{  @$subcategories->url }}">{{  @$subcategories->title }}</a></li>
                                                        @else
                                                        <li><a href="{{ env('WEBSITE_URL').'page/'.  @$subcategories->slug }}">{{  @$subcategories->title }}</a></li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <!-- <li><hr></li>
                                                <li><a href="my-account.html">My account</a></li>
                                                <li><a href="my-purchase.html">Orders</a></li>
                                                <li><a href="order-tracking.html">Track Order</a></li>
                                                <li><a href="faqs.html">FAQ</a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="footer-column footer-4 col-lg-3 col-md-6 col-sm-6 col-12 wow animate__animated animate__fadeIn" data-wow-delay="0.9s">
                                    <?php echo @$fourthCategory->description; ?>   
                                    <!--<div class="footer-widget">
                                        <h4 class="footer-widget-title">Connect With Us</h4>
                                        <div class="footer-contact">
                                            <p><span class="footer-contact-icon"><i class="fa-solid fa-phone"></i></span><span>+91-98765-43210</span></p>
                                            <p><span class="footer-contact-icon"><i class="fab fa-whatsapp"></i></span><span>+91-98765-43210</span></p>
                                            <p><span class="footer-contact-icon"><i class="fa-regular fa-envelope-open"></i></span><span>contact@shoptjap.com</span></p>
                                            <p><span class="footer-contact-icon"><i class="fa-regular fa-clock"></i></span><span>Mon-Fri | 10:00 AM - 06:30 PM (IST)</span></p>
                                        </div>                                 
                                    </div>   -->                                  
                                    <div class="footer-widget">
                                        <div class="footer-social">
                                            <h4 class="footer-widget-title">Follow Us</h4>
                                            <ul class="footer-social-icon">
                                                <li class="facebook"><a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li class="instagram"><a target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li class="pinterest"><a target="_blank" href="#"><i class="fab fa-pinterest"></i></a></li>
                                                <li class="twitter"><a target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li class="youtube"><a target="_blank" href="#"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-outer">
                            <div class="copyright text-center">
                                <p>&copy;2026 Furnish World. All Rights Reserved. Powered BY : <a href="https://dzoneindia.co.in/" target="_blank">Dzone India</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="scroll-top">
            <a class="scroll-to-top" href="javascript:void(0);" id="scrolltop"><i class="fa fa-angle-up"></i></a>
        </div>
        <div class="whatsapp-call">
            <div class="d-none d-md-block">
                <a target="_blank" href="https://web.whatsapp.com/send?phone=+91 9876543210&amp;text=Hi, I had some queries." class="whatsapp"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="d-md-none">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+91 9876543210&amp;text=Hi, I had some queries." class="whatsapp"> <i class="fab fa-whatsapp"></i> </a>
            </div>
        </div>
       
    </div>
    <!-- Wrapper -->
    

        <!--=====================================================
                                 Footer Section End
        =========================================================-->

@if (!empty($settings?->value))
    <div class="seo_description">
        <div class="container">
            {!! $settings->value !!}
        </div>
    </div>
@elseif(!empty($categorySeoValue))
    <div class="seo_description">
        <div class="container">
            {!! $categorySeoValue !!}
        </div>
    </div>
@endif



