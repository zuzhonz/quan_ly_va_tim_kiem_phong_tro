@extends('layouts.admin.main')

@section('title_page', 'Đăng bài')
@section('content')
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <script>
        tinymce.init({
            selector: 'textarea#desc',
        });
    </script>

    <div class="row gap-2" style="display: grid;grid-template-columns: 8fr 3fr;">
        <div class="bg-white p-4 shadow-lg rounded-4">
            <p class="alert alert-success">
                Tin nóng: Website mới thêm tính năng tích điểm nhận vé quay khi mua gói.
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1000">Xem chi tiết</a>
            <div class="modal fade" id="exampleModal1000" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết sự kiện mua gói nhận vé quay
                                miễn phí</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <p><i class="fa-solid fa-triangle-exclamation"></i> Lưu ý: Sự kiện không áp dụng đối với gói
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
            <h5>Thông tin phòng</h5>
            <input type="hidden" value="{{$data}}" id="data">
            <form action="">
                <div class="row">
                    <div class="col-4">
                        <label for="">Mã Phòng</label>
                        <input type="text" class="form-control" disabled value="{{$motel->room_number}}">
                    </div>
                    <div class="col-4">
                        <label for="">Giá (tháng)</label>
                        <input type="text" class="form-control" disabled value="{{$motel->price}}">
                    </div>
                    <div class="col-4">
                        <label for="">Đối tượng thuê</label>
                        <input type="text" class="form-control" disabled
                               value="{{json_decode($motel->services)->actor}}">
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-3">
                        <label for="">Ngày có thể vào ở</label>
                        @if($motel->end_time)
                            <input type="text" class="form-control" disabled
                                   value="{{\Carbon\Carbon::parse($motel->end_time)->format('d/m/Y')}}">
                        @else
                            <input type="date" class="form-control">
                        @endif
                    </div>
                    <div class="col-4">
                        <label for="">Số người ở tối đa</label>
                        <input type="text" class="form-control" value="{{$motel->max_people ?? 'Không giới hạn'}}"
                               disabled>
                    </div>
                    <div class="col-5">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" value="{{$motel->address}}" disabled>
                    </div>
                </div>
                <div class="my-4">
                    <label for="">Khu trọ</label>
                    <input type="text" class="form-control" value="Nhà trọ quang minh" disabled>
                </div>
                <div>
                    <label for="">Mô tả</label>
                    <textarea name="" class="form-control" id="desc" cols="30" rows="10" disabled>
                        {!! $motel->description !!}
                    </textarea>
                </div>
                <div class="text-center">
                    <a href="" class="btn btn-link">Xem thêm</a>
                </div>
                <div class="my-4 row">
                    <div class="col-7">
                        <label for="">Lựa chọn gói đăng bài</label>
                        <select class="form-control" name="plan" id="plan">
                            <option value="0">Lựa chọn gói bài đăng</option>
                            @foreach($plans as $plan)
                                <option value="{{$plan->id}}" data-title="{{$plan->name}}"
                                        data-price="{{$plan->price}}">{{$plan->name}}</option>
                            @endforeach
                        </select>
                        <p class="my-2 ms-2 text-sm">Xem chi tiết các gói dịch vụ.Click vào <a
                                href="https://www.facebook.com/" target="_blank" class="text-danger">đây</a></p>
                    </div>
                    <div class="col-5">
                        <label for="">Nhập số ngày đăng bài</label>
                        <input type="number" id="day" name="day" placeholder="Nhập số ngày đăng bài.VD: 1"
                               class="form-control">
                    </div>
                </div>
            </form>
        </div>
        <div class="" style="display: grid;grid-template-rows: 0.25fr 0.25fr 0.5fr;gap: 12px;">
            <div class="bg-white p-4 shadow-lg rounded-4">
                <h6 class="">Tài khoản</h6>
                <p class=" font-weight-bold">Tài khoản gốc: <span
                        id="currentMoney">{{\Illuminate\Support\Facades\Auth::user()->money}}</span> <i
                        class="fa-brands fa-bitcoin text-warning"></i></p>
                <p>Số điểm thưởng hiện có: <span
                        id="point">{{$gift}}</span>
                    <i
                        class="fa-solid fa-gift text-danger"></i> <a
                        href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2000">Đổi ngay</a>
                <p>Số vé
                    có: {{$numberTicket}}
                    <i
                        class="fa-solid fa-ticket text-warning"></i></p>
                <div class="modal fade" id="exampleModal2000" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi điểm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin_swap_gift_to_ticket')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <p>Điểm hiện có: {{$gift}} <i
                                            class="fa-solid fa-gift text-danger"></i></p>
                                    <div class="row">
                                        <div class="col-5 form-group">
                                            <label for="">Số điểm muốn đổi</label>
                                            <input type="number" step="10" name="gift" id="gift" class="form-control">
                                        </div>
                                        <div class="col-2 text-center">
                                            <i class="fa-solid fa-right-left"></i>
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="">Số vé nhận được</label>
                                            <input type="number" name="ticket" id="ticket" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <p id="messageSwapTicket"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button type="submit" id="swapTicket" class="btn btn-primary">Đổi ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </p>
                <div class="text-center">
                    <button class="btn btn-info" style="width: 100%">Nạp tiền ngay</button>
                </div>
            </div>
            @if($current_plan_motel)
                <div class="bg-white p-4 shadow-lg rounded-4">
                    <h6 class="">Gói hiện tại</h6>
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
                            <td class="text-success font-weight-bold"><span
                                    id="old_price"> {{$current_plan_motel->price}}</span> <i
                                    class="fa-brands fa-bitcoin text-warning"></i></td>
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
                    </table>
                    <input type="text" class="form-control my-2"
                           {{\Illuminate\Support\Facades\Auth::user()->money ? '' : 'disabled'}}  id="date_more"
                           name="date_more"
                           placeholder="Nhập số ngày muốn gia hạn">
                    <p class="text-secondary text-sm my-2 text-danger" id="notification2"></p>
                    <button
                        data-toggle="modal"
                        data-target="#exampleModal2"
                        type="button"
                        class="btn btn-success"
                        {{\Illuminate\Support\Facades\Auth::user()->money ? '' : 'disabled'}} id="btn_more"
                        style="width: 100%"
                    >Gia hạn ngay
                    </button>
                </div>
            @endif
            <div class="bg-white p-4 shadow-lg rounded-4">
                <div>
                    <h6 class="">Chi phí dự kiến</h6>
                    <table class="table table-striped">
                        <tr>
                            <td>Loại tin</td>
                            <td class="font-weight-bold" id="title"></td>
                        </tr>
                        <tr>
                            <td>Thời gian(ngày)</td>
                            <td class="font-weight-bold" id="day_plan"></td>
                        </tr>
                        <tr>
                            <td>Giá (ngày)</td>
                            <td class="text-success font-weight-bold"><span id="money"> 0</span> <i
                                    class="fa-brands fa-bitcoin text-warning"></i></td>
                        </tr>
                        @if($current_plan_motel)
                            <tr>
                                <td>Tiền thừa của gói trước</td>
                                <td class="text-success font-weight-bold"><span
                                        id="moneyO">{{$current_plan_motel->price * (\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}</span>
                                    <i
                                        class="fa-brands fa-bitcoin text-warning"></i></td>
                            </tr>
                        @endif
                        <tr>
                            <td>Phí dịch vu</td>
                            <td class="text-danger font-weight-bold"><span id="total">0</span> <i
                                    class="fa-brands fa-bitcoin text-warning"></i></td>
                        </tr>
                    </table>

                    <div class="text-center">
                        @if($current_plan_motel)
                            <p class="text-secondary text-sm my-2 text-danger" id="notification"></p>
                            <button type="button" class="btn btn-success" id="tt" disabled style="width: 100%"
                                    data-toggle="modal"
                                    data-target="#exampleModal50000" {{$current_plan_motel->priority_level === 1 ? 'disabled' : '' }} >
                                Thay đổi gói
                            </button>
                        @else
                            <p class="text-secondary text-sm my-2 text-danger" id="notification"></p>
                            <button type="button" class="btn btn-success" id="tt" disabled  style="width: 100%"
                                    data-toggle="modal"
                                    data-target="#exampleModal50000">Thanh toán
                            </button>
                        @endif
                            <div class="modal fade" id="exampleModal50000" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" id="post_plan_id" name="post_plan_id">
                                            <input type="hidden" id="post_money" name="post_money">
                                            @if($current_plan_motel)
                                                <input type="hidden" id="ID" name="ID" value="{{$current_plan_motel->ID}}">
                                                <input type="hidden" id="plan_id_o" name="plan_id_o" value="{{$current_plan_motel->plan_id}}">
                                                <input type="hidden" name="old_day" id="old_day"
                                                       value="{{\Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1}}">
                                                <input type="hidden" id="money_plan_old" name="money_plan_old"
                                                       value="{{$current_plan_motel->price * ( \Carbon\Carbon::parse($current_plan_motel->created_at_his)->addDays($current_plan_motel->day)->diffInDays(\Carbon\Carbon::now()) + 1)}}">
                                                <input type="hidden" id="change_plan" name="change_plan" value="123132">
                                            @endif
                                            <input type="hidden" id="post_day" name="post_day">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($current_plan_motel)
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="gia_han" value="true">
                        <input type="hidden" id="plan_id_o" name="plan_id_o" value="{{$current_plan_motel->plan_id}}">
                        <input type="hidden" id="post_money_more" name="post_money_more">
                        <input type="hidden" id="post_day_more" name="post_day_more">
                        <input type="hidden" id="ID" name="ID" value="{{$current_plan_motel->ID}}">
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
    <a class="btn btn-primary my-4 text-light"
       href="{{route('admin.motel.info',['id' => $params['area_id'],'idMotel' => $params['motel_id']])}}">Quay lại</a>
    <script>
        const data = JSON.parse(document.getElementById('data').value);
        const day = document.getElementById('day');
        const plan = document.getElementById('plan');
        const title = document.getElementById('title');
        const day_plan = document.getElementById('day_plan');
        const money = document.getElementById('money');
        const total = document.getElementById('total');
        const currentMoney = document.getElementById('currentMoney').innerText;
        const date_more = document.getElementById('date_more');
        const btn_more = document.getElementById('btn_more');
        const old_price = document.getElementById('old_price');
        const ticket = document.getElementById('ticket');
        const gift = document.getElementById('gift');
        const point = document.getElementById('point');
        const swapTicket = document.getElementById('swapTicket');
        const messageSwapTicket = document.getElementById('messageSwapTicket');
        if (date_more) {

            date_more.addEventListener('keyup', (e) => {
                document.getElementById('money_more').innerText = e.target.value * old_price.innerText;
                if (Number(e.target.value) * old_price.innerText > currentMoney) {
                    btn_more.setAttribute('disabled', 'true');
                    document.getElementById('notification2').innerText = 'Tài khoàn của bạn không đủ để thực hiện giao dịch.Vui lòng nạp tiền để tiếp tục giao dịch';
                } else {
                    document.getElementById('post_money_more').value = Number(e.target.value) * old_price.innerText;
                    document.getElementById('post_day_more').value = e.target.value;
                    btn_more.removeAttribute('disabled');
                    document.getElementById('notification2').innerText = '';

                }
            })
        }
        gift.addEventListener('change', (e) => {
            if (e.target.value > Number(point.innerText)) {
                swapTicket.setAttribute('disabled', 'true');
                gift.style.border = '2px solid red';
                messageSwapTicket.innerHTML = `<i class="fa-solid fa-triangle-exclamation text-danger"></i> Bạn không đủ điểm để thực hiện hành động này !`;
            } else if (e.target.value < 0) {
                swapTicket.setAttribute('disabled', 'true');
                gift.style.border = '2px solid red';
                messageSwapTicket.innerHTML = `<i class="fa-solid fa-triangle-exclamation text-danger"></i> Dữ liệu không hợp lệ !`;
            } else {
                gift.value = e.target.value - e.target.value % 10;
                ticket.value = (e.target.value - e.target.value % 10) / 10;
                gift.style.border = '1px solid #ced4da';
                messageSwapTicket.innerText = '';
                swapTicket.removeAttribute('disabled');
            }

        })

        function reset() {
            title.innerText = '';
            money.innerText = '';
        }

        plan.addEventListener('change', (e) => {
            if (!e.target.value) {
                reset();
                return;
            }
            if (document.getElementById('plan_id_o') && e.target.value == document.getElementById('plan_id_o').value) {
                document.getElementById('tt').setAttribute('disabled', 'true');
                document.getElementById('notification').innerText = 'Vui lòng chọn gói bài đăng khác'
                return;
            }

            document.getElementById('post_plan_id').value = e.target.value;
            const obj = data.find(item => item.id === +e.target.value);
            title.innerText = obj.title;
            money.innerText = obj.price;
            if (obj.more) {
                day_plan.innerText = 2;
                day.value = 2;
                day.setAttribute('disabled', true);
            } else {
                day_plan.innerText = day.value;
                day.removeAttribute('disabled');
            }


            const abc = document.getElementById('moneyO') ? Number(document.getElementById('moneyO').innerText) : 0;
            total.innerText = obj.price * day.value;
            document.getElementById('post_money').value = obj.price * day.value;
            if (Number(total.innerText) > Number(currentMoney) + abc) {
                document.getElementById('tt').setAttribute('disabled', 'true');
                document.getElementById('notification').innerText = 'Tài khoàn của bạn không đủ để thực hiện giao dịch.Vui lòng nạp tiền để tiếp tục giao dịch';
            } else {

                document.getElementById('tt').removeAttribute('disabled');
                document.getElementById('notification').innerText = '';

            }
        })

        day.addEventListener('keyup', (e) => {
            day_plan.innerText = e.target.value;
            total.innerText = money.innerText * day_plan.innerText;

            if (document.getElementById('plan_id_o') && plan.value == document.getElementById('plan_id_o').value) {
                document.getElementById('tt').setAttribute('disabled', 'true');
                document.getElementById('notification').innerText = 'Vui lòng chọn gói bài đăng khác'
                return;
            }
            document.getElementById('post_day').value = e.target.value;

            const abc = document.getElementById('moneyO') ? Number(document.getElementById('moneyO').innerText) : 0;
            console.log(currentMoney)
            if (Number(total.innerText) > Number(currentMoney) + abc) {
                document.getElementById('tt').setAttribute('disabled', 'true');
                document.getElementById('notification').innerText = 'Tài khoàn của bạn không đủ để thực hiện giao dịch.Vui lòng nạp tiền để tiếp tục giao dịch';
            } else {
                document.getElementById('tt').removeAttribute('disabled');
                document.getElementById('notification').innerText = '';

            }
            document.getElementById('post_money').value = money.innerText * day_plan.innerText;
        });


    </script>
@endsection
