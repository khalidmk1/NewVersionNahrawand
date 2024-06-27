<?php

namespace App\Interfaces;

interface VideoInterface {
    public function create($content);
    public function store($request);
    public function update($request , $id);
    public function destroy($request , $id);
    public function delete($request , $id);
    public function restore($videoId);

    //api videos
    public function showVideo($video);
    public function createView($video);
    public function noteCreate($request , $videoId);
}