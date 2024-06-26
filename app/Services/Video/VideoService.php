<?php

namespace  App\Services\Video;

use App\Interfaces\VideoInterface;
use App\Services\Video\VideoQuery;

class VideoService extends VideoQuery implements VideoInterface {

    public function create($content){
        $content = $this->createVideo($content);
        $inviteUsers = $this->allInvites();
        $conferencerUsers = $this->allConferencers();
        return view('video.create')->with(['content' => $content['content'],
        'videos' => $content['videos'],'inviteUsers' => $inviteUsers ,
         'conferencerUsers' => $conferencerUsers]);
    }

    public function store($request){
        $video = $this->storeVideo($request);
        return redirect()->back()->with('status' , 'You have created video');
    }

    public function update($request , $id){
        $video = $this->updateVideo($request , $id);
        return redirect()->back()->with('status' , 'You Updated video');
    }

    public function destroy($request , $id){
        $video = $this->destroyVideo($request , $id);
        return redirect()->back()->with('status' , 'You have Delete Video');
    }

    public function delete($request , $id){
        $video = $this->deleteVideo($request , $id);
        return redirect()->back()->with('status' , 'You have Delete Video');
    }

    public function restore($videoId){
        $video = $this->restoreVideo($videoId);
        return redirect()->back()->with('status' , 'You have restore Video');
    }

    //api videos
    public function showVideo($video){
        $videos = $this->getVideoByContent($video);
        return response()->json($videos);
    }

    public function createView($video){
        $video = $this->createVideoView($video);
        return response()->json($video);
    }

    public function noteCreate($request , $videoId){
        $video = $this->createNote($request , $videoId);
        return response()->json($video);
    }

}