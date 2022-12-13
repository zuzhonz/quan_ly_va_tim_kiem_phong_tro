<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\LocationImport;
use App\Imports\MotelsImport;
use App\Models\Location;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LocationController extends Controller
{
    //

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $model = new Location();
        $this->v['locations'] = $model->getAllLocation(1);
        return view('admin.location.index', $this->v);
    }

    public function importFileExcel(Request $request)
    {
        Excel::import(new LocationImport(), $request->file('file'));

        return redirect()->back()->with('success', 'Nhập file excel thành công');
    }
}
