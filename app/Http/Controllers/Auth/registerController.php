<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\ForgotOtp;
use App\Mail\RegisterOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class registerController extends Controller
{
    public function index_register()
    {
        return view('auth.register');
    }

    public function register_user(Request $request)
    {
        $users = new User();
        $email = $users->checkAndRetunUser($request->email);
        if (!$email) {
            $users->fill($request->all());
            $users->password = Hash::make($request->password);
            $users->status = 0;
            $users->token = Str::random('16');
            $users->save();
            Mail::to($request->email)->send(new RegisterOtp($users));
            return redirect()->route('get_login')->with('success_register', 'đăng ký thành công');
        } else {
            return redirect()->route('get_register')->with('email_fall', 'email đã tồn tại');
        }
    }


    public function get_change_email($code)
    {
        $user = User::where('token', $code)->first();
        if ($user) {
            // $user->token = '';
            $user->status = 1;
            $user->save();
            return view('auth.confirm_email')->with('success');
        } else {
            abort(404);
        }
    }
}