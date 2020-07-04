<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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
        if (Auth::check())
        {

            if(Auth::user()->isAdmin())
            {
                return $next($request);
            }
        }
        return redirect('login')->with('message', 'Không đủ quyền truy cập');
    }
}
