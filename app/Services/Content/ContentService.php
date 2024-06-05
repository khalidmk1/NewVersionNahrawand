<?php

namespace App\Services\Content;

use App\Interfaces\ContentInterface;
use Illuminate\Support\Facades\Crypt;
use App\Services\Content\ContentQuery;


class ContentService extends ContentQuery implements ContentInterface {

    public function index()
    {
        $contents = $this->allContent();
        return view('content.index')->with(['contents' => $contents['contents']]);
    }

    public function quicklyIndex(){
        $contents = $this->allContent();
        return view('content.quicklyIndex')->with(['Quicklys' => $contents['contentQuicly'] ]);
    }

    /* public function allContent(){
        $contents = $this->allContentApi();
        return response()->json($contents);
    } */

    

    public function show($content){
        $content = $this->getContentById($content);
        $moderatorUsers = $this->allModerators();
        $animatorUsers = $this->allAnimators();
        $formateurUsers = $this->allFormateur();
        $invertersUsers = $this->allInvites();
        $conferencerUsers = $this->allConferencers();
        $categories = $this->allCategories();
        $objectives = $this->allObjectives();
        $subCategories = $this->allSubCategories();
        return view('content.show')->with(['content' => $content , 'moderatorUsers' => $moderatorUsers , 
        'conferencerUsers' => $conferencerUsers ,'animatorUsers' => $animatorUsers , 
        'formateurUsers' => $formateurUsers , 'invertersUsers' => $invertersUsers ,'categories' => $categories , 
        'objectives' => $objectives , 'subCategories' => $subCategories
    ]);
    }

    public function create()
    {
        $categories = $this->allCategories();
        $moderatorUsers = $this->allModerators();
        $animatorUsers = $this->allAnimators();
        $formateurUsers = $this->allFormateur();
        $programs = $this->allPrograms();
        $subCategories = $this->allSubCategories();
        return view('content.create')->with(['categories' => $categories , 
        'moderatorUsers' => $moderatorUsers , 'animatorUsers' => $animatorUsers , 
        'formateurUsers' => $formateurUsers , 'programs' => $programs , 'subCategories' => $subCategories]);
    }

    public function objectivesByCategory($id)
    {
        $objectives = $this->chercheObejectiveByCategory($id);
        return response()->json($objectives);
    }

    public function store($request){
        $content = $this->storeContent($request);

        if($content->contentType == 'podcast' || $content->contentType == 'formation' || $content->contentType == 'conference'){
            return redirect()->route('video.show', Crypt::encrypt($content->id));
        }else{
            return redirect()->back()->with('status' , 'You have Created Quickly');
        }
       
    }

    public function update($request , $id){
        $content = $this->updateContent($request , $id);

        return redirect()->back()->with('status' , 'You updated the Content');
    }

    public function destroy($request , $id){
        $distroyedContent = $this->destroyContent($request , $id);

        return redirect()->route('content.index')->with('status', 'You have deleted content');
    }

    //Api React Native
    public function comingSoonContent(){
        $contents = $this->allComingContentApi();
        return response()->json($contents);
    }

    public function contentFormation(){
        $contents = $this->formationContentApi();
        return response()->json($contents);
    }

    public function createFavoris($content){
        $favoris = $this->contentFavoris($content);

        return response()->json($favoris);
    }

    public function favorisExists($content){
        $favoris = $this->checkFavoris($content);
        return $favoris;
    }

    public function createView($content){
        $view = $this->createContentView($content);
        return response()->json($view);
    }

    public function createFinished($content){
        $finishedContent = $this->createContentFinished($content);
        return response()->json($finishedContent);
    }
    public function checkFinished($content){
        $finishedContent = $this->checkContentFinished($content);
        return response()->json($finishedContent);
    }

    public function createComment($request , $content){
        $commentContent = $this->createContentComment($request , $content);
        return $commentContent;
    }

    public function contentComment($content){
        $comment = $this->createContentComment($content);
        return $comment;
    }

}