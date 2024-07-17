<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\MapsInterface;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    private $mapInterface;

    public function __construct(MapsInterface $mapInterface) {
        $this->mapInterface = $mapInterface;
    }
    
    public function index(){
        return $this->mapInterface->mapAll();
    }
}
