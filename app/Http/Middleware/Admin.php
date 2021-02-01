<?php

namespace App\Http\Middleware;

use Auth;
use Route;
use Closure;

use App\Http\Controllers\RoleController as RoleCtrl;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $myData = Auth::guard('admin')->user();
        if ($myData == "") {
            return redirect()->route('admin.loginPage')->withErrors([
                'message' => 'Anda harus login dahulu sebelum melanjutkan'
            ]);
        }
        $currentRoute = Route::current();
        $currentPrefix = explode("/", $currentRoute->getPrefix())[1];
        $currentAction = explode(".", $currentRoute->getName())[1];
        if ($currentPrefix == "admin") {
            $currentPrefix = explode("/", $currentRoute->uri)[1];
            $currentAction = "view";
        }
        
        $auth = RoleCtrl::authenticate($currentPrefix, $currentAction);
        // echo $auth;
        // die();
        if (!$auth) {
            return redirect()->route('admin.error', 403);
        }
        return $next($request);
    }
}
