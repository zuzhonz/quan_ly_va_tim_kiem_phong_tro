<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = ['name', 'type', 'latitude', 'longitude'];

    public function getAllLocation($paginate = 0)
    {
        if ($paginate) {
            return DB::table($this->table)->select(['id', 'latitude', 'longitude', 'name', 'type'])->orderBy('id', 'desc')->paginate(10);
        }
        return DB::table($this->table)->select(['id', 'latitude', 'longitude'])->get();
    }
}
