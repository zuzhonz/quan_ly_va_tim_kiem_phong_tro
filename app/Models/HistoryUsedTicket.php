<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUsedTicket extends Model
{
    use HasFactory;

    protected $table = 'history_used_ticket';

    protected $fillable = ['ticket_id', 'gift'];
}
