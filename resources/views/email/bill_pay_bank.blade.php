<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        td {
            text-align: center;
            font-size: 20px;
            padding: 4px;
        }

        span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container" style="width: 900px;margin:0 auto;border: 1px solid black;padding: 16px;">
        <div style="display: flex;width: auto;margin-bottom: 24px;">
            <div>
                <img src="https://i.pinimg.com/originals/2c/6a/26/2c6a26997424f975d485dc6678f30a97.jpg" width="100"
                    alt="">
            </div>
            <div>
                <div style="display: flex;justify-content:center;margin-bottom: 8px;">
                    <div style="text-align: center;">
                        <p style="font-size: 14px;">{{ $data['area'] }}</p>
                        <p style="font-size: 14px;">Hotline: 0325500080</p>
                    </div>
                    <h3 class="" style="margin-left: 190px;font-size: 24px;">{{ $data['status'] }}</h3>
                </div>
                <div>
                    <p>Người thuê phòng: {{ $data['user'] }}</p>
                    <p>Số phòng: <span>{{ $data['room'] }}</span></p>
                    <p>Địa chỉ: <span>{{ $data['address'] }}</span></p>
                    <p>Tổng: <strong>{{ number_format($data['money'], 0, ',', '.') }}VNĐ</strong></p>
                    </p>
                </div>
            </div>
        </div>


    </div>
</body>

</html>
