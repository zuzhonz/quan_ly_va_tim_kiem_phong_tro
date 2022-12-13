@extends('layouts.admin.main')

@section('title_page','Thông tin tài khoản')

@section('content')

    <div class="row">
        <div class="col-md-6 col-xl-5">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Chi tiết</h5>
                </div>
                <div class="card-body text-center">
                    <img
                        src="{{\Illuminate\Support\Facades\Auth::user()->avatar ?? 'https://lovablemessages.com/wp-content/uploads/2022/09/1662876858_685_Tron-bo-54-anh-anime-nam-den-moinhat-thang-9.jpg'}}"
                        alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="img-fluid rounded-circle mb-2"
                        width="128" height="128"/>
                    <h5 class="card-title mb-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                    <div class="text-muted mb-2">{{\Illuminate\Support\Facades\DB::table('roles')
->select('name')->where('id',\Illuminate\Support\Facades\Auth::user()->role_id)->first()->name}}</div>

                    <small>Tài khoản gốc: {{\Illuminate\Support\Facades\Auth::user()->money}} <i
                            class="fa-brands fa-bitcoin text-warning"></i></small>
                </div>
                <hr class="my-0"/>
                <div class="card-body">
                    <h5 class="h6 card-title">Thông tin cá nhân</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Email <a
                                href="#">{{\Illuminate\Support\Facades\Auth::user()->email}}</a>
                        </li>
                        <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Nơi ở <a
                                href="#">{{\Illuminate\Support\Facades\Auth::user()->address}}</a></li>

                        <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Số điện thoại <a
                                href="#">{{\Illuminate\Support\Facades\Auth::user()->phone_number}}</a></li>

                    </ul>
                </div>
                <hr class="my-0"/>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <h5 class="h6 card-title">Script message FB</h5>
                        <textarea name="script_fb" class="form-control" rows="10"
                                  placeholder="Copy paste đoạn mã vào đây">
                        {{ \Illuminate\Support\Facades\Auth::user()->script_fb}}
                    </textarea>
                        <button class="btn btn-primary mt-2">Lưu</button>
                    </form>


                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-7">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Hoạt động</h5>
                </div>
                <div class="card-body h-100">

                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar-5.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="Vanessa Tucker">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">5m ago</small>
                            <strong>Phạm Thu Trang</strong> đã đăng ký ở ghép phòng P301 - <strong>Nhà trọ Quang
                                Minh</strong><br/>
                            <small class="text-muted">Today 7:51 pm</small><br/>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>

                    <hr/>
                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="Charles Hall">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">30m ago</small>
                            <strong>Nguyễn Quyết Tiến</strong> đã bật trạng thái tìm người ghép phòng P302 - <strong>Nhà
                                trọ Vĩnh Hằng</strong><br/>
                            <small class="text-muted">Today 7:21 pm</small><br/>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>
                    <hr/>
                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar-4.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="Christina Mason">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1h ago</small>
                            <strong>Nguyễn Quyết Tiến</strong> đã rời phòng P301 - <strong>Nhà trọ Vĩnh
                                Hằng</strong><br/>
                            <small class="text-muted">Today 6:35 pm</small><br/>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>
                    <hr/>
                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar-4.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="Christina Mason">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1h ago</small>
                            <strong>Nguyễn Quyết Tiến</strong> đã rời phòng P301 - <strong>Nhà trọ Vĩnh
                                Hằng</strong><br/>
                            <small class="text-muted">Today 6:35 pm</small><br/>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>
                    <hr/>
                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar-2.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="William Harris">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">3h ago</small>
                            <strong>Hoàng Xuân Vũ</strong> đã đồng ý cho <strong>Ngô Văn Phong</strong> ở ghép phòng
                            P301 - <strong>Nhà trọ Quang Minh</strong><br/>
                            <small class="text-muted">Today 5:12 pm</small><br>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>
                    <hr/>
                    <div class="d-flex align-items-start">
                        <img src="{{asset('assets/admin/img/avatars/avatar-2.jpg')}}" width="36" height="36"
                             class="rounded-circle me-2"
                             alt="William Harris">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">3h ago</small>
                            <strong>Hoàng Xuân Vũ</strong> đã đồng ý cho <strong>Ngô Văn Phong</strong> ở ghép phòng
                            P301 - <strong>Nhà trọ Quang Minh</strong><br/>
                            <small class="text-muted">Today 5:12 pm</small><br>
                            <small class="text-muted"><a href="">Chi tiết</a></small><br/>
                        </div>
                    </div>
                    <hr/>
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
