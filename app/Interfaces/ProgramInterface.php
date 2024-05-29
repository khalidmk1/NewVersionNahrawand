<?php

namespace App\Interfaces;


interface ProgramInterface {
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy( $request , $id);
}