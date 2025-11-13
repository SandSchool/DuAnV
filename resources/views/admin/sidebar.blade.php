<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset("public/backend") }}/img/logo-small.png">
            </div>
            <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
            Creative Tim
        <!-- <div class="logo-image-big">
                  <img src="{{ asset("public/backend") }}/img/logo-big.png">
                </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @php
                $route = Route::currentRouteAction(); // lay thong tin route hien tai
                $route_data = explode("@", $route);
                $controllerName = class_basename($route_data[0]); // ten controller
                $actionName = $route_data[1]; // ten action
                // echo "Current controller: {$controllerName} <br>";
                //echo "Current action: {$actionName}";
            @endphp
            <li @if($controllerName == "HomeController") class="active " @endif>
                <a href="{{ route('admin.home.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Trang chủ</p>
                </a>
            </li>
            <li @if($controllerName == "CategoryController") class="active " @endif>
                <a href="{{ route("admin.category.index") }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Quản lý danh mục</p>
                </a>
            </li>
            <li @if($controllerName == "ProductController") class="active " @endif>
                <a href="{{ route('admin.product.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Quản lý sản phẩm</p>
                </a>
            </li>
            <li>
                <a href="./notifications.html">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Notifications</p>
                </a>
            </li>
            <li>
                <a href="./user.html">
                    <i class="nc-icon nc-single-02"></i>
                    <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="./tables.html">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Table List</p>
                </a>
            </li>
            <li>
                <a href="./typography.html">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li class="active-pro">
                <a href="./upgrade.html">
                    <i class="nc-icon nc-spaceship"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li>
        </ul>
    </div>
</div>
