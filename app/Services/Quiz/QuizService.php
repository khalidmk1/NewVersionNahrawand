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

    public function update($request, $id){
        $quiz = $this->updateQuiz($request , $id);
        return redirect()->back()->with('status', 'You have updated quiz');
    }

    public function destroy($request , $id){
        $quiz = $this->destroyQuiz( $request ,  $id);
        return redirect()->back()->with('status', 'You have deleted quiz');
    }

    public function delete($id){
        $quiz = $this->deleteQuiz($id);
        return redirect()->back()->with('status', 'You have deleted quiz');
    }

    public function storeNote($request , $id){
        $note = $this->storeNoteQuiz($request , $id);
        return response()->json($note);
    }


    //api quiz
    public function qsmIndexContent($contentId){
        $qsmContents = $this->qsmContentIndex($contentId);
        return response()->json($qsmContents);
    }
    
  /*   public function qsmIndexContentQuestion($contentId){
        $qsmContents = $this->qsmContentQuestionIndex($contentId);
        return response()->json($qsmContents);
    } */

    public function storeQuestionAnswer($request , $contentId , $quizId){
        $answer = $this->storeQuestionClient($request , $contentId , $quizId);
        return response()->json($answer);
    }



}