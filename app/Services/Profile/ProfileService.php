<?php

namespace App\Services\profile;

use App\Interfaces\ProfileInterface;
use App\Services\Profile\ProfileQeury;

class ProfileService extends ProfileQeury implements ProfileInterface {

    public function showClient($id){
        $client = $this->userId($id);
        $groupedByDomain = $this->userSubCategoryByDomain($client);
        return view('client.show')->with(['client' => $client , 'groupedByDomain' => $groupedByDomain]);
    }

    public function passwordChange(){
        return view('auth.change-password');
    }

    public function indexAdmin(){
        $admins = $this->allAdmins();
        return view('guestProfile.admin.index')->with('admins' , $admins);
    }
    public function indexManager(){
        $managers = $this->allManagers();
        return view('guestProfile.manager.index')->with('managers' , $managers);
    }
    public function indexSpeaker(){
        $speakers = $this->allRoleSpeakers();
        return view('guestProfile.speaker.index')->with('speakers' , $speakers);
    }

    public function indexClient(){
        $clients = $this->allClient();
        return view('client.index')->with('clients' , $clients);
    }

    public function speakersAllRole(){
        $roles = $this->allRoleSpeaker();
        return $roles;
    }

    public function mangerAllRole(){
        $roles = $this->allRoleManagers();
        return $roles;
    }

    public function adminAllRole(){
        $role = $this->allRoleAdmin();
        return $role;
    }

    public function superAdminRole(){
        $role = $this->allRoleSuperAdmin();
        return $role;
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

    public function restore($userId){
        $user = $this->restoreUser($userId);
        return redirect()->back()->with('status' , 'You Have restored User');
    }

    //notification user

    public function notification(){
        return view('notification.index');
    }

    public function allNotification(){
        return $notifications = $this->notificationIndex();
    }

    public function notificationSend(){
        return $this->sendNotification();
    }

    public function notificationRead($notificationId){
        $notification = $this->markNotificationAsRead($notificationId);
        return redirect()->back()->with('status' ,'Notification updated successfully.');
    }

    public function notificationDelete($notificationId){
        $notification = $this->deleteNotification($notificationId);
        return redirect()->back()->with('status' ,'Notification deleted successfully.');
        
    }

    //api profile user
    public function authUser(){
        $user = $this->authClient();
        return $user;
    }

    public function populaire(){
        $users = $this->populaireUsers();
        return response()->json($users);
    }

    public function speakersAll(){
        $user = $this->speakerApiUsers();
        return response()->json($user);
    }

    public function updateApi($request){
        $user = $this->updateClientApi($request);
        return response()->json($user);
    }

    public function updateAvatar($request){
        $avatar = $this->updateClientAvatarApi($request);
        return $avatar;
    }

    public function createUserSubCategory($subCategoryId){
        $userSubCategory = $this->createUserSubCategoryApi($subCategoryId);
        return response()->json($subCategoryId);
    }

    public function allUserSubctegory(){
        $subCategories = $this->allUserSubcatagoryApi();
        return response()->json($subCategories);
    }

}