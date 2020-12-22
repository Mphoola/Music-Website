<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('management.dashboard');
    }

    public function loginPage(){
        return view('management.Adminlogin');
    }

    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = Admin::where('email',$request->email)->first();
        $att =  Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
      
        if($att){
            session()->put('user', $user);
            session()->put('type', 'admin');
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('errors','Your email and password does not match')->
            withInput($request->only('email', 'remember'));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        session()->forget('user');
        return redirect('/');
    }
    
}
