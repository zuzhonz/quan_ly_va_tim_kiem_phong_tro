<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ForgotOtp;
use App\Models\ContactMotelHistory;
use App\Models\HistoryUsedTicket;
use App\Models\Motel;
use App\Models\PlanHistory;
use App\Models\Recharge;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserMotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccountManagementController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function getRecharge()
    {
        return view('client.account_management.recharge', $this->v);
    }

    public function historyRecharge(Request $request)
    {
        $model = new Recharge();
        $this->v['recharges'] = $model->admin_get_list_recharges($request->all());
        return view('client.account_management.history_recharge', $this->v);
    }

    public function historyBuyPlan(Request $request)
    {
        $planHistory = new PlanHistory();
        $this->v['params'] = $request->all();
        $this->v['plansHistory'] = $planHistory->LoadPlansHistoryWithPage($this->v['params']);
//        dd($this->v['plansHistory']);
        return view('client.account_management.history_buy_plan', $this->v);
    }

    public function outMotel($motelId, Request $request)
    {
        if (!isset($request->status)) {
            $userMotel = DB::table('user_motel')
                ->where('motel_id', $motelId)
                ->where('user_id', Auth::id())
                ->where('status', 1)
                ->update(['status' => 2]);
            return redirect()->back()->with('success', 'Gửi yêu cầu rời trọ thành công');
        } else {
            $userMotel = DB::table('user_motel')
                ->where('motel_id', $motelId)
                ->where('user_id', Auth::id())
                ->where('status', 2)
                ->update(['status' => 1]);
            return redirect()->back()->with('success', 'Hủy yêu cầu rời trọ thành công');
        }

//        Mail::to(Auth::user()->email)->send(new ForgotOtp(Auth::user()->name) . ' đã gửi yêu cầu rời trọ');

    }

    public function profile()
    {
        $this->v['user'] = Auth::user();
        $this->v['currentMotel'] = [];
        if (isset(UserMotel::select('motel_id')->where('user_id', Auth::id())->where('status', 1)->first()->motel_id)) {
            $this->v['currentMotel'] = DB::table('users')
                ->select(['email', 'users.name as userName', 'users.address as userAdd', 'phone_number', 'areas.name as area_name', 'room_number', 'user_motel.start_time as tg'])
                ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
                ->join('motels', 'user_motel.motel_id', '=', 'motels.id')
                ->join('areas', 'motels.area_id', '=', 'areas.id')
                ->where('motel_id', UserMotel::select('motel_id')->where('user_id', Auth::id())->where('status', 1)->first()->motel_id)
                ->where('user_motel.status', 1)
                ->get();
        }

        return view('client.account_management.profile', $this->v);
    }

    public function editProfile(Request $request)
    {
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ]);

        return redirect()->back()->with('success', 'true');
    }

    public function changePassword(Request $request)
    {
        return view('client.account_management.changePassword', $this->v);
    }

    public function saveChangePassword(Request $request)
    {

        if (Hash::check($request->password_old, Auth::user()->password)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Thành công');
        } else {
            return redirect()->back()->with('error', 'Lỗi');
        }
    }

    public function history_contact_by_user(Request $request)
    {
        $model = new Motel();

        $this->v['list'] = $model->get_list_contact_by_user(Auth::id());

        return view('client.live-together.history_contact_by_user', $this->v);
    }

    public function wheel_luck()
    {
        $this->v['number_ticket_user'] = Ticket::where('status', 2)->where('user_id', Auth::id())->count();
        $this->v['history_wheel_luck'] = HistoryUsedTicket::select(['gift', 'history_used_ticket.created_at'])
            ->join('tickets', 'history_used_ticket.ticket_id', '=', 'tickets.id')
            ->where('user_id', Auth::id())
            ->orderBy('history_used_ticket.created_at', 'desc')
            ->get();

        return view('client.rotation.index', $this->v);
    }
}
