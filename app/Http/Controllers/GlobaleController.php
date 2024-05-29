<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\VideoInterface;
use App\Interfaces\ContentInterface;
use App\Interfaces\ProfileInterface;
use App\Http\Requests\DestroyRequest;

class GlobaleController extends Controller
{
    private $ContentInterface;
    private $ProfileInterface;

    public function __construct(ContentInterface $ContentInterface , ProfileInterface $ProfileInterface , VideoInterface $videoInterface) {
        $this->ContentInterface = $ContentInterface;
        $this->ProfileInterface = $ProfileInterface;
        $this->videoInterface = $videoInterface;
    }
    
    public function objectivesByCategory(String $id)
    {
        return $this->ContentInterface->objectivesByCategory($id);
    }

    public function indexAdmin(){
        return $this->ProfileInterface->indexAdmin();
    }

    
    public function indexManager(){
        return $this->ProfileInterface->indexManager();
    }

    public function indexSpeaker(){
        return $this->ProfileInterface->indexSpeaker();
    }

    public function createAdmin(){
        return $this->ProfileInterface->createAdmin();
    }

    public function createManager(){
        return $this->ProfileInterface->createManager();
    }

    public function createSpeaker(){
        return $this->ProfileInterface->createSpeaker();
    }


    public function deletevideo(DestroyRequest $request , String $id){
        return $this->videoInterface->delete($request , $id);
    }
}
