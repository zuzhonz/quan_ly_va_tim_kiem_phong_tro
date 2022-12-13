<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = [
        'id',
        'name',
        'desc',
        'priority_level',
        'type',
        'time',
        'price',
        'created_at',
        'status'
    ];

    public function getAll(){
        return DB::table($this->table)->select($this->fillable)->get();
    }
}
