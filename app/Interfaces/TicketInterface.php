<?php

namespace App\Interfaces;

interface TicketInterface {

    public function index();
    //api tickets
    public function create($request);
    public function indexApi();
}