@extends('layout.default')
@section('content')
<div class="container my-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-white text-center py-3">
            <h4 class="mb-0">{{ __('Đăng Ký Tài Khoản') }}</h4>
            <p class="text-muted mb-0">Tạo tài khoản mới</p>
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('customer.register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Họ và Tên') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- Email Address --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Địa chỉ E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label for="password-confirm" class="form-label">{{ __('Xác nhận Mật khẩu') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>             

                {{-- Submit Button --}} 
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Đăng Ký') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <small class="text-muted">Đã có tài khoản? <a href="{{ route('customer.login') }}">Đăng nhập ngay</a></small>
        </div>
    </div>
</div>
@endsection
