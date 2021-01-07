<?php

namespace App\Http\Middleware;

use Auth;
use Request;
use Closure;

class User
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
        $myData = Auth::guard('user')->user();
        if ($myData == "") {
            $currentRoute = Request::url();
            $currentRoute = substr(explode(env('APP_URL'), $currentRoute)[1], 1);
            return redirect()->route('user.loginPage', ['ref' => $currentRoute])->with([
                'message' => 'Anda harus login dahulu sebelum melanjutkan',
                'isErrorMessage' => 1
            ]);
        }
        return $next($request);
    }
}
