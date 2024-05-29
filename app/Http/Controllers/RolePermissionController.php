<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RolePermissionInterface;

class RolePermissionController extends Controller
{

    private $RolePermissionInterface;

    public function __construct(RolePermissionInterface $RolePermissionInterface) {
        $this->RolePermissionInterface = $RolePermissionInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->RolePermissionInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->RolePermissionInterface->store($request);
    }

    public function storeRolePermission(String $roleId , String $permissionId){
        return $this->RolePermissionInterface->storeRolePermission($roleId , $permissionId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
