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
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
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

    public function updateQuiz(Request $request, string $id) {

        $quiz = Quiz::findOrFail(Crypt::decrypt($id));

        if($quiz->content->quizType == 0){
            $request->validate([
                'question' => ['required','string'],
                'answer' => ['required' , 'array' , 'min:1'],
                'answer.0' => ['required' , 'string'],
            ]);
        }else{
            $request->validate([
                'question' => ['required','string'],
            ]); 
        }

       

  
       
    
        $quiz->update([
            'question' => $request->question,
        ]);


       /*  $quizParameters = QuizPrameter::whereIn('contentId', $quiz->pluck('contentId'))->update([
            'rate' => $request->rate,
            'count' => $request->count,
        ]);
 */
        
    
       $quiz->answers()->forceDelete();
       $answersData = array_filter($request->input('answer', []), fn($answer) => !is_null($answer) && $answer !== '');
       foreach ($answersData as $answerText) {
            $quiz->answers()->create([
                'Answer' => $answerText,
            ]);
        }

    
        return $quiz;
    }


    public function destroyQuiz(DestroyRequest $request , String $id){
        
        $quiz = Quiz::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $quiz->delete();   
        }
        return $quiz;
    }

    public function deleteQuiz(String $id){

        $quiz = Quiz::findOrFail(Crypt::decrypt($id));
        $quiz->forceDelete();
        $parametere = QuizPrameter::where('quizId' , $quiz->id)->forceDelete();

        foreach ($quiz->answers as $key => $answer) {
            $answer->forceDelete();
        }

        return $quiz;
    }
    



    //api quiz
    public function qsmContentIndex(String $contentId){
        $content = Content::findOrFail($contentId);
        $qsmContent = Quiz::where('contentId', $content->id)->get();

        if($content->quizType == 0){
            $filteredQsmContent = $qsmContent->map(function ($qsm) {
                $answers = $qsm->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'answer' => $answer->Answer,
                    ];
                });
        
                $rightAnswerId = $qsm->quizParameter->first()->rightAnswer->id ?? null;
        
                return [
                    'question' => [
                        'id' => $qsm->id,
                        'question' => $qsm->question,
                    ],
                    'rightAnswer' => [
                        'id' => $rightAnswerId,
                    ],
                    'answers' => $answers->toArray()
                ];
            });
        
            return $filteredQsmContent;
        }
        if($content->quizType == 1){

            $filteredQsmContent = $qsmContent->map(function ($qsm) {
                return [
                    'question' => [
                        'id' => $qsm->id,
                        'question' => $qsm->question,
                    ],
                ];
            });
        
            return $filteredQsmContent;
        }

        return null;
    
       
    }

   /*  public function qsmContentQuestionIndex(String $contentId){
        $content = Content::findOrFail($contentId);
        $qsmContent = Quiz::where('contentId', $content->id)->get();
    
        $filteredQsmContent = $qsmContent->map(function ($qsm) {
            return [
                'question' => [
                    'id' => $qsm->id,
                    'question' => $qsm->question,
                ],
            ];
        });
    
        return $filteredQsmContent;
    } */


    public function storeQuestionClient(Request $request , String $contentId , String $quizId){

        $request->validate([
            'answer' => 'required|string',
        ]);


        $content = Content::findOrFail($contentId);
        $quiz = Quiz::findOrFail($quizId);

        $questionAnswerExists = QuizAnswerQuestion::where('quizId' , $quiz->id)->exists();

        if($questionAnswerExists){
            return false;
        }else{
            $question = QuizAnswerQuestion::create([
                'contentId' => $content->id,
                'userId' => Auth::user()->id,
                'quizId' => $quiz->id,
                'answer' => $request->answer
            ]);
            return $question;
        }

    }

    public function  storeNoteQuiz(Request $request , String $id){

        $note = QuizAnswerQuestion::findOrFail($id);
        $noteAnswer = $request->noteAnswer == 'on';
        $note->update([
            'confirmed' => $noteAnswer
        ]);

        return $note;
    }
    
    
    

}