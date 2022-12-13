<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = ['user_id', 'motel_id', 'time', 'status'];

    public function insertRecord($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function currentAppoint($motel_id)
    {
        return DB::table($this->table)->where('user_id', Auth::id())->where('motel_id', $motel_id)->first() ?? null;
    }

    public function client_get_history()
    {
        return DB::table($this->table)
            ->select(['users.name', 'areas.name as area_name',
                'phone_number', 'room_number',
                'time', 'appointments.id', 'appointments.status'])
            ->join('motels', 'appointments.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->join('users', 'areas.user_id', '=', 'users.id')
            ->where('appointments.user_id', Auth::id())
            ->paginate(10);
    }

    public function admin_get_history()
    {
        return DB::table('users')
            ->select(['users.name', 'areas.name as area_name',
                'phone_number', 'room_number',
                'time', 'appointments.id', 'appointments.status'])
            ->join('appointments', 'users.id', '=', 'appointments.user_id')
            ->join('motels', 'appointments.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('areas.user_id', Auth::id())
            ->paginate(10);
    }

    public function updateAppoint($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
}
