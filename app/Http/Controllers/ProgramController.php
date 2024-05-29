<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProgramInterface;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\ProgramRequest;


class ProgramController extends Controller
{

    private $ProgramInterface;

    public function __construct(ProgramInterface $ProgramInterface) {
        $this->ProgramInterface = $ProgramInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->ProgramInterface->index();
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
    public function store(ProgramRequest $request)
    {
        return  $this->ProgramInterface->store($request);
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
    public function update(ProgramRequest $request, string $id)
    {
        return  $this->ProgramInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request  ,string $id)
    {
        return  $this->ProgramInterface->destroy($request ,$id);
    }
}
