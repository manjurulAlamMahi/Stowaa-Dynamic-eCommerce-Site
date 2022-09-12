<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use app\Models\user;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Image;


class users extends Controller
{
    // Log In Auth
    function __construct()
    {
        $this->middleware('auth');
    }
    // User Table
    function users_table()
    {
        $all_users = User::where('id', '!=' , Auth::id())->paginate(3);
        $count_users = User::count();
        return view('admin.users.index', compact('all_users', 'count_users'),);
    }
    // Delete User From Table
    function delete_user($user_id)
    {
        user::find($user_id)->delete();
        return back();
    }
    // Profile
    function user_profile()
    {
        $user = user::where('id' , Auth::id())->get();
        $permission = Permission::all();
        $role = Role::all();
        return view('admin.users.user_profle',[
            'user' => $user,
            'permission' => $permission,
            'role' => $role,
        ]);
    }
    // Edit Profile
    function edit_user_photo($update_code){

        $edit_type = $update_code;

        return view('admin.users.edit_user',[
            'edit_type' => $edit_type,
        ]);
    }
    // Update Profile
    function update_user(Request $request){
        $new_name = $request->name;
        $new_email = $request->email;
        $new_photo = $request->profile_photo;
        $password = $request->password;
        $user_id = $request->user_id;

        // NAME UPDATE
        if($new_email == "" && $new_photo == "")
        {
            if(Hash::check($password, Auth::user()->password))
            {
                user::where('id', $user_id)->update([
                    'name' => $new_name,
                ]);

                return redirect()->route('user_profile');
            }
            else
            {
                return back()->with('error', "Incorrect Password!");
            }
        }
        // Email UPDATE
        else if($new_name == "" && $new_photo == "")
        {
            if(Hash::check($password, Auth::user()->password))
            {
                user::where('id', $user_id)->update([
                    'email' => $new_email,
                ]);

                return redirect()->route('user_profile');
            }
            else
            {
                return back()->with('error', "Incorrect Password!");
            }
        }
        // Profile Photo UPDATE
        else
        {
            if(Hash::check($password, Auth::user()->password))
            {
                // Old Image Exists
                if(Auth::user()->user_img != null)
                {
                    $delete_from = public_path('uploads/users/profile_images/'.Auth::user()->user_img);
                    unlink($delete_from);

                    $extension = $new_photo->getClientOrginalExtension();
                    $img_name = Auth::id().".".$extension;

                    Image::make($new_photo)->save(public_path('uploads/users/profile_images/'.$img_name));

                    user::where('id', $user_id)->update([
                        'user_img' => $img_name,
                    ]);

                    return redirect()->route('user_profile');

                }
                // Old Image Not Exists
                else
                {
                    $extension = $new_photo->getClientOrginalExtension();
                    $img_name = Auth::id().".".$extension;

                    Image::make($new_photo)->save(public_path('uploads/users/profile_images/'.$img_name));

                    user::where('id', $user_id)->update([
                        'user_img' => $img_name,
                    ]);

                    return redirect()->route('user_profile');
                }
            }
            else
            {
                return back()->with('error', "Incorrect Password!");
            }
        }

    }
}
