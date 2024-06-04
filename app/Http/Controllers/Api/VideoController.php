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

    public function showVideo(String $content){
        return $this->videoInterface->showVideo($content);
    }

}
