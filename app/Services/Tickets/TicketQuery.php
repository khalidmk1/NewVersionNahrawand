<?php

namespace  App\Services\Tickets;

use App\Models\Ticket;
use App\Services\GlobaleService;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TicketQuery extends GlobaleService {


    public function ticketIndex(){
        $tickets = Ticket::all();
        return $tickets;
    }

    public function editeTicket(String $id){
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        return $ticket;
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