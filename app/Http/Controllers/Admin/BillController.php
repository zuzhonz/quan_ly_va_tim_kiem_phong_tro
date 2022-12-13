<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function React\Promise\all;

class BillController extends Controller
{
    //
    public $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $model = new Bill();

        $area = new Area();
        $this->v['areas'] = $area->admin_get_list_area();
        $this->v['list'] = $model->admin_get_list_bill($request->all());
        $this->v['params'] = $request->all();
        if (!empty($this->v['params'])) {
            if (isset($this->v['params']['area_id']) && $this->v['params']['area_id']) {
                $this->v['motels'] = DB::table('motels')
                    ->select('id', 'room_number')
                    ->where('area_id', $this->v['params']['area_id'])
                    ->get();
            }
        }
        return view('admin.bill.index', $this->v);
    }

    public function confirm(Request $request)
    {
        $res = Bill::find($request->bill_id);

        $res->status = 1;

        $res->save();

        return redirect()->back()->with('success', 'Xác nhận tiền phòng thành công');
    }


    public function get_motel_by_area(Request $request)
    {
        $motel = DB::table('motels')->select('id', 'room_number')->where('area_id', $request->area_id)->get();

        return response()->json($motel);
    }
}
