@extends('front.layouts.app', ['page' => 'login'])
@section('content')
    <form action="{{ route('front-user.postLogin') }}" method="post" autocomplete="off">
        @csrf
        <section class="site-content">
            <div class="page-banner-section">
                <div class="page-banner">
                    <div class="container">
                        <div class="page-banner-wrap">
                            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                                <ul class="breadcrumb-items">
                                    <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span
                                                itemprop="name">Home</span></a></li>
                                    <li class="breadcrumb-item trail-end"><span itemprop="name">Sign In</span></li>
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
                        <h1 class="page-title">Sign In</h1>
                    </div>
                    <div class="content-area">
                        <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
                            <div class="loginregister-area">
                                <div class="loginregister-header">
                                    <h3>Welcome</h3>
                                    <p>Enter your email address to sign in.</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul class="mt-2 mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="form-focus row login-form-inner">
                                    <div class="form-group col-12">
                                        <label class="label-focus" for="email">Email <span
                                                class="required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="label-focus" for="password">Password <span
                                                class="required">*</span></label>
                                        <div class="password-group">
                                            <input type="password" class="form-control password-input" name="password"
                                                id="password" placeholder="" required>
                                            <span class="password-icon">SHOW</span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="cartItems" id="loginCartItems">
                                    <div class="form-group col-12">
                                        <a href="{{ route('front-user.forgetPassword') }}" class="forgot-pass">Forgot
                                            Password?</a>
                                    </div>
                                </div>
                                <div class="form-submit">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                                <div class="login-social">
                                    <p>Login with social account</p>
                                    <ul class="login-social-icon">
                                        <li class="facebook"><a target="_blank" href="#"><i
                                                    class="fa-brands fa-facebook-f"></i></a></li>
                                        <li class="facebook"><a target="_blank" href="#"><i
                                                    class="fa-brands fa-google"></i></a></li>
                                    </ul>
                                </div>
                                <div class="loginregister-footer">
                                    <p>Don't have an account? <a href="{{ route('front-user.signup') }}"
                                            class="ms-2 text-decoration-underline">Register</a></p>
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
