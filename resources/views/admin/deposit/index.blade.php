@extends('layouts.admin.main')


@section('title_page','Lịch sử đặt cọc phòng trọ')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <form action="" class="my-4">
            <div class="row">
                <div class="col-5">
                    <input class="form-control" name="name"
                           value="{{isset($params['name']) && $params['name'] ? $params['name'] : ''}}"
                           placeholder="Tìm kiếm theo tên khu trọ,tên người đặt cọc">

                </div>
                <div class="col-2">
                    <select class="form-control" name="order_by">
                        <option
                            value="desc" {{ isset($params['order_by']) && $params['order_by'] == 'desc' ? 'selected' : ''}}>
                            Sắp xếp mới nhất
                        </option>
                        <option
                            value="asc" {{isset($params['order_by']) && $params['order_by'] == 'asc' ? 'selected' : ''}}>
                            Sắp
                            xếp cũ nhất
                        </option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="form-control" name="limit">
                        <option value="" {{ !isset($params['limit']) ? 'selected' : ''}}>Số lượng bản ghi hiển thị
                        </option>
                        <option value="10" {{ isset($params['limit']) && $params['limit'] == '10' ? 'selected' : ''}}>10
                        </option>

                        <option value="25" {{ isset($params['limit']) && $params['limit'] == '25' ? 'selected' : ''}}>25
                        </option>
                        <option value="50" {{ isset($params['limit']) && $params['limit'] == '50' ? 'selected' : ''}}>50
                        </option>
                        <option value="100" {{ isset($params['limit']) && $params['limit'] == '100' ? 'selected' : ''}}>
                            100
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary">Tìm kiếm</button>
                    <a class="btn btn-danger" href="{{route('backend_get_list_deposit')}}">Bỏ chọn</a>
                </div>
            </div>
        </form>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Đóng</span>
                </button>
            </div>
        @endif
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
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
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Người đặt cọc</th>
                <th>Tiền cọc</th>
                <th>Hình thức</th>
                <th>Mã phòng</th>
                <th>Khu trọ</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deposits as $deposit)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{!! isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$deposit->userName) : $deposit->userName!!}</td>
                    <td>{!! $deposit->type == 0 ? $deposit->value.' VNĐ' :$deposit->value .' <i
                            class="fa-brands fa-bitcoin text-warning"></i>' !!}</td>
                    <td>{{$deposit->type == 1 ? "Chuyển xu" : "Chuyển khoản"}}</td>
                    <td>{{$deposit->room_number}}</td>
                    <td>{!!isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$deposit->areaName) :  $deposit->areaName !!}</td>
                    <td>
                        {{\Carbon\Carbon::parse($deposit->date)->format('d/m/Y H:i:s')}}
                    </td>
                    <td>
                        @if($deposit->type == 2)
                            @if(!$deposit->deStatus)
                                <button type="button" data-bs-toggle="modal" style="border:none"
                                        data-bs-target="#exampleModal{{$deposit->deID}}"
                                        class="badge text-bg-warning p-2">
                                    Chờ xác nhận
                                </button>
                            @else
                                <span class="badge text-bg-success p-2">Hoàn thành</span>
                            @endif
                        @else
                            <span class="badge text-bg-success p-2">Hoàn thành</span>
                        @endif
                    </td>
                    <div class="modal fade" id="exampleModal{{$deposit->deID}}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Xác nhận bạn đã nhận được tiền ?</p>
                                </div>
                                <div class="modal-footer">
                                    <form
                                        action="{{ route('backend_admin_change_status_deposit', ['id'=>$deposit->deID]) }}"
                                        method="post">
                                        @csrf
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay
                                            lại
                                        </button>
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$deposits->links()}}
    </div>
@endsection
