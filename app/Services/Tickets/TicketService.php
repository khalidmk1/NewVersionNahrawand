<?php

namespace App\Services\Tickets;

use App\Interfaces\TicketInterface;
use App\Services\Tickets\TicketQuery;

class TicketService extends TicketQuery implements TicketInterface {

    public function index(){
        $tickets = $this->ticketIndex();
        return view('tickets.index')->with('tickets' , $tickets);
    }

    public function edite($id){
        $ticket =  $this->editeTicket($id);
        return view('tickets.edite')->with('ticket' , $ticket);
    }

    //api tickets
    public function create($request){
        $ticket = $this->CreateTicket($request);
        return response()->json($ticket);
    }

    public function indexApi(){
        $tickets = $this->ticketIndexApi();
        return response()->json($tickets);
    }
}