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

    public function speakersAll(){
        return $this->ProfileInterface->speakersAll();
    }

    public function updateApi(Request $request){
        return $this->ProfileInterface->updateApi($request);
    }

    public function updateAvatar(Request $request){
        return $this->ProfileInterface->updateAvatar($request);
    }

    public function createUserSubCategory(String $subCategoryId){
        return $this->ProfileInterface->createUserSubCategory($subCategoryId);
    }

    public function allUserSubctegory(){
        return $this->ProfileInterface->allUserSubctegory();
    }

    public function checkSession(){
        return $this->ProfileInterface->checkSession();
    }
}
