<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    public function admin_get_list_area($params = [])
    {
        $params['order_by'] = $params['order_by'] ?? 'desc';
        $params['name'] = $params['name'] ?? '';
        $params['limit'] = $params['limit'] ?? 5;
        $query = DB::table($this->table)->where('user_id', Auth::id())->where('status', '!=', 0);

        if ($params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        return $query
            ->orderBy('id', $params['order_by'])
            ->paginate($params['limit']);
    }

    public function admin_create_area($params = [])
    {
        $result = DB::table($this->table)->insertGetId([
            'name' => $params['cols']['name'],
            'address' => $params['cols']['address'],
            'link_gg_map' => $params['cols']['link_gg_map'],
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'img' => $params['cols']['img'],
            'district_id' => $params['cols']['district_id'],
            'ward_id' => $params['cols']['ward_id'],
            'latitude' => $params['cols']['latitude'],
            'longitude' => $params['cols']['longitude'],
            'city_id' => $params['cols']['city_id']
        ]);

        return $result;
    }

    public function getArea($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    public function admin_update_area($params = [])
    {
        $result = DB::table($this->table)->where('id', $params['cols']['id'])->update([
            'name' => $params['cols']['name'],
            'address' => $params['cols']['address'],
            'link_gg_map' => $params['cols']['link_gg_map'],
            'img' => $params['cols']['img'],
            'district_id' => $params['cols']['district_id'],
            'ward_id' => $params['cols']['ward_id'],
            'city_id' => $params['cols']['city_id'],
            'latitude' => $params['cols']['latitude'],
            'longitude' => $params['cols']['longitude'],
        ]);

        return $params['cols']['id'];
    }

    public function adminDeteletArea($id)
    {
        DB::table($this->table)->where('id', $id)->update(['status' => 0]);
    }

    public function client_Get_List_Top_Area()
    {

        $res = DB::table('areas')->select(['areas.id', 'areas.name', 'areas.img as image', 'areas.address', DB::raw('COUNT(motels.area_id) as quantity')])
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->where('plan_history.status', 1)
            ->where('motels.status', 5)
            ->limit(8)
            ->orderByDesc('quantity')
            ->groupBy('areas.name', 'areas.address', 'areas.id', 'image')
            ->get();
        return $res;
    }

    public function client_get_list_motel($area_id)
    {
        $query = DB::table('users')
            ->select(['users.name',
                'motel_id',
                'electric_money',
                'warter_money',
                'motels.price',
                'area',
                'avatar',
                'plan_history.created_at',
                'room_number',
                'areas.address',
                'link_gg_map',
                'services',
                'photo_gallery',
                'areas.name as area_name'])
            ->join('areas', 'users.id', '=', 'areas.user_id')
            ->join('motels', 'areas.id', '=', 'motels.area_id')
            ->join('plan_history', 'motels.id', '=', 'plan_history.motel_id')
            ->join('plans', 'plan_history.plan_id', '=', 'plans.id')
            ->where('plan_history.status', 1)
            ->where('type', 1)
            ->where('motels.status', '=', 5)
            ->where('area_id', $area_id)
            ->orderBy('priority_level')
            ->paginate(10);
        return $query;
    }
}
