<?php

namespace App\Services\SubCategory;

use App\Models\Domain;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\UserSubcategory;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\SubCategoryRequest;


class SubCategoryQuery extends GlobaleService {
    
    public function allCategory(){
        $categories = Category::all();

        return $categories;
    }

    public function allSubCategory(){
        $subCategory = SubCategory::paginate(10);

        return $subCategory;
    }

    public function storeSuCategory(SubCategoryRequest $request){
        $validatedData = $request->validated();

        $existingSubCategory = SubCategory::where('name', $request->name)->first();

        if($existingSubCategory){
            return redirect()->back()->with('faild' , ' The name has already been taken.');
        }

        $subCategory = SubCategory::create([
            'categoryId' => $request->categoryId,
            'name' => $request->name
        ]);

        return redirect()->back()->with('status' , 'You Created SubCategory');
    }

    public function updateSubCategory(SubCategoryRequest $request , String $id){

        $subCategory = SubCategory::findOrFail(Crypt::decrypt($id));
        $validatedData = $request->validated();

        
        $existingSubCategory = SubCategory::where('name', $request->name)
        ->where('id', '!=', $subCategory->id)
        ->first();

        if($existingSubCategory){
            return redirect()->back()->with('faild' , ' The name has already been taken.');
        }

        $subCategory->categoryId = $request->categoryId;
        $subCategory->name = $request->name;

        $subCategory->save();

        return redirect()->back()->with('status' , 'You Updated SubCategory');
    }

    public function destroySubCategory(Request $request , String $id){

        $subCategory = SubCategory::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required' ,  'current_password']
        ]);

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $subCategory->delete();
        }
        return $subCategory;

    }


    //api subCategory
    public function subCategoryByDomainApi(){
        $domains = Domain::with('category.subcategory')->get();
        $subCategoryData = $domains->map(function($domain) {
            return [
                'domain' => $domain->name,
                'subcategories' => $domain->category->flatMap(function($category) {
                    return $category->subcategory->map(function($subCategory) {
                        return [
                            'id' => $subCategory->id,
                            'name' => $subCategory->name,
                        ];
                    });
                }),
            ];
        });
    
            return $subCategoryData;
        }

    
}