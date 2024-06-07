<?php

namespace App\Interfaces;

interface TicketInterface {

    public function index();
    public function edite($id);
    //api tickets
    public function create($request);
    public function indexApi();
}