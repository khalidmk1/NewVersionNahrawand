<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\VideoInterface;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    private $videoInterface;

    public function __construct(VideoInterface $videoInterface) {
        $this->videoInterface = $videoInterface;
    }

    public function showVideo(String $video){
        return $this->videoInterface->showVideo($video);
    }

    public function createView(String $video){
        return $this->videoInterface->createView($video);
    }

}
