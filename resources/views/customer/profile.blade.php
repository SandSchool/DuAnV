@extends("layout.default")
@section("content")

<div class="profile-wrapper">
    <div class="container profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h2>{{ $customer->HOTEN }}</h2>
                <p>{{ $customer->EMAIL }}</p>
            </div>

            <div class="profile-body">
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('customer.profile.update') }}">
                    @csrf

                    <h3 class="section-title">
                        <i class="fas fa-user-edit me-2"></i>Thông tin cá nhân
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $customer->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $customer->EMAIL) }}" required>
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input id="address" type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address', $customer->address) }}" required>
                        @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthday" class="form-label">Ngày sinh</label>
                                <input id="birthday" type="date"
                                    class="form-control @error('birthday') is-invalid @enderror"
                                    name="birthday" value="{{ old('birthday', $customer->birthday) }}" required>
                                @error('birthday')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="password-section">
                        <h3 class="section-title">
                            <i class="fas fa-lock me-2"></i>Đổi mật khẩu (Không bắt buộc)
                        </h3>

                        <div class="form-group">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password">
                            @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                                    <input id="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        name="new_password">
                                    @error('new_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                    <input id="new_password_confirmation" type="password"
                                        class="form-control"
                                        name="new_password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('home.index') }}" class="btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save me-2"></i>Cập nhật thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection