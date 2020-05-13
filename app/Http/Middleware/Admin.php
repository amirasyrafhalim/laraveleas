<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    const ADMIN_DEFAULT_EMAIL = 'admin@eas.com';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(env('ADMIN_EMAIL') == null) {
            $adminEmail = self::ADMIN_DEFAULT_EMAIL;
        } else {
            $adminEmail = env('ADMIN_EMAIL');
        }

        if(!Auth::guest()) {
            if(auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
 

