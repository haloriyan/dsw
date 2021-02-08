<?php

namespace App\Http\Controllers;

use App\Timeline;
use Illuminate\Http\Request;

use \App\Http\Controllers\AdminController as AdminCtrl;
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $filter = [];
        if ($eventID != NULL) {
            $filter = [
                ['id', '=', $eventID]
            ];
        }
        $data = EventCtrl::get($filter)->with('timeline');
        $events = $eventID != NULL ? $data->first() : $data->get();

        $eventsHasNoTimeline = [];
        if ($eventID == NULL) {
            foreach ($events as $event) {
                if ($event->timeline == "") {
                    array_push($eventsHasNoTimeline, $event);
                }
            }
        }else {
            array_push($eventsHasNoTimeline, $events);
        }
        
        return view('admin.timeline.create', [
            'events' => $eventsHasNoTimeline,
            'eventID' => $eventID,
            'myData' => $myData,
            'menus' => $menus
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

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
            'menus' => $menus,
            'myData' => $myData,
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $timeline = Timeline::where('id', $id)->with('event')->first();

        return view('admin.timeline.view', [
            'timeline' => $timeline,
            'menus' => $menus,
            'myData' => $myData
        ]);
    }
}
