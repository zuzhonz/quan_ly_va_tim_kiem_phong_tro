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
            <img src="https://i.pinimg.com/originals/2c/6a/26/2c6a26997424f975d485dc6678f30a97.jpg" width="100" alt="">
        </div>
        <div>
            <div style="display: flex;justify-content:center;margin-bottom: 8px;">
                <div style="text-align: center;">
                    <p style="font-size: 14px;">{{$data['ten_khu_tro']}}</p>
                    <p style="font-size: 14px;">Hotline: 0325500080</p>
                </div>
                <h3 class="" style="margin-left: 190px;font-size: 24px;">{{$data['tieu_de']}}</h3>
            </div>
            <div>
                <p>Người thuê phòng: {{$data['nguoi_thue']}}</p>
                <p>Số phòng: <span>{{$data['ma_phong']}}</span></p>
                <p>Địa chỉ: <span>{{$data['dia_chi']}}</span></p>
                <p>Ngày làm hóa đơn: <span>{{\Carbon\Carbon::parse($data['ngay_lam_hd'])->format('h:i d/m/Y')}}</span>
                </p>
            </div>
        </div>
    </div>
    <table border=1 style="width: 100%;margin-bottom: 24px;">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên dịch vụ</th>
            <th>Chỉ số cũ</th>
            <th>Chỉ số mới</th>
            <th>Số lượng</th>
            <th>Đơn giá<br>(VNĐ)</th>
            <th>Thành tiền<br>(VNĐ)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="">1</td>
            <td>Tiền phòng</td>
            <td></td>
            <td></td>
            <td>1</td>
            <td>{{number_format($data['tien_phong'], 0, ',', '.')}}</td>
            <td>{{number_format($data['tien_phong'], 0, ',', '.')}}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Điện (số)</td>
            <td>{{number_format($data['so_dien_cu'], 0, ',', '.')}}</td>
            <td>{{number_format($data['so_dien_moi'], 0, ',', '.')}}</td>
            <td>{{number_format($data['so_dien_moi'] - $data['so_dien_cu'], 0, ',', '.')}}</td>
            <td>{{number_format($data['gia_dien'], 0, ',', '.')}}</td>
            <td>{{number_format($data['tong_dien'], 0, ',', '.')}}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Nước (m3/tháng)</td>
            <td>{{number_format($data['so_nuoc_cu'], 0, ',', '.')}}</td>
            <td>{{number_format($data['so_nuoc_moi'], 0, ',', '.')}}</td>
            <td>{{number_format($data['so_nuoc_moi'] - $data['so_nuoc_cu'], 0, ',', '.')}}</td>
            <td>{{number_format($data['gia_nuoc'], 0, ',', '.')}}</td>
            <td>{{number_format($data['tong_nuoc'], 0, ',', '.')}}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Internet (phòng/tháng)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{number_format($data['wifi'], 0, ',', '.')}}</td>
        </tr>
        <tr>
            <td colspan="6">Tổng</td>
            <td>{{number_format($data['tong_tien'], 0, ',', '.')}}</td>
        </tr>
        </tbody>
    </table>
    <p><span>BQL xin thông báo: </span> Yêu cầu các phòng thanh toán tiền nhà và tiền dịch vụ từ <span>ngày 01 đến ngày 04</span>
        của kỳ thanh toán và tất cả
        đều nhận theo hình thực chuyển khoản <span>KHÔNG DÙNG TIỀN MẶT</span>.Tất cả các trường hợp chậm sau ngày 06 đều
        bị xử phạt 200.000đ/1 lần trừ vào tiền cọc</p>

    <p style="margin-top: 8px;">Tên TK: Ngô Văn Phong</p>
    <p style="margin: 8px 0px;">Số TK: 0976322350</p>
    <p style="margin: 8px 0px;">Ngân hàng: MB bank</p>
    <p style="margin-bottom: 10px">Nội dung:Tên viết tắt của địa chỉ nhà,số phòng,Tên người chuyển </p>
    <div style="margin-bottom: 24px">
        <p style="font-weight: bold;font-size: 16px;float: left;margin-left: 200px;">Người thu tiền</p>
        <p style="font-weight: bold;font-size: 16px;float: right;margin-right: 200px;">Người nộp tiền</p>
    </div>
</div>
</body>
</html>
