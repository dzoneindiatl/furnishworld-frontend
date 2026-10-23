@extends('front.layouts.app')
@section('content')
 <div class="our_store_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-text-headung">
                 
                    <span class="section-text-headung-line-before"></span>
                    <h2 class="main-heading">Our Store</h2>
                    <span class="section-text-headung-line-after"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            <div class="our_store_sec_item">
                <div class="img-card">
                    <div class="img_card_img">
                        <img class="img_normal" src="{{ asset('assets/front/img/vasvi_add1.png')}}" alt="Image">
                        <img class="img_normal_hover" src="{{ asset('assets/front/img/vasvi_add1_hover.png')}}" alt="Image">
                    </div>
                    <div class="collection__item">
                        <h4>Jaipur, Rajasthan</h4>
                        <p>B- 276, Vaishali Marg, opp. Trends, Shivraj Niketan Colony, Vaishali Nagar, Jaipur, Rajasthan 302021</p>
                        <p>Monday-Sunday 10:30 am - 9:30 pm</p>
                        <div class="card-buttons">
                            <a href="https://maps.app.goo.gl/GfuNDMYfCkvLPsCo6?g_st=aw" class="btn_get_direction" target="_blank"><img
                                    src="../assets/front/img/get_direction.png"> Get Direction</a>
                            <a href="tel:06376681424" type="button" class="phone-link" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.8228 14.1039C17.8962 13.6052 16.9589 13.0372 15.9895 12.6412C14.1162 11.8773 14.2429 14.1359 12.9055 14.8679C12.0362 15.3439 10.8095 14.4812 10.0509 14.0039C8.72554 13.1692 7.55088 12.0706 6.57488 10.7999C6.07488 10.1506 4.97089 8.92926 5.10689 8.0186C5.32289 6.57327 7.03221 6.50127 6.54288 4.73327C6.28155 3.78661 5.81355 2.85461 5.46288 1.94261C4.99355 0.719948 4.80022 -0.0627168 3.43089 0.00394974C2.44156 0.0519496 1.78556 0.474615 1.17756 1.26795C-0.467766 3.41061 -0.219767 6.29993 0.885564 8.65059C2.45089 11.9773 5.13355 15.1132 7.99888 17.1399C9.94821 18.5186 12.5162 19.7706 14.8762 19.9826C16.6042 20.1386 19.0215 19.2039 19.6402 17.3279C19.5975 17.4586 19.5562 17.5852 19.5362 17.6452C19.5508 17.5986 19.5828 17.5039 19.6402 17.3279C19.6655 17.2532 19.6815 17.2026 19.6975 17.1546C19.6802 17.2066 19.6615 17.2639 19.6415 17.3239C20.1855 15.6706 20.2522 14.8732 18.8228 14.1039ZM19.6975 17.1546C19.7188 17.0892 19.7375 17.0319 19.7482 17.0012C19.7402 17.0266 19.7215 17.0812 19.6975 17.1546Z"
                                        fill="#D15C62"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="our_store_sec_item">
                <div class="img-card">
                    <div class="img_card_img">
                        <img class="img_normal" src="{{ asset('assets/front/img/vasvi_add2.png')}}" alt="Image">
                        <img class="img_normal_hover" src="{{ asset('assets/front/img/vasvi_add2_hover.png')}}" alt="Image">
                    </div>
                    <div class="collection__item">
                        <h4>Jaipur, Rajasthan</h4>
                        <p>ward 27, 56/07, Rajat Path, Mansarovar Sector 5, Mansarovar, Jaipur, Rajasthan 302020</p>
                        <p>Monday-Sunday 10:00 am - 9:30 pm</p>
                        <div class="card-buttons">
                            <a href="https://maps.app.goo.gl/rWQizSvXReBUpTrS8?g_st=aw" class="btn_get_direction" target="_blank"><img
                                    src="../assets/front/img/get_direction.png"> Get Direction</a>
                            <a href="tel:06376681424" type="button" class="phone-link" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.8228 14.1039C17.8962 13.6052 16.9589 13.0372 15.9895 12.6412C14.1162 11.8773 14.2429 14.1359 12.9055 14.8679C12.0362 15.3439 10.8095 14.4812 10.0509 14.0039C8.72554 13.1692 7.55088 12.0706 6.57488 10.7999C6.07488 10.1506 4.97089 8.92926 5.10689 8.0186C5.32289 6.57327 7.03221 6.50127 6.54288 4.73327C6.28155 3.78661 5.81355 2.85461 5.46288 1.94261C4.99355 0.719948 4.80022 -0.0627168 3.43089 0.00394974C2.44156 0.0519496 1.78556 0.474615 1.17756 1.26795C-0.467766 3.41061 -0.219767 6.29993 0.885564 8.65059C2.45089 11.9773 5.13355 15.1132 7.99888 17.1399C9.94821 18.5186 12.5162 19.7706 14.8762 19.9826C16.6042 20.1386 19.0215 19.2039 19.6402 17.3279C19.5975 17.4586 19.5562 17.5852 19.5362 17.6452C19.5508 17.5986 19.5828 17.5039 19.6402 17.3279C19.6655 17.2532 19.6815 17.2026 19.6975 17.1546C19.6802 17.2066 19.6615 17.2639 19.6415 17.3239C20.1855 15.6706 20.2522 14.8732 18.8228 14.1039ZM19.6975 17.1546C19.7188 17.0892 19.7375 17.0319 19.7482 17.0012C19.7402 17.0266 19.7215 17.0812 19.6975 17.1546Z"
                                        fill="#D15C62"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="our_store_sec_item">
                <div class="img-card">
                    <div class="img_card_img">
                        <img class="img_normal" src="{{ asset('assets/front/img/vasvi_add3.png')}}" alt="Image">
                        <img class="img_normal_hover" src="{{ asset('assets/front/img/vasvi_add3_hover.png')}}" alt="Image">
                    </div>
                    <div class="collection__item">
                        <h4>Mumbai, Maharashtra</h4>
                        <p>Shop Number 1/2, Ganpati Bhavan, Mahatma Gandhi Rd, opposite Jain Derasar Mandir, Tilak Nagar, Goregaon West, Mumbai, Maharashtra 400104</p>
                        <p>Monday-Sunday 10:00 am - 9:30 pm</p>
                        <div class="card-buttons">
                            <a href="https://maps.app.goo.gl/f7SaQi2UNUTah5uf6?g_st=aw" class="btn_get_direction" target="_blank"><img
                                    src="../assets/front/img/get_direction.png"> Get Direction</a>
                            <a href="tel:08879404173" type="button" class="phone-link" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.8228 14.1039C17.8962 13.6052 16.9589 13.0372 15.9895 12.6412C14.1162 11.8773 14.2429 14.1359 12.9055 14.8679C12.0362 15.3439 10.8095 14.4812 10.0509 14.0039C8.72554 13.1692 7.55088 12.0706 6.57488 10.7999C6.07488 10.1506 4.97089 8.92926 5.10689 8.0186C5.32289 6.57327 7.03221 6.50127 6.54288 4.73327C6.28155 3.78661 5.81355 2.85461 5.46288 1.94261C4.99355 0.719948 4.80022 -0.0627168 3.43089 0.00394974C2.44156 0.0519496 1.78556 0.474615 1.17756 1.26795C-0.467766 3.41061 -0.219767 6.29993 0.885564 8.65059C2.45089 11.9773 5.13355 15.1132 7.99888 17.1399C9.94821 18.5186 12.5162 19.7706 14.8762 19.9826C16.6042 20.1386 19.0215 19.2039 19.6402 17.3279C19.5975 17.4586 19.5562 17.5852 19.5362 17.6452C19.5508 17.5986 19.5828 17.5039 19.6402 17.3279C19.6655 17.2532 19.6815 17.2026 19.6975 17.1546C19.6802 17.2066 19.6615 17.2639 19.6415 17.3239C20.1855 15.6706 20.2522 14.8732 18.8228 14.1039ZM19.6975 17.1546C19.7188 17.0892 19.7375 17.0319 19.7482 17.0012C19.7402 17.0266 19.7215 17.0812 19.6975 17.1546Z"
                                        fill="#D15C62"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-4">
            <div class="our_store_sec_item">
                <div class="img-card">
                    <div class="img_card_img">
                        <img class="img_normal" src="{{ asset('assets/front/img/vasvi_add4.png')}}" alt="Image">
                        <img class="img_normal_hover" src="{{ asset('assets/front/img/vasvi_add4_hover.png')}}" alt="Image">
                    </div>
                    <div class="collection__item">
                        <h4>Mandi, Himachal Pradesh</h4>
                        <p>301/4, School Bazar, Samkhetar, Mandi, Himachal Pradesh 175001</p>
                        <p>Monday-Sunday 10:00 am - 8:00 pm</p>
                        <div class="card-buttons">
                            <a href="https://maps.app.goo.gl/9TvrJReoa2pDCrTR7?g_st=aw" class="btn_get_direction" target="_blank"><img
                                    src="../assets/front/img/get_direction.png"> Get Direction</a>
                            <a href="tel:06376681424" type="button" class="phone-link" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.8228 14.1039C17.8962 13.6052 16.9589 13.0372 15.9895 12.6412C14.1162 11.8773 14.2429 14.1359 12.9055 14.8679C12.0362 15.3439 10.8095 14.4812 10.0509 14.0039C8.72554 13.1692 7.55088 12.0706 6.57488 10.7999C6.07488 10.1506 4.97089 8.92926 5.10689 8.0186C5.32289 6.57327 7.03221 6.50127 6.54288 4.73327C6.28155 3.78661 5.81355 2.85461 5.46288 1.94261C4.99355 0.719948 4.80022 -0.0627168 3.43089 0.00394974C2.44156 0.0519496 1.78556 0.474615 1.17756 1.26795C-0.467766 3.41061 -0.219767 6.29993 0.885564 8.65059C2.45089 11.9773 5.13355 15.1132 7.99888 17.1399C9.94821 18.5186 12.5162 19.7706 14.8762 19.9826C16.6042 20.1386 19.0215 19.2039 19.6402 17.3279C19.5975 17.4586 19.5562 17.5852 19.5362 17.6452C19.5508 17.5986 19.5828 17.5039 19.6402 17.3279C19.6655 17.2532 19.6815 17.2026 19.6975 17.1546C19.6802 17.2066 19.6615 17.2639 19.6415 17.3239C20.1855 15.6706 20.2522 14.8732 18.8228 14.1039ZM19.6975 17.1546C19.7188 17.0892 19.7375 17.0319 19.7482 17.0012C19.7402 17.0266 19.7215 17.0812 19.6975 17.1546Z"
                                        fill="#D15C62"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
