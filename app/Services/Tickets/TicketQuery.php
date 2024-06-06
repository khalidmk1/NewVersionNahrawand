<?php

namespace  App\Services\Tickets;

use App\Services\GlobaleService;
use App\Http\Requests\TicketRequest;

class TicketQuery extends GlobaleService {

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

}