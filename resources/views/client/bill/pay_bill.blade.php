@extends('layouts.client.main')

@section('content')
    <style>
        section.single-proper.details {
            padding: 10rem 0 !important;
        }

        p {
            font-size: 17px
        }

        .hp-6 .btn {
            background: none;
            /* color: #fff;  */
        }

        .btn-success {
            color: #fff !important;
            background-color: #198754 !important;
            border-color: #198754 !important;
        }

        .btn-success:hover {
            color: #fff !important;
            background-color: #157347 !important;
            border-color: #146c43 !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .btn-primary:hover {
            color: #fff !important;
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
        }

        .inner-pages .form-control {
            padding: 0.7rem;
            border: 1px solid #dddddd;
        }
    </style>
    <section class="single-proper blog details">
        <div class="container">

            <section>
                <div class="row p-4">
                    <div>
                        <h3> Hóa đơn tiền phòng {{ $item->room_number }} </h3>
                    </div>
                    <div class="container bootstrap snippets bootdeys">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default invoice" id="invoice">
                                    <div class="panel-body">
                                        <div class="row table-row">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th class="col-4">Dịch vụ</th>
                                                    <th class="text-right col-2">Số lượng/cũ</th>
                                                    <th class="text-right col-2">Số lượng/mới</th>
                                                    <th class="text-right col-2">Giá tiền/số</th>
                                                    <th class="text-right col-4">Thành tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Tiền điện</td>
                                                    <td class="text-right">{{ $item->number_elec_old }}</td>
                                                    <td class="text-right">{{ $item->number_elec }}</td>
                                                    <td class="text-right">
                                                        {{ number_format($item->electric_money, 0, ',', '.') }} đ
                                                    </td>
                                                    <td class="text-right">
                                                        {{ number_format($item->tien_dien, 0, ',', '.') }} đ
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Tiền nước</td>
                                                    <td class="text-right">{{ $item->number_warter_old }}</td>
                                                    <td class="text-right">{{ $item->number_warter }}</td>
                                                    <td class="text-right">
                                                        {{ number_format($item->warter_money, 0, ',', '.') }} đ
                                                    </td>
                                                    <td class="text-right">
                                                        {{ number_format($item->tien_nuoc, 0, ',', '.') }} đ
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tiền trọ</td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right">
                                                        {{ number_format($item->price, 0, ',', '.') }} đ
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tiền Wifi</td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right">
                                                        {{ number_format($item->wifi, 0, ',', '.') }} đ
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 text-right pull-right invoice-total">
                                                <p>Tổng : {{ number_format($item->tong, 0, ',', '.') }} đ</p>
                                                <p>Thành xu : {{ number_format($item->tong / 1000, 0, ',', '.') }} </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mx-4 ">
                    <h3 class="mb-5">Lựa chọn hình thức thanh toán</h3>
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Đóng</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Đóng</span>
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


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <ul class="nav nav-tabs mx-2" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="fw-bolder nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Thanh toán bằng xu
                                    </button>
                                </li>
                                <li class="fw-bolder nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Thanh toán bằng chuyển
                                        khoản
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mx-2" id="pills-tabContent">
                                {{-- Đặt cọc bằng xu --}}
                                <div class="tab-pane fade show active col-6" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <div class="d-flex flex-row justify-content-between mr-4">
                                        <li style="list-style:none ;">
                                            <p class="">Tài khoản gốc: <span id="user_money"
                                                                             class="font-weight-bold">{{ number_format(\Illuminate\Support\Facades\Auth::user()->money, 0, ',', '.') }}</span>
                                                <i class="fa-brands fa-bitcoin text-warning"></i>
                                            </p>
                                        </li>
                                        <button class="btn btn-primary">Nạp thêm tiền</button>

                                    </div>

                                    @if ($item->status == 2)
                                        <p class="text-success my-4">Hóa đơn đã được thanh toán</p>
                                    @elseif($item->status == 3)
                                        <div class="alert alert-success alert-dismissible mt-3" role="alert">
                                            <strong>Hóa đơn đang được xác nhận thanh toán</strong>
                                            <button type="button" class="close" data-bs-dismiss="alert"
                                                    aria-label="Close">
                                                {{-- <span aria-hidden="true">&times;</span> --}}
                                                {{-- <span class="sr-only">Đóng</span> --}}
                                            </button>
                                        </div>
                                    @else
                                        <form action="{{ route('client_pay_bill', $item->id) }}" method="POST">
                                            @csrf
                                            <div>
                                                <label for="">Tổng tiền thanh toán</label>
                                                <input type="number" class="form-control" name="tong"
                                                       value="{{ number_format($item->tong, 0, ',', '.') }}" readonly>
                                                <label for="">Quy đổi thành xu</label>
                                                <input type="test" class="form-control" name="coin"
                                                       value="{{ number_format($item->tong/1000, 0, ',', '.') }}"
                                                       readonly>
                                            </div>
                                            <input type="text" hidden name="pay_type" value="1">

                                            <div class="my-4">
                                                <button type="submit" id="button_submit" class="btn btn-success">
                                                    Xác thanh toán
                                                </button>
                                            </div>
                                        </form>
                                    @endif

                                </div>

                                {{-- Đặt cọc chuyển khoản --}}
                                <div class="tab-pane fade col-10" id="pills-profile" role="tabpanel"
                                     aria-labelledby="pills-profile-tab">
                                    <div class="mr-4 d-flex flex-row-reverse justify-content-between">
                                        <div class="col-5">
                                            <div class="mt-2">
                                                <strong> Chủ phòng :</strong>
                                                <span>{{ $boss->name }} </span>
                                            </div>
                                            <div class="mt-2">
                                                <strong> Email:</strong>
                                                <span>{{ $boss->email }} </span>
                                            </div>
                                        </div>
                                        <div>
                                            @if ($item->status == 2)
                                               <p class="text-success my-4">Hóa đơn đã được thanh toán</p>
                                            @elseif($item->status == 3)
                                                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                                                    <strong>Hóa đơn đang được xác nhận thanh toán</strong>
                                                    <button type="button" class="close" data-bs-dismiss="alert"
                                                            aria-label="Close">
                                                        {{-- <span aria-hidden="true">&times;</span> --}}
                                                        {{-- <span class="sr-only">Đóng</span> --}}
                                                    </button>
                                                </div>
                                            @else
                                                <form action="{{ route('client_pay_bill', $item->id) }}" method="POST">
                                                    @csrf
                                                    <p>Số tiền cọc giữ phòng:
                                                        <span class="font-weight-bold">
                                                            {{ number_format($item->tong, 0, ',', '.') }}đ
                                                        </span>
                                                    </p>

                                                    <input type="text" hidden name="pay_type" value="2"
                                                           id="">
                                                    <p class="text-warning fs-6">Sau khi chuyển tiền, hãy click button
                                                        bên
                                                        dưới để thông báo với chủ trọ</p>

                                                    <button type="submit" class="btn btn-primary">Xác nhận đã chuyển
                                                        tiền
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('client_get_list_bill')}}" class="btn btn-success">Quay lại</a>
                </div>


            </section>
        </div>
    </section>
    <script>
        var user_money = document.getElementById('user_money');
        var money_deposit = document.getElementById('money_deposit');
        if (Number(user_money.innerText.replaceAll(".", "")) < Number(money_deposit.value.replaceAll(".", ""))) {
            document.getElementById('button_submit').setAttribute('disabled', 'true');
            document.getElementById('message').innerText = "Tài khoản của bạn không đủ, hãy nạp thêm";
        }
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
@endsection
