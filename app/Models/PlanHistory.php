<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\CollectionModify;

class PlanHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "plan_id",
        "motel_id",
        'area_id',
        'day',
        'time',
        'type',
        'plan_history.created_at as date',
        "plans.name as planName",
        "areas.name as areaName",
        "room_number",
        'parent_id',
        'plan_history.created_at as created_at',
        'plan_history.status as tt',
        'parent_id',
        'plans.price as gia',
        'is_first'
    ];

    protected $table = "plan_history";

    public function LoadPlansHistoryWithPage($params = [])
    {
        $order_by = $params['order_by'] ?? 'desc';
        $limit = $params['limit'] ?? 10;
        $plansHistory = DB::table('plans')
            ->select(["plan_id",
                "motel_id",
                'area_id',
                'day',
                'time',
                'plans.type',
                'plan_history.created_at as date',
                "plans.name as planName",
                "areas.name as areaName",
                "room_number",
                'parent_id',
                'plan_history.created_at as created_at',
                'plan_history.status as tt',
                'parent_id',
                'plans.price as gia',
                'is_first'])
            ->join('plan_history', 'plans.id', '=', 'plan_history.plan_id')
            ->join('motels', 'plan_history.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->join('users', 'areas.user_id', '=', 'users.id');
        if (isset($params['name'])) {
            $plansHistory = $plansHistory->where('room_number', $params['name']);
        }
        if (!Auth::user()->is_admin) {
            $plansHistory = $plansHistory->where('plan_history.user_id', Auth::id());
        }
        return $plansHistory->where('plan_history.status', '>', 1)
            ->orderBy('plan_history.id', $order_by)->paginate($limit);
    }

    public function LoadPlansHistoryClientWithPage($params = [])
    {
        $order_by = $params['order_by'] ?? 'desc';
        $limit = $params['limit'] ?? 10;
        $plansHistory = DB::table('plans')
            ->select($this->fillable)
            ->join('plan_history', 'plans.id', '=', 'plan_history.plan_id')
            ->join('motels', 'plan_history.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->join('users', 'areas.user_id', '=', 'users.id');
        if (isset($params['name'])) {
            $plansHistory = $plansHistory->where('room_number', $params['name']);
        }
        if (!Auth::user()->is_admin) {
            $plansHistory = $plansHistory->where('users.id', Auth::id());
        }
        return $plansHistory->where('plan_history.status', '>', 1)
            ->orderBy('plan_history.id', $order_by)->paginate($limit);
    }

    public function create($data)
    {
        $query = DB::table($this->table)->insertGetId([
            'plan_id' => $data['plan_id'],
            'motel_id' => $data['motel_id'],
            'day' => $data['day'],
            'status' => $data['status'],
            'parent_id' => $data['parent_id'],
            'is_first' => $data['is_first'],
            'created_at' => Carbon::now(),
            'user_id' => $data['user_id']
        ]);

        return $query;
    }

    public function updateCurrentPlanHistory($motel_id, $plan_id, $day)
    {
        $query = DB::table($this->table)->where('motel_id', $motel_id)
            ->where('plan_id', $plan_id)
            ->where('status', 1)
            ->update([
                'day' => $day
            ]);

        return 1;
    }

    public function list_live_together()
    {
        $query = DB::table('plans')
            ->select(['plan_history.status',
                'motels.id as motel_id',
                'max_people',
                'plans.name',
                'plans.id as plan_id',
                'priority_level',
                'plans.name as plan_name',
                'motels.id as motel_id',
                'motels.room_number',
                'motels.price', 'motels.area',
                'motels.services', 'motels.data_post',
                'motels.photo_gallery as photo_gallery_i',
                'areas.name as area_name',
                'areas.address',])
            ->join('plan_history', 'plans.id', '=', 'plan_history.plan_id')
            ->join('motels', 'plan_history.motel_id', '=', 'motels.id')
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('plan_history.status', 1)
            ->where('type', 2)
            ->orderBy('priority_level', 'asc')
            ->paginate(10);

        foreach ($query as $item) {
            $sql2 = DB::table('votes')->selectRaw('AVG(score) as tb')->where('motel_id', $item->motel_id)->groupBy(['motel_id'])->first()->tb ?? 0;

            $item->vote = $sql2;
        }

        return $query;
    }
}
