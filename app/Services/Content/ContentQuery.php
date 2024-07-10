<?php

namespace App\Services\Content;

use App\Models\User;
use Spatie\Tags\Tag;
use App\Models\Content;
use App\Models\Program;
use App\Models\Category;
use App\Models\ContentView;
use Illuminate\Http\Request;
use App\Models\ContentComment;
use App\Models\ContentFavoris;
use App\Events\NotifyProcessed;
use App\Models\ContentFinished;
use App\Models\UserSubcategory;
use App\Models\ContentObjective;
use App\Services\GlobaleService;
use App\Models\ContentSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ContentRequest;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\UserNotification;
use App\Http\Requests\ContentUpdateRequest;
use App\Notifications\ContentCreatedNotification;

class ContentQuery extends GlobaleService {


    public function allContent()
    {
        $contentType = ['conference', 'podcast', 'formation'];
        $contents = Content::whereIn('contentType', $contentType)->orderBy('created_at', 'desc')->paginate(9);
        return $contents;
    }

    public function allContentQuickly()
    {
        $contentQuickly = Content::where('contentType', 'quickly')->orderBy('created_at', 'desc')->paginate(9);
        return $contentQuickly;
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
        $subCategories = array_map('intval', $request->subCategoryId ?? []);

        $contentImage = $this->storeConteImage($request);
        $contentImageFlex = $this->storeConteImageFlex($request);
        $document = $this->storeConteDocument($request);
        $videoUrl = $this->extractYoutubeId($request->videoUrl);

        $program = $request->programId == 0 ? null : $request->programId;

        $content = Content::create([
            'categoryId' => $request->cotegoryId,
            'hostId' => $request->contentHost,
            'programId' => $program,
            'image' => $contentImage,
            'imageFlex' => $contentImageFlex,
            'video' => $videoUrl,
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

        $permission = 'Creation Contenu';
        $message = 'content has been created';
        $contentType = 'content';
        $notify = $this->notifyUsersWithPermission( $permission , $content->id, $content->title , $message , $contentType );
        return $content;
    }

    public function updateContent(ContentUpdateRequest $request , String $id){
        $content = Content::findOrFail(Crypt::decrypt($id));
      
        /* $nameDocument = $content->document; */
        $nameFlexImage = $content->imageFlex ?? '' ;
        $nameImage = $content->image ?? '' ;

        $videoUrl = $this->extractYoutubeId($request->videoUrl);
        $flexImage = $this->updateConteImageFlex($request, $nameFlexImage);
        $contentImage = $this->updateConteImage($request, $nameImage);
        /* $contentDocument = $this->updateConteDocument($request, $nameDocument); */
        $isComing = $request->isComing == 'on';
        $isActive = $request->isActive == 'on';
        $isCertify = $request->isCertify == 'on';
        $programId = $request->programId == 0 ? null : $request->programId;



        $content->update([
            'categoryId' => $request->cotegoryId,
            'hostId' => $request->contentHost,
            'programId' => $programId,
            'video' => $videoUrl,
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

        /* if($request->has('objectivesId')){
            $objectives = array_map('intval', $request->objectivesId);
            foreach ($objectives as $objective) {
                ContentObjective::create([
                    'contentId' => $content->id,
                    'objectivelId' => $objective
                ]);
            }
        } */


        if($request->has('subCategoryId')){
            $subCategories = array_map('intval', $request->subCategoryId);
            foreach ($subCategories as $subCategorie) {
                ContentSubCategory::create([
                    'contentId' => $content->id,
                    'subCategoryId' => $subCategorie
                ]);
            }
        }

        $permission = 'Modifier Contenu';
        $message = 'content has been updated';
        $contentType = 'content';

        $notify = $this->notifyUsersWithPermission( $permission , $content->id, $content->title , $message , $contentType );

        return $content;
    }

  

    public function destroyContent(DestroyRequest $request , String $id){

        $content = Content::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $content->delete();
           
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

        $existingView = ContentFinished::where('contentId', $content->id)
        ->where('userId', Auth::id())
        ->exists();

        if ($existingView) {
            return response()->json(['message' => 'View already exists, updated timestamp', 'view' => $existingView]);
        } else {
            $newView = ContentView::create([
                'contentId' => $content->id,
                'userId' => Auth::id(),
            ]);
    
            return response()->json(['message' => 'New view created', 'view' => $newView]);
        }

    }

    public function createContentFinished(String $content){
        $content = Content::findOrFail($content);
        $finishedExists = ContentFinished::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->exists();

        $viewExists = ContentView::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->delete();

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
        ->exists();

        return $finishedExists; 
    }

    public function createContentComment(Request $request , String $content){
        $content = Content::findOrFail($content);

        $commentExists = ContentComment::where('contentId', $content->id)
        ->where('userId', Auth::user()->id)
        ->exists();

        if(!$commentExists){
            $comment = ContentComment::create([
                'contentId' => $content->id,
                'userId' => Auth::user()->id,
                'comment' => $request->comment
            ]);
            $comment->with('user');

            return response()->json([
                'id' => $comment->id,
                'comment' => $comment->comment,
                'updated' => $comment->updated_at,
                'user' => [
                    'fullName' => $comment->user->firstName . ' '. $comment->user->lastName  ,
                    'avatar' => $comment->user->avatar,
                ]
            ]);
        }else{

            $existingComment  = ContentComment::where('contentId', $content->id)
            ->where('userId', Auth::user()->id)
            ->with('user')
            ->first();

            $existingComment ->update([
                'comment' => $request->comment
            ]);

            return response()->json([
                'id' => $existingComment->id,
                'comment' => $existingComment->comment,
                'updated' => $existingComment->updated_at,
                'user' => [
                    'fullName' => $existingComment->user->firstName . ' '. $existingComment->user->lastName  ,
                    'avatar' => $existingComment->user->avatar,
                ]
            ]);
        }
        
    }

    public function indexContentComment(String $content){
        $content = Content::findOrFail($content);
        $comments = ContentComment::where('contentId', $content->id)
        ->with('user')
        ->get();

        $response = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'updated' => $comment->updated_at,
                'user' => [
                    'fullName' => $comment->user->firstName . ' ' . $comment->user->lastName,
                    'avatar' => $comment->user->avatar,
                ]
            ];
        });

        return $response;
    }

    public function getFavoris(){
        $favoris = ContentFavoris::where('userId' , Auth::user()->id)->get();

        $contents = Content::whereIn('id' , $favoris->pluck('contentId'))->get();

        $contentfilleted = $contents->map(function($content){
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'video' => $content->video,
                'title' => $content->title,
                'contentType' => $content->contentType,
                'quizType' => $content->quizType,
                'smallDescription' => $content->smallDescription,
                'bigDescription' => $content->bigDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'duration' => $content->duration,
                'categoryName' => $content->category->name,
                'tags' => $content->tags->pluck('name')->toArray(),
                'user' => [
                    'id' => $content->user->id,
                    'avatar' => $content->user->avatar,
                    'cover' => $content->user->cover,
                    'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                    'roles' => $content->user->roles->pluck('name')->toArray(),
                    'biographie' => $content->user->biographie,
                    'faceboock' => $content->user->faceboock,
                    'linkdin' => $content->user->linkdin,
                    'instagram' => $content->user->instagram,
                ],
            ];
        });

        return $contentfilleted;
    }

