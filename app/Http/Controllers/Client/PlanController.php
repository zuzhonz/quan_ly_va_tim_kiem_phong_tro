<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $v;
    private $Plans;

    public function __construct()
    {
        $this->v = [];
    }

    public function index_plan()
    {
        $model = new Plans();
        $this->v['plans'] = $model->list();
        return view('client.home.Plans', $this->v);
    }
}
