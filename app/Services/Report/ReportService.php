<?php

namespace App\Services\Report;

use App\Interfaces\ReportInterface;
use App\Services\Report\ReportQuery;

class ReportService extends ReportQuery implements ReportInterface {

    public function clientStatus(){
        $user = $this->stateClient();
        return response()->json($user);
    }
}