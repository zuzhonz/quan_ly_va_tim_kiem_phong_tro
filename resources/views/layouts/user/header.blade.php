<header id="header-container" class="db-top-header">
    <!-- Header -->
    <div id="header">
        <div class="container-fluid">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="index.html"><img
                            src="{{\Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://yt3.ggpht.com/ytc/AMLnZu_LsaWhvhA9-Hbda7_l-pQJCN8wB6nbhYBiDW4C0A=s900-c-k-c0x00ffffff-no-rj'}}"
                            alt=""></a>
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
                        <li><a href="{{route('home')}}">Trang chủ</a>
                        </li>

                        <li><a href="{{route('motels')}}">Phòng trọ</a>
                        </li>
                        <li><a href="{{route('client_list_live_together')}}">Tìm người ở ghép</a>
                        </li>
                        <li><a href="{{ route('frontend_get_plans') }}">Bảng giá dịch vụ</a>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
            </div>
            <!-- Left Side Content / End -->
            <!-- Right Side Content / -->
            <div class="header-user-menu user-menu">
                <div class="header-user-name">
                    <span><img class="avatar_admin"
                               src="{{\Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://yt3.ggpht.com/ytc/AMLnZu_LsaWhvhA9-Hbda7_l-pQJCN8wB6nbhYBiDW4C0A=s900-c-k-c0x00ffffff-no-rj'}}"
                               alt=""></span>Chào,
                    {{\Illuminate\Support\Facades\Auth::user()->name}}!
                </div>
                <ul>
                    <li><a href="{{route('client.get_profile')}}">Thông tin cá nhân</a></li>
                    <li><a href={{route('client.change_password')}}>Đổi mật khẩu</a></li>
                    <li><a href="{{route('getRecharge')}}">Nạp tiền</a></li>
                    <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                </ul>
            </div>
            <!-- Right Side Content / End -->
        </div>
    </div>
    <!-- Header / End -->
</header>
