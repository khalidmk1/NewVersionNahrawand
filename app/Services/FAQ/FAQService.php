<?php

namespace App\Services\FAQ;

use App\Services\FAQ\FAQQuery;
use App\Interfaces\FAQInterface;

class FAQService extends FAQQuery implements FAQInterface {

    public function index(){
        $FAQs = $this->paginateFAQ();
        return view('FAQ.index')->with('FAQs' , $FAQs);
    }

    public function store($request){
        $FAQ = $this->storeFAQ($request);
        return redirect()->back()->with('status' , 'You have Created FAQ');
    }

    public function update($request , $id){
        $FAQ = $this->updateFAQ($request , $id);
        return redirect()->back()->with('status' , 'You have Updated FAQ');
    }

    //api FAQ
    public function FAQIndex(){
        $FAQs = $this->indexFAQ();
        return response()->json($FAQs);
    }
}