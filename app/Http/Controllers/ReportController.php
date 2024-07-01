<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ReportInterface;

class ReportController extends Controller
{

    private $ReportInterface;

    public function __construct(ReportInterface $ReportInterface) {
        $this->ReportInterface = $ReportInterface;
    }

    public function index(){
        return view('dashboard');
    }


    public function clientStatus(){
        return $this->ReportInterface->clientStatus();
    }


}
