@extends('layouts.admin.main')

@section('title_page', 'Yêu cầu rời phòng')
@section('content')
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Đóng</span>
            </button>
        </div>
    @endif
    <div class="bg-white shadow-lg p-4 rounded-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Ngày bắt đầu thuê</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
                <tr>
                    <td></td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone_number}}</td>
                    <td>{{\Carbon\Carbon::parse($item->start_time)->format('h:i d/m/Y')}}</td>
                    <td>
                        @if($item->status == 2)
                            <span class="text-secondary">Đang chờ duyệt</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 2)
                            <a href="{{route('admin.motel.confirm_out_motel',['id' => $item->id,'email' => $item->email,'motel_id' => $id[1]])}}"
                               class="btn btn-success">Đồng ý</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        {{$histories->links()}}--}}
        {{--        <a href="{{route('admin.motel.info',['id' => $id[0],'idMotel' => $id[1]])}}" class="btn btn-success">Quay--}}
        {{--            lại</a>--}}
    </div>

@endsection
