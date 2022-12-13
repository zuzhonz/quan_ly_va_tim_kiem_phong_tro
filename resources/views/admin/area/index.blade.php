@extends('layouts.admin.main')


@section('title_page', 'Danh sách khu trọ')

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
                    <a href="{{ route('backend_get_create_area') }}" class="btn btn-secondary"><i
                            class="fa-solid fa-folder-plus"></i> Thêm mới</a>
                </div>
            </div>
        </form>
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên khu trọ</th>
                <th>Ảnh</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($areas as $area)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! isset($params['name'])
                            ? str_replace($params['name'], '<span class="bg-warning">' . $params['name'] . '</span>', $area->name)
                            : $area->name !!}</td>
                    <td><img class="img-thumbnail" width="150px"
                             src="{{$area->img ?? asset('assets/client/images/popular-places/5.jpg')}}" alt=""></td>
                    <td>{{ $area->address }}</td>
                    <td>
                        <a href="{{ route('admin.motel.list', ['id' => $area->id]) }}" class="btn btn-info"><i
                                class="fa-solid fa-circle-info"></i></a>
                        <a href="{{ route('backend_get_edit_area', ['id' => $area->id]) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal{{$area->id}}"
                                class="btn btn-danger"
                                title="Gửi hóa đơn tiên phòng"><i class="fa-solid fa-paper-plane"></i></button>
                        <div class="modal fade" id="exampleModal{{$area->id}}" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <form action="{{route('backend_send_bill')}}" method="POST" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Gửi hóa đơn tháng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <input type="hidden" name="area_id" value="{{$area->id}}">
                                        <div class="modal-body">
                                            <div>
                                                <label for="">File tiền dịch vụ</label>
                                                <input accept=".xlsx" type="file" class="form-control" name="file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Hủy
                                            </button>
                                            <button type="submit" class="btn btn-primary">Gửi hóa đơn</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $areas->links() }}
    </div>

@endsection
