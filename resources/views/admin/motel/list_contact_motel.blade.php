@extends('layouts.admin.main')

@section('title_page', 'Danh sách người đăng ký ở ghép - '.$info->motel->room_number)
@section('content')
    @foreach ($info as $a)
        <div class="mt-3">
            @if ($info->motel->max_people == count($info) && count($list) > 0)
                <label for="" class="text text-danger">
                    <span class="text-danger font-weight-bold"><i class="fa-solid fa-triangle-exclamation"></i> Số lượng thành viên phòng {{$info->motel->room_number}} đã đạt tối đa</span>
                </label>
            @endif
        </div>
    @endforeach
    <div class="bg-white p-4 shadow-lg rounded-4 my-4">
        <table class="table text-center">

            <thead>

            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Ngày đăng ký</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tg)->format('H:i d/m/Y') }}</td>
                    <td>
                        @if ($item->tt == 0)
                            <span class="text-secondary font-weight-bold">Chờ xác nhận</span>
                        @elseif($item->tt == 1)
                            <span class="text-success font-weight-bold">Đồng ý</span>
                        @elseif($item->tt == 3)
                            <span class="text-warning font-weight-bold">Đã thêm vào phòng</span>
                        @else
                            <span class="text-danger font-weight-bold">Không chấp nhận</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->tt == 1)
                            <a href="{{ route('admin.motel.add_people', ['id' => $area_id, 'idMotel' => $motel_id, 'user_id' => $item->user_id, 'type' => 2]) }}"
                               disabled="true" class="btn btn-success">Thêm vào phòng</a>
                        @else
                            <button disabled class="btn btn-success">Thêm vào phòng</button>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>

@endsection
