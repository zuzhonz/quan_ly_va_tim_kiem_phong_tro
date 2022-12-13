<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\ForgotOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function getLogin()
    {
        return view('auth.login', $this->v);
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role_id != 3) {
                return redirect()->route('backend_get_dashboard')->with('login_success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->with('failed', 'abc');
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return redirect()->route('get_login')->with('logout', 'abc');
        } else {
            abort(404);
        }
    }

    public function getFormForgotPassword()
    {
        return view('auth.forgot_password', $this->v);
    }

    public function getCodeForgotPassword(LoginRequest $request)
    {
        $model = new User();

        $user = $model->checkAndRetunUser($request->email);
        if ($user) {
            $result = $model->updateUser([
                'token' => Str::random(64),
                'confirmation_code' => rand(100000, 999999),
                'confirmation_code_expired_in' => Carbon::now()->addSecond(180)
            ], $user->id);
            try {
                Mail::to($result->email)->send(new ForgotOtp($result));
                Session::flash('token_s', json_encode([$result->token, $result->email]));
                return redirect()->route('get_form_confirm_account');
            } catch (\Exception $err) {
                dd($err);
                //                    $user->delete();
            }
        }

        return redirect()->back()->with('incorrect_info', 'true');
    }

    public function getFormConfirmAcc()
    {
        if (Session::has('token_s')) {
            $this->v['email'] = json_decode(Session::get('token_s'))[1];
            return view('auth.code', $this->v);
        }
        abort(404);
    }

    public function postCodeConfirmAcc(LoginRequest $request)
    {
        $model = new User();

        $user = $model->getUserByEmail($request->email);

        if ($request->code === $user->confirmation_code) {
            Session::flash('email', $user->email);
            return redirect()->route('password_retrieval');
        } else {
            Session::flash('token_s', json_encode([$user->token, $user->email]));
            return redirect()->back();
        }
    }

    public function passwordRetrieval()
    {
        if (Session::has('email')) {
            $this->v['email'] = Session::get('email');
            return view('auth.change_password', $this->v);
        }
        abort(404);
    }

    public function changePassword(LoginRequest $request)
    {
        $model = new User();
        $result = $model->updateUser([
            'password' => Hash::make($request->password)
        ], $model->getUserByEmail($request->email)->id);

        if ($result) {
            return redirect()->route('get_login')->with('change', 'success');
        }
        Session::flash('email', $request->email);
        return redirect()->back();
    }
}