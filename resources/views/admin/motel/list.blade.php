@extends('layouts.admin.main')

@section('title_page', 'Danh sách phòng trọ')

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
                           placeholder="Tìm kiếm theo tên phòng trọ">
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
                <div class="col-2">
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
                <div class="col-5">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a class="btn btn-danger" href="{{route('admin.motel.list',['id' => 1])}}">Bỏ chọn</a>
                    <a href="{{route('admin.motel.create',['id' => $id])}}" class="btn btn-secondary"><i
                            class="fa-solid fa-folder-plus"></i> Thêm mới</a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info"><i
                            class="fa-solid fa-file-import"></i> Nhập file exel
                    </button>
                </div>
            </div>
        </form>
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Mã phòng</th>
                <th class="">Giá thuê(đ)</th>
                <th>Số người tối đa</th>
                <th>Giá điện(số)</th>
                <th>Giá nước(số)</th>
                <th>Thời gian bắt đầu thuê</th>
                <th>Thời gian kết thúc hợp đồng</th>
                <th>Trạng thái</th>
                <th class="">Chức năng</th>
            </tr>
            </thead>
            <tbody>
            @if(count($motels) === 0)
                <tr>
                    <td colspan="11"><span class="text-warning" style="font-size: 16px">Bạn chưa có phòng trọ nào</span>
                    </td>
                </tr>
            @else
                @foreach ($motels as $motel)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $motel->room_number }}</td>
                        <td class="">{{ number_format($motel->price, 0, ',', '.') }}</td>
                        <td class="">{{ $motel->max_people }}</td>
                        <td>{{number_format($motel->electric_money, 0, ',', '.')}}</td>
                        <td>{{number_format($motel->warter_money, 0, ',', '.')}}</td>
                        <td>{{$motel->start_time ? \Carbon\Carbon::parse($motel->start_time)->format('d/m/Y') : 'Chưa xác định'}}</td>
                        <td>{{$motel->end_time ? \Carbon\Carbon::parse($motel->end_time)->format('d/m/Y') : 'Chưa xác định'}}</td>
                        <td>
                            @if($motel->status == 1)
                                <span class="badge bg-secondary p-2">Trống</span>
                            @elseif($motel->status == 3)
                                <span class="badge bg-warning p-2">Đã được đặt cọc</span>
                            @elseif($motel->status == 4)
                                <span class="badge bg-danger p-2">Sắp hết hạn hợp đồng</span>
                            @elseif($motel->status == 5)
                                <span class="badge bg-dark p-2">Đang đăng tin</span>
                            @elseif($motel->status == 6)
                                <span class="badge bg-danger p-2">Đã hết hạn hợp đồng</span>
                            @else
                                <span class="badge bg-success p-2">Đã được thuê</span>
                            @endif
                        </td>
                        <td class="">
                            <a title="Cập nhật phòng trọ"
                               href="{{ route('admin.motel.edit', ['id' => $motel->area_id, 'idMotel' => $motel->id]) }}"
                               class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a title="Thông tin phòng trọ" class="btn btn-info"
                               href="{{route('admin.motel.info',['id' => $motel->area_id,'idMotel' => $motel->id])}}"><i
                                    class="fa-solid fa-circle-info"></i></a>
                            {{--                            <button class="btn btn-danger "--}}
                            {{--                                {{$motel->status == 2 ? 'disabled' : ''}}>--}}
                            {{--                                <a title="Xóa phòng trọ"--}}
                            {{--                                   href="" onclick="return confirm('Bạn có chắc muốn xóa phòng trọ')"--}}
                            {{--                                   class="text-white"><i class="fa-solid fa-trash"></i></a></button>--}}
                            <a href="{{route('admin.duplicate.motel',['id' => $motel->area_id, 'idMotel' => $motel->id])}}"
                               onclick="return confirm('Bạn có chắc muốn sao chép phòng trọ này ?')"
                               title="Sao chép phòng trọ" class="btn btn-secondary"><i class="fa-solid fa-copy"></i></a>
                        </td>
                    </tr>
                @endforeach

            @endif
            </tbody>
        </table>
        {{ $motels->links() }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.motel.import')}}" method="POST" enctype="multipart/form-data">


            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập danh sách</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>File exel</label>
                        @csrf
                        <input type="hidden" value="{{$id}}" name="area_id" id="area_id">
                        <input type="file" class="form-control" name="file" id="file">
                        <span class="text-sm text-danger ms-1">Bạn nên xem trước định dạng file trước khi nhập</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Nhập</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
