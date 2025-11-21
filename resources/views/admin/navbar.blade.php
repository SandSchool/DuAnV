<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="{{ route('admin.home.index') }}">Quản lý ShoesVN</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navigation">

            <form>
                <div class="input-group no-border" style="margin-bottom: 0;"> <input type="text" value="" class="form-control" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav align-items-center">

                <li class="nav-item mr-3" title="Xem trang chủ">
                    <a class="nav-link btn-magnify" href="{{ url('/') }}" target="_blank" style="margin-top: 0;">
                        <i class="nc-icon nc-layout-11" style="font-size: 20px;"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Xem shop</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item btn-rotate dropdown mr-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 0;">
                        <i class="nc-icon nc-bell-55" style="font-size: 20px;"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Thông báo</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Có đơn hàng mới</a>
                        <a class="dropdown-item" href="#">Hệ thống cập nhật</a>
                    </div>
                </li>

                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 0;">
                        <i class="nc-icon nc-settings-gear-65" style="font-size: 20px;"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Tài khoản</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                        <span class="dropdown-item disabled" style="color: #666; font-weight: bold;">
                            Xin chào, {{ Auth::check() ? Auth::user()->name : 'Admin' }}
                        </span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Hồ sơ cá nhân</a>

                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nc-icon nc-button-power"></i> Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>