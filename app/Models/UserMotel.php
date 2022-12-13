<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMotel extends Model
{
    use HasFactory;

    protected $table = "user_motel";


    public function add($motel_id, $user_id, $type)
    {
        $model = DB::table($this->table)->insert([
            'motel_id' => $motel_id,
            'user_id' => $user_id,
            'status' => 1,
            'start_time' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        $motel = DB::table('motels')->where('id', $motel_id);

        if ($motel->first()->status) {
            $motel->update([
                'status' => 2
            ]);
        }
        if ($type) {
            DB::table('contact_motel_history')
                ->where('user_id', $user_id)
                ->where('motel_id', $motel_id)
                ->where('status', 1)
                ->update([
                    'status' => 3
                ]);
        }

        return 1;
    }

    public function historyMotel($motel_id)
    {
        return DB::table($this->table)
            ->select(['name', 'email', 'phone_number', 'user_motel.status as tt', 'user_motel.start_time as bd', 'user_motel.end_time as kt'])
            ->join('users', 'user_motel.user_id', '=', 'users.id')
            ->where('motel_id', $motel_id)
            ->paginate(10);
    }

    public function currentMotel($motel_id = null)
    {
        return DB::table($this->table)
            ->select(['user_motel.id', 'motels.id as motel_id',
                'area_id',
                'motels.photo_gallery',
                'motels.description',
                'areas.name as area_name',
                'areas.address',
                'user_motel.status as tt',
                'user_motel.start_time as user_motel_start_time',
                'user_motel.end_time as user_motel_end_time',
                'motels.room_number',
                'motels.price',
                'motels.data_post',
                'is_vote'
            ])
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('user_motel.user_id', Auth::id())
            ->orderBy('user_motel_start_time', 'desc')
            // ->limit(1)
            ->get();
    }

    public function currentMotel1($motel_id = null)
    {
        return DB::table($this->table)
            ->select(['motels.id as motel_id',
                'motels.photo_gallery',
                'motels.description',
                'areas.name as area_name',
                'areas.address',
                'user_motel.status as tt',
                'user_motel.start_time as user_motel_start_time',
                'user_motel.end_time as user_motel_end_time',
                'motels.room_number',
                'motels.price',
                'motels.data_post'])
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('user_motel.user_id', Auth::id())
            ->where('motel_id', $motel_id)
            ->first();
    }

    public function number_people_live_now($motel_id)
    {
        return DB::table($this->table)
            ->select('user_id')->where('motel_id', $motel_id)
            ->get();
    }

}
