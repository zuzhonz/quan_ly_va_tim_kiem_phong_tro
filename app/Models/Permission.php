<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use HasFactory;
    public function getAllPermission(){
        $query = DB::table("permissions")->get();
        return $query;
    }
   
}
