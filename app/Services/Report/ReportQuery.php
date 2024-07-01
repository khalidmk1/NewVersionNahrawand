<?php

namespace App\Services\Report;

use App\Models\User;
use App\Services\GlobaleService;

class ReportQuery extends GlobaleService{

    public function stateClient(){
        $userLogin = User::role('client')->where('isLogin', 1)->get();
        $userLogOut = User::role('client')->where('isLogin', 0)->get();
    
        return ['login' => $userLogin->count(), 'logout' => $userLogOut->count()];
    }

    public function latestClient(){
        $recentClients = User::role('client')
        ->orderBy('created_at', 'desc')->take(10)->get(); 
        
        return $recentClients;
    }

    public function contentByDomain(){
        
    }
}