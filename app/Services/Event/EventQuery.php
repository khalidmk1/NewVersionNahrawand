<?php

namespace App\Services\Event;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventUser;
use App\Services\GlobaleService;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\EventUpdateRequest;

class EventQuery extends GlobaleService {

    public function paginateEvent(){
        $events = Event::paginate(10);

        return $events;
    }

    public function showEvent(String $event){
        $event = Event::findOrFail(Crypt::decrypt($event));

        return $event;
    }

    public function storeEvent(EventRequest $request){


        $fileNameEventImage = $this->storeEventImage($request);

        $formattedDateStart = Carbon::parse($request->datestart)->formatLocalized('%a, %d %b %Y %I:%M %p');
        $formattedDateEnd = Carbon::parse($request->DateEnd)->formatLocalized('%a, %d %b %Y %I:%M %p');

        $event = Event::create([
            'image' => $fileNameEventImage,
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
            'dateStart' => $formattedDateStart ,
            'dateEnd' => $formattedDateEnd
        ]);



        if($request->has('speakerID')){
            foreach ($request->speakerID as $key => $speakerID) {
                $VideoGuest = EventUser::create([
                    'userId' => (int) $speakerID,
                    'eventId' => $event->id
                ]);
            }
        }


        return $event;
    }

    public function updateEvent(EventUpdateRequest $request , String $id){
        $event = Event::findOrFail(Crypt::decrypt($id));
        $nameImage = $event->image;

        $formattedDateStart = $request->has('dateStart') ? Carbon::parse($request->dateStart)
        ->formatLocalized('%a, %d %b %Y %I:%M %p') : $event->dateStart;

        $formattedDateEnd = $request->has('dateEnd') ? Carbon::parse($request->dateEnd)
        ->formatLocalized('%a, %d %b %Y %I:%M %p') : $event->dateEnd;

        $eventImage = $this->updateEventImage($request , $nameImage);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'datestart' => $formattedDateStart,
            'DateEnd' => $formattedDateEnd,
            'image' => $eventImage,
            'url' => $request->url
        ]);

        $event->eventUser()->delete();

        if($request->has('speakerID')){
            foreach ($request->speakerID as $key => $speakerID) {
                $VideoGuest = EventUser::create([
                    'userId' => (int) $speakerID,
                    'eventId' => $event->id
                ]);
            }
        }


        return $event;
    }

    //api event

    public function getEventIndex(){
        $events = Event::all();
        $event->load('eventUser');
        $filtredEvents =  $events->map(function($event){
            return [
                'image' => $event->image,
                'title' => $event->title,
                'description' => $event->description,
                'dateStart' => $event->dateStart,
                'dateEnd' => $event->dateEnd,
                'user' => [
                    'image' => $event->eventUser->avatar
                ]
            ];
        });
    }

   
}