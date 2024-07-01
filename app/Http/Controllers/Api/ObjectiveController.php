<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ObjectiveInterface;
use App\Http\Requests\ObjectiveRequest;

class ObjectiveController extends Controller
{

    private $ObjectiveInterface;

    public function __construct(ObjectiveInterface $ObjectiveInterface) {
        $this->ObjectiveInterface = $ObjectiveInterface;
    }
    
    public function store(ObjectiveRequest $request , String $subCategoryId){
        return $this->ObjectiveInterface->store($request , $subCategoryId);
    }
}
