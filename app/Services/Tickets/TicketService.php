<?php

namespace App\Services\Tickets;

use App\Interfaces\TicketInterface;
use App\Services\Tickets\TicketQuery;

class TicketService extends TicketQuery implements TicketInterface {
    
    public function create($request){
        $ticket = $this->CreateTicket($request);
        return response()->json($ticket);
    }
}