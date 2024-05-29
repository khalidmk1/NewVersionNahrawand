<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionQeury {

     /**
    * Display a listing of the resource.
    */
    public function allPermission()
    {
        $permission = Permission::all();

        return $permission;
    }

    public function allRoles(){
        $excludedRoles = ['Client', 'Animateur', 'Formateur', 'Invité', 'Modérateur', 'Conférencier'];
        $roles = Role::whereNotIn('name', $excludedRoles)->get();

        return $roles;
    }

    public function roleHasPermission(){
        $rolePermissions = DB::table('role_has_permissions')
        ->select('role_id', 'permission_id')
        ->get()
        ->groupBy('role_id');

        return $rolePermissions;
    }
    
    public function storeRole(Request $request){

        $request->validate([
            'name' => ['required' ,'string' , 'max:255' , 'unique:roles,name']
        ]); 
        
        $role = Role::create([
            'name' => $request->name
        ]);

        return $role;
    }

   

    public function asginRolePermission(String $roleId , String $permissionId){
        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
        }else{
            $rolePermission = $role->givePermissionTo($permission);
        }
        return $rolePermission;
       
    }
}

