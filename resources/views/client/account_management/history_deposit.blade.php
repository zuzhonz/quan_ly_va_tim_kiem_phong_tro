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
        <h4>Lịch sử đặt cọc</h4>
        <div class="my-properties shadow-lg">
            <table class="table-responsive text-center shadow p-3 mb-5 bg-body rounded">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người đặt cọc</th>
                        <th>Tiền cọc</th>
                        <th>Hình thức</th>
                        <th>Số ngày</th>
                        <th>Mã phòng</th>
                        <th>Khu trọ</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{!! isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$deposit->userName) : $deposit->userName!!}</td>
                            <td>{{number_format($deposit->value, 0, ',', '.')}}</td>
                            <td>{{$deposit->type == 1 ? "Chuyển xu" : "Chuyển khoản"}}</td>
                            <td>{{$deposit->day_deposit}}</td>
                            <td>{{$deposit->room_number}}</td>
                            <td>{!!isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$deposit->areaName) :  $deposit->areaName !!}</td>
                            <td>
                                {{\Carbon\Carbon::parse($deposit->date)->format('d/m/Y H:i:s')}}
                            </td>
                            <td>
                                @if($deposit->deStatus == 0)
                                    <span class="badge text-bg-warning p-2">Chờ xác nhận</span>
                                @else
                                    <span class="badge text-bg-success p-2">Hoàn thành</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            
                    </tbody>
            </table>
        </div>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
@endsection
