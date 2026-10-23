@extends('front.layouts.app', ['page' => 'login'])
@push('styles')
    <link href="{{ asset('assets/front/css/login.css') }}" rel="stylesheet">
@endpush
@section('content')
    <form action="{{ route('front-user.resetPasswordSave', $validate_string) }}" method="post" autocomplete="off">
        @csrf
        <div class="login-section">
            <div class="container">
                <div class="login-box my-5">

                    <div class="white-box">
                        <div class="text-center w-100 mb-5">
                            <img src="{{ asset('assets/front/img/favi_vasvi.png') }}" />
                        </div>
                        <!--<h2 class="mb-4">Reset password</h2>-->
                        <div class="form-group">
                            <label>Create password</label>
                            <input type="password" name="new_password"
                                class="form-control login @error('new_password') is-invalid @enderror"
                                placeholder="Create a new password" />
                            @if ($errors->has('new_password'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('new_password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="new_password_confirmation"
                                class="form-control login @error('new_password_confirmation') is-invalid @enderror"
                                placeholder="Re-enter your Password" />
                            @if ($errors->has('new_password_confirmation'))
                                <div class=" invalid-feedback">
                                    {{ $errors->first('new_password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" href="success-password.html" class="login-button">
                                Change password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
