@extends('layouts.user.main')
@section('content')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#description',
        });
    </script>
    <style>
        /* @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap"); */

        body {
            background-color: #f5eee7;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }

        .card {
            border: none;
        }

        .card-header {
            padding: .5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: none;
        }

        .btn-light:focus {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
            box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
        }

        .form-control {
            height: 50px;
            border: 2px solid #eee;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #039be5;
            outline: 0;
            box-shadow: none;
        }

        .input {
            position: relative;
        }

        .input i {
            position: absolute;
            top: 16px;
            left: 11px;
            color: #989898;
        }

        .input input {
            text-indent: 25px;
        }
    </style>
    <div class="w-full overflow-hidden rounded-lg shadow-xs my-3">
        @if ( Session::has('recharge_success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('recharge_success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('recharge_error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('recharge_error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <p class="alert alert-success">
            Tin nóng: Website mới thêm tính năng tích điểm nhận vé quay khi mua gói.
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1000">Xem chi tiết</a>
        </p>
        <form>@csrf
            <div class="row">

                <div class="modal fade" id="exampleModal1000" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-size: 18px">Chi tiết sự
                                    kiện mua gói nhận vé quay
                                    miễn phí</h1>
                                <button type="button" class="btn-close" style="background-color: white;border: none"
                                        data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"
                                                                                      style="font-size: 24px"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="text-center table table-striped">
                                    <tr>
                                        <th>STT</th>
                                        <th>Loại gói</th>
                                        <th>Số điểm nhận</th>
                                    </tr>
                                    @foreach($plans as $plan)
                                        @if($plan->price > 0)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$plan->name}}</td>
                                                <td>{{10 / $plan->priority_level}} <i
                                                        class="fa-solid fa-gift text-danger"></i></td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                                <p><i class="fa-solid fa-triangle-exclamation"></i> Lưu ý: Sự kiện không áp dụng đối với
                                    gói
                                    tin thường miễn phí
                                </p>
                                <p>Quy đổi: 10 <i
                                        class="fa-solid fa-gift text-danger"></i> = 1 <i
                                        class="fa-solid fa-ticket text-warning"></i></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đã hiểu</button>
                            </div>
                        </div>
                    </div>
                </div>
                </p>
                <div class="col-8">
                    <div class="single-add-property">
                        <h3 class="mb-3">Thông tin bài đăng</h3>
                        <div class="property-form-group mb-3 px-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <label for="title">Tiêu đề</label>
                                        <input type="text" id="title" value="{{$data_post->title ?? ""}}">
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 col-md-12">
                                    <p class="no-mb">
                                        <label for="room_number">Mã phòng</label>
                                        <input type="text" value="{{$motels->room_number}}" id="room_number" readonly>
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <p class="no-mb">
                                        <label for="price">Giá/tháng</label>
                                        <input type="text" value="{{number_format($motels->price,0,",",".")}}"
                                               id="price" readonly>
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <p class="no-mb">
                                        <label for="">Số người ở hiện tại</label>
                                        <input type="number" value="{{$number_people}}" id="number_people" readonly>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <label for="description">Mô tả</label>
                                        <textarea id="description">
                                            {!!isset($data_post->description) ? $data_post->description :  $motels->description  !!}
                                        </textarea>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <p class="no-mb">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" value="{{$motels->address}}"
                                               id="address" readonly>
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="address">Đối tượng ở ghép</label>
                                    <div class="nice-select form-control wide" style="margin-top: 2px !important;"
                                         tabindex="0"><span class="current" id="gender_current">Giới tính</span>
                                        <ul class="list">
                                            <li data-value="1"
                                                class="option {{ (isset($data_post) && $data_post->gender == 1) ? 'selected' : ''}}"
                                                onclick="getGender(event)">
                                                Nam
                                            </li>
                                            <li data-value="2"
                                                class="option {{ (isset($data_post) && $data_post->gender == 2) ? 'selected' : ''}}"
                                                onclick="getGender(event)">
                                                Nữ
                                            </li>
                                            <li data-value="3"
                                                class="option {{ (isset($data_post) && $data_post->gender == 3) ? 'selected' : ''}}"
                                                onclick="getGender(event)">
                                                Tất cả
                                            </li>
                                        </ul>
                                        <input type="hidden" name="" id="inp_gender_current"
                                               value="{{ (isset($data_post) ? $data_post->gender : "")}}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3 style="color:#FF385C;">Thông tin liên hệ</h3>
                        <div class="property-form-group px-3">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <p>
                                        <label for="con-name">Họ tên</label>
                                        <input type="text" id="con-name" name="" value="{{$user->name}}">
                                        <input type="hidden" id="" name="user_id" value="{{$user->id}}">
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <p class="no-mb first">
                                        <label for="con-email">Email</label>
                                        <input type="email" value="{{$user->email}}">
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <p class="no-mb last">
                                        <label for="con-phn">Số điện thoại</label>
                                        <input type="text" value="{{$user->phone_number}}">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property mb-1" style="height: 400px">
                        <h3 style="color:#FF385C;">Thông tin đẩy tin</h3>
                        <div class="property-form-group row px-3">
                            <div class="mb-3 col-6">
                                <label for="address">Chọn gói đăng tin</label>
                                <div class="nice-select form-control wide" style="margin-top: 2px !important;"
                                     tabindex="0"><span class="current">Chọn gói đăng tin</span>

                                    <ul class="list">

                                        @foreach ($plans as $plan)
                                            <li id="post_plan" onclick="getData(event)" data-value="{{$plan->id}}"
                                                data-price="{{$plan->price}}" class="option">{{$plan->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <p class="no-mb">
                                    <label for="" class="mb-2">Số ngày đăng bài</label>
                                    <input type="number" placeholder="Số ngày đăng bài" id="post_day">
                                    <p id="message" class="text-danger"></p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex flex-column">
                        <div class="single-add-property">
                            <div>
                                <h3>Tài khoản</h3>
                                <div class="px-3">
                                    <div class="property-form-group d-flex flex-row justify-content-between p-0 mb-3">
                                        <span>Tài khoản gốc:</span>
                                        <span class="la la-envelope-o">
                                            <span>{{$user->money}}</span>&nbsp<i class="fa-brands fa-bitcoin"
                                                                                 aria-hidden="true"
                                                                                 style="color:#FF9801;"></i>
                                        </span>

                                    </div>
                                    <p>Số điểm thưởng có: {{$numberTicketUser}} <i
                                            class="fa-solid fa-gift text-danger"></i></p>
                                    <div class="d-flex flex-column">
                                        <a href="{{route('backend_get_form_recharge')}}" class="btn btn-primary">Nạp
                                            thêm tiền</a>
                                        <p id="notification" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($current_plan_motel)
                            <div class="single-add-property">
                                <div class="mb-4">
                                    <h3>Gói hiện tại</h3>
                                    <div class="property-form-group column px-3">
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Loại tin</td>
                                                <td class="font-weight-bold">{{$current_plan_motel->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Thời gian(ngày)</td>
                                                <td class="font-weight-bold">{{$current_plan_motel->day}}</td>
                                            </tr>
                                            <tr>
                                                <td>Giá (ngày)</td>
                                                <td class="text-success font-weight-bold"><span id="old_price">
                                                {{$current_plan_motel->price}}</span> <i
                                                        class="fa-brands fa-bitcoin text-warning"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Số ngày còn lại</td>
                                                <td class="text-danger font-weight-bold">
                                                    <span>{{\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Thành tiền</td>
                                                <td class="text-danger font-weight-bold">
                                                    <span id="money_more">0</span> <i
                                                        class="fa-brands fa-bitcoin text-warning"></i>
                                                </td>
                                            <tr>
                                        </table>
                                        <input type="number" class="form-control my-2" id="date_more" name="date_more"
                                               placeholder="Nhập số ngày muốn gia hạn" {{\Illuminate\Support\Facades\Auth::user()->money ? '' : 'disabled'}}>


                                        <p class="text-secondary text-sm my-2 text-danger" id="notification2"></p>
                                        <button data-toggle="modal" data-target="#exampleModal2" type="button"
                                                class="btn btn-success" id="btn_more" style="width: 100%"
                                            {{\Illuminate\Support\Facades\Auth::user()->money ? '' : 'disabled'}} disabled>Gia
                                            hạn ngay
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="single-add-property">
                            <div class="mb-4">
                                <h3>Chi phí dự kiến</h3>
                                <div class="property-form-group column px-3">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Loại tin</td>
                                            <td class="font-weight-bold" id="show_plan"></td>
                                        </tr>
                                        <tr>
                                            <td>Thời gian(ngày)</td>
                                            <td class="font-weight-bold" id="show_day">0</td>
                                        </tr>
                                        <tr>
                                            <td>Giá (ngày)</td>
                                            <td class="text-success font-weight-bold"><span id="show_money"> 0</span>
                                                <i class="fa-brands fa-bitcoin text-warning"></i></td>
                                        </tr>
                                        @if($current_plan_motel)
                                            <tr>
                                                <td>Tiền thừa của gói trước</td>
                                                <td class="text-success font-weight-bold"><span
                                                        id="moneyO">{{$current_plan_motel->price * (\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}</span>
                                                    <i class="fa-brands fa-bitcoin text-warning"></i></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Phí dịch vụ</td>
                                            <td class="text-danger font-weight-bold"><span id="show_total">0</span>
                                                <i class="fa-brands fa-bitcoin text-warning"></i></td>
                                        </tr>
                                    </table>
                                    <div class="text-center">
                                        @if($current_plan_motel)
                                            <p class="text-secondary text-sm my-2 text-danger" id="notification"></p>

                                            <input type="hidden" name="old_day" id="old_day"
                                                   value="{{\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1}}">
                                            <input type="hidden" id="money_plan_old" name="money_plan_old"
                                                   value="{{$current_plan_motel->price * ( \Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}">
                                            <button
                                                type="button"
                                                class="btn btn-success"
                                                id="tt"
                                                disabled style="width: 100%"
                                                data-toggle="modal"
                                                data-target="#exampleModal" {{$current_plan_motel->priority_level === 1 ? 'disabled' : '' }} >
                                                Thay đổi gói
                                            </button>
                                        @else
                                            <p class="text-secondary text-sm my-2 text-danger" id="notification"></p>
                                            <button type="button" class="btn btn-success" id="tt" disabled
                                                    style="width: 100%"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal">Thanh toán
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="data_plan" value="{{$data_plan}}">
            <input type="hidden" id="money_user" value="{{Auth::user()->money}}">
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('client_save_post_live_together', ['motel_id'=>$motels->motel_id]) }}"
                          method="post">
                        @csrf
                        <input type="hidden" id="title1" name="title">
                        <input type="hidden" id="motel_id1" name="motel_id" value="{{$motels->motel_id}}">
                        <input type="hidden" id="number_people1" name="number_people">
                        <input type="hidden" id="description1" name="description">
                        <input type="hidden" id="gender1" name="gender">

                        {{-- <input type="hidden" id="user_id1" name="user_id" value="{{Auth::user()->id}}"> --}}
                        <input type="hidden" id="post_plan1" name="post_plan">
                        <input type="hidden" id="post_day1" name="post_day">
                        <input type="hidden" id="post_money1" name="post_money">


                        @if($current_plan_motel)
                            <input type="hidden" name="plan_id_old" value="{{$current_plan_motel->plan_id}}">
                            <input type="hidden" name="ID" value="{{$current_plan_motel->ID}}">
                            <input type="hidden" name="old_day" id="old_day"
                                   value="{{\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1}}">
                            <input type="hidden" id="money_plan_old" name="money_plan_old"
                                   value="{{$current_plan_motel->price * ( \Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}">
                            <input type="hidden" id="gender3" name="gender">

                            <input type="hidden" id="change_plan" name="change_plan" value="123132">
                        @endif
                        {{-- <input type="hidden" id="post_day" name="post_day"> --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận thanh toán</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc muốn đăng phòng trọ này lên mục tìm kiếm ở website chúng tôi ?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Đồng ý</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        @if($current_plan_motel)

            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('client_save_post_live_together', ['motel_id'=>$motels->motel_id]) }}"
                              method="post">
                            @csrf
                            <input type="hidden" id="title2" name="title">
                            <input type="hidden" id="motel_id2" name="motel_id" value="{{$motels->motel_id}}">
                            <input type="hidden" id="number_people2" name="number_people">
                            <input type="hidden" id="description2" name="description">
                            <input type="hidden" id="gender2" name="gender">

                            <input type="hidden" name="gia_han" value="true">
                            <input type="hidden" id="post_money2" name="post_money">
                            <input type="hidden" id="post_day_more" name="post_day_more">
                            <input type="hidden" id="plan_id_old" name="plan_id_old"
                                   value="{{$current_plan_motel->plan_id}}">
                            <input type="hidden" name="ID" value="{{$current_plan_motel->ID}}">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận gia hạn</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc gia hạn bài đăng phòng trọ này trên mục tìm kiếm ở website chúng tôi ?
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Đồng ý</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <script>
            const money_more = document.getElementById('money_more');
            const old_price = document.getElementById('old_price');
            const data = JSON.parse(document.getElementById('data_plan').value);
            const post_plan = document.getElementById('post_plan');
            const post_day = document.getElementById('post_day');

            const show_plan = document.getElementById('show_plan');
            const show_day = document.getElementById('show_day');
            const show_money = document.getElementById('show_money');
            const show_total = document.getElementById('show_total');
            const money_user = document.getElementById('money_user');
            const date_more = document.getElementById('date_more');
            const gender_current = document.getElementById('gender_current');
            const inp_gender_current = document.getElementById('inp_gender_current');
            var money_temp = 0;

            // console.log((typeof(document.getElementById('plan_id_old')) != 'undefined' && document.getElementById('plan_id_old') != null));
            if (inp_gender_current.value == 1) {
                gender_current.innerText = "Nam";
            } else if (inp_gender_current.value == 2) {
                gender_current.innerText = "Nữ";
            } else if (inp_gender_current.value == 3) {
                gender_current.innerText = "Tất cả";
            } else {
                gender_current.innerText = "Giới tính";
            }
            if ((typeof (document.getElementById('plan_id_old')) != 'undefined' && document.getElementById('plan_id_old') != null) == true) {
                document.getElementById('gender2').value = inp_gender_current.value; //gia hạn
                document.getElementById('gender3').value = inp_gender_current.value; //đổi gói
            }


            function getGender(e) {
                document.getElementById('gender1').value = e.target.dataset.value
            }

            function changeDisable(total) {
                if(total == 0){
                    document.getElementById('tt').setAttribute('disabled', 'true');
                }
                else if (Number(total) > Number(money_user.value)) {
                    document.getElementById('tt').setAttribute('disabled', 'true');
                    document.getElementById('notification').innerText = 'Tài khoàn của bạn không đủ để thực hiện giao dịch.Vui lòng nạp tiền để tiếp tục giao dịch';
                } else {
                    document.getElementById('tt').removeAttribute('disabled');
                    document.getElementById('notification').innerText = '';
                }
            }
            function changeDisable2(total) {
                if(total == 0){
                    document.getElementById('btn_more').setAttribute('disabled', 'true');
                }
                else if (Number(total) > Number(money_user.value)) {
                    document.getElementById('btn_more').setAttribute('disabled', 'true');
                    document.getElementById('notification').innerText = 'Tài khoàn của bạn không đủ để thực hiện giao dịch.Vui lòng nạp tiền để tiếp tục giao dịch';
                } else {
                    document.getElementById('btn_more').removeAttribute('disabled');
                    document.getElementById('notification').innerText = '';
                }
            }

            function getData(e) {
                var post_plan_value = e.target.dataset.value;
                var post_plan_price = e.target.dataset.price;
                var post_plan_title = e.target.innerText;
                data.forEach(e => {
                    if (post_plan_value != 0) {
                        if (post_plan_value == e.id) {
                           
                            show_plan.innerText = post_plan_title;
                            show_money.innerText = post_plan_price
                            money_temp = post_plan_price;
                            show_total.innerText = money_temp * post_day.value
                            document.getElementById('post_plan1').value = e.id
                            if (Number(post_plan_price) === 0) {
                                post_day.setAttribute('value', 2);
                                post_day.setAttribute('readonly', 'true');
                                document.getElementById('post_day1').value = 2;
                                show_day.innerText = 2;
                                show_total.innerText = money_temp * 2
                                document.getElementById('post_money1').setAttribute('value', money_temp * 2);
                            } else {
                                document.getElementById('post_day1').value = +post_day.value;
                                post_day.removeAttribute('readonly');
                            }
                            //nếu có trường plan_id_old thì mới thực hiện lấy dữ liệu để kiểm tra
                            if ((typeof (document.getElementById('plan_id_old')) != 'undefined' && document.getElementById('plan_id_old') != null) == true) {
                                const currentPlanId = document.querySelector('#plan_id_old').value;
                                if (currentPlanId && currentPlanId == post_plan_value) {
                                    document.getElementById('tt').setAttribute('disabled', 'true');
                                    document.getElementById('post_day').setAttribute('disabled', 'true');
                                    document.getElementById('message').innerText = 'Hãy chọn gói đăng bài khác !'
                                }else{
                                    changeDisable(money_temp * post_day.value);
                                    document.getElementById('post_day').removeAttribute('disabled', 'true');
                                    document.getElementById('message').innerText = '';
                                }
                            }
                        }
                    } else {
                        show_plan.innerText = '';
                        show_money.innerText = 0
                        money_temp = 0
                        show_total.innerText = money_temp * post_day.value
                        changeDisable(money_temp * post_day.value);
                    }
                });
                document.getElementById('title1').value = document.getElementById('title').value
                document.getElementById('description1').value = document.getElementById('description').value
                document.getElementById('number_people1').value = document.getElementById('number_people').value
            }

            post_day.oninput = function () {
                document.getElementById('post_day1').value = +post_day.value;
                show_day.innerText = post_day.value;
                show_total.innerText = money_temp * post_day.value
                document.getElementById('post_money1').setAttribute('value', money_temp * post_day.value);
                changeDisable(money_temp * post_day.value,post_day.value);
            }

            if ((typeof (document.getElementById('plan_id_old')) != 'undefined' && document.getElementById('plan_id_old') != null) == true) {
                date_more.oninput = function () {
                    money_more.innerText = old_price.innerText * date_more.value
                    document.getElementById('title2').value = document.getElementById('title').value
                    document.getElementById('description2').value = document.getElementById('description').value
                    document.getElementById('number_people2').value = document.getElementById('number_people').value
                    document.getElementById('post_day_more').value = date_more.value
                    document.getElementById('post_money2').setAttribute('value', old_price.innerText * date_more.value);
                    changeDisable2(old_price.innerText * date_more.value);
                }
            }


        </script>

@endsection
