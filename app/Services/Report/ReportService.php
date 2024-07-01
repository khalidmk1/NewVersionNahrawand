<?php

namespace App\Services\Report;

use App\Interfaces\ReportInterface;
use App\Services\Report\ReportQuery;

class ReportService extends ReportQuery implements ReportInterface {

    public function index(){
        $recentClients = $this->latestClient();
        $contents = $this->latestContent();
        $tickets = $this->tickets();
        return view('dashboard')->with(['recentClients' => $recentClients , 'contents' => $contents , 'tickets' => $tickets]);
    }

    public function clientStatus(){
        $user = $this->stateClient();
        return response()->json($user);
    }

    

}