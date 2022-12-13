</html>
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
    <div>
        <h3>{{$email['user_email']}} vừa đặt cọc tại phòng {{$email['room_number']}}, {{$email['area_name']}}</h3>
        <p>Hình thức cọc: {{$email['type'] == 1 ? 'Chuyển xu' : 'Chuyển khoản'}}</p>
        <p>
            @if ($email['type'] == 1)
                <span>Số xu: {{number_format($email['value'], 0, ',', '.')}} Xu</span>
            @else
                <p>Số tiền: <span>{{number_format($email['value'], 0, ',', '.')}} VNĐ</span></p>
                <p>Nếu đã nhận được, hãy vào hệ thống xác minh bạn đã nhận được tiền cọc</p>
            @endif
        </p>
    </div>
</body>
</html>
