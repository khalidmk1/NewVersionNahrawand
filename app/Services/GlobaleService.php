<?php

namespace App\Services;


use App\Models\User;
use App\Models\Event;
use App\Models\Content;
use App\Models\Program;
use App\Models\Category;
use App\Models\Objective;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\ContentVideo;
use Illuminate\Http\Request;
use App\Models\ProgramCategory;
use Spatie\Permission\Models\Role;
use App\Http\Requests\EventRequest;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\ContentVideoRequest;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Notifications\DatabaseNotification;


class GlobaleService  {

    /**
     * Extract YouTube video ID from URL.
     *
     * @param string $url
     * @return string|null
     */
    public function extractYoutubeId($url): ?string
    {
        $queryParameters = parse_url($url, PHP_URL_QUERY);
        if (!$queryParameters) {
            $path = parse_url($url, PHP_URL_PATH);
            $pathComponents = explode('/', $path);
            $videoId = end($pathComponents);

            if ($videoId) {
                return 'https://www.youtube.com/embed/' . $videoId;
            }
            
            return null;
        }
        parse_str($queryParameters, $queryParamsArray);
        return isset($queryParamsArray['v']) ? 'https://www.youtube.com/embed/' . $queryParamsArray['v'] : null;
    }

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

    
    //notification
    function notifyUsersWithPermission($permission, $contentId, $contentTitle, $message, $contentType) {
        $users = User::permission($permission)->get();
        
        $clients = User::whereHas('roles', function($query) {
            $query->where('name', 'Client');
        })->get();

        if ($permission == 'Creation Contenu'){
            foreach ($clients as $client) {
                $client->notify(new UserNotification($contentId, $contentTitle, $message, $contentType));
            }
        }
        
        foreach ($users as $user) {
            $user->notify(new UserNotification($contentId, $contentTitle, $message, $contentType));
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
        $subCategories = SubCategory::all('id' , 'name');
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
        $speakersRole = ['Modérateur', 'Animateur' , 'Invité' , 'Conférencier' , 'Formateur'];
        $role = Role::whereIn('name' , $speakersRole)->get();
        $speakers = User::role($role) 
        ->whereNull('deleted_at')
        ->get();

        return $speakers;
    }

    public function historyDeleted() {
        $contents = Content::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $videos = ContentVideo::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $categories = Category::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $subCategories = SubCategory::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $programs = Program::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $events = Event::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    
        return [
            'contents' => $contents, 'videos' => $videos, 'categories' => $categories, 'subCategories' => $subCategories,
            'programs' => $programs,'events' => $events,'users' => $users
        ];
    }


    public function restoreUser(String $userId){
        $user = User::withTrashed()->findOrFail(Crypt::decrypt($userId));
        $user->restore();
        return $user;
    }


    //restore 
    public function restoreContent(String $contentId){
        $content = Content::withTrashed()->findOrFail(Crypt::decrypt($contentId));
        $content->restore();
        return $content;
    }

    public function restoreVideo(String $videoId){
        $video = ContentVideo::withTrashed()->findOrFail(Crypt::decrypt($videoId));
        $video->restore();
        return $video;
    }

    public function restoreEvent(String $eventId){
        $event = Event::withTrashed()->findOrFail(Crypt::decrypt($eventId));
        $event->restore();
        return $event;
    }

    public function restoreCategory(String $categoryId){
        $category = Category::withTrashed()->findOrFail(Crypt::decrypt($categoryId));
        $programCategory = ProgramCategory::where('categoryId' , $category->id)->restore();
        $category->restore();
        return $category;
    }

    public function restoreSubCategory(String $subCategoryId){
        $subCategory = SubCategory::withTrashed()->findOrFail(Crypt::decrypt($subCategoryId));
        $subCategory->restore();
        return $subCategory;
    }

    public function restoreProgram(String $programId){
        $program = Program::withTrashed()->findOrFail(Crypt::decrypt($programId));
        $program->restore();
        return $program;
    }

    //all api cotent Query


    public function allComingContentApi()
    {
        $contents = Content::where('isComing', 1)
                ->with('category', 'tags')
                ->get(['id', 'title', 'smallDescription', 'image', 'created_at', 'duration']);

        $videos = ContentVideo::where('isComing', 1)
                    ->get(['image']);

        return ['contents' => $contents,'videos' => $videos];
    }

    public function formationContentApi()
    {
        $contents = Content::where('contentType', 'formation')
            ->where('isComing', 0)
            ->paginate(3, ['id', 'image', 'quizType', 'imageFlex', 'title', 'bigDescription' ,'smallDescription' ,'categoryId', 'hostId', 'document', 'created_at']);
    
        // Load relationships
        $contents->load('user', 'category', 'tags');
    
        // Format contents
        $formattedContents = $contents->getCollection()->map(function ($content) {
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'title' => $content->title,
                'quizType' => $content->quizType,
                'bigDescription' => $content->bigDescription,
                'smallDescription' => $content->smallDescription,
                'condition' => $content->condition,
                'document' => $content->document,
                'categoryName' => $content->category->name,
                'tags' => $content->tags->pluck('name')->toArray(),
                'created_at' => $content->created_at,
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
    
        // Manually build pagination links
        $links = collect([
            'previous' => $contents->previousPageUrl(),
            'next' => $contents->nextPageUrl(),
            'current' => $contents->url($contents->currentPage()),
            'first' => $contents->url(1),
            'last' => $contents->url($contents->lastPage())
        ]);
    
        return response()->json([
            'current_page' => $contents->currentPage(),
            'data' => $formattedContents,
            'first_page_url' => $links['first'],
            'from' => $contents->firstItem(),
            'last_page' => $contents->lastPage(),
            'last_page_url' => $links['last'],
            'links' => $links,
            'next_page_url' => $links['next'],
            'path' => $contents->path(),
            'per_page' => $contents->perPage(),
            'prev_page_url' => $links['previous'],
            'to' => $contents->lastItem(),
            'total' => $contents->total(),
        ]);
    }
    



    public function podcastContentApi(){
        $contents = Content::where('contentType', 'podcast')->where('isComing' , 0)
        ->get(['id', 'video' ,'image', 'imageFlex', 'title', 'smallDescription', 'bigDescription' ,'categoryId', 'hostId']);
        $contents->load('user', 'category');

        $formattedContents = $contents->map(function ($content) {
            return [
                'id' => $content->id,
                'video' => $content->video,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'title' => $content->title,
                'smallDescription' => $content->smallDescription,
                'bigDescription' => $content->bigDescription,
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

        return $formattedContents;

    }


    public function quicklyContentApi(){
        $contents = Content::where('contentType', 'quickly')->where('isComing' , 0)
        ->with('tags')
        ->get();
        $contents->load('user', 'category');

        $formattedContents = $contents->map(function ($content) {
            return [
                'id' => $content->id,
                'image' => $content->image,
                'imageFlex' => $content->imageFlex,
                'title' => $content->title,
                'video' => $content->video,
                'smallDescription' => $content->smallDescription,
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

        return $formattedContents;

    }


    public function allContentApi(){
        $contentType = ['conference' , 'podcast' , 'formation']; 
        $contents = Content::whereIn('contentType' , $contentType)->with(['user' , 'tags'])->get();
        $contentQuicly = Content::where('contentType' , 'quickly')->get(); 
        return ['contents'=>$contents , 'contentQuicly' => $contentQuicly];
    }

    //files api

    public function storeFileTicket(TicketRequest $request){
        if ($request->has('file')) {
            $avatarData = $request->file;
        
            $avatarData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $avatarData);
        
            $ticketImage = base64_decode($avatarData);
        
            $fileName = 'avatar_' . Str::uuid() . '.png';
        
            Storage::disk('public')->put('ticket/' . $fileName, $ticketImage);

           return $fileName;
        }
    }

    public function CreatenotifyApi($element){
        return response()->json($element);
    }

}