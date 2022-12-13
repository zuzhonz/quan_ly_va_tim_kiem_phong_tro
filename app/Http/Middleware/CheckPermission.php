<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $check_permission)
    {
        if (Auth::user()) {

            $role_id_login = Auth::user()->role_id;
            if (Auth::user()->id == 1) {
                return $next($request);
            }
            $permissions = Role::where('id', $role_id_login)->first();
            $check = false;
            foreach ($permissions->permissionRoles as $permission) {
                if ($check_permission == $permission->name) {
                    $check = true;
                    break;
                }
            }
            if ($check) {
                return $next($request);
            } else {
                return redirect()->route('403');
            }
        }

    }
}
