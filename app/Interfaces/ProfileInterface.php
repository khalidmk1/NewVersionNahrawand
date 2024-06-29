<?php

namespace App\Interfaces;

interface ProfileInterface {
    public function showClient($id);
    public function passwordChange();

    public function indexAdmin();
    public function indexManager();
    public function indexSpeaker();
    public function indexClient();

    public function speakersAllRole();
    public function mangerAllRole();
    public function adminAllRole();
    public function superAdminRole();
    
    
    public function createAdmin();
    public function createManager();
    public function createSpeaker();

    public function store($request);
    public function restore($userId);

    //notification
    function notifyUsersWithPermission($permission, $contentId, $contentTitle, $message, $contentType);

    //api profile user
    public function authUser();
    public function populaire();
    public function speakersAll();
    public function updateApi($request);
    public function updateAvatar($request);
    public function allUserSubctegory();
}