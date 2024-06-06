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
    public function contentPodcast();
    
    public function createFavoris($content);
    public function favorisExists($content);
    public function createView($content);
    public function createFinished($content);
    public function checkFinished($content);
    public function createComment($request , $content);
    public function contentComment($content);
    public function favoris();
    public function views();
    public function finishedContent();
}

