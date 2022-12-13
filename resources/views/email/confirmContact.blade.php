<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>Phòng {{$data['motel'].' - '.$data['area']}}</h3>
<p>{{\Illuminate\Support\Facades\Auth::user()->name}} đã thay đổi trạng thái đăng ký ở ghép của {{$data['name']}}</p>
<p>Thời gian: {{\Carbon\Carbon::now()->format('h:i d/m/Y')}}</p>

</body>
</html>
