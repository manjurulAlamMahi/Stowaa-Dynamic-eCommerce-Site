<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class roleManagerController extends Controller
{
    function role_manager(){
        $permission = Permission::all();
        $role = Role::all();

        return view('admin.roleManager.index',[
            'permission' => $permission,
            'role' => $role,
        ]);
    }

    function permission_store(Request $request){

        $permission = Permission::create(['name' => $request->permission_name]);

        return back();
    }

    function role_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    function edit_role($role_id){
        $permission = Permission::all();
        $role = Role::find($role_id);

        return view('admin.roleManager.edit_role',[
            'permission' => $permission,
            'role' => $role,
        ]);
    }

    function role_update(Request $request){
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);
        return back();
    }

    function assgin_role(){
        $permission = Permission::all();
        $role = Role::all();
        $users = user::where('id', '!=' , Auth::id())->paginate(6);

        return view('admin.roleManager.assginRole',[
            'permission' => $permission,
            'role' => $role,
            'users' => $users,
        ]);
    }

    function assgin_role_store(Request $request){

        $user = user::find($request->user_id);
        $user->assignRole($request->role_id);

        return back();
    }

}
