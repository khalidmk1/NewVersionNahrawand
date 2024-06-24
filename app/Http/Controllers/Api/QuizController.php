<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\QuizIntreface;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{

    private $QuizInterface;

    public function __construct(QuizIntreface $QuizInterface) {
        $this->QuizInterface = $QuizInterface;
    }


    public function qsmIndexContent(String $contentId){
        return  $this->QuizInterface->qsmIndexContent($contentId);
    }
}
