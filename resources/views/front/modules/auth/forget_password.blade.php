@extends('front.layouts.app', ['page' => 'login'])
@push('styles')
    <link href="{{ asset('assets/front/css/login.css') }}" rel="stylesheet">
@endpush
@section('content')
    <form action="{{ route('front-user.sendPassword') }}" method="post" autocomplete="off">
        @csrf
        <div class="login-section">
            <div class="container">
                <div class="login-box my-5">

                    <div class="white-box">
                        <div class="text-center w-100 mb-5">
                            <img src="{{ asset('assets/front/img/favi_vasvi.png') }}" />
                        </div>
                        <h2 class="mb-4">Forgot password</h2>
                        <p class="mb-3">Enter your register email and we’ll send a reset password link</p>
                        <div class="form-group mt-4 mb-5">
                            <label>Email</label>
                            <input type="text" name="email"
                                class="form-control login @error('email') is-invalid @enderror"
                                placeholder="Enter your email" value="{{ old('email') }}" />
                            @if ($errors->has('email'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="success-link.html">
                                <button type="submit" class="login-button">
                                    Submit
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
