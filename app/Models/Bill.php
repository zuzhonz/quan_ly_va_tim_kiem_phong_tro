<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = ['motel_id', 'title', 'status', 'number_elec', 'number_warter', 'number_elec_old', 'number_warter_old'];


    public function admin_get_list_bill($params = [])
    {
        $query = DB::table('areas')
            ->selectRaw('name,bills.id as bill_id,room_number,
            price,
            (electric_money * (number_elec - number_elec_old)) as tien_dien,
            (warter_money * (number_warter - number_warter_old)) as tien_nuoc,
            wifi,
            bills.created_at,
            bills.status
            ,(electric_money * (number_elec - number_elec_old) + warter_money * (number_warter - number_warter_old) + wifi  + price) as tong')
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('bills', 'motels.id', '=', 'bills.motel_id')
            ->where('areas.user_id', Auth::id());
        if (isset($params['area_id']) && $params['area_id']) {
            $query = $query
                ->where('area_id', $params['area_id']);
        }
        if (isset($params['room_number']) && $params['room_number']) {
            $query = $query
                ->where('motels.id', $params['room_number']);
        }
        if (isset($params['year']) && $params['year']) {
            $query = $query->whereRaw('YEAR(bills.created_at) = ' . $params['year']);
        }
        if (isset($params['month']) && $params['month']) {
            $query = $query->whereRaw('MONTH(bills.created_at) = ' . $params['month']);
        }
        return $query->orderBy('bills.id', 'desc')
            ->paginate($params['limit'] ?? 10);
    }


    public
    function client_get_list_bill_user()
    {
        $query = DB::table('user_motel')
            ->selectRaw('bills.id,
            area_id,
            room_number,
            price,
           (electric_money * (number_elec - number_elec_old)) as tien_dien,
            (warter_money * (number_warter - number_warter_old)) as tien_nuoc,
            wifi,
            bills.created_at,
            bills.status
          ,(electric_money * (number_elec - number_elec_old) + warter_money * (number_warter - number_warter_old) + wifi + price) as tong')
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->join('bills', 'motels.id', '=', 'bills.motel_id')
            ->orderBy('bills.created_at', 'desc')
            ->where('user_motel.user_id', Auth::id())
            ->where('user_motel.status', 1)
            ->paginate(10);
        foreach ($query as $a) {
            $a->area_name = DB::table('areas')->select('name')->where('id', $a->area_id)->first()->name;
        }
        return $query;
    }

    public
    function client_get_bill_user($id)
    {
        $bill = 'bills.id,area_id,room_number,price,wifi,bills.created_at,bills.status,';
        $money = 'motels.electric_money,motels.warter_money,';
        $number = 'bills.number_elec,bills.number_warter,bills.number_elec_old,bills.number_warter_old,';
        $electric_money = '(electric_money * (number_elec - number_elec_old)) as tien_dien,';
        $warter_money = '(warter_money * (number_warter - number_warter_old)) as tien_nuoc,';
        $sum_money = '(electric_money * (number_elec - number_elec_old) + warter_money * (number_warter - number_warter_old) + wifi + price) as tong';

        $query = DB::table('user_motel')
            ->selectRaw($bill . $money . $number . $electric_money . $warter_money . $sum_money)
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->join('bills', 'motels.id', '=', 'bills.motel_id')
            ->orderBy('bills.created_at', 'desc')
            ->where('user_motel.user_id', Auth::id())
            ->where('user_motel.status', 1)
            ->where('bills.id', $id)
            ->first();

        $query->area_name = DB::table('areas')->select('name')->where('id', $query->area_id)->first()->name;

        return $query;
    }
}
