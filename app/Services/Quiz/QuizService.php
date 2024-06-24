<?php

namespace App\Services\Quiz;

use App\Services\Quiz\QuizQuery;
use App\Interfaces\QuizIntreface;

class QuizService extends QuizQuery implements QuizIntreface {

    public function create($id){
        $content =  $this->createQsmContent($id);
        return view('quiz.content.create')->with('content' , $content);
    }

    public function storeContentQsm($request , $id) {
        $qsm = $this->storeQsmContent($request , $id);
        return redirect()->back()->with('status' , 'You Have created Qsm');
    }


    //api quiz
    public function qsmIndexContent($contentId){
        $qsmContents = $this->qsmContentIndex($contentId);
        return response()->json($qsmContents);
    }



}