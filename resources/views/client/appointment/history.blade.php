@extends('layouts.user.main')
@section('content')
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
        <h4>Lịch sử đặt lịch xem trọ</h4>
        <div class="my-properties shadow-lg">
            <table class="table-responsive text-center shadow p-3 mb-5 bg-body rounded">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên chủ trọ</th>
                    <th>Số điện thoại</th>
                    <th>Mã phòng</th>
                    <th>Tên khu trọ</th>
                    <th>Thời gian đặt lịch xem</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($history as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone_number}}</td>
                        <td>{{$item->room_number}}</td>
                        <td>{{$item->area_name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->time)->format('h:i A d/m/Y')}}</td>
                        <td>
                            @if($item->status == 1)
                                <span class="badge bg-success p-2 text-xl">Đồng ý</span>
                            @elseif($item->status == 2)
                                <span class="badge bg-primary p-2 text-xl">Đã xem phòng</span>
                            @elseif($item->status == 3)
                                <span class="badge bg-primary p-2 text-xl">Đã hủy</span>
                            @else
                                <span class="badge bg-secondary p-2 text-xl">Chờ xác nhận</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status != 2 && $item->status != 3)
                                <a onclick="return confirm('Bạn có chắc muốn hủy lịch hẹn này ?')"
                                   href="{{route('client.cancelAppoint',['appoint_id' => $item->id,'status' => 3])}}"
                                   class="btn btn-danger">Hủy lịch hẹn</a>
                            @else
                                <button disabled class="btn btn-danger">Hủy</button>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
              crossorigin="anonymous">
@endsection
