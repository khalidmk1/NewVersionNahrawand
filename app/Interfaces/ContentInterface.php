<?php 

namespace App\Interfaces;

interface ContentInterface {
    public function index();
    public function quicklyIndex();
    public function create();
    public function objectivesByCategory($id);
    public function store($request); 
    public function show($content); 
    public function update($request , $id);
    public function destroy($request ,$id);

    //api content

    public function comingSoonContent();
    public function allContent();
    public function contentFormation();
    public function createFavoris($content);
}

