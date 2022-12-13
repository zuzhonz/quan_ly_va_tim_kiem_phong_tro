@extends('layouts.admin.main')

@section('title_page',$title)

@section('content')
<div class="w-full overflow-hidden rounded-lg shadow-xs my-3">
    <div class="w-full overflow-x-auto ">
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
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
        <form action="" method="POST" enctype="multipart/form-data" id="content">
            @csrf
            <div class="bg-white shadow-lg p-4">
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Họ tên</h5>
                            </div>
                            <div class="card-body">
                                <input value="{{$user->name}}" name="name" id="name" type="text" class="form-control mb-4">
                            </div>
                        </div>
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Email</h5>
                            </div>
                            <div class="card-body">
                                <input value="{{$user->email}}" readonly name="email" type="email" class="form-control mb-4">
                            </div>
                        </div>
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Số điện thoại</h5>
                            </div>
                            <div class="card-body">
                                <input value="{{$user->phone_number}}" id="phone_number" name="phone_number" type="number" class="form-control mb-4">
                            </div>
                        </div>
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Địa chỉ</h5>
                            </div>
                            <div class="card-body">
                                <input value="{{$user->address}}" name="address" id="address" type="text" class="form-control mb-4">
                            </div>
                        </div>
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Mật khẩu</h5>
                            </div>
                            <div class="card-body">
                                <input value="{{$user->password}}" readonly name="password" type="password" class="form-control mb-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Ảnh đại diện</h5>
                            </div>
                            <div class="card-body">
                                <img id="avt_preview" src="{{$user->avatar ?? "https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-avatar-vector-isolated-on-white-background-png-image_1694546.jpg"}}" alt="your image" style="max-width: 200px; height:95px;" class="img-fluid mb-2"/>
                                <input name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror mb-4">
                                <input type="hidden" value="{{$user->avatar}}" name="avatar_old">
                            </div>
                        </div>
                        <div>
                            <div class="card-header">
                                <h5 class="card-title mb-4">Quyền</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-3" name="role_id" id="role_id">
                                    @foreach ($role as $key => $value)
                                        @if ($user->role_id === $key)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="{{$user->id}}">
            <button class="btn btn-success mt-4">Lưu</button>
            <a href="{{route('backend_user_getAll')}}" class="btn btn-secondary mt-4">Quay lại</a>

        </form>
    </div>
</div>
<style>
    label.error{
        color: red;
    }
</style>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
     const urlDefault = $("#avt_preview").attr('src');
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }else{
                    $(selector).attr('src', urlDefault);
                }
            }
            $("#avatar").change(function () {
                readURL(this, '#avt_preview');
            });
        });
</script>
<script>
    id = $('#id').val();
    $("#content").validate({
        rules: {
            "name": {
                required: true,
            },
            "address": {
                required: true
            },
            "role_id": {
                required: true
            },
            "phone_number": {
                required: true
            }
        },
        messages: {
            "name": {
                required: 'Tên người dùng bắt buộc nhập'
            },
            "address": {
                required: 'Địa chỉ bắt buộc nhập'
            },
            "phone_number": {
                required: 'Số điện thoại bắt buộc nhập'
            },
            "role_id": {
                required: 'Vai trò bắt buộc chọn'
            },
        },
        submitHandler: function (form) {
            $('#content').attr('action', "http://127.0.0.1:8000/user/update/"+id);
            form.submit();
        }
    });
</script>
@endsection

