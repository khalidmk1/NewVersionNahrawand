<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Interfaces\EventInterface;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    private $eventInterface;

    public function __construct(EventInterface $eventInterface) {
        $this->eventInterface = $eventInterface;
    }

    public function eventIndex(){
        return $this->eventInterface->eventIndex();
    }
}
