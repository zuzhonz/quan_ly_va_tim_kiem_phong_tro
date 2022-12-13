<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @include('layouts.admin._css')
    <style>
        .error {
            color: red;
            margin-top: 4px;
        }
    </style>
</head>

<body
    style="background-image: url('https://anhdepfree.com/wp-content/uploads/2019/05/hinh-nen-background-dep-48.jpg');background-size: 100%">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h1 text-white">Đăng ký hệ thống</h1>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-lx-6">

                                    <form class="px-md-4" action="{{ route('post_register') }}" method="POST"
                                        id="content">
                                        @csrf
                                        <label class="form-label" for="form3Example1q">Họ tên</label>
                                        <div class="form-outline">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Nhập tên của bạn" />
                                        </div>

                                        <div class="row">
                                            <div class="col">

                                                <div class="form-outline datepicker">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email"
                                                        name="email" placeholder="Nhập email của bạn" />
                                                </div>

                                            </div>



                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label">Số Điện thoại</label>
                                                    <input type="text" class="form-control" id="phone_number"
                                                        name="phone_number" placeholder="Nhập số điện thoại " />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label">Vai trò </label>
                                                    <select name="role_id" id="role_id" class="form-control">
                                                        <option value="">Chọn vai trò</option>
                                                        <option value="1">Chủ trọ</option>
                                                        <option value="3">Người dùng</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-outline ">
                                                <label class="form-label">Địa chỉ</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Nhập địa chỉ" />
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 md-4 mt-2">
                                                <div class="form-outline datepicker">
                                                    <label class="form-label">Mật khẩu</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>

                                            <div class="col-md-6 md-4 mt-2">
                                                <div class="form-outline datepicker">
                                                    <label class="form-label">Nhập lại Mật Khẩu</label>
                                                    <input type="password" class="form-control" id="confirm_password"
                                                        name="confirm_password" placeholder="nhập lại mật khẩu">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-3">
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me"
                                                    name="remember-me" checked>
                                                <span class="form-check-label">Nếu bạn đã có tài khoản <a
                                                        href="{{ route('get_login') }}"class="">Đăng
                                                        nhập</a></span>
                                            </label>
                                            <div class="col-md-6 pull-center">
                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <strong
                                                            class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <a href="{{ route('home') }}" class="btn btn-success">Về trang chủ</a>
                                            <button class="btn btn-primary">Đăng ký</button>

                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
    </main>

    @include('layouts.admin._js')

    <script>
        $("#content").validate({
            rules: {
                "name": {
                    minlength: 6,
                    required: true,
                },
                "email": {
                    required: true,
                    email: true
                },
                "password": {
                    required: true,
                    minlength: 6,
                },
                "confirm_password": {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },

                "phone_number": {
                    required: true,
                    minlength: 10,
                    maxlength: 11,
                },
                "address": {
                    minlength: 6,
                    required: true,
                },
            },
            messages: {
                "name": {
                    minlength: 'Tên phải ít nhất 6 ký tự !',
                    required: 'Bắt buộc nhập tên tài khoản !',
                },
                "email": {
                    required: 'Bắt buộc nhập email !',
                    email: 'Email không đúng định dạng'
                },
                "password": {
                    required: 'Mật khẩu bắt buộc nhập !',
                    minlength: 'Tối thiểu 6 ký tự !',
                },
                "confirm_password": {
                    required: 'Mật khẩu bắt buộc nhập !',
                    minlength: 'Tối thiểu 6 ký tự !',
                    equalTo: "Nhập đúng với password ! "
                },

                "phone_number": {
                    required: "Bắt buộc nhập số điện thoại",
                    minlength: "tối thiểu 10 số !",
                    maxlength: 'Nhập quá giới hạn tối đa !',
                },
                "address": {
                    minlength: "tối thiểu nhập 6 ký tự !",
                    required: "Bắt buộc nhập địa chỉ !",
                },
            },
            submitHandler: function(form) {

                form.submit();

            }

        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (\Illuminate\Support\Facades\Session::has('success_register'))
        <script>
            function modal() {
                Swal.fire(
                    'đăng ký tài khoản thành công',
                    '',
                    'success'
                )
            }

            modal();
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('email_fall'))
        <script>
            function modal() {
                Swal.fire(
                    'Email đã tồn tại !',
                    '',
                    'error'
                )
            }

            modal();
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('change'))
        <script>
            function modal() {
                Swal.fire(
                    'Lấy lại mật khẩu thành công',
                    '',
                    'success'
                )
            }

            modal();
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('logout'))
        <script>
            function modal() {
                Swal.fire(
                    'Đăng xuất thành công!',
                    '',
                    'success'
                )
            }

            modal();
        </script>
    @endif
</body>

</html>
