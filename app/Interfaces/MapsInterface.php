<?php

namespace App\Interfaces;

interface MapsInterface {

    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function update($request , $id);
    public function destroy($request , $id);
    public function delete($id);
    //api map
    public function mapAll();
}
