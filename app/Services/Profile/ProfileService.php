<?php

namespace App\Services\profile;

use App\Interfaces\ProfileInterface;
use App\Services\profile\ProfileQeury;

class ProfileService extends ProfileQeury implements ProfileInterface {

    public function indexAdmin(){
        $admins = $this->allAdmins();
        return view('guestProfile.admin.index')->with('admins' , $admins);
    }
    public function indexManager(){
        $managers = $this->allManagers();
        return view('guestProfile.manager.index')->with('managers' , $managers);
    }
    public function indexSpeaker(){
        $speakers = $this->allSpeakers();
        return view('guestProfile.speaker.index')->with('speakers' , $speakers);
    }

    public function speakersAllRole(){
        $roles = $this->allRoleSpeaker();
        return $roles;
    }

    public function mangerAllRole(){
        $roles = $this->allRoleManagers();
        return $roles;
    }


    public function createAdmin(){
        return view('guestProfile.admin.create');
    }

    public function createManager(){
        $roleManagers = $this->allRoleManagers();
        return view('guestProfile.manager.create')->with('roleManagers' , $roleManagers);
    }
    public function createSpeaker(){
        $roleSpeakers = $this->allRoleSpeaker();
        return view('guestProfile.speaker.create')->with('roleSpeakers' , $roleSpeakers);
    }

    public function store($request){
        $storedData = $this->storeAdmin($request);
        return redirect()->back()->with('status' , 'You Created A user');
    }

}