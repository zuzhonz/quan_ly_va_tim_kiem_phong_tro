@extends('layouts.user.main')
@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");

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

        .card-text {

            font-size: 13px;
            margin-left: 6px;
        }

        .certificate-text {

            font-size: 12px;
        }


        .billing {
            font-size: 11px;
        }

        .super-price {

            top: 0px;
            font-size: 22px;
        }

        .super-month {

            font-size: 11px;
        }


        .line {
            color: #bfbdbd;
        }

        .free-button {

            background: #1565c0;
            height: 52px;
            font-size: 15px;
            border-radius: 8px;
        }


        .payment-card-body {

            flex: 1 1 auto;
            padding: 24px 1rem !important;

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
        <h4>Lịch sử nạp tiền</h4>
        <div class="my-properties shadow-lg">
            <table class="table-responsive text-center">
                <thead>
                <tr>
                    <th>Mã giao dịch</th>
                    <th>Email</th>
                    <th>Họ tên</th>
                    <th>Phương thức</th>
                    <th>Số tiền</th>
                    <th>Số xu nhận đc</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recharges as $item)
                    <tr>
                        <td>#{{$item->recharge_code}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @if($item->payment_type)
                                <span class="text-primary font-weight-bold">PayPal</span>
                            @elseif($item->payment_type == 2)
                                <span class="text-info font-weight-bold">Tiền mặt</span>
                            @endif
                        </td>
                        <td>{{$item->value}} $</td>
                        <td><span
                                class="text-success mx-1">+{{$item->value * 24.855}}</span><i
                                class="fa-brands fa-bitcoin text-warning"></i></td>
                        <td>
                            @if($item->tt)
                                <span class="text-success font-weight-bold p-2">Thành công</span>
                            @elseif($item->tt == 2)
                                <span class="text-success font-weight-bold p-2">Chờ xử lý</span>
                            @elseif($item->tt == 3)
                                <span class="text-success font-weight-bold p-2">Hoàn tiền</span>
                            @endif
                        </td>
                        <td>{{$item->note}}</td>
                        <td>{{\Carbon\Carbon::parse($item->date)->format('d/m/Y H:i:s')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
