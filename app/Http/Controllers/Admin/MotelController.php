<?php

namespace App\Http\Controllers\Admin;

use App\Console\Commands\Motels;
use App\Http\Controllers\Controller;
use App\Imports\MotelsImport;
use App\Mail\ConfirmOutMotel;
use App\Mail\ForgotOtp;
use App\Mail\NotificeDelMotel;
use App\Models\Area;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\Motel;
use App\Models\Plan;
use App\Models\PlanHistory;
use App\Models\PrintPdf;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserMotel;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;

class MotelController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_motels',
                'add_motels',
                'saveAdd_motels',
                'info_user_motels',
                'add_people_of_motels',
                'create_post_motels',
                'save_create_post_motels',
                'contact_motel'
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_motels($id, Request $request)
    {
        // dd($request->all());
        $motel = new Motel();
        $this->v['motels'] = $motel->LoadMotelsWithPage($request->all(), $id);
        $this->v['id'] = $id;
        return view('admin.motel.list', $this->v);
    }

    public function add_motels($id)
    {
        $category = new Category();
        $this->v['categories'] = $category->getAll();
        $this->v['area_id'] = $id;
        return view('admin.motel.add', $this->v);
    }

    public function saveAdd_motels(Request $request, $id)
    {
        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = '';
            }
            if (is_string($item)) {
                $item = trim($item);
            }

            return $item;
        }, $request->all());

        $service_checkbox = [];
        foreach ($params['cols']['service'] as $key => $value) {
            if ($value == 'on') {
                unset($params['cols']['service'][$key]);
                array_push($service_checkbox, $key);
                $params['cols']['service']['service_checkbox'] = $service_checkbox;
            }
        }
        unset($params['cols']['_token']);
        $params['cols']['area_id'] = $request->id;
        $imgs = [];
        foreach (json_decode($request->img) as $file) {
            $uploadedFileUrl = cloudinary()->upload($file, [
                'resource_type' => 'auto',
                'folder' => 'DATN_FALL2022'
            ])->getSecurePath();;

            $imgs[] = $uploadedFileUrl;
        }
        $params['cols']['photo_gallery'] = $imgs;
        $model = new Motel();

        $result = $model->createMotel($params['cols']);
        if ($result !== true) {
            return redirect()->route('admin.motel.list', ['id' => $id])->with('error', 'Thêm mới phòng trọ thất bại');
        }
        return redirect()->route('admin.motel.list', ['id' => $id])->with('success', 'Thêm mới phòng trọ thành công');
    }

    public function info_user_motels($id, $idMotel)
    {
        $model = new Motel();
        $this->v['id'] = $id;

        $this->v['info'] = $model->info_motel($idMotel);
        $ids = [];

        // dd($model->info_motel_email('hoangxuanvu248@gmail.com'));

        $userInfo = DB::table('users')
            ->select(['user_id'])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->where('user_motel.status', 1)
            ->get();
        foreach ($userInfo as $item) {
            $ids[] = $item->user_id;
        }
        $this->v['user'] = DB::table('users')->where('role_id', '3')->whereNotIn('id', $ids)->get();
        $this->v['data'] = json_encode($this->v['user']);
        $this->v['params'] = [
            'motel_id' => $idMotel,
            'area_id' => $id
        ];


        return view('admin.motel.info', $this->v);
    }

    public function add_peolpe_of_motels(Request $request, $id, $idMotel)
    {
        $type = $request->type ?? 0;
        $model = new UserMotel();

        $model->add($idMotel, $request->user_id, $type);

        return redirect()->route('admin.motel.info', ['id' => $id, 'idMotel' => $idMotel])->with('success', 'Thêm mới thành viên phòng thành công');
    }

    public function create_post_motels(Request $request, $id, $idMotel)
    {
        $this->v['params'] = [
            'motel_id' => $idMotel,
            'area_id' => $id
        ];
        $this->v['gift'] = Ticket::selectRaw('SUM(ticket)  as quantity')->where('user_id', Auth::id())->where('status', 1)->first()->quantity ?? 0;
        $this->v['numberTicket'] = Ticket::selectRaw('SUM(ticket)  as quantity')->where('user_id', Auth::id())->where('status', 2)->first()->quantity / 10 ?? 0;
        $this->v['plans'] = Plan::select(['id', 'name', 'type', 'time', 'price', 'status', 'priority_level'])->where('type', 1)->where('status', 1)->get();
        $data = [];
        foreach ($this->v['plans'] as $i) {
            $data[] = [
                'id' => $i->id,
                'title' => $i->name,
                'price' => $i->price,
                'time' => $i->time,
                'more' => $i->price == 0 ? 1 : 0
            ];
        }

        $this->v['data'] = json_encode($data);
        $this->v['current_plan_motel'] = DB::table('plan_history')
            ->select(['name', 'day', 'price', 'plan_history.created_at as created_at_his', 'plan_id', 'plan_history.id as ID', 'priority_level'])
            ->join('plans', 'plan_history.plan_id', '=', 'plans.id')
            ->where('motel_id', $idMotel)
            ->where('type', 1)
            ->where('plan_history.status', 1)
            ->first();
        $model = new Motel();
        $this->v['motel'] = $model->detailMotel($idMotel);
        return view('admin.motel.post', $this->v);
    }

    public function save_create_post_motels(Request $request, $id, $idMotel)
    {
        // dd($request->post());
        DB::table('motels')->where('id', $idMotel)->update(['status' => 5]);
        $model = new PlanHistory();
        if ($request->gia_han) {
            $model->create([
                'plan_id' => $request->plan_id_o,
                'motel_id' => $idMotel,
                'day' => $request->post_day_more,
                'status' => 2,
                'parent_id' => $request->ID,
                'user_id' => Auth::id(),
                'is_first' => 0
            ]);

            $planHistory = PlanHistory::find($request->ID);

            $planHistory->day += $request->post_day_more;

            $planHistory->save();
            $plan = Plan::find($request->plan_id_o);
            $trong_so = $plan->priority_level != 6 ? 10 / $plan->priority_level : 0;
            $currentTicket = Ticket::where('user_id', Auth::id())->where('ticket', '<', 10)->first();
            if ($currentTicket) {
                $ticket = $trong_so + $currentTicket->ticket;
                if ($ticket > 10) {
                    $currentTicket->ticket = 10;
                    Ticket::insert([
                        'user_id' => Auth::id(),
                        'status' => 1,
                        'ticket' => $ticket - 10,
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    $currentTicket->ticket = $ticket;
                }
                $currentTicket->save();
            } else {
                Ticket::insert([
                    'user_id' => Auth::id(),
                    'status' => 1,
                    'ticket' => $trong_so
                ]);
            }

            $user = User::find(Auth::id());
            $user->money -= $request->post_money_more;

            $user->save();
            return redirect()->back()->with('success', 'Gia hạn bài đăng thành công');
        } else if ($request->change_plan) {
            $model->create([
                'plan_id' => $request->plan_id_o,
                'motel_id' => $idMotel,
                'day' => $request->old_day,
                'status' => 4,
                'parent_id' => 0,
                'user_id' => Auth::id(),
                'is_first' => 0
            ]);
            $id = $model->create([
                'plan_id' => $request->post_plan_id,
                'motel_id' => $idMotel,
                'day' => $request->post_day,
                'status' => 1,
                'parent_id' => 0,
                'user_id' => Auth::id(),
                'is_first' => 0
            ]);
            $model->create([
                'plan_id' => $request->post_plan_id,
                'motel_id' => $idMotel,
                'day' => $request->post_day,
                'status' => 2,
                'parent_id' => $id,
                'user_id' => Auth::id(),
                'is_first' => 1
            ]);
            $planOld = Plan::find($request->plan_id_o);
            $planNew = Plan::find($request->post_plan_id);
            $trong_so1 = $planOld->priority_level != 6 ? 10 / $planOld->priority_level : 0;
            $trong_so2 = $planNew->priority_level != 6 ? 10 / $planNew->priority_level : 0;
            $currentTicket = Ticket::where('user_id', Auth::id())->where('ticket', '<', 10)->first();
            if (!$currentTicket) {
                Ticket::insert([
                    'user_id' => Auth::id(),
                    'status' => 1,
                    'ticket' => 0 - $trong_so1 + $trong_so2,
                    'created_at' => Carbon::now()
                ]);
            } else {
                if ($currentTicket->ticket - $trong_so1 + $trong_so2 > 10) {
                    $currentTicket->ticket = 10;
                    Ticket::insert([
                        'user_id' => Auth::id(),
                        'status' => 1,
                        'ticket' => 10 - $currentTicket->ticket + $trong_so1 - $trong_so2,
                        'created_at' => Carbon::now()
                    ]);

                } else {
                    $currentTicket->ticket = $currentTicket->ticket - $trong_so1 + $trong_so2;
                }

                $currentTicket->save();
            }

            PlanHistory::where('id', $request->ID)->update([
                'status' => 0,
            ]);

            $tien = $request->money_plan_old - $request->post_money;
            $user = User::find(Auth::id());
            $user->money += $tien;

            $user->save();
            return redirect()->back()->with('success', 'Thay đổi gói bài đăng thành công');
        } else {
            $id = $model->create([
                'plan_id' => $request->post_plan_id,
                'motel_id' => $idMotel,
                'day' => $request->post_day,
                'status' => 1,
                'parent_id' => 0,
                'user_id' => Auth::id(),
                'is_first' => 0
            ]);
            $model->create([
                'plan_id' => $request->post_plan_id,
                'motel_id' => $idMotel,
                'day' => $request->post_day,
                'status' => 2,
                'parent_id' => $id,
                'user_id' => Auth::id(),
                'is_first' => 1
            ]);
            $user = User::find(Auth::id());
            $user->money -= $request->post_money;

            $user->save();
            $plan = Plan::find($request->post_plan_id);
            $trong_so = $plan->priority_level != 6 ? 10 / $plan->priority_level : 0;
            $currentTicket = Ticket::where('user_id', Auth::id())
                ->where('ticket', '<', 10)
                ->first();
            if ($currentTicket) {
                $ticket = $trong_so + $currentTicket->ticket;
                if ($ticket > 10) {
                    $currentTicket->ticket = 10;
                    Ticket::insert([
                        'user_id' => Auth::id(),
                        'status' => 1,
                        'ticket' => $ticket - 10,
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    $currentTicket->ticket = $ticket;
                }
                $currentTicket->save();
            } else {
                Ticket::insert([
                    'user_id' => Auth::id(),
                    'status' => 1,
                    'ticket' => $trong_so,
                    'created_at' => Carbon::now()
                ]);
            }

            return redirect()->back()->with('success', 'Đăng bài thành công');
        }
    }

    public function contact_motel(Request $request, $id, $idMotel)
    {
        $model = new Motel();
        $this->v['info'] = $model->info_motel($idMotel);
        $this->v['list'] = $model->get_list_contact($idMotel, $id);
        $this->v['motel_id'] = $idMotel;
        $this->v['area_id'] = $id;
        return view('admin.motel.list_contact_motel', $this->v);
    }

    public function detail_motels($id, $idMotel)
    {

        $motel = new Motel();
        $this->v['motel'] = $motel->detail_motels($idMotel);
        $this->v['photo_gallery'] = $this->v['motel']->photo_gallery;
    }


    public function edit_motels($id, $idMotel)
    {
        $category = new Category();
        $this->v['categories'] = $category->getAll();
        $motel = new Motel();
        $this->v['motel'] = $motel->detailMotel($idMotel);
        return view('admin.motels.edit', $this->v);
    }

    public function saveUpdate_motels(Request $request, $id)
    {
        $modelMotel = new Motel();

        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }

            return $item;
        }, $request->all());

        unset($params['cols']['_token']);

        $service_checkbox = [];
        foreach ($params['cols']['service'] as $key => $value) {
            if ($value == 'on') {
                unset($params['cols']['service'][$key]);
                array_push($service_checkbox, $key);
            }
        }
        $data = [
            'room_number' => $request->room_number,
            'price' => $request->price,
            'area' => $request->area,
            'description' => $request->description,
            'video' => $request->video,
            'image_360' => $request->image_360,
            'max_people' => $request->max_people,
            'money_deposit' => $request->money_deposit,
            'day_deposit' => $request->day_deposit,
            'category_id' => $request->category_id,
            'transfer_infor' => $request->transfer_infor,
            'services' => json_encode([
                'bedroom' => $request->bedroom,
                'toilet' => $request->toilet,
                'service_checkbox' => $service_checkbox,
                'more' => $request->service_more,
                'actor' => $request->actor
            ]),
            'electric_money' => $request->electric_money,
            'warter_money' => $request->warter_money,
            'wifi' => $request->wifi,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $imgs = [];
        foreach (json_decode($request->img) as $file) {
            if (strpos($file, 'https://res.cloudinary.com') === false) {
                $file = cloudinary()->upload($file, [
                    'resource_type' => 'auto',
                    'folder' => 'DATN_FALL2022'
                ])->getSecurePath();;
            }

            $imgs[] = $file;
        }
        $data['photo_gallery'] = json_encode($imgs);

        $modelMotel->saveUpdate_motels($data, $request->id);
        return redirect()->route('admin.motel.list', $request->area_id)->with('success', 'Cập nhật phòng trọ thành công');
    }

    public function history_motel($id, $idMotel)
    {
        $model = new UserMotel();

        $this->v['histories'] = $model->historyMotel($idMotel);
        $this->v['id'] = [$id, $idMotel];
        return view('admin.motel.history', $this->v);
    }

    public
    function print(Request $request, $motelId)
    {
        Motel::where('id', $motelId)->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'electric_money' => $request->electric_money,
            'warter_money' => $request->warter_money,
            'wifi' => $request->wifi,
            'status' => 2
        ]);
        $model = new PrintPdf();;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($model->printMotel($motelId, [
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'electric_money' => $request->electric_money,
            'warter_money' => $request->warter_money,
            'wifi' => $request->wifi,
        ]));
        return $pdf->download('hop_dong.pdf');

    }

    public function import(Request $request)
    {
        Excel::import(new MotelsImport($request->area_id), $request->file('file'));

        return redirect()->back()->with('success', 'Nhập danh sách thành công');
    }

    public function duplicate(Request $request, $id, $idMotel)
    {
        $motel = Motel::find($idMotel);
        $newMotel = $motel->replicate();
        $newMotel->created_at = Carbon::now();
        $newMotel->status = 1;
        $newMotel->save();

        return redirect()->back()->with('success', 'Sao chép dữ liệu phòng ' . $motel->room_number . ' thành công');
    }

    public function list_out_motel(Request $request, $id, $idMotel)
    {

        $this->v['id'] = [$id, $idMotel];
        $this->v['list'] = DB::table('users')
            ->select(['name', 'email', 'phone_number', 'start_time', 'user_motel.status', 'user_motel.id'])
            ->join('user_motel', 'users.id', '=', 'user_motel.user_id')
            ->where('motel_id', $idMotel)
            ->where('user_motel.status', '=', 2)
            ->paginate(10);
        return view('admin.motel.list_out_motel', $this->v);
    }

    public function confirm_out_motel(Request $request, $id)
    {
        // dd($request->all(), $id);
        $res = DB::table('user_motel')->where('id', $id)->update([
            'status' => 0,
            'end_time' => Carbon::now()
        ]);

        $user = UserMotel::where('motel_id', $request->motel_id)->where('status', 1)->get();
        if (count($user) === 0) {

            try {
                $motel = Motel::find($request->motel_id);
                $motel->status = 1;
                $motel->end_time = date('Y-m-d');
                $motel->save();

                Motel::where('id', $request->motel_id)->update(['end_time' => null, 'start_time' => null]);

                PlanHistory::where('motel_id', $request->motel_id)->where('status', 1)->update(['status' => 5]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        Mail::to($request->email)->send(new ConfirmOutMotel());
        return redirect()->back()->with('success', 'Cập nhật đơn rời phòng thành công');
    }

    public function deleteUserFormMotel(Request $request, $id)
    {
        if ($id !== 'null') {
            $res = DB::table('user_motel')->where('id', $id)->update([
                'status' => 3 //status = 3 : bị xóa do hết hạn
            ]);
            $user = UserMotel::where('motel_id', $request->motel_id)->where('status', 1)->get();
            if (count($user) === 0 || !$user) {
                try {
                    $motel = Motel::find($request->motel_id);
                    $motel->status = 1;
                    $motel->end_time;
                    $motel->save();
                } catch (\Exception $e) {
                    return redirect()->back();
                }
            }
        } else {
            $user = UserMotel::where('motel_id', $request->motel_id)->where('status', 1)->update(['status' => 3]);
            try {
                $motel = Motel::find($request->motel_id);
                $motel->status = 1;
                $motel->end_time;
                $motel->save();
            } catch (\Exception $e) {
                return redirect()->back();
            }
        }


        return redirect()->back()->with('success', 'Xóa thành công thành viên!');
    }
}
