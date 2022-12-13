<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RechargeController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_recharges',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_recharges(Request $request)
    {
        $model = new Recharge();
        $this->v['recharges'] = $model->admin_get_list_recharges($request->all());
        $this->v['params'] = $request->all();
        return view('admin.recharge.index', $this->v);
    }

    public function get_form_recharge()
    {
        return view('admin.recharge.form', $this->v);
    }
}
