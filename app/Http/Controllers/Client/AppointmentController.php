<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\CancelAppoint;
use App\Mail\NewAppoint;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Pusher\Pusher;

class AppointmentController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function post_appointment(Request $request)
    {
        $model = new Appointment();

        $res = $model->insertRecord([
            'user_id' => Auth::id(),
            'motel_id' => $request->motel_id,
            'time' => $request->time,
            'status' => 0,
            'created_at' => Carbon::now()
        ]);
        try {
            $data =
                DB::table('appointments')
                    ->select(['email', 'users.name', 'areas.name as area_name',
                        'phone_number', 'room_number',
                        'time', 'areas.user_id'])
                    ->join('motels', 'appointments.motel_id', '=', 'motels.id')
                    ->join('areas', 'motels.area_id', '=', 'areas.id')
                    ->join('users', 'areas.user_id', '=', 'users.id')
                    ->where('appointments.id', $res)->first();
            Mail::to($data->email)->send(new NewAppoint($data));
            $user = User::find($data->user_id);
            $data = [
                'title' => 'Bạn vừa có 1 lịch hẹn mới',
                'message' =>
                    Auth::user()->name . ' đã đăng ký lịch hẹn xem phòng ' . $data->room_number . ' - ' . $data->area_name . ' của bạn.Thời gian hẹn ' . Carbon::parse($data->time)->format('h:i A d/m/y'),
                'time' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('admin.get_list_appoint')
            ];
            $user->notify(new AppNotification($data));

        } catch (\Exception $e) {
            return redirect()->back();
        }


        return redirect()->back()->with('success', 'Đặt lịch thành công');
    }

    public function history_appointment()
    {
        $model = new Appointment();
        $this->v['history'] = $model->client_get_history();


        return view('client.appointment.history', $this->v);
    }


    public function cancelAppoint(Request $request, $appoint_id)
    {
        $model = new Appointment();

        $res = $model->updateAppoint([
            'status' => 3,
        ], $appoint_id);
        try {
            $data =
                DB::table('appointments')
                    ->select(['email', 'users.name', 'areas.name as area_name',
                        'phone_number', 'room_number', 'areas.user_id',
                        'time'])
                    ->join('motels', 'appointments.motel_id', '=', 'motels.id')
                    ->join('areas', 'motels.area_id', '=', 'areas.id')
                    ->join('users', 'areas.user_id', '=', 'users.id')
                    ->where('appointments.id', $appoint_id)->first();
            Mail::to($data->email)->send(new CancelAppoint($data));
        } catch (\Exception $e) {
            return redirect()->back();
        }
        $user = User::find($data->user_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
        $data = [
            'title' => 'Bạn vừa có 1 thông báo mới',
            'message' => Auth::user()->name . ' đã hủy đăng ký lịch hẹn xem phòng ' . $data->room_number . ' - ' . $data->area_name . ' của bạn.Thời gian hẹn ' . Carbon::parse($data->time)->format('h:i A d/m/y'),
            'time' => Carbon::now()->format('h:i A d/m/Y'),
            'href' => route('admin.get_list_appoint')
        ];
        $user->notify(new AppNotification($data));

        return redirect()->back()->with('success', 'Hùy lịch hẹn thành công');
    }
}
