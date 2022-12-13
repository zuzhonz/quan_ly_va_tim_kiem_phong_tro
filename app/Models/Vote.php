<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';

    protected $fillable = ['score', 'message', 'question', 'user_id', 'id'];


    public function client_get_list_vote_motel($motel_id)
    {
        return DB::table('users')
            ->select(['avatar', 'name', 'votes.created_at', 'score', 'message'])
            ->join('votes', 'users.id', '=', 'votes.user_id')
            ->where('motel_id', $motel_id)
            ->paginate(10);
    }
}
