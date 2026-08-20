@extends('front.layouts.app')
@section('content')
<!-- Banner -->
<section class="banner-section">
    <div class="banner-inner">
        <div class="shape1"><img src="{{ asset('assets/front/img/breadcumb-shape1_1.png')}}" alt="shape" /></div>
        <div class="shape2"><img src="{{ asset('assets/front/img/breadcumb-shape1_2.png')}}" alt="shape" /></div>
        <div class="shape3"><img src="{{ asset('assets/front/img/breadcumb-shape1_3.png')}}" alt="shape" /></div>
        <div class="shape4"><img src="{{ asset('assets/front/img/breadcumb-shape1_4.png')}}" alt="shape" /></div>
        <div class="container">
            <div class="banner-text">
                <h1>My Address</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Address</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="checkout-page">
    <div class="container">
    
        <div class="row Delivery-sec">
            <div class="col-md-6">
                <div class="checkout-left">
                    <div id="checkout-cart-container">
                  
                    </div>
                    <!-- <div class="apply-field mt-4 mb-4">
                        <input type="text" name="" placeholder="Discount code or gift card" class="form-control" />
                        <button class="field-btn">Apply</button>
                    </div> -->
                    <div class="total-bill-sec">
                        <ul class="total-list">
                            <li>
                                <span>Subtotal • <b id="total-items"></b> items</span>
                                <p class="subTotal">₹0</p>
                            </li>
                            <li>
                                <span>Tax</span>
                                <p class="text-success" id="taxPrice">₹0</p>
                            </li>
                            <li>
                                <span>Coupon Discount</span>
                                <p class="text-success" id="couponDiscount">₹0</p>
                            </li>
                            <!-- <li>
                                <span>Shipping <a href="#"></a></span>
                                <p>Enter shipping address</p>
                            </li> -->
                            <li>
                                <hr />
                            </li>

                            <li>
                                <span>
                                    <b class="text-uppercase">Total</b><br />
                                  
                                </span>
                                <p><b class="finalAmount">₹0</b></p>
                            </li>
                        </ul>
                    </div>
                    <!--<button class="w-100 full-btn">Pay Now</button>-->
                    <button class="w-100 full-btn" id="pay_now">Pay Now</button>
                    
                    <!--<button type="button" class="btn btn-primary py-3 btn-lg w-100" name="checkout_place_order" id="place_order">Place your order</button>-->
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkout-right">
                    <div class="checksection-box">
                            <div id="main_billing" style="display:none;">
                                <div class="checksection-box-head">
                                    <h4>Billing Address</h4>
                                </div>
                                
                                @php
                                $fullname = trim(Auth::guard('customer')->user()->name);
                                $parts = explode(' ', trim($fullname));
                                $firstName = $parts[0];
                                $lastName = end($parts);
                                @endphp
                                
                                <form  method="post" id="addressForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="address_type" value="billing">
                                    <div class="row address-form">
                                        <div class="col-md-12 mb-3">
                                            <select class="form-select selectcommon" name="country" id="country" aria-label="Default select example">
                                                <option selected>Country/Region</option>
                                                @if(isset($countries))
                                                    @foreach($countries as $key=>$country)
                                                       <option value="{{ $key }}">{{ $country}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="firstname" placeholder="First name" value="{{ $firstName ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lastname" placeholder="Last name"  value="{{ $lastName ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="address" class="form-control" placeholder="Addess" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="addressSecond" class="form-control" placeholder="Apartment, suite, etc. (optional)" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select selectcommon" id="state" name="state" aria-label="Default select example">
                                                <option selected>State</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select selectcommon" id="city" name="city" aria-label="Default select example">
                                                <option selected>City</option>
                                                
                                            </select>
                                            <!--<div class="form-group">-->
                                            <!--    <input type="text" name="city" class="form-control" placeholder="City" />-->
                                            <!--</div>-->
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="pinCode" class="form-control" placeholder="PIN code" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{Auth::guard('customer')->user()->phone_number}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                           <div class="inner_check_box">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="home" value="1" checked/>
                                                    <label class="form-check-label" for="home">
                                                        <div class="sp-content">
                                                            <h6>Home</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                           
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="office" value="2" />
                                                    <label class="form-check-label" for="office">
                                                        <div class="sp-content">
                                                            <h6>Office</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                            
                                               <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="Others" value="3"/>
                                                    <label class="form-check-label" for="Others">
                                                        <div class="sp-content">
                                                            <h6>Others</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-button" style="margin-top: 15px;">
                                                <button type="button" id="save_billing_address" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary btn_cancel_txt billing_cancel">Cancel</button>
                                            </div>
                                        </div>
                                       </div>
                                    </form>
                            </div>
                        
                            <div class="col-md-12 select-delivery-box mt-4 mb-2">
                                <div class="select-delivery-box-inner">
                                    @if(isset($userBillingAddress[0]))
                                          <h5>Select Billing Address</h5>
                                         @foreach($userBillingAddress as $key=>$userAdd)
                                            <div class="form-check">
                                                <input class="form-check-input select_billing_address" type="radio" name="address" value="{{ $userAdd->id }}" />
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <div class="select-content">
                                                        <span class="tagcheck">@if($userAdd->address_type == 1) Home @elseif($userAdd->address_type == 2) Office @else Others @endif</span>
                                                        <h6>{{ $userAdd->name }}</h6>
                                                        <p>{{ $userAdd->address }} {{ $userAdd->landmark }}, {{ $userAdd->city->name ?? '' }}, {{ $userAdd->state->name }}, {{ $userAdd->country->name }} - {{ $userAdd->postal_code }}</p>
                                                        <p>Phone: +91{{ $userAdd->phone_number }}</p>
                                                    </div>
                                                </label>
                                                <a href="javascript:void(0)" data-id="{{ $userAdd->id }}" data-bs-toggle="modal" data-bs-target="#edit-address" class="form-link edit-address-btn">Edit</a>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div id="message_for_billing_address"></div>
                                    <a class="btn btn-primary mt-2" id="add_new_billing_address">Add New Billing Address</a>
                                </div>
                            </div>
                            
                            
                            <div id="main_shipping" style="display:none;">
                                <div class="checksection-box-head">
                                   <h4>Shipping Addrress</h4>
                                </div>
                        
                                <form method="post" id="shippingAddressForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="address_type" value="shipping">
                                    <div class="row address-form">
                                        <div class="col-md-12 mb-3">
                                            <select class="form-select selectcommon" name="country" id="shipping_country" aria-label="Default select example">
                                                <option selected>Country/Region</option>
                                                @if(isset($countries))
                                                    @foreach($countries as $key=>$country)
                                                       <option value="{{ $key }}">{{ $country}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="firstname" placeholder="First name" value="{{ $firstName ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lastname" placeholder="Last name"  value="{{ $lastName ?? ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="address" class="form-control" placeholder="Addess" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="addressSecond" class="form-control" placeholder="Apartment, suite, etc. (optional)" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select selectcommon" id="shipping_state" name="state" aria-label="Default select example">
                                                <option selected>State</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select class="form-select selectcommon" id="shipping_city" name="city" aria-label="Default select example">
                                                <option selected>City</option>
                                                
                                            </select>
                                           
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <input type="text" name="pinCode" class="form-control" placeholder="PIN code" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{Auth::guard('customer')->user()->phone_number}}"/>
                                            </div>
                                        </div>
                                        
                                       <div class="col-md-12">
                                           <div class="inner_check_box">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="home" value="1" checked/>
                                                    <label class="form-check-label" for="home">
                                                        <div class="sp-content">
                                                            <h6>Home</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                           
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="office" value="2" />
                                                    <label class="form-check-label" for="office">
                                                        <div class="sp-content">
                                                            <h6>Office</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                            
                                               <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="address_place_type" id="Others" value="3"/>
                                                    <label class="form-check-label" for="Others">
                                                        <div class="sp-content">
                                                            <h6>Others</h6>
                                                        </div>
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                            
                                        <div class="col-md-12">
                                            <div class="form-button">
                                                <button type="button" id="save_shipping_address" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary btn_cancel_txt shipping_cancel">Cancel</button>
                                            </div>
                                        </div>
                                      </div>
                                    </form>
                            </div>
                            
                            <div class="col-md-12 select-delivery-box mt-4 mb-2">
                                <div class="select-delivery-box-inner">
                                    @if(isset($usershippingAddress[0]))
                                          <h5>Select Shipping Addrress</h5>
                                         @foreach($usershippingAddress as $userShipAdd)
                                            <div class="form-check">
                                                <input class="form-check-input select_shipping_address" type="radio"  name="shipaddress" value="{{ $userShipAdd->id }}"   />
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <div class="select-content">
                                                        <span class="tagcheck">@if($userShipAdd->address_type == 1)Home @elseif($userShipAdd->address_type == 2) Office @else Others @endif</span>
                                                        <h6>{{ $userShipAdd->name }}</h6>
                                                        <p>{{ $userShipAdd->address }} {{ $userShipAdd->landmark }}, {{ $userShipAdd->city->name ?? '' }}, {{ $userShipAdd->state->name }}, {{ $userShipAdd->country->name }} - {{ $userShipAdd->postal_code }}</p>
                                                        <p>Phone: +91{{ $userShipAdd->phone_number }}</p>
                                                    </div>
                                                </label>
                                                <!--<span class="pencil-icon" onclick="openPopup(32)"> -->
                                                <!--    <i class="fa fa-pencil"></i>-->
                                                <!--</span>-->
                                                <a href="javascript:void(0)" data-id="{{ $userShipAdd->id }}" data-bs-toggle="modal" data-bs-target="#edit-address" class="form-link edit-address-btn">Edit</a>
                                            </div>
                                        @endforeach
                                    @endif
                                    
                                    <div class="form-group mb-3 col-sm-12 col-12 has-value">
                                        <input class="form-check-input" type="checkbox" value="0" id="same_as_billing" name="same_as_billing" onclick="toggleShippingAddressForm()">
                                        <label class="form-check-label" for="same_as_billing">
                                            Same as billing address
                                        </label>
                                    </div>
                                    <a class="btn btn-primary mt-2 shipping-address" id="add_new_shipping_address">Add New Shipping Addrress</a>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="" />
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Save this information for next time
                                    </label>
                                </div>
                            </div>
                            <div class="toggle-box-check">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="" id="news-offer" checked="" />
                                    <label class="form-check-label" for="news-offer">
                                        Text me with news and offers
                                    </label>
                                </div>
                                <div class="show-toggle-check-news pt-2" style="display: none;">
                                    <div class="form-group">
                                        <input type="" name="" class="form-control" placeholder="Mobile phone number" />
                                    </div>
                                    <p>
                                        By signing up via text, you agree to receive recurring automated marketing messages, including cart reminders, at the phone number provided. Consent is not a condition of purchase. Reply STOP
                                        to unsubscribe. Reply HELP for help. Message frequency varies. Msg & data rates may apply. View our Privacy policy and Terms of service.
                                    </p>
                                </div>
                            </div>
                            <div class="toggle-box-check">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="" id="Gstin-detail" checked="" />
                                    <label class="form-check-label" for="Gstin-detail">
                                        Use GSTIN details for this order
                                    </label>
                                </div>
                                <div class="show-toggle-check pt-3" style="display: none;">
                                    <div class="form-group GST-group">
                                        <input type="text" name="" class="form-control mb-3" placeholder="GST Business Name" />
                                        <input type="text" name="" class="form-control" placeholder="GST Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="checksection-box col-md-12 mt-4">
                                <div class="select-payment-mode-sec">
                                    <h4>Select Payment Mode</h4>
                                    <ul class="payment-mode-list">
                                    <!-- <li>
                                        <div class="form-check">
                                            <input class="form-check-input wallet-or-online" type="radio" name="wallet_online" id="flexRadioDefault11" />
                                            <label class="form-check-label" for="flexRadioDefault11">
                                                <div class="sp-content">
                                                    <h6>Use Vasvi Wallet</h6>
                                                    <p>Login to redeem a Gift card and use wallet balance</p>
                                                </div>
                                            </label>
                                            <span class="tag-label" id="wallet_amount">₹00.00</span>
                                        </div>
                                    </li> -->
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input wallet-or-online" type="radio" name="pay_online" checked  value="razorpay" id="flexRadioDefault12" />
                                            <label class="form-check-label" for="flexRadioDefault12">Pay Online</label>
                                            <span class="tag-label">Free</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pay_online" value="cod" id="flexRadioDefault13" />
                                            <label class="form-check-label" for="flexRadioDefault13">Cash on Delivery</label>
                                            <span class="tag-label">₹00.00</span>
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="checksection-box col-md-12 mt-4">
                                <div class="payment-mode-sec">
                                    <div class="payment-mode-head mb-3">
                                        <h4>Payment</h4>
                                        <span>All transactions are secure and encrypted.</span>
                                    </div>
                                    <ul class="Payment-mode-list">
                                        <li>
                                            <h4>Razorpay Secure (UPI, Cards, Wallets, NetBanking)</h4>
                                            <ul class="payment-info">
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-1.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-2.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-3.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-4.svg')}}" /></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h4>Phone Pay Secure (UPI, Cards, Wallets, NetBanking)</h4>
                                            <ul class="payment-info">
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-1.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-2.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-3.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-4.svg')}}" /></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h4>Paypal Secure (UPI, Cards, Wallets, NetBanking)</h4>
                                            <ul class="payment-info">
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-1.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-2.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-3.svg')}}" /></a>
                                                </li>
                                                <li>
                                                    <a><img src="{{ asset('assets/front/img/upi-img-4.svg')}}" /></a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Model for Edit address-->
     <div class="modal fade common-modal" id="edit-address" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
              <div class="modal-header">
                 <h1 id="staticBackdropLabel">Edit Address</h1>
                 <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </div>
              <form method="post" id="editAddressForm">
              <div class="modal-body">
                 <div class="row address-form">
                    <div class="col-md-12 mb-3">
                       <select class="form-select selectcommon" name="country" id="country" aria-label="Default select example">
                          <option>Country/Region</option>
                          <option value="101" selected="">India</option>
                       </select>
                    </div>
                    <input type="hidden" name="addressId" class="addressId" value="">
                    <div class="col-md-6 mb-3">
                       <div class="form-group">
                          <input type="text" class="form-control" name="firstname" placeholder="First name" />
                       </div>
                    </div>
                    <div class="col-md-6 mb-3">
                       <div class="form-group">
                          <input type="text" class="form-control" name="lastname" placeholder="Last name"/>
                       </div>
                    </div>
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                          <input type="text" name="address" class="form-control" placeholder="Addess" />
                       </div>
                    </div>
                    <div class="col-md-12 mb-3">
                       <div class="form-group">
                           <input type="text" name="addressSecond" class="form-control" placeholder="Apartment, suite, etc. (optional)" />
                       </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <!--<select class="form-select selectcommon editState" name="state" aria-label="Default select example">-->
                        <select class="form-select selectcommon editState" id="state" name="state">
                            <option>State</option>
                            @if(isset($states))
                                @foreach($states as $key=>$state)
                                   <option value="{{ $key }}">{{ $state }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                       <div class="form-group">
                           <select class="form-select selectcommon editCity"  name="city">
                                <option>City</option>
                                
                            </select>
                       </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                       <div class="form-group">
                          <input type="text" name="pinCode" class="form-control" placeholder="PIN code" />
                       </div>
                    </div>
                    <div class="col-md-12">
                       <div class="form-group">
                          <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{Auth::guard('customer')->user()->phone_number}}"/>
                       </div>
                    </div>
                    <div class="col-md-12">
                   <div class="inner_check_box">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="address_place_type" id="home" value="1">
                            <label class="form-check-label" for="home">
                                <div class="sp-content">
                                    <h6>Home</h6>
                                </div>
                            </label>
                        </div>
                   
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="address_place_type" id="office" value="2">
                            <label class="form-check-label" for="office">
                                <div class="sp-content">
                                    <h6>Office</h6>
                                </div>
                            </label>
                        </div>
                    
                       <div class="form-check">
                            <input class="form-check-input" type="radio" name="address_place_type" id="Others" value="3">
                            <label class="form-check-label" for="Others">
                                <div class="sp-content">
                                    <h6>Others</h6>
                                </div>
                            </label>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                       <button type="submit" class="btn btn-primary" id="updateAddressBtn">Save</button>
                       <button type="button" class="btn btn-secondary ms-2" id="cancelAddressBtn">Cancel</button>
                    </div>
                 </div>
              </div>
              </form>
           </div>
        </div>
     </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/front/js/checkouts.js') }}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

 var RAZORPAYKEY = "{{ env('RAZORPAY_LIVE_KEY') }}";
 var USERNAME    = "{{ (Auth::guard('customer')->check() ? Auth::guard('customer')->user()->name : '') }}";
 var USEREMAIL   = "{{ (Auth::guard('customer')->check() ? Auth::guard('customer')->user()->email : '') }}";
 var USERPHONE   = "{{ (Auth::guard('customer')->check() ? Auth::guard('customer')->user()->phone_number : '9876543210') }}";
</script>

@endpush

