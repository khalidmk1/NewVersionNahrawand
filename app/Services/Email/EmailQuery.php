<?php

namespace App\Services\Email;

use App\Models\User;
use Spatie\Permission\Models\Role;

class EmailQuery {
    public function allUsersNotClient(){
        $excludeRoleNames = ['Client', 'Admin', 'Super Admin'];
        $excludeRoles = Role::whereIn('name', $excludeRoleNames)->pluck('id')->toArray();
     
        $notClientUsers = User::whereDoesntHave('roles', function($query) use ($excludeRoles) {
            $query->whereIn('id', $excludeRoles);
        })->get();
       
        return $notClientUsers;
    }
}