<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\VideoInterface;
use App\Interfaces\TicketInterface;
use App\Interfaces\ContentInterface;
use App\Interfaces\ProfileInterface;
use App\Http\Requests\DestroyRequest;

class GlobaleController extends Controller
{
    private $ContentInterface;
    private $ProfileInterface;
    private $videoInterface;
    private $TicketInterface;

    public function __construct(ContentInterface $ContentInterface , ProfileInterface $ProfileInterface , 
    VideoInterface $videoInterface , TicketInterface $TicketInterface) {
        $this->ContentInterface = $ContentInterface;
        $this->ProfileInterface = $ProfileInterface;
        $this->videoInterface = $videoInterface;
        $this->TicketInterface = $TicketInterface;
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

    public function indexClient(){
        return $this->ProfileInterface->indexClient();
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

    public function quicklyIndex(){
        return $this->ContentInterface->quicklyIndex();
    }

    public function history(){
        return $this->ContentInterface->history();
    }

    public function createComment(Request $request ,String $id){
        return  $this->TicketInterface->createComment($request , $id); 
    }


    public function deletevideo(DestroyRequest $request , String $id){
        return $this->videoInterface->delete($request , $id);
    }
}
