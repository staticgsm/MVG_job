@extends('layouts.frontend')

@section('title', 'Register - MVGC Services Private Limited')

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
            <div class="col-xl-6 col-lg-7 col-md-10">
                <div class="auth-card bg-white">
                    <div class="auth-header">
                        <a href="{{ route('frontend.home') }}">
                            <img src="{{ asset('images/MVG_logo .png') }}" alt="MVGC Logo" class="auth-logo">
                        </a>
                        <h4 class="alt-font text-dark-gray fw-600 mb-0">Create Account</h4>
                        <p class="fs-15 text-medium-gray mt-2">Join us to explore better opportunities</p>
                    </div>

                    <div class="auth-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="name" class="form-label alt-font fw-500 text-dark-gray">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label alt-font fw-500 text-dark-gray">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="form-label alt-font fw-500 text-dark-gray">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="password-confirm" class="form-label alt-font fw-500 text-dark-gray">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="mb-0 mt-2">
                                <button type="submit" class="btn btn-primary w-100 alt-font text-white">
                                    {{ __('Create Account') }}
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="fs-14 text-medium-gray mb-0">Already have an account? <a href="{{ route('login') }}" class="text-base-color fw-600">Login Instead</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
