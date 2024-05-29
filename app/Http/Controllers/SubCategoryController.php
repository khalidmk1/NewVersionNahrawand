<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SubCategoryInterface;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    private $SubCategoryInterface;

    public function __construct(SubCategoryInterface $SubCategoryInterface) {
        $this->SubCategoryInterface = $SubCategoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->SubCategoryInterface->index();
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
    public function store(SubCategoryRequest $request)
    {
        return $this->SubCategoryInterface->store($request);
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
    public function update(SubCategoryRequest $request, string $id)
    {
        return $this->SubCategoryInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , string $id)
    {
        return $this->SubCategoryInterface->destroy($request , $id);
    }
}
