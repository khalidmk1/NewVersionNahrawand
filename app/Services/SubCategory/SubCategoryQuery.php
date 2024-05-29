<?php

namespace App\Services\SubCategory;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\SubCategoryRequest;


class SubCategoryQuery {
    
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

        $subCategory = SubCategory::create([
            'categoryId' => $request->categoryId,
            'name' => $request->name
        ]);

        return $subCategory;
    }

    public function updateSubCategory(SubCategoryRequest $request , String $id){

        $subCategory = SubCategory::findOrFail(Crypt::decrypt($id));
        $validatedData = $request->validated();

        $subCategory->categoryId = $request->categoryId;
        $subCategory->name = $request->name;

        $subCategory->save();
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
}