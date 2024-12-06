@extends('layouts.app')

@section('content')
<div class="container-fluid login-container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card login-card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>{{ config('app.name', 'Film Rental') }}</h3>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="Enter your email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password"
                                       placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-muted me-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a class="btn btn-link text-primary" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100vh;
    }

    .login-card {
        border-radius: 15px;
        background-color: rgba(255, 255, 255, 0.9);
    }

    .login-card .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }

    .form-control {
        border-left: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.05);
    }

    .btn-link {
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
