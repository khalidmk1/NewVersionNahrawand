<?php

namespace App\Services\Objective;

use App\Models\Content;
use App\Models\Objective;
use App\Models\SubCategory;
use App\Models\UserObjective;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\DB;
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


    

 */

    public function allObjectives() {

        $userId = Auth::id();

        $objectives = UserObjective::where('userId', $userId)
            ->with('subCategory')
            ->get()
            ->filter(function ($objective) {
                return $objective->subCategory !== null;
            })
            ->groupBy('subCategory.id')
            ->map(function ($items) {
                $subCategory = $items->first()->subCategory;
                return [
                    'subCategory' => [
                        'id' => $subCategory->id,
                        'name' => $subCategory->name,
                        'objective' => $items->map(function ($item) {
                            return ['name' => $item->name];
                        })->toArray()
                    ]
                ];
            })->values(' ')->toArray(); // Convert to plain array

        return $objectives;
    }

    public function storeObjective(ObjectiveRequest $request ,String $contentId)
    {

        $content = Content::findOrFail($contentId);

        $createdObjective = UserObjective::create([
            'userId' => Auth::user()->id,
            'subCategoryId' => $request->subCategoryId,
            'contentId' => $content->id,
            'name' => $request->name,
            'date' => $request->date
        ]);
    
        return $createdObjective;
       
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