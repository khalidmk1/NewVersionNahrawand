<?php

namespace App\Services\Email;

use App\Interfaces\EmailIterface;
use App\Services\Email\EmailQuery;

class EmailService extends EmailQuery implements EmailIterface {

    public function index(){
        $users = $this->allUsersNotClient();
        return view('email.index')->with('users' , $users);
    }
}