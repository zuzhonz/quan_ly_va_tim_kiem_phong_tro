<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plans extends Model
{
    use HasFactory;

    protected $table = 'Plans';

    //lấy các trường trong các data
    protected $fillable = [
        'id',
        'name',
        'desc',
        'priority_level',
        'type',
        'time',
        'price',
        'created_at',
        'status',
        'title_color'
    ];

    public function list()
    {
        $plans = new Plans;
        return $plans->select($this->fillable)->where('status', '!=', 0)->orderBy('id', 'desc')->get();
    }

    public function show_plans($id)
    {
        $plans = new Plans;
        $data = $plans->select($this->fillable)->find($id);
        return $data;
    }

    public function filter_plans($params = [])
    {
        $params['order_by'] = $params['order_by'] ?? 'asc';
        $params['limit'] = $params['limit'] ?? 10;

        $query = DB::table($this->table)->select($this->fillable);
        if (isset($params['name']) && $params['name']) {
            $query = $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        return $query->orderBy('id', $params['order_by'])->paginate($params['limit']);
    }
}
