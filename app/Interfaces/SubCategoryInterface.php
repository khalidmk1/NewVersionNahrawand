<?php

namespace App\Interfaces;

use App\Http\Requests\SubCategoryRequest;

interface SubCategoryInterface {

    public function index();
    public function store($request);
    public function update($request , $id);
    public function destroy($request , $id);
    public function restore($subCategoryId);

    //api subCategory
    public function subCategoryByDomain();
    public function subCategoryApi();

}