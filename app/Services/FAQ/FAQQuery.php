<?php

namespace App\Services\FAQ;

use App\Models\FAQ;
use App\Services\GlobaleService;
use App\Http\Requests\FAQRequest;
use Illuminate\Support\Facades\Crypt;

class FAQQuery extends GlobaleService{

    public function paginateFAQ(){
        $FAQs = FAQ::paginate(10);
        return $FAQs;
    }

    public function storeFAQ(FAQRequest $request){
        $FAQ = FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return $FAQ;
    }

    public function updateFAQ(FAQRequest $request , String $id){
        $FAQ = FAQ::findOrFail(Crypt::decrypt($id));

        $FAQ->update([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return $FAQ;
    }
}