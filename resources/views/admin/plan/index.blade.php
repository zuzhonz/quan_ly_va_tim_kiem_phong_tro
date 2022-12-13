@extends('layouts.admin.main')

@section('title_page', 'Quản lý các gói dịch vụ')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">

        <form action="" class="mb-4">
            <div class="row col-12">
                <div class="col-3 pl-0 pr-1">
                    <input class="form-control" name="name"
                        value="{{ isset($params['name']) && $params['name'] ? $params['name'] : '' }}"
                        placeholder="Tìm kiếm theo tên gói dịch vụ">
                </div>
                <div class="col-2 px-1">
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
                <div class="col-3 px-1">
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
                        <option value="100" {{ isset($params['limit']) && $params['limit'] == '100' ? 'selected' : '' }}>
                            100
                        </option>
                    </select>
                </div>
                <div class="col-4 d-flex flex-row">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a class="btn btn-danger mx-2" href="">Bỏ chọn</a>
                    <a href="{{ route('backend_admin_create_plans') }}" class="btn btn-primary"><i
                            class="fa-solid fa-folder-plus"></i> Thêm mới</a>
                </div>
            </div>
        </form>
        <table class="table text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên gói</th>
                    <th>Độ ưu tiên</th>
                    <th>Loại gói</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $plan->name }}</td>
                        <td class="text-danger font-weight-bold">{{ $plan->priority_level }}</td>
                        <td>
                            @if ($plan->type == 1)
                                <span class="badge bg-success p-2 text-xl">Gói đăng bài</span>
                            @else
                                <span class="badge bg-danger p-2 text-xl">Gói tìm ngưởi ờ ghép</span>
                            @endif
                        </td>
                        <td><span class="text-success mx-1">{{ $plan->price }}</span><i
                                class="fa-brands fa-bitcoin text-warning"></i></td>
                        <td>
                            @if ($plan->status)
                                <span class="text-success font-weight-bold">Hoạt động</span>
                            @else
                                <span class="text-warning font-weight-bold">Tạm dừng</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('backend_admin_edit_plans', ['id' => $plan->id]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('backend_admin_delete_plans', ['id' => $plan->id]) }}"
                                onclick="return confirm('Bạn có chăc muốn xóa gói dịch vụ này này')"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $plans->links() }}
    </div>
@endsection
