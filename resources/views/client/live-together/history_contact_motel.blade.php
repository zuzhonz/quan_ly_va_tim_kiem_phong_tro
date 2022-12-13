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
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        <h4>Lịch sử đăng ký ở ghép</h4>
        <div class="my-properties shadow-lg">
            <table class="table-responsive text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($history as $item)
                    <tr>
                        <td></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone_number}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tg)->format('h:i d/m/Y')}}</td>
                        <td>
                            @if($item->tt == 0)
                                <span class="text-secondary">Người đăng ký mới</span>

                            @elseif($item->tt == 1)
                                <span class="text-success">Đồng ý</span>
                            @elseif($item->tt == 3)
                                <span class="text-warning">Đã thêm vào phòng</span>
                            @elseif($item->tt == 4)
                                <span class="text-danger">Đã hủy</span>
                            @else
                                <span class="text-danger">Từ chối</span>
                            @endif
                        </td>
                        <td>
                            @if($item->tt == 0)
                                <a href="{{route('client.confirm_contact_motel',
['motel_id'=>$item->motel_id,'area_id' => $item->area_id,'status' => 1,'contact_id' => $item->contact_id])}}"
                                   class="btn btn-success text-white">Chấp nhận</a>
                                <a href="{{route('client.confirm_contact_motel', ['motel_id'=>$item->motel_id,'area_id' => $item->area_id,'status' => 2,'contact_id' => $item->contact_id])}}"
                                   class="btn btn-danger text-white">Không chấp nhận</a>
                            @else
                                @if($item->tt == 3 || $item->tt === 4)
                                    <button
                                        class="btn btn-warning text-white" disabled>Hùy
                                    </button>
                                @else
                                    <a href="{{route('client.confirm_contact_motel', ['motel_id'=>$item->motel_id,'area_id' => $item->area_id,'status' => 0,'contact_id' => $item->contact_id])}}"
                                       class="btn btn-warning text-white">Hùy</a>
                                @endif

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
