<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Beat;
use App\Http\Controllers\Controller;
use App\Song;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;

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

    public function my_profile($id){
        $user = Admin::findOrFail($id);
        $role = $user->getRoleNames()->first();
        $music_uploads = $user->songs->count();
        $beat_uploads = $user->beats->count();
        $video_uploads = $user->videos->count();
        $video_approvals = Video::where('verified_by', $user->id)->count();
        return view('management.managers.my_profile', compact('user','role', 
            'music_uploads', 'beat_uploads', 'video_uploads', 'video_approvals'));
    }

    public function my_profile_update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user = Admin::findOrFail($id);
       
        if (isset($request->image)) {
            $picNameWithExt = $request->file('image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('image')->move(base_path().'/public/Uploads/User_Profiles', $picNameToStore);
            
           // this is to resize the image using Intervention Image!
           $image_path = base_path().'/public/Uploads/User_Profiles/'. $picNameToStore;
           Image::make($image_path)->resize(1160, 950)->save();

           if(file_exists($user->image) && $user->image != '96/images/bea.png'){
            unlink($user->image);
           }
           $user->image = 'Uploads/User_Profiles/'. $picNameToStore;
        }

        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->saveOrFail();
    
        return redirect()->route('my_profile', $user->id)->with('success', 'Your profile is updated');
    }

    
}
