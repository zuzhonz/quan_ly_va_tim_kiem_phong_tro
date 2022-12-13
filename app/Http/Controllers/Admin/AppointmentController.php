<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAppoint;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function get_list_appoint()
    {
        $model = new Appointment();

        $this->v['history'] = $model->admin_get_history();

        return view('admin.appointment.history', $this->v);
    }

    public function confirm_appoint(Request $request)
    {
        $model = new Appointment();

        $res = $model->updateAppoint([
            'time' => $request->time,
            'status' => $request->status
        ], $request->appoint_id);
        if ($request->status == 1) {
            try {
                $data = Appointment::select(['email', 'users.name', 'time', 'areas.address', 'room_number', 'areas.name as area_name'])
                    ->join('users', 'appointments.user_id', '=', 'users.id')
                    ->where('appointments.id', $request->appoint_id)
                    ->join('motels', 'appointments.motel_id', '=', 'motels.id')
                    ->join('areas', 'motels.area_id', '=', 'areas.id')
                    ->first();
                Mail::to($data->email)->send(new ConfirmAppoint($data));
            } catch (\Exception $e) {
                return redirect()->back();
            }
        }
        return redirect()->back()->with('success', 'Thay đổi trạng thái lịch đặt thành công');
    }
}
