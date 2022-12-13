<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .login_wrapper a.google-plus {
            background: #db4c3e;
            border: 1px solid #db4c3e;
        }

        .login_wrapper a.google-plus:hover {
            background: #bd4033;
            border-color: #bd4033;
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
                        <h1 class="h1 text-white">Đăng nhập hệ thống</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form action="" method="post" id="content">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                               id="email" placeholder="Email"/>
                                    </div>
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password"
                                               id="password" placeholder="Mật khẩu"/>
                                    </div>
                                    <small>
                                        <a href="{{ route('get_form_forgot_password') }}">Quên mật khẩu?</a>
                                    </small>
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div>

                                        <div>
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me"
                                                       name="remember-me" checked>
                                                <span class="form-check-label">Ghi nhớ tài khoản <a
                                                        href="{{ route('get_register') }}"> Đăng ký</a></span>
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
                                    </div>

                                    <div class="text-center mt-3">

                                        <button class="btn btn-primary" type="submit">Đăng nhập</button>
                                        <button type="button" id="login" class="btn btn-info google-plus"> Đăng nhập
                                            bằng tài khoản google<i class="fa-brands fa-google mx-2"></i></button>
                                        <div class="mt-2">
                                            <a href="{{ route('home') }}" class="btn btn-link ">Về trang chủ</a>

                                        </div>
                                        <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</main>

@include('layouts.admin._js')

<script>
    $("#content").validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
            "password": {
                required: true
            }
        },
        messages: {
            "password": {
                required: 'Mật khẩu bắt buộc nhập'
            },
            "email": {
                required: 'Email bắt buộc nhập',
                email: 'Email không đúng định dạng'
            },

        },
        submitHandler: function (form) {

            form.submit();

        }


    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('login').addEventListener('click', () => {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('login_with_gg') }}",
            data: {},
            type: 'POST',
            dataType: 'json',
            success: function (result) {

                document.location = JSON.parse(JSON.stringify(result)).url;


            }
        });
    })
</script>
@if (\Illuminate\Support\Facades\Session::has('failed'))
    <script>
        function modal() {
            Swal.fire(
                'Đăng nhập thất bại!',
                'Thông tin đăng nhập không chính xác.',
                'error'
            )
        }

        modal();
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@if (\Illuminate\Support\Facades\Session::has('failed'))
    <script>
        function modal() {
            Swal.fire(
                'Đăng nhập thất bại!',
                'Thông tin đăng nhập không chính xác.',
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
@if (isset($_GET['success']))
    <script>
        function modal() {
            Swal.fire(
                'Có lỗi xảy ra vui lòng thử lại sau',
                '',
                'error'
            )
        }

        modal();
    </script>
@endif
<script>
    window.history.pushState("", "", 'http://phong.ngo/dang-nhap');
</script>
</body>

</html>
