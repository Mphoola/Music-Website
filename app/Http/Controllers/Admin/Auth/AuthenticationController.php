<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function loginPage(){
        return view('management.authentication.Adminlogin');
    }

    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $user = Admin::where('email',$request->email)->first();
        $att =  Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
      
        if($att){
            \activity()
                
                ->by(Auth::guard('admin')->user()->id)
                ->withProperties(['word' => 'welcome '.Auth::guard('admin')->user()->name])
                ->log('Logged in');

            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);
            
            $request->session()->regenerate();
            // session()->put('user', $user->name);
            // session()->put('type', 'admin');
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error','Your email and password does not match')->
            withInput($request->only('email', 'remember'));
        }
    }

    public function expired(){
        return view('management.authentication.expired');
    }

    public function postExpired(Request $request){
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:12',
        ]);

        // Checking current password
        if (!Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }

        Auth::guard('admin')->user()->update([
            'password' => Hash::make($request->password),
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect('/management/dashboard')->with(['success' => 'Password changed successfully']);
    }

    public function logout(){
        \activity()
            ->by(Auth::guard('admin')->user()->id)
            ->withProperties(['word' => 'Goodbye '.Auth::guard('admin')->user()->name])
            ->log('Logged out');

        Auth::guard('admin')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        // session()->forget('user');
        // session()->forget('admin');
        return redirect('/management/login');
    }
}
