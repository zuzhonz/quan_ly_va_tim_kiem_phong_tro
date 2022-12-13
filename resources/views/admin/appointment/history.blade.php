@extends('layouts.admin.main')


@section('title_page', 'Danh sách lịch hẹn xem phòng')

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
        <form action="" class="my-4">
            <div class="row">
                <div class="col-3">
                    <input class="form-control" name="name" value="{{ $params['name'] ?? '' }}"
                           placeholder="Tìm kiếm theo tên khu trọ">

                </div>
                <div class="col-2">
                    <select class="form-control" name="order_by">
                        <option value="desc"
                            {{ isset($params['order_by']) && $params['order_by'] == 'desc' ? 'selected' : '' }}>
                            Sắp xếp mới nhất
                        </option>
                        <option value="asc"
                            {{ isset($params['order_by']) && $params['order_by'] == 'asc' ? 'selected' : '' }}>Sắp
                            xếp cũ nhất
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <select class="form-control" name="limit">
                        <option value="" {{ !isset($params['limit']) ? 'selected' : '' }}>Số lượng bản ghi hiển thị
                        </option>
                        <option value="10" {{ isset($params['limit']) && $params['limit'] == '10' ? 'selected' : '' }}>
                            10
                        </option>

                        <option value="25" {{ isset($params['limit']) && $params['limit'] == '25' ? 'selected' : '' }}>
                            25
                        </option>
                        <option value="50" {{ isset($params['limit']) && $params['limit'] == '50' ? 'selected' : '' }}>
                            50
                        </option>
                        <option
                            value="100" {{ isset($params['limit']) && $params['limit'] == '100' ? 'selected' : '' }}>
                            100
                        </option>
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a class="btn btn-danger" href="{{ route('backend_get_list_area') }}">Bỏ chọn</a>
                </div>
            </div>
        </form>
        <table class="table text-center p-3 mb-5">
            <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Mã phòng</th>
                <th>Tên khu trọ</th>
                <th>Thời gian đặt lịch xem</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone_number ?? '0325500080'}}</td>
                    <td>{{$item->room_number}}</td>
                    <td>{{$item->area_name}}</td>
                    <td>{{\Carbon\Carbon::parse($item->time)->format('h:i A d/m/Y')}}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success p-2 text-xl" style="cursor: pointer;" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal{{$item->id}}">Đồng ý</span>
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận lịch hẹn</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('admin.confirm_appoint')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group text-left">
                                                    <input type="hidden" value="{{$item->id}}" name="appoint_id">
                                                    <label for="time">Thời gian đặt</label>
                                                    <input type="datetime-local" readonly class="form-control"
                                                           value="{{\Carbon\Carbon::make($item->time)}}" id="time"
                                                           name="time">
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="status">Tình trạng lịch hẹn</label>
                                                    <select name="status" class="form-control" id="status">
                                                        <option value="3">Khách không đến</option>
                                                        <option value="2">Đã xem phòng</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Đóng
                                                </button>
                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @elseif($item->status == 3)
                            <span class="badge bg-danger p-2 text-xl">Hủy</span>
                        @elseif($item->status == 2)
                            <span class="badge bg-primary p-2 text-xl">Đã xem phòng</span>
                        @else
                            <span class="badge bg-secondary p-2 text-xl" style="cursor: pointer;" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal{{$item->id}}">Chờ xác nhận</span>
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận lịch hẹn</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('admin.confirm_appoint')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group text-left">
                                                    <input type="hidden" value="{{$item->id}}" name="appoint_id">
                                                    <label for="time">Thời gian đặt</label>
                                                    <input type="datetime-local" class="form-control"
                                                           value="{{\Carbon\Carbon::make($item->time)}}" id="time"
                                                           name="time">
                                                </div>
                                                <div class="form-group text-left">
                                                    <label for="status">Tình trạng lịch hẹn</label>
                                                    <select name="status" class="form-control" id="status">
                                                        <option value="1">Đồng ý</option>
                                                        <option value="2">Đã xem phòng</option>
                                                        <option value="3">Từ chối</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Đóng
                                                </button>
                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{--        {{ $areas->links() }}--}}
    </div>

@endsection
