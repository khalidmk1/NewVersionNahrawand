<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ProfileInterface;

class ProfileController extends Controller
{

    private $ProfileInterface;

    public function __construct(ProfileInterface $ProfileInterface) {
        $this->ProfileInterface = $ProfileInterface;
    }
    
    public function authUser(){
        return $this->ProfileInterface->authUser();
    }

    public function populaire(){
        return $this->ProfileInterface->populaire();
    }

    public function updateApi(Request $request){
        return $this->ProfileInterface->updateApi($request);
    }

    public function updateAvatar(Request $request){
        return $this->ProfileInterface->updateAvatar($request);
    }
}
