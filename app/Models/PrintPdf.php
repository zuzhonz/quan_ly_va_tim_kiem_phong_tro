<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Money\Number;

class PrintPdf extends Model
{
    use HasFactory;


    public function printMotel($motel_id, $data)
    {
        $infoMotel = DB::table('motels')
            ->select(['users.name as boss', 'room_number', 'areas.name as area_name', 'price', 'areas.address as dc', 'phone_number'])
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('motels.id', $motel_id)
            ->first();
        $user = DB::table('users')->select(['name', 'phone_number'])->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->where('motel_id', $motel_id)->where('user_motel.status', 1)->first();
        $output = '
        <style>
 body{
 font-family: "DejaVu Sans";
 }
</style>
      <div style="border: 1px solid black">
        <div style="text-align: center">
        <h4 style="font-weight: bold;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
        <p>Độc lập – Tự do – Hạnh phúc</p>
        <p>HỢP ĐỒNG THUÊ PHÒNG TRỌ</p>
        </div>
<div style="margin-left: 10px;">
<p >Hôm nay ngày ' . Carbon::now()->format('d') . ' tháng ' . Carbon::now()->format('m') . ' năm ' . Carbon::now()->format('Y') . '; tại địa chỉ: ' . $infoMotel->dc . '</p>
<p style="font-weight: bold">Chúng tôi gồm:</p>
<p>1.Đại diện bên cho thuê phòng trọ (Bên A):</p>
<p>Ông/bà: ' . $infoMotel->boss . '. Sinh ngày: 13/04/2000.</p>
<p>Nơi đăng ký HK: Tốt Động,Chương Mỹ,Hà Nội</p>
<p>CMND số: 001202023168 cấp ngày 23/05/2021 tại: Cục cảnh sát.</p>
<p>Số điện thoại: ' . $infoMotel->phone_number . '</p>
<p>2. Bên thuê phòng trọ (Bên B):</p>
<p>Ông/bà: ' . $user->name . '. Sinh ngày: 22/10/2000.</p>
<p>Nơi đăng ký HK: Tốt Động,Chương Mỹ,Hà Nội</p>
<p>CMND số: 001202023168 cấp ngày 23/05/2021 tại: Cục cảnh sát.</p>
<p>Sau khi bàn bạc trên tinh thần dân chủ, hai bên cùng có lợi, cùng thống nhất như sau:</p>
<p>Bên A đồng ý cho bên B thuê 01 phòng ở tại địa chỉ: ' . $infoMotel->dc . '</p>
<p>Tiền điện ' . number_format($data['electric_money'], 0, ',', '.') . 'đ / kwh tính theo chỉ số công tơ, thanh toán vào cuối các tháng .</p >
<p> Tiền nước: ' . number_format($data['warter_money'], 0, ',', '.') . 'đ / người thanh toán vào đầu các tháng .</p >
<p>Tiền mạng: ' . number_format($data['wifi'], 0, ',', '.') . 'đ / người thanh toán vào đầu các tháng .</p>
<p>Giá thuê: ' . number_format($infoMotel->price, 0, ',', '.') . '.đ/tháng</p>
<p>Hình thức thanh toán: Chuyển khoản.</p>
<p > Hợp đồng có giá trị kể từ ngày ' . Carbon::parse($data['start_time'])->format('d') . ' tháng ' . Carbon::parse($data['start_time'])->format('m') . ' ' . Carbon::parse($data['start_time'])->format('Y') . ' đến ngày ' . Carbon::parse($data['end_time'])->format('d') . ' tháng ' . Carbon::parse($data['end_time'])->format('m') . ' năm ' . Carbon::parse($data['end_time'])->format('Y') . ' </p >
<p style = "font-weight: bold;" > TRÁCH NHIỆM CỦA CÁC BÊN </p >
<p >* Trách nhiệm của bên A:</p >
<p > -Tạo mọi điều kiện thuận lợi để bên B thực hiện theo hợp đồng .</p >
<p > -Cung cấp nguồn điện, nước, wifi cho bên B sử dụng .</p >
<p >* Trách nhiệm của bên B:</p >
<p > -Thanh toán đầy đủ các khoản tiền theo đúng thỏa thuận .</p >
<p > -Bảo quản các trang thiết bị và cơ sở vật chất của bên A trang bị cho ban đầu(làm hỏng phải sửa, mất phải đền).</p >
<p > -Không được tự ý sửa chữa, cải tạo cơ sở vật chất khi chưa được sự đồng ý của bên A .</p >
<p > -Giữ gìn vệ sinh trong và ngoài khuôn viên của phòng trọ .</p >
<p > -Bên B phải chấp hành mọi quy định của pháp luật Nhà nước và quy định của địa phương .</p >
<p > -Nếu bên B cho khách ở qua đêm thì phải báo và được sự đồng ý của chủ nhà đồng thời phải chịu trách nhiệm về các hành vi vi phạm pháp luật của khách trong thời gian ở lại .</p >
<div ></div >
<div ></div >
<p style = "font-weight: bold;" > TRÁCH NHIỆM CHUNG </p >
<p > -Hai bên phải tạo điều kiện cho nhau thực hiện hợp đồng .</p >
<p > -Trong thời gian hợp đồng còn hiệu lực nếu bên nào vi phạm các điều khoản đã thỏa thuận thì bên còn lại có quyền đơn phương chấm dứt hợp đồng; nếu sự vi phạm hợp đồng đó gây tổn thất cho bên bị vi phạm hợp đồng thì bên vi phạm hợp đồng phải bồi thường thiệt hại .</p >
<p > -Một trong hai bên muốn chấm dứt hợp đồng trước thời hạn thì phải báo trước cho bên kia ít nhất 30 ngày và hai bên phải có sự thống nhất .</p >
<p > -Bên A phải trả lại tiền đặt cọc cho bên B .</p >
<p > -Bên nào vi phạm điều khoản chung thì phải chịu trách nhiệm trước pháp luật .</p >
<p > -Hợp đồng được lập thành 02 bản có giá trị pháp lý như nhau, mỗi bên giữ một bản .</p >
<p >
<span style = "margin-left: 15%;font-weight: bold;margin-bottom: 100px" > ĐẠI DIỆN BÊN A </span >
<span style = "margin-left: 28%;font-weight: bold;margin-bottom: 100px" > ĐẠI DIỆN BÊN B </span >
</p >
</div >
</div >
    ';
        return $output;
    }
}
