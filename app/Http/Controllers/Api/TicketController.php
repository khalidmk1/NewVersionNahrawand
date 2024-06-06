<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\TicketInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{

    private $TicketInterface;

    public function __construct(TicketInterface $TicketInterface) {
        $this->TicketInterface = $TicketInterface;
    }

    public function create(TicketRequest $request){
       return  $this->TicketInterface->create($request); 
    }

    public function index(){
        return  $this->TicketInterface->index(); 
    }
}
