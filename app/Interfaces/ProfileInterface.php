<?php

namespace App\Interfaces;

interface ProfileInterface {
    public function indexAdmin();
    public function indexManager();
    public function indexSpeaker();
    
    
    public function createAdmin();
    public function createManager();
    public function createSpeaker();

    public function store($request);
}