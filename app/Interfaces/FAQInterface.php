<?php

namespace  App\Interfaces;

interface FAQInterface {
    public function index();
    public function store($request);
    public function update($request , $id);
}