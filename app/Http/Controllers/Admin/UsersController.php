<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

;

class UsersController extends Controller
{
    public function list_users(){
        if(Auth::guard('admin')->user()->can('see users')){
            $users = User::withCount('songs', 'beats', 'videos')->get();
            return view('management.users.list_users', compact('users'));
        }else{
            return redirect()->back()->with('error', 'You are not authorized to carry that action');
        }
    }

    public function list_user_media($id){
        $user = User::findOrFail($id);
        $user->load('songs', 'beats', 'videos');
        return view('management.users.list_user_media', compact('user'));
    }

    public function delete_user($id){

    }

    public function add_admin(Request $request){
        $this->validate($request, ['email' => 'unique:admins']);

            $admin = new Admin;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
            return redirect()->back()->with('success', 'New manager added success, To give roles and permission, click view more below');
       
    }

    public function list_admins(){
      
        if(Auth::guard('admin')->user()->can('see admins')){
            return view('management.managers.list_admins')
                ->with('admins', Admin::with('roles')->withCount('permissions')->get());
        }else{
            return redirect()->back()->with('error', 'You are not authorized to carry that action');
        }
    }

    public function list_permissions( $id){
        if(Auth::guard('admin')->user()->can('see admins')){
            $admin = Admin::findOrFail($id);
            return view('management.managers.list_permissions')
                ->with('admin', $admin)
                ->with('roles', Role::all())
                ->with('admin_current_role', $admin->getRoleNames())
                ->with('permissions', Permission::all())
                ->with('current_permissions', $admin->getAllPermissions());
            }else{
            return redirect()->back()->with('error', 'You are not authorized to carry that action');
        }
    }

    public function update_permissions(Request $request, $id){
        $admin = Admin::findOrFail($id);
        
        //give user a new role
        $user_new_role = $request->role;
        $admin->syncRoles($user_new_role);

        //give user new permissions
        $user_new_permissions = $request->permissions;
        $admin->syncPermissions($user_new_permissions);

        $admin->update($request->all());
        session()->flash('success','User Role and Permissions updated successfully.');
        return redirect()->back();

    }

    
}
