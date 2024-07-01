<?php

namespace App\Services\Objective;

use App\Interfaces\ObjectiveInterface;
use App\Services\Objective\ObjectiveQeury;

class ObjectiveService extends ObjectiveQeury implements ObjectiveInterface {

    public function index(){
        $subCategories = $this->allSubCategory();
        $objectives = $this->allObjectives();
        return view('filter.objective.index')->with(['subCategories' => $subCategories , 
        'objectives' => $objectives]);
    }

    public function store($request , $subCategoryId , $contentId){
        $objective = $this->storeObjective($request , $subCategoryId , $contentId);
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