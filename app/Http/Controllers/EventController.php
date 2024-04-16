<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;

use App\Models\Event;


class EventController extends Controller
{

    public function index(Request $request)
    {

        $data = array();

        $data['events'] = Event::where('user_id', auth()->user()->id)
            ->orderBy('event_date', 'DESC')
            ->orderBy('event_time', 'DESC')
            ->get();

        return Inertia::render('Events/Events', ['data' => $data]);
    }


    public function createEvent(Request $request)
    {

        $newEvent = Event::create(
            [
                'user_id' => auth()->user()->id,
                'title' => $request->data['title'],
                'age_restrictons' => '0+',
                'enable' => 0,
                'archive' => 0,
                'moderation_status' => 0,
                'status' => 0,
            ]
        );

        return response()->json($newEvent);
    }

    public function viewEvent($id)
    {

        $data = array();

        $data['event'] = Event::find($id);

        return Inertia::render('Events/ViewEvent', ['data' => $data]);
    }

    public function updateEvent($id, Request $request)
    {
        $event = Event::find($id);

        $event->title = $request->title;
        $event->age_restrictions = $request->age_restrictions;
        $event->short_description = $request->short_description;
        $event->long_description = $request->long_description;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->ticket_price_from = $request->ticket_price_from;
        $event->ticket_price_to = $request->ticket_price_to;
        $event->place = $request->place;
        $event->page_alias = $request->page_alias;
        $event->external_link = $request->external_link;

        $event->save();
    }
}
