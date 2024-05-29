<?php

namespace App\Services\Category;

use App\Interfaces\CategoryInterface;
use App\Services\Category\CtegoryQeury;


class CategoryService  extends CtegoryQeury implements CategoryInterface{

    public function index(){
        $domains = $this->allDomains();
        $categories =$this->allCategories();
        return view('filter.category.index')->with(['domains' => $domains , 
        'categories' => $categories]);
    }
    
    public function store($request){
        $category = $this->storeCategory($request);
        return redirect()->back()->with('status' , 'You Create Category');
    }

    public function update($request, $id){
        $category = $this->updateCategory($request , $id);
        return redirect()->back()->with('status' , 'You Update Category');
    }

    public function destroy($request , $id){
        $category = $this->deleteCategory($request ,$id);
        return redirect()->back()->with('status' , 'You Delete Category');
    }

   
}