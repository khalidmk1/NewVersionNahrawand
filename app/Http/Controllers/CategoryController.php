<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DestroyRequest;
use App\Interfaces\CategoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    private $CategoryInterface;

    public function __construct(CategoryInterface $CategoryInterface) {
        $this->CategoryInterface = $CategoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->CategoryInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return $this->CategoryInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest  $request, string $id)
    {
        return $this->CategoryInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request ,string $id)
    {
        return $this->CategoryInterface->destroy($request , $id);
    }

    public function restore(String $categoryId){
        return $this->CategoryInterface->restore($categoryId);
    }
}
