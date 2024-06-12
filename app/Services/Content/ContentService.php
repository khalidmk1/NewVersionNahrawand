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
        $programs = $this->allPrograms();
        return view('content.show')->with(['content' => $content , 'moderatorUsers' => $moderatorUsers , 
        'conferencerUsers' => $conferencerUsers ,'animatorUsers' => $animatorUsers , 
        'formateurUsers' => $formateurUsers , 'invertersUsers' => $invertersUsers ,'categories' => $categories , 
        'objectives' => $objectives , 'subCategories' => $subCategories , 'programs' => $programs
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

    public function history(){
        $histories = $this->historyDeleted();
        return view('history.index')->with(['contents' => $histories['contents'] , 'videos' => $histories['videos'] , 
        'categories' => $histories['categories'] , 'subCategories' => $histories['subCategories'] , 
        'programs' => $histories['programs'] , 'events' => $histories['events'] , 'users' => $histories['users'] ]);
    }

    public function restore($contentId){
        $content = $this->restoreContent($contentId);
        return redirect()->back()->with('status' , 'You have restore content');
    }

    //Api React Native
    public function comingSoonContent(){
        $contents = $this->allComingContentApi();
        return response()->json(['contents' => $contents['contents'] , 'vidoes' => $contents['videos']]);
    }

    public function contentFormation(){
        $contents = $this->formationContentApi();
        return response()->json($contents);
    }

    public function contentPodcast(){
        $contents = $this->podcastContentApi();
        return response()->json($contents);
    }

    public function contentQuicly(){
        $contents = $this->quicklyContentApi();
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
        $comment = $this->indexContentComment($content);
        return response()->json($comment);
    }

    public function favoris(){
        $contents = $this->getFavoris();
        return response()->json($contents);
    }

    public function views(){
        $contents = $this->getContentStarted();
        return response()->json($contents);
    }

    public function finishedContent(){
        $contents = $this->getFinishedContent();
        return response()->json($contents);
    }

    public function contentPodcastBySubCategory(){
        $contents = $this->contentPodcastBySubCategoryApi();
        return response()->json($contents);
    }

    public function contentFormationBySubCategory(){
        $contents = $this->contentFormationBySubCategoryApi();
        return response()->json($contents);
    }

    public function contentByProgram($programId){
        $contents = $this->contentByProgramApi($programId);
        return response()->json($contents);
    }

}