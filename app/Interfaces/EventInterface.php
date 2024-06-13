<?php

namespace App\Interfaces;

interface EventInterface {
    public function index();
    public function create();
    public function show($event);
    public function store($request);
    public function update($request , $id);
    public function destroy($request , $id);
    public function restore($eventId);

    //api event
    public function eventIndex();
}