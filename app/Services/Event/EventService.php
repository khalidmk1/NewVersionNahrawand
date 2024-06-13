<?php

namespace App\Services\Event;

use App\Interfaces\EventInterface;
use App\Services\Event\EventQuery;


class EventService extends EventQuery implements EventInterface   {

    
    public function index(){
        $events =  $this->paginateEvent();
        return view('event.index')->with('events' , $events);
    }
    
    public function create(){
        $speakers = $this->allSpeakers();
        return view('event.create')->with('speakers' , $speakers);
    }

    public function show($event){
        $event = $this->showEvent($event);
        $speakers = $this->allSpeakers();
        return view('event.show')->with(['event' => $event , 'speakers' => $speakers]);
    }

    public function store($request){
        $event = $this->storeEvent($request);
        return redirect()->back()->with('status' , 'You Have Created Event');
    }

    public function update($request , $id){
        $event = $this->updateEvent($request , $id);
        return redirect()->back()->with('status' , 'You Have updated event');
    }

    public function destroy($request , $id){
        $event = $this->destroyEvent($request , $id);
        return redirect()->route('event.index')->with('status', 'You have deleted event');
    }

    public function restore($eventId){
        $event = $this->restoreEvent($eventId);
        return redirect()->back()->with('status' , 'You have restored event');

    }

    //api event
    public function eventIndex(){
        $events = $this->getEventIndex();
        return response()->json($events);
    }

}