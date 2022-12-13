@extends('layouts.admin.main')


@section('title_page','Danh sách địa điểm')

@section('content')
    <div class="bg-white shadow-lg p-4 rounded-4">
        <button type="button" class="btn btn-primary  my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nhập file excel
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('backend_importFileExcel_location')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập danh sách</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="">File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên địa điểm</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Loại địa điểm</th>
            </tr>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$location->name}}</td>
                    <td>{{$location->latitude}}</td>
                    <td>{{$location->longitude}}</td>
                    <td>
                        @if($location->type === 1)
                            <span>Trường học</span>
                        @elseif($location->type === 2)
                            <span>Bệnh viện</span>
                        @elseif($location->type === 3)
                            <span>Siêu thị</span>
                        @else
                            <span>Bến xe</span>
                        @endif
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

        {{$locations->links()}}
    </div>
@endsection
