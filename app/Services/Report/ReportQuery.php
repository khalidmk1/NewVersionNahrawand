<?php

namespace App\Services\Report;

use App\Services\GlobaleService;

class ReportQuery extends GlobaleService{

    public function stateClient(){
        $userLogin = User::where('isLogin' , 1)->get();
        $userLogOut = User::where('isLogin' , 0)->get();

        return ['login' => $userLogin , 'logout' => $userLogOut];
    }
}