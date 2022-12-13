@extends('layouts.admin.main')

@section('title_page', 'Lịch sử thuê phòng')
@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Họ tên</th>
                    <th>Số điện thoại</th>
                    <th>Ngày bắt đầu thuê</th>
                    <th>Ngày rời phòng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->phone_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->bd)->format('H:i d/m/Y') }}</td>
                        <td>{{ $a->kt ? \Carbon\Carbon::parse($a->bd)->format('H:i d/m/Y') : 'Chưa xác định' }}</td>
                        <td>
                            @if ($a->tt == 1)
                                <span class="text-success font-weight-bold">Đang ở</span>
                            @elseif($a->tt == 3)
                                <span class="text-danger font-weight-bold">Đã xóa</span>
                            @else
                                <span class="text-danger font-weight-bold">Đã rời phòng</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $histories->links() }}
        <a href="{{ route('admin.motel.info', ['id' => $id[0], 'idMotel' => $id[1]]) }}" class="btn btn-success">Quay lại</a>
    </div>

@endsection
