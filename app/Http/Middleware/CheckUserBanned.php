<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckUserBanned
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
        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            Auth::logout();

            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please contact administrator.';
            } else {
                $message = 'Your account has been suspended for '.$banned_days.' '.Str::plural('day', $banned_days).'. Please contact administrator.';
            }

            return redirect()->route('login')->with('error',$message);
        }

        return $next($request);
    }
}
