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
}
