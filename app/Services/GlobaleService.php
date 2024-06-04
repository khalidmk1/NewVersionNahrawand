<?php

namespace App\Services;


use App\Models\User;
use App\Models\Content;
use App\Models\Program;
use App\Models\Category;
use App\Models\Objective;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\ContentVideoRequest;
use Intervention\Image\ImageManagerStatic as Image;

class GlobaleService  {



    public function storeAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $directory = '/avatars';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName, 'public');
            return $fileName;
        }else{
            return null;
        }

    }

    public function storeCover(Request $request){
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $directory = '/cover';
            $fileNameCover = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameCover, 'public');
            return $fileNameCover;
        }else{
            return null;
        }
    }
    public function storeConteImage(Request $request){
        if ($request->hasFile('contentImage')) {
            $file = $request->file('contentImage');
            $directory = '/content';
            $fileNameConetentImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentImage, 'public');
            return $fileNameConetentImage;
        }else{
            return null;
        }
    }
    public function updateConteImage(Request $request , String $imageContent){
        if ($request->hasFile('contentImage')) {
            $imagePath = 'content/'.$imageContent;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('contentImage');
            $directory = '/content';
            $fileNameConetentImage = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentImage, 'public');
            return $fileNameConetentImage;
        }else{
            return $imageContent;
        }
    }

    public function storeConteImageFlex(Request $request){
        if ($request->hasFile('contentImageFlex')) {
            $file = $request->file('contentImageFlex');
            $directory = '/flex';
            $fileNameConetentImageFlex = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentImageFlex, 'public');
            return $fileNameConetentImageFlex;
        }else{
            return null;
        }
    }
    public function updateConteImageFlex(Request $request ,String $nameFlexImage){

        if ($request->hasFile('contentImageFlex')) {
            $imagePath = 'flex/'.$nameFlexImage;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('contentImageFlex');
            $directory = '/flex';
            $fileNameConetentImageFlex = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentImageFlex, 'public');
            return $fileNameConetentImageFlex;
        }else{
            return $nameFlexImage;
        }
    }
    public function storeConteDocument(Request $request){
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $directory = '/document';
            $fileNameConetentDocument = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentDocument, 'public');
            return $fileNameConetentDocument;
        }else{
            return null;
        }
    }
    public function updateConteDocument(Request $request , String $contentDocument){
        if ($request->hasFile('document')) {
            $imagePath = 'document/'.$contentDocument;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('document');
            $directory = '/document';
            $fileNameConetentDocument = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameConetentDocument, 'public');
            return $fileNameConetentDocument;
        }else{
            return $contentDocument;
        }
    }

    public function storeVideoImage(ContentVideoRequest $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/video';
            $fileNameVideo = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameVideo, 'public');
            return $fileNameVideo;
        }else{
            return null;
        }
    }

    public function updateVideoImage(VideoUpdateRequest $request , String $videoImage){
        if ($request->hasFile('image')) {
            $imagePath = 'video/'.$videoImage;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('image');
            $directory = '/video';
            $fileNameVideo = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameVideo, 'public');
            return $fileNameVideo;
        }else{
            return $videoImage;
        }
    }

    public function storeEventImage(EventRequest $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = '/event';
            $fileNameEvent = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameEvent, 'public');
            return $fileNameEvent;
        }else{
            return null;
        }
    }


    public function updateEventImage(EventUpdateRequest $request , String $eventImage){
        if ($request->hasFile('image')) {

            $imagePath = 'event/'.$eventImage;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('image');
            $directory = '/event';
            $fileNameEvent = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileNameEvent, 'public');
            return $fileNameEvent;
        }else{
            return $eventImage;
        }
    }

    public function chercheObejectiveByCategory(String $id){
        $category = Category::with('subcategory.objectives')->findOrFail($id);
        $objectvesByCategory = $category->subcategory->flatMap->objectives;
        return $objectvesByCategory;
    }

    public function allPrograms()
    {
        $programs = Program::all();
        return $programs;
    }

    public function allObjectives(){
        $objectives = Objective::all();
        return $objectives;
    }

    public function allSubCategories(){
        $subCategories = SubCategory::all();
        return $subCategories;
    }

    public function allModerators(){
        $role = Role::where('name', 'Modérateur')->first();
        $moderatoreUsers = User::role($role)->get();
        return $moderatoreUsers;
    }

    public function allCategories(){
        $categories = Category::all();
        return $categories;
    }

    public function allAnimators(){
        $role = Role::where('name', 'Animateur')->first();
        $animatorUsers = User::role($role)->get();
        return $animatorUsers;
    }

    public function allFormateur(){
        $role = Role::where('name', 'Formateur')->first();
        $formateurUsers = User::role($role)->get();
        return $formateurUsers;
    }

    public function allInvites(){
        $role = Role::where('name', 'Invité')->first();
        $inviteUsers = User::role($role)->get();
        return $inviteUsers;
    }

    public function allConferencers(){
        $role = Role::where('name', 'Conférencier')->first();
        $conferencerUsers = User::role($role)->get();
        return $conferencerUsers;
    }

    

    public function allSpeakers(){
        $speakersRole = ['Animateur' , 'Invité' , 'Conférencier' , 'Formateur'];
        $role = Role::whereIn('name' , $speakersRole)->get();
        $speakers = User::role($role) 
        ->whereNull('deleted_at')
        ->get();

        return $speakers;
    }

    //all api cotent Query

    public function allComingContentApi()
    {
        $contents = Content::where('isComing', 1)
        ->with('category', 'tags')
        ->get(['id', 'title', 'smallDescription', 'image', 'created_at', 'duration']);

        return $contents;
    }

    public function formationContentApi()
    {
        $contents = Content::where('contentType', 'formation')
            ->get(['id', 'image', 'imageFlex', 'title', 'smallDescription', 'categoryId', 'hostId']);

        $contents->load('user', 'category');
        $formattedContents = $contents->map(function ($content) {
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'title' => $content->title,
                'quizType' => $content->quizType,
                'smallDescription' => $content->smallDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'categoryName' => $content->category->name,
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

        return $formattedContents;
    }


    public function allContentApi(){
        $contents = Content::all(['id' , 'image' , 'title']);
        return $contents;
    }

}