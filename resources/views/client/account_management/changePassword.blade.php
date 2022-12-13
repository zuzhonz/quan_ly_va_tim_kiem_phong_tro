@extends('layouts.user.main')
@section('content')
    <h4>Đổi mật khẩu</h4>
    <div class="bg-white p-4 shadow-sm rounded-4">

        <form action="" method="POST">
            <div>
                @csrf
                <label for="">Mật khẩu cũ</label>
                <input type="password" name="password_old" class="form-control">
            </div>
            <div class="my-">
                <label for="">Mật khẩu mới</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div>
                <label for="">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirm" class="form-control">
            </div>
            <div class="my-4">
                <button class="btn btn-success">Lưu thay đổi</button>
            </div>
        </form>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thay đổi mật khẩu thành công',
                timer: 1500
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Xác nhận mật khẩu cũ không chính xác',
                timer: 1500
            })
        </script>
    @endif
@endsection
