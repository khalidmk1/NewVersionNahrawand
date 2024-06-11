<?php

namespace App\Interfaces;

interface TicketInterface {

    public function index();
    public function edite($id);
    public function update($request , $id);
    //api tickets
    public function create($request);
    public function indexApi();
}