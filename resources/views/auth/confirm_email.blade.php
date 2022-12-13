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
        <div hidden class="main" data-url="{{ route('get_login') }}"></div>
    </main>

    @include('layouts.admin._js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function modal() {
            var url = $('.main').data('url');
            console.log(url);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Xác nhận email thành công ',
            }).then(result => {
                location.href = url
            })
        }
        modal();
    </script>
</body>

</html>
