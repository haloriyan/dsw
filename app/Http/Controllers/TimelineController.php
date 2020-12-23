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
    public function create() {
        $events = EventCtrl::get();
        
        return view('admin.timeline.create', [
            'events' => $events
        ]);
    }
    public function store(Request $req) {
        $saveData = Timeline::create([
            'event_id' => $req->event_id,
            'type' => $req->type,
            'open_date' => $req->open_date,
            'close_date' => $req->close_date,
            'judgement_date' => $req->judgement_date,
            'main_date' => $req->main_date,
        ]);

        return redirect()->route('admin.timeline')->with([
            'message' => "Data timeline berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $timeline = Timeline::find($id);
        $events = EventCtrl::get();
        
        return view('admin.timeline.edit', [
            'timeline' => $timeline,
            'events' => $events
        ]);
    }
    public function update($id, Request $req) {
        $updateData = Timeline::where('id', $id)->update([
            'event_id' => $req->event_id,
            'type' => $req->type,
            'open_date' => $req->open_date,
            'close_date' => $req->close_date,
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
}
