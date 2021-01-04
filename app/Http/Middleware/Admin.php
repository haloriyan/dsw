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
            return redirect()->route('admin.loginPage')->with([
                'message' => 'Anda harus login dahulu sebelum melanjutkan',
                'isErrorMessage' => 1
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
        if (!$auth) {
            die("403");
        }
        return $next($request);
    }
}
