<?php

namespace App\Services\Content;

use Spatie\Tags\Tag;
use App\Models\Content;
use App\Models\Category;
use App\Models\ContentView;
use App\Models\ContentFavoris;
use App\Models\ContentFinished;
use App\Models\ContentObjective;
use App\Services\GlobaleService;
use App\Models\ContentSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ContentRequest;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ContentUpdateRequest;

class ContentQuery extends GlobaleService {


    public function allContent()
    {
        $contentType = ['conference' , 'podcast' , 'formation']; 
        $contents = Content::whereIn('contentType' , $contentType)->paginate(10);
        $contentQuicly = Content::where('contentType' , 'quickly')->paginate(10); 
        return ['contents'=>$contents , 'contentQuicly' => $contentQuicly];
    }

    public function getContentById(String $content){
        $content = Content::findOrFail(Crypt::decrypt($content));
        return $content;
    }

    
   

    public function storeContent(ContentRequest $request){
        $isComing = $request->isComing == 'on';
        $isActive = $request->isActive == 'on';
        $isCertify = $request->isCertify == 'on';
         
        /*  $objectives = array_map('intval', $request->objectivesId);  */
        $subCategories = array_map('intval', $request->subCategoryId); 

        $contentImage = $this->storeConteImage($request);
        $contentImageFlex = $this->storeConteImageFlex($request);
        $document = $this->storeConteDocument($request);

        $program = $request->programId == 0 ? null : $request->programId;

        $content = Content::create([
            'categoryId' => $request->cotegoryId,
            'hostId' => $request->contentHost,
            'programId' => $program,
            'image' => $contentImage,
            'imageFlex' => $contentImageFlex,
            'video' => $request->videoUrl,
            'title' => $request->title,
            'bigDescription' => $request->bigDescription,
            'smallDescription' => $request->smallDescription,
            'contentType' => $request->contentType,
            'isActive' => $isActive,
            'isComing' => $isComing,
            'isCertify' => $isCertify,
            'document' => $document,
            'condition' => $request->condition,
            'duration' => $request->duration
        ]);


        if ($request->has('tags') && $request->tags[0] !== null) {
            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $content->syncTags($arrTags, 'content');
        }

        

      /*   foreach ($objectives as $key => $objective) {
            $objectiveContent = ContentObjective::create([
                'contentId' => $content->id,
                'objectivelId' => $objective
            ]);
        } */

        foreach ($subCategories as $key => $subCategorie) {
            $subCategorieContent = ContentSubCategory::create([
                'contentId' => $content->id,
                'subCategoryId' => $subCategorie
            ]);
        }

        return $content;
    }

    public function updateContent(ContentUpdateRequest $request , String $id){
        $content = Content::findOrFail(Crypt::decrypt($id));
        /* $nameDocument = $content->document; */
        $nameFlexImage = $content->imageFlex ?? '' ;
        $nameImage = $content->image ?? '' ;

        $flexImage = $this->updateConteImageFlex($request, $nameFlexImage);
        $contentImage = $this->updateConteImage($request, $nameImage);
        /* $contentDocument = $this->updateConteDocument($request, $nameDocument); */
        $isComing = $request->isComing == 'on';
        $isActive = $request->isActive == 'on';
        $isCertify = $request->isCertify == 'on';



        $content->update([
            'categoryId' => $request->cotegoryId,
            'hostId' => $request->contentHost,
            'programId' => $request->programId,
            'video' => $request->videoUrl,
            'title' => $request->title,
            'bigDescription' => $request->bigDescription,
            'smallDescription' => $request->smallDescription,
            'isActive' => $isActive,
            'isComing' => $isComing,
            'isCertify' => $isCertify,
            'isUpdated' => true,
            /* 'document' => $contentDocument, */
            'imageFlex' => $flexImage,
            'image' => $contentImage,
            'condition' => $request->condition,
            'duration' => $request->duration,
        ]);

        $content->contentObjectives()->delete();
        $content->contentSubCategories()->delete();

      

        if ($request->has('tags') && !empty($request->tags[0])) {
            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $content->syncTags($arrTags, 'content');
        } else {

            $content->syncTags([], 'content');
        }

        if($request->has('objectivesId')){
            $objectives = array_map('intval', $request->objectivesId);
            foreach ($objectives as $objective) {
                ContentObjective::create([
                    'contentId' => $content->id,
                    'objectivelId' => $objective
                ]);
            }
        }


        if($request->has('subCategoryId')){
            $subCategories = array_map('intval', $request->subCategoryId);
            foreach ($subCategories as $subCategorie) {
                ContentSubCategory::create([
                    'contentId' => $content->id,
                    'subCategoryId' => $subCategorie
                ]);
            }
        }
        

        return $content;
    }

  

    public function destroyContent(DestroyRequest $request , String $id){

        $content = Content::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $content->delete();

            foreach ($content->videos as $key => $video) {
                $video->delete();
            }
           
        }
        return $content;

    }

    //api content

    public function contentFavoris(String $content){
        $content = Content::findOrFail($content);
        
        $favorisExists = ContentFavoris::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->exists();
    
        if($favorisExists){
            ContentFavoris::where('contentId', $content->id)
            ->where('userId', Auth::user()->id)
            ->delete();
        }else{
            $favoris = ContentFavoris::create([
                'contentId' => $content->id,
                'userId' => Auth::user()->id,
            ]);
            return $favoris;
        }
    }

    public function checkFavoris(String $content){
        $content = Content::findOrFail($content);

        $Checkfolow = ContentFavoris::where('userId', Auth::user()->id)
        ->where('contentId', $content->id)
        ->exists();

        if($Checkfolow){
            return response()->json(true);
        }

        return response()->json(false);
    }

    public function createContentView(String $content){

        $content = Content::findOrFail($content);

        $viewExists = ContentView::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->exists();

        if(!$viewExists){
            $view = ContentView::create([
                'contentId' => $content->id,
                'userId' => Auth::user()->id,
            ]);
    
            return $view;
        }
        
        return $viewExists;

    }

    public function createContentFinished(String $content){
        $content = Content::findOrFail($content);
        $finishedExists = ContentFinished::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->exists();

        if(!$finishedExists){
            $finishedContent = ContentFinished::create([
                'contentId' => $content->id,
                'userId' => Auth::user()->id,
            ]);
    
            return $finishedContent;
        }
        
        return $finishedExists;
    }

    public function checkContentFinished(String $content){
        $content = Content::findOrFail($content);
        $finishedExists = ContentFinished::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->get();

        return $finishedExists;
    }


}