<?php

namespace App\Services\Tickets;

use App\Interfaces\TicketInterface;
use App\Services\Tickets\TicketQuery;

class TicketService extends TicketQuery implements TicketInterface {

    public function index(){
        $tickets = $this->ticketIndex();
        return view('tickets.index')->with('tickets' , $tickets);
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