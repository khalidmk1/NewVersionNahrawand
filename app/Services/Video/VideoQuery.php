<?php

namespace  App\Services\Video;

use Spatie\Tags\Tag;
use App\Models\Content;
use App\Models\VideoNote;
use App\Models\VideoView;
use App\Models\VideoGuest;
use App\Models\ContentVideo;
use Illuminate\Http\Request;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\ContentVideoRequest;

class VideoQuery extends GlobaleService{


    public function createVideo(String $content){
        $content = Content::findOrFail(Crypt::decrypt($content));
        $videos = ContentVideo::where('contentId' , $content->id)->get();
        return ['content' => $content , 'videos' => $videos];
    }


    public function storeVideo(ContentVideoRequest $request){

        $fileNameImage  = $this->storeVideoImage($request);
        $isComing = $request->isComing == 'on';
        $videoUrl = $this->extractYoutubeId($request->video);
        $video = ContentVideo::create([
            'contentId' => $request->podcastId,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileNameImage,
            'video' => $videoUrl,
            'isComing' => $isComing,
            'duration' => $request->duration
        ]);

        if($request->has('guestIds')){
            foreach ($request->guestIds as $key => $guestId) {
                $VideoGuest = VideoGuest::create([
                    'VideoId' => $video->id,
                    'userId' => (int) $guestId
                ]);
            }
        }

       

        if ($request->has('tags') && $request->tags[0] !== null) {

            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $video->syncTags($arrTags, 'video');
        }

        


        return $video;
    }

    public function updateVideo(VideoUpdateRequest $request , String $id){
        $video = ContentVideo::findOrFail(Crypt::decrypt($id));
        $isComing = $request->isComing == 'on';
        $imageName =  $video->image ?? '' ;
        $fileNameImage  = $this->updateVideoImage($request ,$imageName);
        $videoUrl = $this->extractYoutubeId($request->video);

        $video->update([
            'title' => $request->title,
            'description' => $request->description, 
            'image' => $fileNameImage,
            'video' => $videoUrl,
            'isComing' => $isComing,
            'isUpdated' => true,
            'duration' => $request->duration
        ]);


        $video->videoguest()->delete();
        if($request->has('guestIds')){
            foreach ($request->guestIds as $key => $guestId) {
                $VideoGuest = VideoGuest::create([
                    'VideoId' => $video->id,
                    'userId' => (int) $guestId
                ]);
            }
        }

        
        if ($request->has('tags') && $request->tags[0] !== null) {
            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $video->syncTags($arrTags, 'video');
        }

        return $video;
    }




    public function destroyVideo(DestroyRequest $request , String $id){
        $video = ContentVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $video->Delete();
        
            $video->content->update([
                'isDelete' => true,
            ]);

        }
        return $video;
    }

    public function deleteVideo(DestroyRequest $request , String $id){
        $video = ContentVideo::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $video->forceDelete();
            $imagePath = 'video/'.$video->image;
            Storage::disk('public')->delete($imagePath);

        }
        return $video;
    }

    //api video

    public function getVideoByContent(String $video){
        $videos = ContentVideo::where('contentId' , $video)
        ->where('isComing' , 0)
        ->get(['id' ,'title' , 'video' , 'image' , 'description']);
        $formattedVideos = $videos->map(function ($video) {
            $users = $video->videoguest->map(function($guest){
                return [
                    'image' => $guest->user->avatar,
                ];
            });
            return [
                'id' => $video->id,
                'image' =>$video->image,
                'title' => $video->title,
                'video' => $video->video,
                'description' => $video->description,
                'tags' => $video->tags->pluck('name')->toArray(), 
                'users' => $users
            ];
        });

        return $formattedVideos;
    }

    public function createVideoView(String $video){
        $video = ContentVideo::findOrFail($video);

        $viewExists = VideoView::where('videoId', $video->id)
        ->where('userId', Auth::user()->id)
        ->exists();

        if(!$viewExists){
            $view = VideoView::create([
                'videoId' => $video->id,
                'userId' => Auth::user()->id,
            ]);
    
            return $view;
        }
        
        return $viewExists;
    }

    public function createNote(Request $request , String $videoId){
        $video = ContentVideo::findOrFail($videoId);

        $note = VideoNote::create([
            'videoId' => $video->id,
            'userId' => Auth::user()->id,
            'note' => $request->note
        ]);

        return $note;
    }

}