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
    <style>
        .loader-container {
            width: 100%;
            height: 100vh;
            position: fixed;
            background: #ffffff url("https://img.pikbest.com/png-images/20190918/cartoon-snail-loading-loading-gif-animation_2734139.png!bw340") center no-repeat;
            z-index: 1;
        }
    </style>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


    @include('layouts.admin._css')

</head>

<body>

    <div class="loader-container">
        <div class="spinner"></div>
    </div>
    <div class="wrapper">
        @include('layouts.admin.sidebar')

        <div class="main">
            @include('layouts.admin.header')

            <main class="content">
                <div class="container-fluid p-0">
                    {{--                <strong>Analytics</strong> Dashboard --}}
                    <h1 class="h3 mb-3">@yield('title_page')</h1>

                    @yield('content')

                </div>
            </main>

            @include('layouts.admin.footer')
        </div>
    </div>

    @include('layouts.admin._js')

    @yield('custom_js')
    <script !src="">
        const loaderContainer = document.querySelector('.loader-container');
        window.addEventListener('load', () => {
            loaderContainer.style.display = 'none';
        });
    </script>
</body>

</html>
