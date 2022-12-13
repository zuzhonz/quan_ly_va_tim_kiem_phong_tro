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
    {{--    <script src='https://www.google.com/recaptcha/api.js'></script>--}}
    {{--    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
    {{--    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
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
                        <h1 class="h1 text-white">Quên mật khẩu</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form action="" method="post" id="content">
                                    @csrf
                                    {{--                                    <input type="hidden" value="{{$email}} ">--}}
                                    <div class="mb-3">
                                        <label class="form-label">Mã xác minh</label>
                                        <input class="form-control form-control-lg" type="text" name="code" id="code"
                                        />
                                    </div>
                                    <input type="hidden" value="{{$email}}" name="email">
                                    @error('code')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    <div>
                                        {{--                                        <div class="col-md-6 pull-center">--}}
                                        {{--                                            {!! app('captcha')->display() !!}--}}
                                        {{--                                            @if ($errors->has('g-recaptcha-response'))--}}
                                        {{--                                                <span class="help-block">--}}
                                        {{--<strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>--}}
                                        {{--</span>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <small>
                                        Bạn không nhận được mã ? <span id="box"
                                        >Gửi lại mã</span> <span
                                            class="text-danger" id="time">1:00</span>
                                    </small>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-lg btn-primary">Xác nhận</button>
                                        <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                    </div>
                                </form>
                            </div>
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
            "code": {
                required: true
            }
        },
        messages: {
            "code": {
                required: 'Mã xác minh bắt buộc nhập'
            },
        },
        submitHandler: function (form) {

            form.submit();

        }

    });
</script>
<script>
    let a = 1000;

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                document.getElementById('box').innerHTML = `<a href="">Gửi lại mã</a>`;
                display.innerHTML = '';
                a = 0;
            }
        }, a);
    }

    window.onload = function () {
        var fiveMinutes = 60 * 1,
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--@if (\Illuminate\Support\Facades\Session::has('failed'))--}}
{{--    <script>--}}
{{--        function modal() {--}}
{{--            Swal.fire(--}}
{{--                'Đăng nhập thất bại!',--}}
{{--                'Thông tin đăng nhập không chính xác.',--}}
{{--                'error'--}}
{{--            )--}}
{{--        }--}}

{{--        modal();--}}
{{--    </script>--}}
{{--@endif--}}
{{--@if(\Illuminate\Support\Facades\Session::has('logout'))--}}
{{--    <script>--}}
{{--        function modal() {--}}
{{--            Swal.fire(--}}
{{--                'Đăng xuất thành công!',--}}
{{--                '',--}}
{{--                'success'--}}
{{--            )--}}
{{--        }--}}

{{--        modal();--}}
{{--    </script>--}}
{{--@endif--}}
</body>

</html>
