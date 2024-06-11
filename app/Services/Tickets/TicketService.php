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

    public function update($request , $id){
        $ticket = $this->updateTicket($request , $id);
        return redirect()->back()->with('status' , 'You have Updated the ticket');
    }

    public function createComment($request , $id){
        $comment = $this->createCommentTicket($request , $id);
        return redirect()->back()->with('status' , 'You have created a Comment');
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