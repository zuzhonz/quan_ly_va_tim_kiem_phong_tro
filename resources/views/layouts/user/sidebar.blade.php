<div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
    <div class="user-profile-box mb-0">
        <div class="sidebar-header"><img src="{{asset('assets/client/images/logo-blue.svg')}}"
                                         alt="header-logo2.png"></div>
        <div class="header clearfix">
            <img
                src="{{\Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://yt3.ggpht.com/ytc/AMLnZu_LsaWhvhA9-Hbda7_l-pQJCN8wB6nbhYBiDW4C0A=s900-c-k-c0x00ffffff-no-rj'}}"
                alt="avatar"
                class="img-fluid profile-img avatar_admin">
        </div>
        <div class="active-user">
            <h2>    {{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
            <p class="text-white text-center">Tài khoản gốc: <span
                    class="current_money">{{number_format(\Illuminate\Support\Facades\Auth::user()->money, 0, ',', '.')}}</span>
                <i
                    class="fa-brands fa-bitcoin text-warning"></i></p>
        </div>
        <div class="detail clearfix">
            <ul class="mb-0">
                <li>
                    <a href="{{route('client.get_profile')}}">
                        <i class="fa fa-user"></i>Thông tin cá nhân
                    </a>
                </li>
                <li>
                    <a href="{{route('client_current_motel')}}">
                        <i class="fa fa-heart" aria-hidden="true"></i>Phòng trọ đang ở
                    </a>
                </li>
                <li>
                    <a href="{{route('client.history_appointment')}}">
                        <i class="fas fa-credit-card"></i>Đặt lịch xem phòng
                    </a>
                </li>
                <li>
                    <a href="{{route('getRecharge')}}">
                        <i class="fas fa-credit-card"></i>Nạp tiền
                    </a>
                </li>
                <li>
                    <a href="{{route('get_history_recharge')}}">
                        <i class="fas fa-paste"></i>Lịch sử nạp tiền
                    </a>
                </li>
                <li>
                    <a href="{{route('get_history_buy_plan')}}">
                        <i class="fas fa-paste"></i>Lịch sử dịch vụ
                    </a>
                </li>
                <li>
                    <a href="{{route('get_history_contact_by_user')}}">
                        <i class="fas fa-paste"></i>Lịch sử đăng ký ở ghép
                    </a>
                </li>
                <li>
                    <a href="{{route('get_history_deposit')}}">
                        <i class="fas fa-paste"></i>Lịch sử Đặt cọc
                    </a>
                </li>
                <li>
                    <a href="{{route('client_get_list_bill')}}">
                        <i class="fas fa-paste"></i>Hóa đơn
                    </a>
                </li>
                <li>
                    <a href="{{route('client.get_rotation')}}">
                        <i class="fas fa-paste"></i>Vòng quay
                    </a>
                </li>
                <li>
                    <a href="{{route('client.change_password')}}">
                        <i class="fa fa-lock"></i>Đổi mật khẩu
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>Đăng xuất
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
