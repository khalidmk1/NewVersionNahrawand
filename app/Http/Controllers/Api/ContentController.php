<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ContentInterface;

class ContentController extends Controller
{
    private $contentInterface;

    public function __construct(ContentInterface $contentInterface) {
        $this->contentInterface = $contentInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function allApiContent()
    {
        return $this->contentInterface->allApiContent(); 
    }

    public function comingSoonContent(){
        return $this->contentInterface->comingSoonContent();
    }

    public function contentFormation(){
        return $this->contentInterface->contentFormation();
    }

    public function contentPodcast(){
        return $this->contentInterface->contentPodcast();
    }

    public function contentQuickly(){
        return $this->contentInterface->contentQuickly();
    }

    public function createFavoris(String $content){
        return $this->contentInterface->createFavoris($content);
    }
    public function favorisExists(String $content){
        return $this->contentInterface->favorisExists($content);
    }
    public function createView(String $content){
        return $this->contentInterface->createView($content);
    }
    public function createFinished(String $content){
        return $this->contentInterface->createFinished($content);
    }
    public function checkFinished(String $content){
        return $this->contentInterface->checkFinished($content);
    }

    public function createComment(Request $request ,String $content){
        return $this->contentInterface->createComment($request , $content);
    }
    public function contentComment(String $content){
        return $this->contentInterface->contentComment($content);
    }

    public function favoris(){
        return $this->contentInterface->favoris();
    }
    public function views(){
        return $this->contentInterface->views();
    }
    public function finishedContent(){
        return $this->contentInterface->finishedContent();
    }
    public function contentPodcastBySubCategory(){
        return $this->contentInterface->contentPodcastBySubCategory();
    }
    public function contentFormationBySubCategory(){
        return $this->contentInterface->contentFormationBySubCategory();
    }

    public function contentByProgram(String $programId){
        return $this->contentInterface->contentByProgram($programId);
    }
}
