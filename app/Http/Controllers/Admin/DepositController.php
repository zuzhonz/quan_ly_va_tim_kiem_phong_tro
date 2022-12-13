<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_deposits',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_deposits(Request $request)
    {
        $areas = new Deposit();
        $this->v['deposits'] = $areas->get_list_admin_deposit($request->all());
        $this->v['params'] = $request->all() ?? [];
        return view('admin.deposit.index', $this->v);
    }

    public function change_status_deposit($id)
    {
        $res = Deposit::where('id', $id)->update([
            'status' => 1,
        ]);
        if ($res == 1) {
            return redirect()->back()->with('success', 'Xác nhận thành công');
        }
        return redirect()->back()->with('error', 'Xác nhận thất bại');
    }
}
