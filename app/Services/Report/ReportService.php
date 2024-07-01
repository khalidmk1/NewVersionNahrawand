<?php

namespace App\Services\Report;

use App\Interfaces\ReportInterface;
use App\Services\Report\ReportQuery;

class ReportService extends ReportQuery implements ReportInterface {

    public function index(){
        return view('dashboard');
    }

    public function clientStatus(){
        $user = $this->stateClient();
        return response()->json($user);
    }

    public function clientLast(){
        $user = $this->latestClient();
        
    }
}