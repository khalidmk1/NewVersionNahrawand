<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\Content;
use App\Models\QuizAnswer;
use App\Models\QuizPrameter;
use Illuminate\Http\Request;
use App\Services\GlobaleService;
use App\Http\Requests\QuizRequest;
use App\Models\QuizAnswerQuestion;
use Illuminate\Support\Facades\Auth;
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

            $content->update([
                'quizType' => false
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

            foreach ($request->question as $key => $question) {
                $question = Quiz::create([
                    'contentId' => $content->id,
                    'question' => $question,
                ]);
    
                $content->update([
                    'quizType' => true
                ]);
            }

            return $question;
        }
    }



    //api quiz
    public function qsmContentIndex(String $contentId){
        $content = Content::findOrFail($contentId);
        $qsmContent = Quiz::where('contentId', $content->id)->get();
    
        $filteredQsmContent = $qsmContent->map(function ($qsm) {
            $answers = $qsm->answers->map(function ($answer) {
                return [
                    'id' => $answer->id,
                    'answer' => $answer->Answer,
                ];
            });
    
            $rightAnswerId = $qsm->quizParameter->first()->rightAnswer->id ?? null;
    
            return [
                'question' => $qsm->question,
                'rightAnswer' => [
                    'id' => $rightAnswerId,
                ],
                'answers' => $answers->toArray()
            ];
        });
    
        return $filteredQsmContent;
    }


    public function storeQuestionClient(Request $request , String $contentId , String $quizId){
        $content = Content::findOrFail($contentId);
        $quiz = Quiz::findOrFail($quizId);

        $question = QuizAnswerQuestion::create([
            'contentId' => $content->id,
            'userId' => Auth::user()->id,
            'quizId' => $quiz->id,
            'answer' => $request->answer
        ]);

        return $question;
    }
    
    
    

}