<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanHistoryController extends Controller
{
    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_plan_history',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_plan_history(Request $request)
    {
        $planHistory = new PlanHistory();
        $this->v['params'] = $request->all();
        $this->v['plansHistory'] = $planHistory->LoadPlansHistoryWithPage($this->v['params']);
        return view("admin.plan-history.list", $this->v);
    }
}
