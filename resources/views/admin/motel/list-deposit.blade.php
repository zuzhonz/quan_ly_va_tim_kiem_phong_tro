@extends('layouts.admin.main')


@section('title_page','Danh sách đặt cọc phòng trọ')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
    <table class="table text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>Người đặt cọc</th>
            <th>Tiền cọc</th>
            <th>Thời gian</th>
            <th>Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{!! isset($params['name']) ? str_replace($params['name'],'<span class="bg-warning">'.$params['name'].'</span>',$deposit->userName) : $deposit->userName!!}</td>
                <td>{{$deposit->value}}</td>
                <td>
                    {{\Carbon\Carbon::parse($deposit->date)->format('d/m/Y H:i:s')}}
                </td>
                <td>
                    @if($deposit->deStatus == 0)
                        <span class="badge text-bg-secondary p-2">Chờ ký hợp đồng</span>
                    @elseif($deposit->deStatus == 1)
                        <span class="badge text-bg-primary p-2">Đã ký hợp đồng</span>
                    @else
                        <span class="badge text-bg-success p-2">Đã chuyển tiền</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    </div>
@endsection
