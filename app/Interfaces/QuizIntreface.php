<?php


namespace App\Interfaces;

interface QuizIntreface {
    public function create($id);
    public function storeContentQsm($request , $id);
    public function storeNote($request , $id);
    public function update($request, $id);
    public function destroy($request , $id);
    public function delete($id);
    
    //api quiz
    public function qsmIndexContent($contentId);
    /* public function qsmIndexContentQuestion($contentId); */
    public function storeQuestionAnswer($request , $contentId , $quizId);
}