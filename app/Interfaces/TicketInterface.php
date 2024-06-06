<?php

namespace App\Interfaces;

interface TicketInterface {

    //api tickets
    public function create($request);
    public function index();
}