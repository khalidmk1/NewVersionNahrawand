<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ProgramInterface;

class ProgramController extends Controller
{
    private $ProgramInterface;

    public function __construct(ProgramInterface $ProgramInterface) {
        $this->ProgramInterface = $ProgramInterface;
    }

    public function allProgramApi(){
        return $this->ProgramInterface->allProgramApi();
    }
}
