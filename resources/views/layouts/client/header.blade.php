<header id="header-container" class="header head-tr">
    <!-- Header -->
    <div id="header" class="head-tr bottom">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/client/images/logo-white-1.svg') }}"
                                              data-sticky-logo="images/logo-red.svg" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li><a class="a" href="{{route('home')}}">Trang chủ</a>
                        </li>

                        <li><a class="a" href="{{route('motels')}}">Phòng trọ</a>
                        </li>
                        <li><a class="a" href="{{route('client_list_live_together')}}">Tìm người ở ghép</a>
                        </li>
                        <li><a class="a" href="{{ route('frontend_get_plans') }}">Bảng giá dịch vụ</a>
                        </li>
                    </ul>
                </nav>
            </div>



            @if (\Illuminate\Support\Facades\Auth::user())
                <div class="header-user-menu user-menu add d-none d-none d-lg-none d-xl-flex sign ml-0">
                    <div class="header-user-name a">
                        <span><img class="avatar_admin"
                                src="{{ \Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://yt3.ggpht.com/ytc/AMLnZu_LsaWhvhA9-Hbda7_l-pQJCN8wB6nbhYBiDW4C0A=s900-c-k-c0x00ffffff-no-rj' }}"
                                alt=""></span>Chào, {{ \Illuminate\Support\Facades\Auth::user()->name }}!
                    </div>
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::user()->role_id === 3)
                            <li><a href="{{ route('getRecharge') }}">Tài khoản
                                    gốc: <span
                                        class="font-weight-bold">{{ number_format(\Illuminate\Support\Facades\Auth::user()->money, 0, ',', '.') }}</span>
                                    <i class="fa-brands fa-bitcoin text-warning"></i></a></li>
                            <li><a href="{{route('client.get_profile')}}">Thông tin cá nhân</a></li>
                            <li><a href="{{ route('getRecharge') }}">Nạp tiền</a></li>
                            <li><a href="{{ route('client.change_password') }}">Đổi mật khẩu</a></li>
                            <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                        @else
                            <li><a href="{{ route('admin_home') }}">Quản lý khu trọ</a></li>
                            <li><a href="{{ route('client.change_password') }}">Đổi mật khẩu</a></li>
                            <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="right-side d-none d-none d-lg-none d-xl-flex ml-0"
                     style="padding: 0 4px 0 5px;margin-top: 16px">
                    <!-- Header Widget -->
                    <div class="header-widget sign-in">
                        <div><a class="a" href="{{ route('get_login') }}">Đăng nhập</a></div>
                    </div>
                </div>


            @endif



        </div>
    </div>

</header>
