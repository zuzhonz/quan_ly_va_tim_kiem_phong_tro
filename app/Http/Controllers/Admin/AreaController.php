<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BillsImport;
use App\Imports\MotelsImport;
use App\Mail\ForgotOtp;
use App\Mail\SendBillToCustomer;
use App\Models\Area;
use App\Models\AreaLocation;
use App\Models\Bill;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use mysql_xdevapi\CollectionModify;
use PhpParser\Node\Expr\New_;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{

    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_areas',
                'add_areas',
                'saveAdd_areas',
                'update_areas',
                'saveUpdate_areas',
                'delete_areas'
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_areas(Request $request)
    {
        $areas = new Area();
        $this->v['params'] = $request->all() ?? [];

        $this->v['areas'] = $areas->admin_get_list_area($request->all());

        return view('admin.area.index', $this->v);
    }

    public function add_areas()
    {


        return view('admin.area.add', $this->v);
    }

    public function saveAdd_areas(Request $request)
    {
        $params = [];

        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());

        if ($request->imgReal) {
            $params['cols']['img'] = cloudinary()->upload($request->imgReal, [
                'resource_type' => 'auto',
                'folder' => 'DATN_FALL2022'
            ])->getSecurePath();
        } else {
            $params['cols']['img'] = asset('assets/client/images/popular-places/5.jpg');
        }
        $model = new Area();
        $area_id = $model->admin_create_area($params);
        $dataInsertLocation = [];
        $model = new Location();

        foreach ($model->getAllLocation() as $location) {
            $distance = $this->haversineGreatCircleDistance((double)$request->latitude, (double)$request->longitude, $location->latitude, $location->longitude);
            if ($distance <= 10000) {
                $dataInsertLocation[] = [
                    'area_id' => $area_id,
                    'location_id' => $location->id,
                    'distance' => $distance / 1000
                ];
            }
        }
        $areaLocation = AreaLocation::insert($dataInsertLocation);

        return redirect()->route('backend_get_list_area')->with('success', 'Thêm mới khu trọ thành công');

    }

    public function update_areas($id)
    {
        $model = new Area();

        $this->v['area'] = $model->getArea($id);

        return view('admin.area.edit', $this->v);

    }

    public function saveUpdate_areas(Request $request, $id)
    {

        $params = [];

        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());
        $params['cols']['id'] = $id;
        if (strpos($request->imgReal, 'https://res.cloudinary.com') === false) {
            $params['cols']['img'] = cloudinary()->upload($request->imgReal, [
                'resource_type' => 'auto',
                'folder' => 'DATN_FALL2022'
            ])->getSecurePath();
        } else {
            $params['cols']['img'] = $request->imgReal;
        }

        $model = new Area();
        $area_id = $model->admin_update_area($params);

        $dataInsertLocation = [];

        DB::table('area_location')->where('area_id', $area_id)->delete();

        $model = new Location();

        foreach ($model->getAllLocation() as $location) {
            $distance = $this->haversineGreatCircleDistance((double)$request->latitude, (double)$request->longitude, $location->latitude, $location->longitude);
            if ($distance <= 10000) {
                $dataInsertLocation[] = [
                    'area_id' => $area_id,
                    'location_id' => $location->id,
                    'distance' => $distance / 1000
                ];
            }
        }
        $areaLocation = AreaLocation::insert($dataInsertLocation);


        return redirect()->route('backend_get_list_area')->with('success', 'Cập nhật khu trọ thành công');

    }

    public function delete_areas($id)
    {
        $model = new Area();

        $model->adminDeteletArea($id);

        return redirect()->route('backend_get_list_area');
    }

    public function send_bill(Request $request)
    {
        Excel::import(new BillsImport(), $request->file('file'));

        $motels = DB::table('users')
            ->select(['motel_id', 'email'])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
            ->where('area_id', $request->area_id)
            ->where('user_motel.status', 1)
            ->get();

        foreach ($motels as $motel) {
            $bill = Bill::selectRaw('name,room_number,
            title,
            areas.address,
            price,
            electric_money,
            number_elec_old,
            warter_money,
            number_warter_old,
            number_warter,
            number_elec,
            (electric_money * (number_elec - number_elec_old)) as tien_dien,
            (warter_money * (number_warter - number_warter_old)) as tien_nuoc,
            wifi,
            bills.created_at,
            (electric_money * (number_elec - number_elec_old) + warter_money * (number_warter - number_warter_old) + wifi + price) as tong')
                ->where('motel_id', $motel->motel_id)
                ->join('motels', 'bills.motel_id', '=', 'motels.id')
                ->join('areas', 'motels.area_id', '=', 'areas.id')
                ->where('bills.status', 0)->get();
            $user_name = DB::table('users')
                ->select(['name'])
                ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
                ->where('user_motel.status', 1)
                ->where('motel_id', $motel->motel_id)
                ->orderBy('user_motel.start_time', 'asc')
                ->first()->name;
            if ($bill) {
                try {
                    Mail::to($motel->email)->send(new SendBillToCustomer([
                        'ten_khu_tro' => $bill->name,
                        'nguoi_thue' => $user_name,
                        'ma_phong' => $bill->room_number,
                        'dia_chi' => $bill->address,
                        'ngay_lam_hd' => $bill->created_at,
                        'tieu_de' => $bill->title,
                        'tien_phong' => $bill->price,
                        'so_dien_cu' => $bill->number_elec_old,
                        'so_dien_moi' => $bill->number_elec,
                        'so_nuoc_cu' => $bill->number_warter_old,
                        'so_nuoc_moi' => $bill->number_warter,
                        'wifi' => $bill->wifi,
                        'gia_nuoc' => $bill->warter_money,
                        'gia_dien' => $bill->electric_money,
                        'tong_dien' => $bill->tien_dien,
                        'tong_nuoc' => $bill->tien_nuoc,
                        'tong_tien' => $bill->tong
                    ]));
                } catch (\Exception $e) {
                    return redirect()->back();
                }
            }
        }
        return redirect()->back()->with('success', 'Gửi hóa đơn thành công');
    }

    public function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

}
