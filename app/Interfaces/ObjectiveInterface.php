<?php

namespace App\Interfaces;

interface ObjectiveInterface {
    public function index();
    public function store($request , $contentId);
    public function update($request, $id);
    public function destroy($request, $id);
}