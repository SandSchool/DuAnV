@extends('layout.default')
@section('content') 

<div class="container my-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-white text-center py-3">
            <h4 class="mb-0">{{ __('Đăng Nhập Tài Khoản') }}</h4>
            <p class="text-muted mb-0">Chào mừng bạn!</p>
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('customer.login') }}">
                @csrf

                {{-- Email Address --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Địa chỉ E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Ghi nhớ đăng nhập') }}
                        </label>
                    </div>
                    <a href="{{-- route('password.request') --}}" class="small text-decoration-none">{{ __('Quên mật khẩu?') }}</a>
                </div>

                {{-- Submit Button --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Đăng Nhập') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="card-footer text-center py-3">
            <small class="text-muted">Chưa có tài khoản? <a href="{{-- route('customer.register') --}}">Đăng ký ngay</a></small>
        </div>
    </div>
</div>
@endsection