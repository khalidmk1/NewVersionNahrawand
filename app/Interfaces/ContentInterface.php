<?php 

namespace App\Interfaces;

interface ContentInterface {
    public function index();
    public function create();
    public function objectivesByCategory($id);
    public function store($request); 
    public function show($content); 
    public function update($request , $id);
    public function destroy($request ,$id);
    public function history();
    public function restore($contentId);

    //api content
    public function comingSoonContent();
    public function allApiContent();
    public function contentFormation();
    public function contentPodcast();
    public function contentQuickly();
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
    public function contentPodcastBySubCategory();
    public function contentFormationBySubCategory();
    public function contentByProgram($programId);
}

