<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorySearchController extends Controller
{
    //

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function api()
    {
        $data = [];
        $list = DB::table('history_area_search')->selectRaw('COUNT(id) as number,city')->orderBy('number', 'desc')->groupBy('city')->limit(10)->get();
        foreach ($list as $item) {
            $data['value'][] = $item->number;
            $data['label'][] = $item->city;
        }

        return response()->json($data);
    }

    public function index()
    {
        return view('admin.history_search.index', $this->v);
    }
}
