<?php

namespace App\Services\Objective;

use App\Interfaces\ObjectiveInterface;
use App\Services\Objective\ObjectiveQeury;

class ObjectiveService extends ObjectiveQeury implements ObjectiveInterface {

    public function index(){
        $objectives = $this->allObjectives();
        return response()->make(json_encode($objectives), 200, ['Content-Type' => 'application/json']);
    }

    public function store($request ,  $contentId){
        $objective = $this->storeObjective($request , $contentId);
        return response()->json( 'You Created Objective');
    }

    public function update($request, $id)
    {
        $objective = $this->updateObjective($request , $id);
        return redirect()->back()->with('status' , 'You have Updated Objective');
    }

    public function destroy($request, $id){
        $objective = $this->destroyObjective($request , $id);
        return redirect()->back()->with('status' , 'you have delete objective');
    }

}