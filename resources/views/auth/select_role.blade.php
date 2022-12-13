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

                                <form class="px-md-4" action="" method="POST"
                                      id="content">
                                    <h4 class="text-center">Cảm ơn bạn đã tạo tài khoản ở website chúng tôi.Trước khi
                                        tiếp tục,chúng tôi
                                        muốn hỏi bạn mục đích đăng ký tài khoản của bạn là gì ?</h4>
                                    @csrf
                                    <input type="hidden" value="{{$user_id}}" name="user_id">
                                    <div class="col">
                                        <div class="form-outline">
                                            <select name="role_id" id="role_id" class="form-control">
                                                <option value="1">Chủ trọ</option>
                                                <option value="3">Người dùng</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center mt-3">
                                        <a href="{{ route('home') }}" class="btn btn-success">Về trang chủ</a>
                                        <button class="btn btn-primary">Tiếp tục</button>

                                        <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
</main>

@include('layouts.admin._js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
