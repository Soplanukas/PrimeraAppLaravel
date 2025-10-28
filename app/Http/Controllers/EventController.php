<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with('venue')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_max_capacity = $request->input('event_max_capacity');
        $event->event_speaker_name = $request->input('event_speaker_name');
        $event->event_location_name = $request->input('event_location_name');
        $event->event_meetup_url = $request->input('event_meetup_url');
        $event->event_is_virtual = $request->input('event_is_virtual');
        $event->save();

        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event->load('venue');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->event_name = $request->input('event_name', $event->event_name);
        $event->event_date = $request->input('event_date', $event->event_date);
        $event->event_max_capacity = $request->input('event_max_capacity', $event->event_max_capacity);
        $event->event_speaker_name = $request->input('event_speaker_name', $event->event_speaker_name);
        $event->event_location_name = $request->input('event_location_name', $event->event_location_name);
        $event->event_meetup_url = $request->input('event_meetup_url', $event->event_meetup_url);
        $event->event_is_virtual = $request->input('event_is_virtual');
        $event->save();

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        return Event::destroy($event->id);
    }
}
