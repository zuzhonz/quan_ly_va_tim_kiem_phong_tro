<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Deposit extends Model
{
    use HasFactory;

    protected $table = 'deposits';

    public function get_list_admin_deposit($params = [])
    {
        $params['order_by'] = $params['order_by'] ?? 'desc';
        $params['limit'] = $params['limit'] ?? 10;
        $query = DB::table('users')->select([
            'deposits.id as deID', 'users.name as userName', 'room_number', 'value',
            'areas.name as areaName', 'deposits.created_at as date', 'areas.user_id as boss_id',
            'deposits.status as deStatus', 'type'
        ])
            ->join($this->table, 'users.id', '=', 'deposits.user_id')
            ->join('motels', 'deposits.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id');
        if (!Auth::user()->is_admin) {
            $query = $query->where('areas.user_id', Auth::id());
        }

        if (isset($params['name']) && $params['name']) {
            $query = $query->where('users.name', 'like', '%' . $params['name'] . '%')
                ->orWhere('areas.name', 'like', '%' . $params['name'] . '%');
        }

        return $query->orderBy('deID', $params['order_by'])->paginate($params['limit']);
    }

    public function saveNew($params)
    {
        $data = array_merge($params);
        $data['created_at'] = Carbon::now();
        $request = DB::table($this->table)->insertGetId($data);
        return $request;
    }

    public function get_list_client_deposit()
    {
        $query = DB::table('users')->select([
            'deposits.id as deID', 'users.name as userName', 'room_number', 'value',
            'areas.name as areaName', 'deposits.created_at as date', 'areas.user_id as boss_id',
            'deposits.status as deStatus', 'type', 'day_deposit'
        ])
            ->join($this->table, 'users.id', '=', 'deposits.user_id')
            ->join('motels', 'deposits.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('deposits.user_id', '=', Auth::user()->id)->get();
        // dd($query);
        return $query;
    }
}
