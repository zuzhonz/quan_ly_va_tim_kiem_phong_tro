<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\SendCodeChangePassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
        $arr = [
            'function' => [
                'index_users',
                'update_users',
                'saveAdd_areas',
                'saveUpdate_users',
            ]
        ];
        foreach ($arr['function'] as $item) {
            $this->middleware('check_permission:' . $item)->only($item);
        }
    }

    public function index_users(UserRequest $request)
    {
        $this->v['title'] = "Danh sách tài khoản";
        $objUser = new User();
        $this->v['users'] = $objUser->getAll($request->all());
        $this->v['params'] = $request->all() ?? [];
        return view('admin.user.index', $this->v);
    }

    public function update_users($id, $used_to)
    {
        $objUser = new User();
        $user = $objUser->getOne($id);
        $this->v['user'] = $user;
        $this->v['role'] = DB::table('roles')->select(['id', 'name'])->where('status', 1)->get();
        if ($used_to == 'detail') {
            $this->v['title'] = "Chi tiết tài khoản";
            return view('admin.user.detail', $this->v);
        } else {
            $this->v['title'] = "Cập nhật tài khoản";
            return view('admin.user.form_update', $this->v);
        }
    }

    public function changePassword()
    {
        return view('admin.user.changePassword', $this->v);
    }

    public function getCodeChangePassword(Request $request)
    {
        $user = User::find($request->id);
        $user->confirmation_code = rand(100000, 999999);
        $user->confirmation_code_expired_in = Carbon::now()->addSecond(180);
        $user->save();
        try {
            Mail::to($user->email)->send(new SendCodeChangePassword($user->confirmation_code));
            return response()->json([
                'status' => 'success',
                'message' => 'Lấy mã thành công'
            ], 200);
        } catch (\Exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lấy mã thất bại'
            ], 401);
        }

    }

    public function saveChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'confirm_code' => 'required'
        ], [
            'old_password.required' => 'Mật khẩu cũ bắt buộc nhập',
            'password.required' => 'Mật khẩu mới bặt buộc nhập',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password_confirmation' => 'Bạn chưa xác nhận mật khẩu',
            'confirm_code' => 'Mã xác minh bắt buộc nhập']);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->confirm_code == Auth::user()->confirmation_code) {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->confirmation_code = 0;
                $user->confirmation_code_expired_in = null;
                $user->save();
                return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
            } else {
                return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác');
            }
        } else {
            return redirect()->back()->with('error', 'Mã xác minh không chính xác');
        }


    }

//    public function add(UserRequest $request)
//    {
//        $this->v['title'] = "Thêm mới tài khoản";
//        $this->v['role'] = [
//            '1' => "Admin",
//            '2' => "Chủ trọ",
//            '3' => "Thành viên",
//        ];
//        $method_route = 'backend_user_add';
//        if ($request->isMethod('post')) {
//            $params = array_map(function ($item) {
//                if ($item == '') {
//                    $item = null;
//                }
//                if (is_string($item)) {
//                    $item = trim($item);
//                }
//                return $item;
//            }, $request->post());
//            unset($params['_token']);
//            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
//                $uploadedFileUrl = Cloudinary::upload($request->file('avatar')->getRealPath(), ['folder' => 'DATN_FALL2022'])->getSecurePath();
//                $params['avatar'] = $uploadedFileUrl;
//            }
//            $user = new User();
//            $request = $user->saveNew($params);
//            if ($request == null) {
//                redirect()->route($method_route);
//            } else if ($request > 0) {
//                Session::flash('success', 'Thêm mới thành công');
//            } else {
//                Session::flash('error', 'Thêm mới thất bại');
//                redirect()->route($method_route);
//            }
//        }
//        return view('admin.user.add', $this->v);
//    }

    public function saveUpdate_users(UserRequest $request, $id)
    {
        // dd($id);
        $params = [];
        $params = array_map(function ($item) {
            if ($item == '') {
                $item == null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->post());
        $params['id'] = $id;
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $uploadedFileUrl = Cloudinary::upload($request->file('avatar')->getRealPath(), ['folder' => 'DATN_FALL2022'])->getSecurePath();
            $params['avatar'] = $uploadedFileUrl;
        }
        unset($params['_token']);
        unset($params['avatar_old']);
        $objUser = new User();
        // dd($params);
        $res = $objUser->saveUpdate($params);
        // dd(gettype($res) === 'integer');
        if ($res === null) {
            Session::flash('error', 'Không tìm thấy bản ghi cần cập nhật');
            return redirect()->route('backend_user_detail', ['id' => $id, 'used_to' => 'update']);
        } elseif (gettype($res) === 'integer') {
            Session::flash('success', 'Cập nhật bản ghi ' . $id . ' thành công');
            return redirect()->route('backend_user_getAll');
        } else {
            Session::flash('error', 'Lỗi cập nhật bản ghi ' . $id);
            return redirect()->route('backend_user_detail', ['id' => $id, 'used_to' => 'update']);
        }
    }

    public function uploadImg(Request $request)
    {
        $user = User::find($request->user_id);
        $user->avatar = cloudinary()->upload($request->img, [
            'resource_type' => 'auto',
            'folder' => 'DATN_FALL2022'
        ])->getSecurePath();
        $user->save();
        return response()->json($user->avatar, 200);
    }
}
