<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\SubCategoryInterface;

class SubCategoryController extends Controller
{

    private $SubCategoryInterface;

    public function __construct(SubCategoryInterface $SubCategoryInterface) {
        $this->SubCategoryInterface = $SubCategoryInterface;
    }

    
    public function subCategoryByDomain(){
        return $this->SubCategoryInterface->subCategoryByDomain();
    }
}
