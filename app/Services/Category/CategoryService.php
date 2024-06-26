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
        return $category;
    }

    public function update($request, $id){
        $category = $this->updateCategory($request , $id);
        return $category;
    }

    public function destroy($request , $id){
        $category = $this->deleteCategory($request ,$id);
        return $category;
    }

   
}