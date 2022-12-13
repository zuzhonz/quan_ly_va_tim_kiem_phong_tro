<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AreaLocation extends Model
{
    use HasFactory;

    protected $table = 'area_location';

    public function clientGetListLocationByAreaId($area_id)
    {
        return DB::table($this->table)
            ->select(['type', 'name', 'distance'])
            ->join('locations', 'area_location.location_id', '=', 'locations.id')
            ->where('area_id',$area_id)
            ->orderBy('distance', 'asc')
            ->get();
    }
}
