<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\Content;
use App\Models\QuizAnswer;
use App\Models\QuizPrameter;
use Illuminate\Http\Request;
use App\Services\GlobaleService;
use App\Http\Requests\QuizRequest;
use Illuminate\Support\Facades\Crypt;

class QuizQuery extends GlobaleService{

    public function createQsmContent(String $id){
        $content = Content::findOrFail(Crypt::decrypt($id));
        return $content;
    }

    public function storeQsmContent(QuizRequest $request , String $id){
        $content = Content::findOrFail(Crypt::decrypt($id));
        if($request->has('Qsm')){
            $qsm = Quiz::create([
                'contentId' => $content->id,
                'question' => $request->question,
            ]);

            $correctAnswer = QuizAnswer::create([
                'quizId' => $qsm->id,
                'Answer' => $request->rightAwnser,
            ]);

            foreach ($request->awnser as $key => $answer) {
                $answer = QuizAnswer::create([
                    'quizId' => $qsm->id,
                    'Answer' => $answer,
                ]); 
            }

            $qsmParameter = QuizPrameter::create([
                'contentId' => $content->id,
                'quizId'=> $qsm->id,
                'answerId' => $correctAnswer->id,
                'rate' => $request->rate,
                'count' => $request->count
            ]);

            return $qsm;
        }else{

            
        }
    }



    //api quiz

    public function qsmContentIndex(String $contentId){
        $content = Content::findOrFail($contentId);
        $qsmContent = Quiz::where('contentId', $content->id)->get();
    
        $filteredQsmContent = $qsmContent->map(function ($qsm) {
            // Retrieve all answers for the current quiz question
            $answers = $qsm->answers->pluck('Answer')->toArray();
    
            // Retrieve the correct answer from QuizParameter if it exists
            $rightAnswer = $qsm->quizParameter->first()->rightAnswer->Answer ?? null;
    
            return [
                'question' => $qsm->question,
                'rightAnswer' => $rightAnswer,
                'answers' => $answers
            ];
        });
    
        return $filteredQsmContent;
    }
    
    

}