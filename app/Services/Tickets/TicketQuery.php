<?php

namespace  App\Services\Tickets;

use App\Models\Ticket;
use App\Services\GlobaleService;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Auth;

class TicketQuery extends GlobaleService {


    public function ticketIndex(){
        $tickets = Ticket::all();

        return $tickets;
    }


    //api tickets
    public function CreateTicket(TicketRequest $request){
        
        $fileName = $this->storeFileTicket($request);

        $ticket = Ticket::create([
            'clientId' => Auth::user()->id,
            'TypeTicket' => $request->TypeTicket,
            'status' => false,
            'detail' => $request->detail,
            'file' => $fileName
        ]);

        return $ticket;
    }

    public function ticketIndexApi(){
        $tickets = Ticket::where('clientId' , Auth::user()->id)->get(['TypeTicket' , 'status' , 'updated_at']);
        return $tickets;
    }

}