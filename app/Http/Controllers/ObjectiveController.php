<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DestroyRequest;
use App\Interfaces\ObjectiveInterface;
use App\Http\Requests\ObjectiveRequest;

class ObjectiveController extends Controller
{

    private $ObjectiveInterface;

    public function __construct(ObjectiveInterface $ObjectiveInterface) {
        $this->ObjectiveInterface = $ObjectiveInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->ObjectiveInterface->index();
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
    public function store(ObjectiveRequest $request)
    {
        return $this->ObjectiveInterface->store($request);
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
    public function update(ObjectiveRequest $request, string $id)
    {
        return $this->ObjectiveInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request , string $id)
    {
        return $this->ObjectiveInterface->destroy($request, $id);
    }
}
