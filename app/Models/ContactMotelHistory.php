<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactMotelHistory extends Model
{
    use HasFactory;

    protected $table = 'contact_motel_history';

    public function create_history($data)
    {
        $res = DB::table($this->table)->insert([
            'user_id' => Auth::id(),
            'motel_id' => $data['id'],
            'status' => 0,
            'created_at' => Carbon::now()
        ]);

        return $res;
    }

    public function confirmContact($motel_id, $area_id, $status, $contact_id)
    {
        $email_boss = DB::table('users')
            ->where('id', DB::table('areas')
                ->select('user_id')
                ->where('id', $area_id)
                ->first()->user_id)->first()->email;
        $user_motel = DB::table('user_motel')
            ->select('email')
            ->join('users', 'user_motel.user_id', '=', 'users.id')
            ->where('user_id', '!=', Auth::id())
            ->where('motel_id', $motel_id)
            ->where('user_motel.status', 1)
            ->get();
        $email = [];
        foreach ($user_motel as $user) {
            $email[] = $user->email;
        }
        DB::table('contact_motel_history')
            ->where('id', $contact_id)
            ->update(['status' => $status]);
        $actor = User::select(['email', 'name', 'phone_number'])->where('id', DB::table('contact_motel_history')
            ->where('id', $contact_id)->first()->user_id)->first();

        return [
            'email' => array_merge([$email_boss], $email, [$actor->email]),
            'actor' => [
                'name' => $actor->name,
                'phone_number' => $actor->phone_number,
                'email' => $actor->email,
                'motel' => DB::table('motels')->select('room_number')->where('id', $motel_id)->first()->room_number,
                'area' => DB::table('areas')->select('name')->where('id', $area_id)->first()->name,
            ]
        ];
    }
}
