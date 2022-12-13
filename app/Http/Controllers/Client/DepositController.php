<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\MailDeposit;
use App\Models\Area;
use App\Models\Deposit;
use App\Models\Motel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function deposit($id)
    {
        $motel = new Motel();
        if ($motel->detailMotel($id)) {
            $this->v['motel'] = $motel->detailMotel($id);
            // dd($this->v['motel']);
            return view('client.deposit.deposit', $this->v);
        }
    }

    public function post_deposit(Request $request)
    {
        $params = array_map(function ($item) {
            if ($item == "") {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());

        unset($params['_token']);

        $params['user_id'] = Auth::user()->id;

        $area = Area::find($params['area_id']);

        $bossMotel = User::find($area->user_id);

        unset($params['area_id']);

        $depositModel = new Deposit();

        $dataPost = $depositModel->saveNew($params);

        $a = Motel::find($request->motel_id);
        $a->status = 3;
        $a->save();
        $room_number = $a->room_number;

        $dataMail = [
            'user_email' => Auth::user()->email,
            'area_name' => $area->name,
            'room_number' => $room_number,
            'type' => $params['type'],
            'value' => $params['value'],
        ];

        if (gettype($dataPost) == 'integer') {
            if ($params['type'] == 1) {
                DB::beginTransaction();
                try {
                    User::findOrFail($bossMotel->id)->update(['money' => $bossMotel->money + $params['value']]);
                    User::findOrFail(Auth::user()->id)->update(['money' => Auth::user()->money - $params['value']]);

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw new Exception($e->getMessage());
                    return redirect()->back()->with('error', 'Đặt cọc thất bại, thử lại sau');
                }

                Mail::to($bossMotel->email)->send(new MailDeposit($dataMail));
                return redirect()->route('client.motel.detail', ['id' => $params['motel_id']])->with('success', 'Đặt cọc thành công, thông tin của bạn đã được lưu vào hệ thống');
            } else {
                Mail::to($bossMotel->email)->send(new MailDeposit($dataMail));
                return redirect()->route('client.motel.detail', ['id' => $params['motel_id']])->with('success', 'Thông tin đặt cọc của bạn đã được lưu vào hệ thống và được thông báo đến chủ trọ');
            }
        } else {
            return redirect()->back()->with('error', 'Đặt cọc thất bại, thử lại sau');
        }
    }

    public function historyDeposit()
    {
        $model = new Deposit();
        $this->v['deposits'] = $model->get_list_client_deposit();
        return view('client.account_management.history_deposit', $this->v);
    }
}