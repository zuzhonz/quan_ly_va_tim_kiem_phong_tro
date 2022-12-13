<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryUsedTicket;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function admin_swap_gift_to_ticket(Request $request)
    {
        $ticket = Ticket::where('ticket', 10)->where('user_id', Auth::id())->where('status', 1)->limit($request->ticket)->update([
            'status' => 2
        ]);

        return redirect()->back()->with('success', 'Đổi gói thành công');
    }

    public function get_view_whell_luck(Request $request)
    {
        $this->v['number_ticket_user'] = Ticket::where('status', 2)->where('user_id', Auth::id())->count();
        $this->v['history_wheel_luck'] = HistoryUsedTicket::select(['gift', 'history_used_ticket.created_at'])
            ->join('tickets', 'history_used_ticket.ticket_id', '=', 'tickets.id')
            ->where('user_id', Auth::id())
            ->orderBy('history_used_ticket.created_at', 'desc')
            ->get();
        return view('admin.wheel_luck.index', $this->v);
    }

    public function post_wheel_luck(Request $request)
    {
        $ticketUsed = Ticket::select(['id'])->where('status', 2)->where('user_id', $request->user_id)->first();
        $history = new HistoryUsedTicket();
        $history->gift = $request->gift;
        $history->ticket_id = $ticketUsed->id;
        $history->save();

        $user = User::find($request->user_id);
        $user->money += $request->gift;
        $user->save();

        $ticketUsed->status = 0;
        $ticketUsed->save();
        $history->time = Carbon::parse($history->created_at)->format('h:i A d/m/Y');
        return response()->json([
            'history' => $history

        ], 201);
    }

    public function buy_ticket(Request $request)
    {
        $data = [];
        try {
            DB::beginTransaction();
            for ($i = 0; $i < $request->number_ticket_buy; $i++) {
                $data[] = [
                    'user_id' => Auth::id(),
                    'status' => 2,
                    'ticket' => 10,
                    'created_at' => Carbon::now()
                ];
            }
            $res = Ticket::insert($data);

            $user = User::find(Auth::id());
            $user->money -= $request->number_ticket_buy * 20;
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Mua lượt quay thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }


    }

//    public function get_history_wheel_luck(Request $request)
//    {
//
//        return response()->json($history_wheel_luck, 200);
//    }

}
