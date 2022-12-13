<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - GoSNippets</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <style>@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        body {
            height: 100vh;
            background: linear-gradient(to top, #c9c9ff 50%, #9090fa 90%) no-repeat
        }

        .container {
            margin: 50px auto
        }

        .panel-heading {
            text-align: center;
            margin-bottom: 10px
        }

        #forgot {
            min-width: 100px;
            margin-left: auto;
            text-decoration: none
        }

        a:hover {
            text-decoration: none
        }

        .form-inline label {
            padding-left: 10px;
            margin: 0;
            cursor: pointer
        }

        .btn.btn-primary {
            margin-top: 20px;
            border-radius: 15px
        }

        .panel {
            min-height: 380px;
            box-shadow: 20px 20px 80px rgb(218, 218, 218);
            border-radius: 12px
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ddd;
            color: #4343ff
        }

        input[type='text'],
        input[type='password'] {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none
        }

        img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            position: relative
        }

        a[target='_blank'] {
            position: relative;
            transition: all 0.1s ease-in-out
        }

        .bordert {
            border-top: 1px solid #aaa;
            position: relative
        }

        .bordert:after {
            content: "hoặc đăng ký với";
            position: absolute;
            top: -13px;
            left: 33%;
            background-color: #fff;
            padding: 0px 8px
        }

        @media (max-width: 360px) {
            #forgot {
                margin-left: 0;
                padding-top: 10px
            }

            body {
                height: 100%
            }

            .container {
                margin: 30px 0
            }

            .bordert:after {
                left: 25%
            }
        }</style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container">
    <div class="row">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold">Đăng nhập</h3>
                </div>
                <div class="panel-body p-3">
                    <form action="" method="post" id="content">
                        @csrf
                        <div class="form-group py-2">
                            <div class="input-field"><span class="far fa-user p-2"></span> <input type="text"
                                                                                                  placeholder="Email"
                                                                                                  required name="email"
                                                                                                  id="email"></div>
                        </div>
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-group py-1 pb-2">
                            <div class="input-field"><span class="fas fa-lock px-2"></span> <input type="password"
                                                                                                   name="password"
                                                                                                   id="password">
                                <button class="btn bg-white text-muted"><span class="far fa-eye-slash"></span></button>
                            </div>
                        </div>
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-inline"><input type="checkbox" name="remember" id="remember"> <label
                                for="remember" class="text-muted">Nhớ tài khoản</label> <a
                                href="{{route('get_form_forgot_password')}}" id="forgot"
                                class="font-weight-bold">Bạn
                                quên mật khẩu ?</a></div>
                        <div>
                            <div class="my-2 pull-center">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
<strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
</span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block mt-3" type="submit">Đăng nhập</button>
                        <div class="text-center pt-4 text-muted">Bạn chưa có tài khoản? <a href="#">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
                <div class="mx-3 my-2 py-2 bordert">
                    <div class="text-center py-3"><a href="https://wwww.facebook.com" target="_blank" class="px-2"> <img
                                src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt=""> </a>
                        <button
                            id="login" style="outline: none;border: none;background: white" class="px-2"><img
                                src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png"
                                alt=""></button>
                        <a href="https://www.github.com" target="_blank" class="px-2"> <img
                                src="https://www.freepnglogos.com/uploads/512x512-logo-png/512x512-logo-github-icon-35.png"
                                alt=""> </a></div>
                </div>
                <div class="text-center">
                    <a href="{{
    route('home')}}" class="btn btn-link ">Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
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
@if(\Illuminate\Support\Facades\Session::has('logout'))
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

@if(isset($_GET['success']) && $_GET['success'] == 'true')
    <script>
        function modal() {
            Swal.fire(
                'Đăng ký tài khoản thành công.Thông tin đăng nhập đã được gửi vào email đăng ký!',
                '',
                'success'
            )
        }

        modal();

        window.history.pushState("", "", 'http://phong.ngo/dang-nhap');
    </script>
@endif
@if(isset($_GET['success']) && $_GET['success'] == 'gg_error_exit')
    <script>
        function modal() {
            Swal.fire(
                'Tài khoản đã tồn tại.Vui lòng thử tài khoản khác!',
                '',
                'error'
            )
        }

        modal();
        window.history.pushState("", "", 'http://phong.ngo/dang-nhap');
    </script>
@endif
@if(isset($_GET['success']) && $_GET['success'] == 'gg_error')
    <script>
        function modal() {
            Swal.fire(
                'Có lỗi xảy ra vui lòng thử lại!',
                '',
                'error'
            )
        }

        modal();
        window.history.pushState("", "", 'http://phong.ngo/dang-nhap');
    </script>
@endif
</body>
</html>