    public function getContentStarted(){
        $views = ContentView::where('userId' , Auth::user()->id)->get();
        $contents = Content::whereIn('id' , $views->pluck('contentId'))->get();

        $contentfilleted = $contents->map(function($content){
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'video' => $content->video,
                'title' => $content->title,
                'contentType' => $content->contentType,
                'quizType' => $content->quizType,
                'smallDescription' => $content->smallDescription,
                'bigDescription' => $content->bigDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'duration' => $content->duration,
                'categoryName' => $content->category->name,
                'tags' => $content->tags->pluck('name')->toArray(),
                'user' => [
                    'id' => $content->user->id,
                    'avatar' => $content->user->avatar,
                    'cover' => $content->user->cover,
                    'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                    'roles' => $content->user->roles->pluck('name')->toArray(),
                    'biographie' => $content->user->biographie,
                    'faceboock' => $content->user->faceboock,
                    'linkdin' => $content->user->linkdin,
                    'instagram' => $content->user->instagram,
                ],
            ];
        });

        return $contentfilleted;
    }

    public function getFinishedContent(){
        $finishedContents = ContentFinished::where('userId' , Auth::user()->id)->get();
        $contents =  Content::whereIn('id' , $finishedContents->pluck('contentId'))->get();
        $contentfilleted = $contents->map(function($content){
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'video' => $content->video,
                'title' => $content->title,
                'contentType' => $content->contentType,
                'quizType' => $content->quizType,
                'smallDescription' => $content->smallDescription,
                'bigDescription' => $content->bigDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'duration' => $content->duration,
                'categoryName' => $content->category->name,
                'tags' => $content->tags->pluck('name')->toArray(),
                'user' => [
                    'id' => $content->user->id,
                    'avatar' => $content->user->avatar,
                    'cover' => $content->user->cover,
                    'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                    'roles' => $content->user->roles->pluck('name')->toArray(),
                    'biographie' => $content->user->biographie,
                    'faceboock' => $content->user->faceboock,
                    'linkdin' => $content->user->linkdin,
                    'instagram' => $content->user->instagram,
                ],
            ];
        });

        return $contentfilleted;

    }


    public function contentPodcastBySubCategoryApi(){
        $userSubCategoryIds = UserSubcategory::where('userId', Auth::id())
        ->pluck('subCategoryId');

        $contentIds = ContentSubCategory::whereIn('subCategoryId', $userSubCategoryIds)
        ->pluck('contentId');

        $contents = Content::whereIn('id', $contentIds)
        ->where('contentType', 'podcast')
        ->where('isComing' , 0)
        ->with(['category', 'tags', 'user.roles'])
        ->get();

        $contentFiltered = $contents->map(function($content) {
        return [
            'id' => $content->id,
            'image' => $content->image,
            'imageFlex' => $content->imageFlex,
            'video' => $content->video,
            'title' => $content->title,
            'contentType' => $content->contentType,
            'quizType' => $content->quizType,
            'smallDescription' => $content->smallDescription,
            'bigDescription' => $content->bigDescription,
            'condition' => $content->condition,
            'document' => $content->document,
            'duration' => $content->duration,
            'categoryName' => $content->category->name,
            'tags' => $content->tags->pluck('name')->toArray(),
            'user' => [
                'id' => $content->user->id,
                'avatar' => $content->user->avatar,
                'cover' => $content->user->cover,
                'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                'roles' => $content->user->roles->pluck('name')->toArray(),
                'biographie' => $content->user->biographie,
                'faceboock' => $content->user->faceboock,
                'linkdin' => $content->user->linkdin,
                'instagram' => $content->user->instagram,
            ],
        ];
        });

        return $contentFiltered;

    }


    public function contentFormationBySubCategoryApi(){
        $userSubCategoryIds = UserSubcategory::where('userId', Auth::id())
        ->pluck('subCategoryId');

        $contentIds = ContentSubCategory::whereIn('subCategoryId', $userSubCategoryIds)
        ->pluck('contentId');

        $contents = Content::whereIn('id', $contentIds)
        ->where('contentType', 'formation')
        ->where('isComing' , 0)
        ->with(['category', 'tags', 'user.roles'])
        ->get();

        $contentFiltered = $contents->map(function($content) {
        return [
            'id' => $content->id,
            'image' => $content->image,
            'imageFlex' => $content->imageFlex,
            'video' => $content->video,
            'title' => $content->title,
            'contentType' => $content->contentType,
            'quizType' => $content->quizType,
            'smallDescription' => $content->smallDescription,
            'bigDescription' => $content->bigDescription,
            'condition' => $content->condition,
            'document' => $content->document,
            'duration' => $content->duration,
            'categoryName' => $content->category->name,
            'tags' => $content->tags->pluck('name')->toArray(),
            'user' => [
                'id' => $content->user->id,
                'avatar' => $content->user->avatar,
                'cover' => $content->user->cover,
                'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                'roles' => $content->user->roles->pluck('name')->toArray(),
                'biographie' => $content->user->biographie,
                'faceboock' => $content->user->faceboock,
                'linkdin' => $content->user->linkdin,
                'instagram' => $content->user->instagram,
            ],
        ];
        });

        return $contentFiltered;

    }

    public function contentByProgramApi(String $programId){
        $program = Program::findOrFail($programId);
        $contents = Content::where('programId' , $program->id)->get();
        $contentFiltered = $contents->map(function($content) {
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'video' => $content->video,
                'title' => $content->title,
                'contentType' => $content->contentType,
                'quizType' => $content->quizType,
                'smallDescription' => $content->smallDescription,
                'bigDescription' => $content->bigDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'duration' => $content->duration,
                'categoryName' => $content->category->name,
                'tags' => $content->tags->pluck('name')->toArray(),
                'user' => [
                    'id' => $content->user->id,
                    'avatar' => $content->user->avatar,
                    'cover' => $content->user->cover,
                    'fullName' => $content->user->firstName . ' ' . $content->user->lastName,
                    'roles' => $content->user->roles->pluck('name')->toArray(),
                    'biographie' => $content->user->biographie,
                    'faceboock' => $content->user->faceboock,
                    'linkdin' => $content->user->linkdin,
                    'instagram' => $content->user->instagram,
                ],
            ];
        });

        return $contentFiltered;

    }

    


}