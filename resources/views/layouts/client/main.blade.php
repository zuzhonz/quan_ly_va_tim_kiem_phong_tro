<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Sep 2022 14:23:02 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Chợ phòng trọ - Website tìm kiếm phòng trọ số 1 Việt Nam</title>
    <!-- FAVICON -->
    @include('layouts.client._css')
    <style>
        #header.cloned {
            background-color: #FF385C;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
</head>

<body class="homepage-9 hp-6 homepage-1 mh inner-pages sin-1 homepage-4 hd-white">
    <!-- Wrapper -->
    <div id="wrapper">
        @include('layouts.client.header')
        <div class="clearfix"></div>
        @yield('content')
        @include('layouts.client.footer')
        @include('layouts.client._js')
        @yield('custom_js')
    </div>
</body>
<!-- Mirrored from code-theme.com/html/findhouses/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Sep 2022 14:23:46 GMT -->

</html>
