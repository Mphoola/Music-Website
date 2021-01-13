<?php
namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class PasswordExpired
{

    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);

        if (Carbon::now()->diffInDays($password_changed_at) >= config('auth.password_expires_days')) {
            return redirect()->route('password.expired');
        }

        return $next($request);
    }
}
