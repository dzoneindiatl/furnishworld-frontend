<div class="modal fade flip-modal login-sign-modal" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-head">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="sign-in-sec">
                    <div class="form-head">
                        <h1>Sign in to Vasvi</h1>
                        <p>Enter your email ID to sign in</p>
                    </div>
                    <div class="form-body">
                        <span id="login-error" style="color:red;font-size:14px"></span>
                        <form action="{{ route('front-user.postLogin') }}" method="POST" autocomplete="off" id="customerSignin">
                            @csrf
                            <div class="form-floating mb-2">
                                <input type="text" name="email" value="{{ old('email') ?? request()->cookie('user_email') }}" class="form-control @error('email') is-invalid @enderror"  placeholder="name@example.com" />
                                <label for="floatingInput">Enter your email ID</label>
                            </div>
                            <div class="form-floating  with-icon with_icon_loginpass mb-2">
                                <input type="password" name="password" id="lpassword" value="{{ old('password') ?? request()->cookie('user_password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                                <label for="floatingInput">Enter your password</label>
                                <span class="eye-icon" onclick="createpassword('lpassword', this)"><i class="fa-solid fa-eye-slash"></i></span>
                            </div>
                             <label>
                                <input type="checkbox" name="remember" {{ old('remember') || request()->cookie('remember')  ? 'checked' : '' }}> Remember Me
                            </label>
                            <button class="btn form-btn w-100 mt-3 " id="submit-btn">Sign In</button>
                            <a href="{{route('front-user.forgetPassword')}}">Forgot Password</a>
                        </form>
                        
                        <div class="divider mt-3 mb-3"><span>Or Sign in with</span></div>
                        <div class="link-sec">
                            <a class="link-sign socialLogin" href="javascript:void(0);" data-href="{{ route('front-social.redirect', ['provider' => 'google', 'redirect_to' => url()->current()]) }}""><span>Google</span><img src="{{ Url('assets/front/img/googleIcon.svg') }}" /></a>
                            <a class="link-sign socialLogin" href="javascript:void(0);" data-href="{{ route('front-social.redirect', ['provider' => 'facebook', 'redirect_to' => url()->current()]) }}"><span>Facebook</span><img src="{{ Url('assets/front/img/facebook.png') }}" /></a>
                        </div>
                        <span class="form-bottm-text">Don’t have an account? <a href="javascript:void(0)" class="sign-in">Sign up</a></span>
                    </div>
                </div>
                
                <div class="signup-in-sec" style="display: none;">
                    <form action="{{route('front-user.postSignup')}}" method="post" autocomplete="off" id="customerSignup">  
                        @csrf
                        <div id="signup-error" class="text-danger mb-2" style="display: none;"></div>

                    <div class="form-head">
                        <h1>Register with us</h1>
                        <p>Enter your Email to register</p>
                    </div>
                    <div class="form-body">
                        <div class="form-floating mb-2">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" />
                            <label for="floatingInput">Name</label>
                            @if ($errors->has('name'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    
                        <div class="form-floating mb-2">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="name@example.com" />
                            <label for="floatingInput">Email Id</label>
                            @if ($errors->has('email'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"  placeholder="Phone" />
                            <label for="floatingInput">Phone</label>
                            @if ($errors->has('phone_number'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('phone_number') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" name="referral" class="form-control"  placeholder="Referral" value="{{ $referralCode ?? request()->cookie('referral_code') }}" />
                            <label for="floatingInput">Referral</label>
                        </div>
                        <div class="form-floating with-icon with_icon_loginpass mb-2">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                            <label for="floatingInput">Password</label>
                            <span class="eye-icon" onclick="createpassword('password', this)"><i class="fa-solid fa-eye-slash"></i></span>
                                @if ($errors->has('password'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-floating with-icon with_icon_loginpass mb-2">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password" />
                            <label for="floatingInput">Confirm Password</label>
                            <span class="eye-icon" onclick="createpassword('confirm_password', this)"><i class="fa-solid fa-eye-slash"></i></span>
                                @if ($errors->has('confirm_password'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('confirm_password') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn form-btn w-100 mt-3" id="submit-btn">Register Now</button>
                        <!--<input type="submit" value="Register Now" class="btn form-btn w-100 mt-3">-->
                        </form>
                        
                        <div class="divider mt-3 mb-3"><span>Or Sign in with</span></div>
                        <div class="link-sec">
                                <a class="link-sign socialLogin" href="javascript:void(0);" data-href="{{ route('front-social.redirect', ['provider' => 'google', 'redirect_to' => url()->current()]) }}""><span>Google</span><img src="{{ Url('assets/front/img/googleIcon.svg') }}" /></a>
                        <a class="link-sign socialLogin" href="javascript:void(0);" data-href="{{ route('front-social.redirect', ['provider' => 'facebook', 'redirect_to' => url()->current()]) }}"><span>Facebook</span><img src="{{ Url('assets/front/img/facebook.png') }}" /></a>
                    
                        </div>
                        <span class="form-bottm-text">Don’t have an account? <a href="javascript:void(0)" class="sign-in-btn">Sign in</a></span>
                    </div>
                </div>

                <div class="register-otp" style="display: none;">
                    <div class="form-head">
                        <h1>Verify Your Email</h1>
                        <p>Enter your OTP to verify</p>
                    </div>
                    <span class="otp_message" style="color:green;font-size:14px"></span>
                    <span class="otp_error_msg" style="color:red;font-size:14px"></span>
                    <form action="{{route('front-user.postSignupVerify')}}" method="post" autocomplete="off" id="postSignupVerify">  
                        @csrf
                        <input type="hidden" name="user_id" class="user_id"  />
                        <div id="signup-error" class="text-danger mb-2" style="display: none;"></div>

                        <div class="form-floating mb-2">
                            <input type="text" name="email_otp" class="form-control @error('email_otp') is-invalid @enderror"  placeholder="Enter OTP" required/>
                            <label for="floatingInput">OTP</label>
                            @if ($errors->has('email_otp'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('email_otp') }}
                                </div>
                            @endif
                        </div>
                        <span class="form-bottm-text"><a href="javascript:void(0)" id="resendOtp" style="color:green;font-size:18px;cursor:pointer;float: left;text-decoration: underline;">Resend OTP</a></span>
                        <button type="submit" class="btn form-btn w-100 mt-3" id="submit-otp-btn">Email Verify</button>
                        <!--<input type="submit" value="Register Now" class="btn form-btn w-100 mt-3">-->

                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
    var dashboardUrl = "{{route('user.dashboard')}}";
</script>
<script src="{{asset('assets/front/js/login.js')}}"></script>
