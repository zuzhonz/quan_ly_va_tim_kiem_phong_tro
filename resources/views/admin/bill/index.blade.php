@extends('layouts.admin.main')


@section('title_page', 'Danh sách hóa đơn')

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
        <form action="">
            <div class="row">
                <div class="col-3 form-group">
                    <select name="area_id" id="area_id" class="form-control">
                        <option value="">Lựa chọn khu trọ</option>
                        @foreach($areas as $area)
                            <option
                                value="{{$area->id}}" {{isset($params['area_id']) &&   $params['area_id'] == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 form-group">
                    <select name="room_number" id="room_number" class="form-control">
                        <option value="">Lựa chọn mã phòng</option>
                        @if(isset($motels))
                            @foreach($motels as $motel)
                                <option
                                    value="{{$motel->id}}" {{isset($params['room_number']) &&   $params['room_number'] == $motel->id ? 'selected' : ''}} >{{$motel->room_number}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-2 form-group">
                    <select name="year" id="" class="form-control">
                        <option value="">Lựa chọn năm</option>
                        <option
                            value="2022" {{isset($params['year']) &&   $params['year'] == 2022     ? 'selected' : ''}}>
                            Năm 2022
                        </option>
                    </select>
                </div>
                <div class="col-2 form-group">
                    <select name="month" id="" class="form-control">
                        <option value="">Lựa chọn tháng</option>
                        @for($i = 1 ; $i < 13; $i++)
                            <option
                                value="{{$i}}" {{isset($params['month']) &&  $params['month'] == $i ? 'selected' : ''}}>
                                Tháng {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <button class="btn btn-danger" type="button" onclick="document.location.reload()">Bỏ chọn</button>
                </div>
            </div>
        </form>
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Khu trọ</th>
                <th>Mã phòng</th>
                <th>Tiền phòng</th>
                <th>Tiền điện</th>
                <th>Tiền nước</th>
                <th>Tiền mạng</th>
                <th>Tổng thu</th>
                <th>Ngày làm hóa đơn</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->room_number}}</td>
                    <td>{{number_format($item->price, 0, ',', '.')}} đ</td>
                    <td>{{number_format($item->tien_dien, 0, ',', '.')}} đ</td>
                    <td>{{number_format($item->tien_nuoc, 0, ',', '.')}} đ</td>
                    <td>{{number_format($item->wifi, 0, ',', '.')}} đ</td>
                    <td>{{number_format($item->tong, 0, ',', '.')}} đ</td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('h:i d/m/Y')}}</td>
                    <td>
                        @if($item->status)
                            <span class="badge bg-success p-2 text-xl">Đã thu</span>
                        @else
                            <button class="badge bg-danger p-2 text-xl border-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$item->room_number}}">Chưa thu
                            </button>
                            <div class="modal fade" id="exampleModal{{$item->room_number}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('backend_confirm_bill')}}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận đã thu tiền
                                                    trọ</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn thay đổi trạng thái hóa đơn sang đã thu ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Hủy
                                                </button>

                                                <button type="submit" name="bill_id" value="{{$item->bill_id}}"
                                                        class="btn btn-primary">
                                                    Đồng ý
                                                </button>

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
    </div>

@endsection

@section('custom_js')
    <script>
        document.getElementById('area_id').addEventListener('change', (e) => {
            if (e.target.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('get_motel_by_area') }}",
                    data: {
                        area_id: +e.target.value,
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function (result) {
                        document.getElementById('room_number').innerHTML = `
                         <option value="">Lựa chọn mã phòng</option>
                            ${result.map(item => `<option value="${item.id}">${item.room_number}</option>`).join("")}
                        `;
                    }
                });
            } else {
                document.getElementById('room_number').innerHTML = `
                         <option value="">Bạn chưa chọn khu <trọ></trọ></option>`;
            }
        })
    </script>
@endsection
