<?php

namespace App\Policies;

use App\Models\User;

class MenuPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Determine if the user can view the Gestion Acteur menu.
     */
    public function viewGestionActeur(User $user)
    {  
        return $user->hasPermissionTo('Manager Spearks');
    }

    public function viewReport(User $user){
        return $user->hasPermissionTo('Reporting');
    }

    public function viewCreateContent(User $user){
        return $user->hasPermissionTo('Creation Contenu');
    }

    public function viewEditeContent(User $user){
        return $user->hasPermissionTo('Modifier Contenu');
    }

    public function viewDeleteContent(User $user){
        return $user->hasPermissionTo('Suprimer Contenu');
    }

    public function viewMangeTicket(User $user){
        return $user->hasPermissionTo('Gestion Tickets');
    }

    public function viewManageEmail(User $user){
        return $user->hasPermissionTo('Manager Emails');
    }


}
