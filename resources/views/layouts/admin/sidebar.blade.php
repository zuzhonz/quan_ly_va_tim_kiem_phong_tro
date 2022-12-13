<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Chợ Phòng Trọ</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" data-index="dashboard" data-href="{{ route('backend_get_dashboard') }}"
                   href="#">
                    <i class="fa-solid fa-chart-column"></i><span class="align-middle">Dashboard</span>
                </a>
            </li>
            @if(!\Illuminate\Support\Facades\Auth::user()->is_admin)
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="area" data-href="{{ route('backend_get_list_area') }}" href="#">
                        <i class="fa-solid fa-house-user"></i><span class="align-middle">Khu trọ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="bill" data-href="{{ route('backend_get_list_bill') }}"
                       href="#">
                        <i class="fa-solid fa-money-bill-transfer"></i><span class="align-middle">Hóa đơn</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="bill-a" data-href="{{ route('admin.get_list_appoint') }}"
                       href="#">
                        <i class="fa-solid fa-money-bill-transfer"></i><span
                            class="align-middle">Lịch hẹn xem trọ</span>
                    </a>
                </li>
            @endif
            <li class="sidebar-item">
                <a class="sidebar-link" data-index="deposit1" data-href="{{ route('backend_get_list_deposit') }}"
                   href="#">
                    <i class="fa-solid fa-money-bill-transfer"></i><span class="align-middle">Lịch sử đặt
                        cọc</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" data-index="deposit" data-href="{{ route('backend_get_history_withdraw') }}"
                   href="#">
                    <i class="fa-solid fa-money-bill-transfer"></i><span class="align-middle">Lịch sử rút tiền</span>
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="role" data-href="{{ route('list_role') }}" href="#">
                        <i class="fa-brands fa-critical-role"></i><span class="align-middle">Quyền</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="user" data-href="{{route('backend_user_getAll')}}" href="#">
                        <i class="fa-solid fa-users"></i><span
                            class="align-middle">Tài khoản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="service" data-href="{{route('backend_admin_get_list_plans')}}"
                       href="#">
                        <i class="fa-solid fa-earth-asia"></i><span class="align-middle">Gói dịch vụ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="location" data-href="{{route('backend_get_list_location')}}"
                       href="#">
                        <i class="fa-solid fa-earth-asia"></i><span class="align-middle">Địa điểm</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-index="search" data-href="{{route('backend_get_history_search')}}"
                       href="#">
                        <i class="fa-solid fa-earth-asia"></i><span class="align-middle">Thống kê tìm kiếm</span>
                    </a>
                </li>
            @endif
            <li class="sidebar-item">
                <a class="sidebar-link" data-index="recharge" data-href="{{route('backend_get_list_recharge')}}"
                   href="#">
                    <i class="fa-solid fa-piggy-bank"></i><span
                        class="align-middle">Lịch sử nạp tiền</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" data-index="plan"
                   data-href="{{ route("admin.plan-history.list") }}"
                   href="#">
                    <i class="fa-solid fa-clock-rotate-left"></i><span
                        class="align-middle">Lịch sử giao dịch</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
<script !src="">
    const a = document.querySelectorAll('.sidebar-link');
    const li = document.querySelectorAll('.sidebar-item');

    li.forEach(item => {
        item.classList.remove('active');
    })
    const currentPage = localStorage.getItem('sidebar_active') ? localStorage.getItem('sidebar_active') : 'dashboard';
    a.forEach(item => {
        const {index} = item.dataset;
        const {href} = item.dataset;
        item.addEventListener('click', (e) => {
            localStorage.setItem('sidebar_active', index);
            document.location = href;
        })


        if (index === currentPage) {
            const li = item.parentNode;

            li.classList.add('active');
        }
    });


</script>
