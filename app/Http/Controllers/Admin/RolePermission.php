<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermission extends Controller
{
    public function RolePermissionSetting(){
        $permissions = Permission::all();
        return view('admin.permission.all_permission',compact('permissions'));

    } // End Method

    public function AddRolePermission(){
        return view('admin.permission.add_permission');
    }// End Method


    public function StorePermission(Request $request){

        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);

    }// End Method


    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit_permission',compact('permission'));

     }// End Method



     public function UpdatePermission(Request $request){
         $per_id = $request->id;


          Permission::findOrFail($per_id)->update([
             'name' => $request->name,
             'group_name' => $request->group_name,

         ]);

         $notification = array(
             'message' => 'Permission Updated Successfully',
             'alert' => 'success'
         );

         return redirect()->route('all.permission')->with($notification);


     }// End Method


     public function DeletePermission($id){

          Permission::findOrFail($id)->delete();

          $notification = array(
             'message' => 'Permission Deleted Successfully',
             'alert' => 'success'
         );

         return redirect()->back()->with($notification);
     }// End Method

    //  Role --------------------------------------------------------------------------------
    public function Role(){

        $roles = Role::all();
        return view('admin.role.all_role',compact('roles'));

    } // End Method



    public function AddRole(){
        return view('admin.role.add_role');
    }// End Method


    public function StoreRole(Request $request){

        $role = Role::create([
            'name' => $request->name,

        ]);

        $notification = array(
            'message' => 'Roles Inserted Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }// End Method


    public function EditRoll($id){
        $roles = Role::findOrFail($id);
        return view('admin.role.edit_role',compact('roles'));
    }// End Method


    public function UpdateRole(Request $request){

        $role = $request->id;

        Role::findOrFail($role)->update([
            'name' => $request->name,

        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);

    }// End Method


    public function DeleteRole($id){

     Role::findOrFail($id)->delete();
       $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

    // Role & Permission ------------------------------------------------------------------
    public function AddRolePerm(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.add_roles_permission',compact('roles','permissions','permission_groups'));
   }// End Method


   public function StoreRolePerm(Request $request){

    $data = array();
    $permissions = $request->permission;

    foreach($permissions as $key => $item){
        $data['role'] = $request->role;
        $data['permission_id'] = $item;

        DB::table('role_has_permissions')->insert($data);
    }

     $notification = array(
        'message' => 'Role Permission Added Successfully',
        'alert' => 'success'
    );

    return redirect()->route('all.roles.permission')->with($notification);

    }// End Method




    public function AllRolesPermission(){

        $roles = Role::all();
        return view('admin.role.all_roles_permission',compact('roles'));

    } // End Method



    public function AdminRolesEdit($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.roles_permission_edit',compact('role','permissions','permission_groups'));
    } // End Method



    public function AdminRolesUpdate(Request $request,$id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }

         $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    }// End Method

    public function AdminRolesDelete($id){

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

         $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method


}
