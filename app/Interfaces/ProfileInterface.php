<?php

namespace App\Interfaces;

interface ProfileInterface {
    public function indexAdmin();
    public function indexManager();
    public function indexSpeaker();

    public function speakersAllRole();
    public function mangerAllRole();
    
    
    public function createAdmin();
    public function createManager();
    public function createSpeaker();

    public function store($request);

    //api profile user
    public function authUser();
}