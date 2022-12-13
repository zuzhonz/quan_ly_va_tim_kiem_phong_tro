<?php

namespace App\Http\Controllers\Client;

use Exception;
use App\Models\Area;
use App\Models\Bill;
use App\Models\User;
use App\Models\Motel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\bill_pay_bank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $model = new Bill();
        $this->v['list'] = $model->client_get_list_bill_user();
        return view('client.bill.index', $this->v);
    }

    public function get_pay_bill($id)
    {
        $bill = new Bill();

        try {
            $this->v['item'] = $bill->client_get_bill_user($id);
            $area = Area::find($this->v['item']->area_id);
            $this->v['boss'] = User::find($area->user_id);
            return view('client.bill.pay_bill', $this->v);
        } catch (Exception $e) {
            return view('errors.404');
        }
    }

    public function pay_bill(Request $request, $id)
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

        $model = new Bill();
        $bill = $model->client_get_bill_user($id);
        $area = Area::find($bill->area_id);
        $boss = User::find($area->user_id);


        $data_mail = [
            'user' => User::find(Auth::user()->id)->name,
            'area' => $area->name,
            'room' => $bill->room_number,
            'money' => $bill->tong,
            'address' => $area->address,
            'status' => '',
            'date' => $bill->created_at
        ];
        // dd($data_mail);
        if (gettype($bill) == 'object') {
            if ($bill->status != 2) {
                if ($params['pay_type'] == 1) {
                    DB::beginTransaction();
                    try {
                        User::findOrFail($boss->id)->update(['money' => $boss->money + $params['coin']]);
                        User::findOrFail(Auth::user()->id)->update(['money' => Auth::user()->money - $params['coin']]);
                        $model->find($id)->update(['status' => 2]);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                        return redirect()->back()->with('error', 'Thanh toán thất bại, thử lại sau');
                    }
                    $data_mail['status'] = 'Thanh toán thành công';
                    Mail::to($boss->email)->send(new bill_pay_bank($data_mail));

                    return redirect()->route('client_get_pay_bill', $id)->with('success', 'Thanh toán hóa đơn thành công');
                }
                if ($params['pay_type'] == 2) {
                    $model->find($id)->update(['status' => 3]);
                    DB::commit();
                    $data_mail['status'] = 'Chờ xác nhận thanh toán ';
                    Mail::to($boss->email)->send(new bill_pay_bank($data_mail));
                    return redirect()->route('client_get_pay_bill', $id)->with('success', 'Gửi xác nhận hóa đơn thành công');
                }
            } else {
                return redirect()->route('client_get_pay_bill', $id)->with('error', 'Tài khản đã thanh toán hóa đơn');
            }
        } else {
            return redirect()->route('client_get_pay_bill', $id)->with('error', 'Thanh toán thất bại');
        }
    }
}
