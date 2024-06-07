<?php

namespace App\Services\SubCategory;


use Illuminate\Http\Request;
use App\Interfaces\SubCategoryInterface;
use App\Http\Requests\SubCategoryRequest;
use App\Services\SubCategory\SubCategoryQuery;




class SubCategoryService extends SubCategoryQuery implements SubCategoryInterface {

    public function index(){
        $categories = $this->allCategory();
        $subCategories = $this->allSubCategory();
        return view('filter.subcategory.index')->with(['categories' => $categories , 
        'subCategories' => $subCategories]);
    }

    public function update($request , $id){
        $subcategory = $this->updateSubCategory($request , $id);
        return redirect()->back()->with('status' , 'You Updated SubCategory');
    }

    public function store($request){
        $subcategory = $this->storeSuCategory($request);
        return redirect()->back()->with('status' , 'You Created SubCategory');
    }

    public function destroy($request , $id){
        $subcategory = $this->destroySubCategory($request , $id);

        return redirect()->back()->with('status' , 'You Delete SubCategory');
    }


    //api subCategory
    public function subCategoryByDomain(){
        $subcategories = $this->subCategoryByDomainApi();
        return response()->json($subcategories);
    }

    public function allSubctegory(){
        $subCategories = $this->allUserSubcatagoryApi();
        return response()->json($subCategories);
    }
}