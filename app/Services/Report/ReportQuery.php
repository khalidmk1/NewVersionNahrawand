<?php

namespace App\Services\Report;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Content;
use App\Services\GlobaleService;

class ReportQuery extends GlobaleService{

    public function stateClient(){
        $userLogin = User::role('client')->where('isLogin', 1)->get();
        $userLogOut = User::role('client')->where('isLogin', 0)->get();
    
        return ['login' => $userLogin->count(), 'logout' => $userLogOut->count()];
    }

    public function latestClient(){
        $recentClients = User::role('client')
        ->orderBy('created_at', 'desc')->take(8)->get(); 
        
        return $recentClients;
    }

    public function contentByDomain(){

    }

    public function latestContent(){
        $contents = Content::orderBy('created_at', 'desc')
        ->take(4)->get();
        return $contents;
    }

    public function tickets(){
        $tickets = Ticket::orderBy('created_at', 'desc')
        ->take(7)->get();
        return $tickets;
    }
}