<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotelVote extends Model
{
    use HasFactory;

    protected $table = 'motel_vote';

    protected $fillable = ['vote_id', 'motel_id'];
}
