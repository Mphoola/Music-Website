<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Closure;

class CheckAdminBanned
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
        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->banned_until
             && now()->lessThan(auth()->guard('admin')->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->guard('admin')->user()->banned_until);
            
            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please contact administrator.';
            } else {
                $message = 'Your account has been suspended for '.$banned_days.' '.Str::plural('day', $banned_days).'. Please contact administrator.';
            }
            
            session()->flash('error', $message);
            Auth::guard('admin')->logout();
        }

        return $next($request);
    }
}
