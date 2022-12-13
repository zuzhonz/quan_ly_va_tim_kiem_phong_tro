<?php

namespace App\Http\Controllers;

use App\Mail\CreateAccountWithGoogle;
use App\Mail\ForgotOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use function PHPUnit\Framework\returnSelf;

class GoogleController extends Controller
{
    public function getGoogleSignInUrl()
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return response()->json([
                'url' => $url,
            ])->setStatusCode('200');
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function loginCallback(Request $request)
    {
        try {
            $state = $request->input('state');

            parse_str($state, $result);
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user1 = User::where('email', $googleUser->email)->first();
            if ($user1) {
                $user2 = User::where('google_id', $googleUser->id)->first();
                if ($user2->role_id != 3) {
                    return redirect()->route('backend_get_dashboard', ['id' => $user2->id])->with('login_success', 'Đăng nhập thành công');
                } else {
                    return redirect()->route('home', ['id' => $user2->id]);
                }
            } else {
                $user = new User();

                $user->email = $googleUser->email;
                $user->name = $googleUser->name;
                $user->google_id = $googleUser->id;
                $user->password = '$2y$10$x58PIeez7REKWe0WvncaMenUMkXlMBVDXBgKn2yUiOrfnkto84COO';
                $user->status = 1;
                $user->money = 0;
                $user->role_id = 3;
                $user->avatar = $googleUser->avatar;
                $user->is_admin = 0;
                $user->save();

                return redirect()->route('get_select_role_resign', ['id' => $user->id]);
            }
        } catch (\Exception $exception) {
            Session::flash('gg_error', 'Có lỗi xảy ra vui lòng thử lại');
            return redirect()->route('get_login', ['success' => 'gg_error']);
        }
    }

    public function getFormSelectRole(Request $request)
    {


        return view('auth.select_role', [
            'user_id' => $_GET['id']
        ]);
    }

    public function postFormSelectRole(Request $request)
    {
        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();
        Auth::login($user);
        if ($request->role_id == 1) {
            return redirect()->route('backend_get_dashboard');
        } else {
            return redirect()->route('home');
        }
    }

}
