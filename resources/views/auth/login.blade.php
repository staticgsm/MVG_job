@extends('layouts.frontend')

@section('title', 'Login - MVGC Services Private Limited')

@section('extra_css')
<style>
    .auth-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .auth-header {
        background: #fff;
        padding: 40px 40px 20px;
        text-align: center;
    }
    .auth-body {
        padding: 20px 40px 40px;
    }
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e4e4e4;
    }
    .form-control:focus {
        border-color: #ef7f1a;
        box-shadow: 0 0 0 0.2rem rgba(239, 127, 26, 0.25);
    }
    .btn-primary {
        background-color: #ef7f1a;
        border-color: #ef7f1a;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #d66a10;
        border-color: #d66a10;
        transform: translateY(-2px);
    }
    .auth-logo {
        max-width: 150px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<section class="bg-solitude-blue pt-150px pb-100px">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="auth-card bg-white">
                    <div class="auth-header">
                        <a href="{{ route('frontend.home') }}">
                            <img src="{{ asset('images/MVG_logo .png') }}" alt="MVGC Logo" class="auth-logo">
                        </a>
                        <h4 class="alt-font text-dark-gray fw-600 mb-0">Welcome Back</h4>
                        <p class="fs-15 text-medium-gray mt-2">Login to manage your account</p>
                    </div>

                    <div class="auth-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label alt-font fw-500 text-dark-gray">{{ __('Email Address') }}</label>
                                <div class="position-relative">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="password" class="form-label alt-font fw-500 text-dark-gray mb-0">{{ __('Password') }}</label>
                                    @if (Route::has('password.request'))
                                        <a class="fs-13 text-base-color fw-500" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="position-relative">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check custom-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label fs-14 text-medium-gray" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100 alt-font text-white">
                                    {{ __('Sign In') }}
                                </button>
                            </div>

                            @if (Route::has('register'))
                                <div class="text-center mt-4">
                                    <p class="fs-14 text-medium-gray mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-base-color fw-600">Register Now</a></p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
