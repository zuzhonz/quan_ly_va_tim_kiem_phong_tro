@extends('layouts.admin.main')


@section('title_page', 'Lịch sử nạp tiền')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <form action="" class="my-4">
            <div class="row">
                <div class="col-5">
                    <input class="form-control" name="name"
                           value="{{ isset($params['email']) && $params['email'] ? $params['email'] : '' }}"
                           placeholder="Tìm kiếm theo email">

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
                <div class="col-2">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a class="btn btn-danger" href="{{ route('backend_get_list_recharge') }}">Bỏ chọn</a>
                </div>
            </div>
        </form>
        <table class="table text-center">
            <thead>
            <tr>
                <th>Mã giao dịch</th>
                <th>Email</th>
                <th>Phương thức</th>
                <th>Số tiền nạp</th>
                <th>Phí giao dịch</th>
                <th>Số xu nhận đc</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th>Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($recharges as $item)
                <tr>
                    <td>#{{ $item->recharge_code }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if ($item->payment_type)
                            <span class="text-primary font-weight-bold">PayPal</span>
                        @elseif($item->payment_type == 2)
                            <span class="text-info font-weight-bold">Tiền mặt</span>
                        @endif
                    </td>
                    <td>$ {{ $item->value }}</td>
                    <td>$ {{$item->fee ?? 0}}</td>
                    <td><span class="text-success mx-1">+{{ ($item->value - $item->fee) * 24.855 }}</span><i
                            class="fa-brands fa-bitcoin text-warning"></i></td>
                    <td>
                        @if ($item->tt)
                            <span class="badge text-bg-success text-light p-2">Thành công</span>
                        @elseif($item->tt == 2)
                            <span class="badge text-bg-warning text-light p-2">Chờ xử lý</span>
                        @elseif($item->tt == 3)
                            <span class="badge text-bg-danger text-light p-2">Hoàn tiền</span>
                        @endif
                    </td>
                    <td>{{ $item->note }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $recharges->links() }}
    </div>
@endsection
{{-- Footer --}}
