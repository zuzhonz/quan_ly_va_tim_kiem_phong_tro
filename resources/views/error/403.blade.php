<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:700);

        *, *:before, *:after {
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background-color: #342643;
            height: 100%;
            padding: 10px;
        }

        a {
            color: #EE4B5E !important;
            text-decoration: none;
        }

        a:hover {
            color: #FFFFFF !important;
            text-decoration: none;
        }

        .text-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .title {
            font-size: 5em;
            font-weight: 700;
            color: #EE4B5E;
        }

        .subtitle {
            font-size: 40px;
            font-weight: 700;
            color: #1FA9D6;
        }

        .isi {
            font-size: 18px;
            text-align: center;
            margin: 30px;
            padding: 20px;
            color: white;
        }

        .buttons {
            margin: 30px;
            font-weight: 700;
            border: 2px solid #EE4B5E;
            text-decoration: none;
            padding: 15px;
            text-transform: uppercase;
            color: #EE4B5E;
            border-radius: 26px;
            transition: all 0.2s ease-in-out;
            display: inline-block;

        .buttons:hover {
            background-color: #EE4B5E;
            color: white;
            transition: all 0.2s ease-in-out;
        }

        }
        }

    </style>
</head>
<body>
<div class="text-wrapper">
    <div class="title" data-content="404">
        403 - TRUY CẬP BỊ TỪ CHỐI
    </div>

    <div class="subtitle">
        Rất tiếc, Bạn không có quyền truy cập trang này.
    </div>
    <div class="isi">
        Máy chủ web có thể trả về mã trạng thái HTTP bị cấm 403 để phản hồi lại yêu cầu từ khách hàng cho một trang web
        hoặc tài nguyên để chỉ ra rằng máy chủ có thể được tiếp cận và hiểu được yêu cầu, nhưng từ chối thực hiện bất kỳ
        đẩy mạnh. Các phản hồi mã trạng thái 403 là kết quả của việc máy chủ web được định cấu hình để từ chối quyền
        truy cập, vì
        một số lý do, đến tài nguyên được yêu cầu bởi khách hàng.
    </div>

    <div class="buttons">
        <a class="button" href="{{route('home')}}">Trờ về trang chủ</a>
    </div>
</div>
</body>
</html>
