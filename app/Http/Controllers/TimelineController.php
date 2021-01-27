<?php

namespace App\Http\Controllers;

use App\Timeline;
use Illuminate\Http\Request;

use \App\Http\Controllers\EventController as EventCtrl;

class TimelineController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Timeline::all();
        }
        return Timeline::where($filter)->get();
    }
    public function create($eventID = NULL) {
        $filter = [];
        if ($eventID != NULL) {
            $filter = [
                ['id', '=', $eventID]
            ];
        }
        $data = EventCtrl::get($filter)->with('timeline');
        $events = $eventID != NULL ? $data->first() : $data->get();

        $eventsHasNoTimeline = [];
        foreach ($events as $event) {
            if ($event->timeline == "") {
                array_push($eventsHasNoTimeline, $event);
            }
        }

        return view('admin.timeline.create', [
            'events' => $eventsHasNoTimeline,
            'eventID' => $eventID
        ]);
    }
    public function store(Request $req) {
        $saveData = Timeline::create([
            'event_id' => $req->event_id,
            'type' => $req->type,
            'open_date' => $req->open_date,
            'close_date' => $req->close_date,
            'open_date_2' => $req->open_date_2,
            'close_date_2' => $req->close_date_2,
            'judgement_date' => $req->judgement_date,
            'main_date' => $req->main_date,
        ]);

        return redirect()->route('admin.timeline')->with([
            'message' => "Data timeline berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $timeline = Timeline::where('id', $id)->with('event')->first();
        $events = EventCtrl::get()->get();

        $eventsHasNoTimeline = [];
        foreach ($events as $evt) {
            if ($evt->timeline == "" || $evt->id == $timeline->event_id) {
                array_push($eventsHasNoTimeline, $evt);
            }
        }

        return view('admin.timeline.edit', [
            'timeline' => $timeline,
            'events' => $eventsHasNoTimeline
        ]);
    }
    public function update($id, Request $req) {
        $updateData = Timeline::where('id', $id)->update([
            'event_id' => $req->event_id,
            'type' => $req->type,
            'open_date' => $req->open_date,
            'close_date' => $req->close_date,
            'open_date_2' => $req->open_date_2,
            'close_date_2' => $req->close_date_2,
            'judgement_date' => $req->judgement_date,
            'main_date' => $req->main_date,
        ]);

        return redirect()->route('admin.timeline')->with([
            'message' => "Data timeline berhasil diubah"
        ]);
    }
    public function delete($id) {
        $deleteData = Timeline::where('id', $id)->delete();

        return redirect()->route('admin.timeline')->with([
            'message' => "Data timeline berhasil dihapus"
        ]);
    }
    public function view($id) {
        $timeline = Timeline::where('id', $id)->with('event')->first();

        return view('admin.timeline.view', [
            'timeline' => $timeline
        ]);
    }
}
