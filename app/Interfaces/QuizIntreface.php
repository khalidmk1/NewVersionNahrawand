<?php


namespace App\Interfaces;

interface QuizIntreface {
    public function create($id);
    public function storeContentQsm($request , $id);

    //api quiz
    public function qsmIndexContent($contentId);
}