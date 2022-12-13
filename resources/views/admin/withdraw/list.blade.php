@extends('layouts.admin.main')


@section('title_page', 'Lịch sử rút tiền')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>STT</th>
                <th>Email tài khoản ví</th>
                <th>Số xu rút</th>
                <th>Phí giao dịch</th>
                <th>Số tiên nhận được</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($withdraws as $item)
                <tr>
                    <td>#{{  1}}</td>
                    <td>{{ $item->address_balance }}</td>
                    <td><span class="text-danger font-weight-bold">-{{ $item->money * 24.855 }}</span> <i
                            class="fa-brands fa-bitcoin text-warning"></i></td>
                    <td><span class="text-danger font-weight-bold">-{{$item->fee * 24.855 }}</span> <i
                            class="fa-brands fa-bitcoin text-warning"></i></td>
                    <td>+<span class="text-success font-weight-bold">{{$item->money}} $</span></td>
                    <td>
                        <span class="badge text-bg-success text-light p-2">Thành công</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $withdraws->links() }}
    </div>
@endsection
{{-- Footer --}}
