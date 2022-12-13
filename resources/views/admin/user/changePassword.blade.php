@extends('layouts.admin.main')

@section('title_page','Đổi mật khẩu')

@section('content')
    <div class="bg-white p-4 rounded-4 shadow-lg">
        <div class="w-full overflow-hidden rounded-lg shadow-xs my-2">
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
            </div>
        </div>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="password">Mật khẩu cũ</label>
                <input type="password" name="old_password" value="{{ old('old_password') }}" class="form-control" id="old_password">
                @error('old_password')
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror

            </div>
            <div class="form-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password">
                @error('password')
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Xác nhận lại mật khẩu</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation">
                @error('password_confirmation')
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mã xác minh</label>
                <input type="text" name="confirm_code" value="{{ old('confirm_code') }}"  class="form-control" id="confirm_code">
                <button type="button" class="btn btn-link" id="btnLink">Lấy mã</button>
                @error('confirm_code')
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </div>

@endsection

@section('custom_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btn = document.getElementById('btnLink');

        btn.addEventListener('click', () => {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get_code_change_password') }}",
                data: {
                    id: {{\Illuminate\Support\Facades\Auth::id()}}
                },
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    Swal.fire(
                        'Lấy mã thành công!',
                        'Vui lòng vào email đã đăng ký để lấy mã',
                        'success'
                    )
                    btn.innerHTML = 'Gửi lại mã';

                }
            });
        })

    </script>
@endsection

