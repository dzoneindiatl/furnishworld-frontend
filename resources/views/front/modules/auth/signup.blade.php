@extends('front.layouts.app',['page' => 'login'])

@section('content')  
<form action="{{route('front-user.postSignup')}}" method="post" autocomplete="off">  
@csrf
<section class="site-content">
      <div class="page-banner-section">
        <div class="page-banner">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">Sign Up</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- page-banner-section -->
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">Sign Up</h1>
          </div>
          <div class="content-area">
            <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
              <div class="loginregister-area">
                <div class="loginregister-header">
                  <h3>Register</h3>
                  <p>Create an account to latest Update.</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('front-user.postSignup') }}" method="POST">
                  @csrf 
                  <div class="form-focus row">
                    <div class="form-group col-12">
                      <label class="label-focus" for="name">Name <span class="required">*</span></label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="" required/>
                       @if ($errors->has('name'))
                        <div class=" invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group  col-12">
                      <label class="label-focus" for="email">Email <span class="required">*</span></label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="" required/>
                      @if ($errors->has('email'))
                        <div class=" invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group  col-12">
                      <label class="label-focus" for="phone_number">Phone <span class="required">*</span></label>
                      <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="" required/>
                      @if ($errors->has('phone_number'))
                        <div class=" invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-12">
                      <label class="label-focus" for="password">Password <span class="required">*</span></label>
                      <div class="password-group">
                        <input type="password" class="form-control password-input" name="password" id="password" placeholder="" required/>
                        @if ($errors->has('password'))
                        <div class=" invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                        <!-- <span class="password-icon">SHOW</span> -->
                      </div>                                           
                    </div>
                    <div class="form-group col-12">
                      <label class="label-focus" for="password">Confirm Password <span class="required">*</span></label>
                      <div class="password-group">
                        <input type="password" class="form-control password-input" name="confirm_password" id="confirm_password" placeholder="" required/>
                        @if ($errors->has('confirm_password'))
                        <div class=" invalid-feedback">
                            {{ $errors->first('confirm_password') }}
                        </div>
                        @endif
                      </div>                                           
                    </div>
                    <div class="form-group  col-12">
                      <label class="label-focus" for="referal">Referal (Optional)</label>
                      <input type="text" class="form-control" id="referal" name="referral" placeholder="" />
                    </div>
                  </div>
                  <div class="form-submit">
                    <button type="submit" class="btn btn-primary w-100">Create an account</button>
                  </div>
                </form>
                  
                
                <div class="login-social">
                  <p>Signup with social account</p>
                  <ul class="login-social-icon">
                    <li class="facebook"><a target="_blank" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li class="facebook"><a target="_blank" href="#"><i class="fa-brands fa-google"></i></a></li>                         
                </ul>
              </div>               
                <div class="loginregister-footer">
                  <p>Already have an account? <a href="{{ route('front-user.login') }}" class="ms-2 text-decoration-underline">Sign in?</a></p>
                </div>
              </div>
            </div>
          </div>
          <!--content-area-->
        </div>
        <!--container-->
      </div>
      <!--content-wrapper-->
    </section>
</form>
@endsection