<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MapRequest;
use App\Interfaces\MapsInterface;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\MapUpdateRequest;

class MapController extends Controller
{

    private $mapInterface;

    public function __construct(MapsInterface $mapInterface) {
        $this->mapInterface = $mapInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->mapInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->mapInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MapRequest $request)
    {
        return $this->mapInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->mapInterface->show($id);
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
    public function update(MapUpdateRequest $request, string $id)
    {
        return $this->mapInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request , string $id)
    {
        return $this->mapInterface->destroy($request , $id);
    }

    public function delete(string $id){
        return $this->mapInterface->delete($id);
    }
}
