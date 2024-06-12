<?php

namespace App\Interfaces;

interface CategoryInterface {
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($request , $id);
    public function restore($categoryId);
}

