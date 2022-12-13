<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notify</title>
</head>
<body>
    <h3>Chào {{$data->name}}</h3>
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <h5 class="card-title">Hợp đồng của bạn sắp hết hạn </h5>
            <p class="card-text"> Hợp đồng thuê trọ phòng {{$data->room_number}} của bạn sẽ hết hạn vào ngày {{$data->end_time}} </p>
            <p class="card-text">Để tránh các trường hợp rủi ro <br> chúng tôi cần xác nhận có tiếp tục gia hạn hợp đồng nhà trọ hay không  </p><br>
            <p class="card-text"> Vui lòng liên hệ chủ trọ </p>

        </div>
    </div>
</body>
</html>
