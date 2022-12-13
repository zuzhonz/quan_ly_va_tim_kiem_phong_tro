<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Plans;
use App\Http\Requests\PlansRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PlansController extends Controller

{
    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_plans',
                'add_plans',
                'saveAdd_plans',
                'update_plans',
                'saveUpdate_plans',
                'delete_plans',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_plans(Request $request)
    {
        $plans = new Plans;
        $this->v['plans'] = $plans->filter_plans($request->all());
        $this->v['params'] = $request->all() ?? [];
        return view('admin.plan.index', $this->v);
    }


    public function add_plans()
    {
        return view('admin.plan.create');
    }

    public function saveAdd_plans(PlansRequest $request)
    {
        $plans = new Plans;
        //Điền thông tin vào model với một mảng các thuộc tính.
        $plans->fill($request->all());
        // ép kiểu đúng với các trường trong table
        $plans->priority_level = (int)$request->priority_level;
        $plans->type = (int)$request->type;
        $plans->time = (int)$request->time;
        $plans->price = (float)$request->price;
        // lưu dữ liệu
        if ((int)$request->priority_level === 1) {
            $plans->title_color = '#E13427';
        } elseif ((int)$request->priority_level === 2) {
            $plans->title_color = '#ea2e9d';
        } elseif ((int)$request->priority_level === 3) {
            $plans->title_color = '#FF6600';
        } elseif ((int)$request->priority_level === 4) {
            $plans->title_color = '#007BFF';
        } elseif ((int)$request->priority_level === 5) {
            $plans->title_color = '#055699';
        } else {
            $plans->title_color = '#333';
        }


        $plans->save();

        return redirect()->route('backend_admin_get_list_plans');
    }


    public
    function update_plans($id)
    {
        $plans = new Plans;
        return view('admin.plan.edit', [
            'plan' => $plans->show_plans($id)
        ]);
    }

    public
    function saveUpdate_plans(PlansRequest $request, $id)
    {
        $plans = Plans::find($id);

        $plans->fill($request->all());
        // ép kiểu đúng với các trường trong table
        $plans->priority_level = (int)$request->priority_level;
        $plans->type = (int)$request->type;
        $plans->time = (int)$request->time;
        $plans->price = (float)$request->price;
        if ((int)$request->priority_level === 1) {
            $plans->title_color = '#E13427';
        } elseif ((int)$request->priority_level === 2) {
            $plans->title_color = '#ea2e9d';
        } elseif ((int)$request->priority_level === 3) {
            $plans->title_color = '#FF6600';
        } elseif ((int)$request->priority_level === 4) {
            $plans->title_color = '#007BFF';
        } elseif ((int)$request->priority_level === 5) {
            $plans->title_color = '#055699';
        } else {
            $plans->title_color = '#333';
        }
        $plans->save();
        return redirect()->route('backend_admin_get_list_plans')->with('success', "Insert successfully");
    }

    public
    function delete_plans($id)
    {
        Plan::where('id', $id)->update(['status' => 0]);
        return redirect()->route('backend_admin_get_list_plans');
    }
}
