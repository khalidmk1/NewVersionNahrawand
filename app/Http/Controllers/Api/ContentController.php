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
    public function allContent()
    {
        return $this->contentInterface->allContent(); 
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

    public function contentQuicly(){
        return $this->contentInterface->contentQuicly();
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
}
