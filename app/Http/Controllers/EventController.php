<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\EventInterface;
use App\Http\Requests\EventRequest;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\EventUpdateRequest;

class EventController extends Controller
{

    private $eventInterface;

    public function __construct(EventInterface $eventInterface) {
        $this->eventInterface = $eventInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->eventInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->eventInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        return $this->eventInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $event)
    {
        return $this->eventInterface->show($event);
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
    public function update(EventUpdateRequest $request, string $id)
    {
        return $this->eventInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, string $id)
    {
        return $this->eventInterface->destroy($request , $id);
    }

    public function restore(String $eventId){
        return $this->eventInterface->restore($eventId);
    }
}
