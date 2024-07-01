<?php

namespace App\Services\Objective;

use App\Models\Content;
use App\Models\Objective;
use App\Models\SubCategory;
use App\Models\UserObjective;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ObjectiveRequest;



class ObjectiveQeury extends GlobaleService {

   /*  public function allSubCategory(){
        $subCategory = SubCategory::all();

        return $subCategory;
    }


    public function allObjectives(){
        $objectives = Objective::paginate(10);
        return $objectives;
    }

 */
    public function storeObjective(ObjectiveRequest $request ,String $contentId)
    {

        $content = Content::findOrFail($contentId);

        $createdObjective = UserObjective::create([
            'userId' => Auth::user()->id,
            'subCategoryId' => $request->categoryId,
            'contentId' => $content->id,
            'name' => $request->name,
            'date' => $request->date
        ]);
    
        return $createdObjectives;
       
    }

    public function updateObjective(ObjectiveRequest $request, String $id)
    {
        $objective = Objective::findOrFail(Crypt::decrypt($id));
        $subCategoryIds = array_map('intval', $request->subCategoryIds);

        foreach ($subCategoryIds as $subCategoryId) {
            $objective->subCategoryId = $subCategoryId;
            $objective->name = $request->name;
            $objective->save();
        }
        return $objective;
    }

    public function destroyObjective(DestroyRequest $request , String $id)
    {
        $objective = Objective::findOrFail(Crypt::decrypt($id));

        if (Hash::check($request->password, Auth::user()->password)) {
            $objective->delete();
        }
        return $objective;
    }

}