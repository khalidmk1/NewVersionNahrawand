<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface RolePermissionInterface{

    public function index();

    public function store($request);

    public function storeRolePermission($roleId ,$permissionId);

}