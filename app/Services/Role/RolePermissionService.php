<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\RolePermissionInterface;

class RolePermissionService extends RolePermissionQeury implements RolePermissionInterface {

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
       
        $permissions = $this->allPermission();
        $roles = $this->allRoles();
        $roleHasPermission = $this->roleHasPermission();
        return view('RolePermission.show')->with(['permissions' => $permissions , 'roles' => $roles , 
        'roleHasPermission' => $roleHasPermission]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
       $role = $this->storeRole($request);

       return redirect()->back()->with('status' , 'Role created successfully');
    }

    public function storeRolePermission($roleId ,$permissionId){
        $rolePemission = $this->asginRolePermission($roleId , $permissionId);

        return response()->json($rolePemission);
    }




}