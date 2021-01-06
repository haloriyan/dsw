<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Event;
        }
        return Event::where($filter);
    }

    public function create()
    {
        $eventTypes = EventType::all();
        return view('admin.event.create')->with([
			'eventTypes' => $eventTypes
		]);
    }

    public function store(Request $req) {
        $requirements = implode(",", $req->requirements);
        $prize = implode(",", $req->prize);

        $saveData = Event::create([
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
            'requirements' => $requirements,
            'prize' => $prize
        ]);

        return redirect()->route('admin.event');
    }

    public function view($id)
    {
        $event = Event::where('id' , $id)->with(['type','timeline'])->first();
        return view('admin.event.view',['event' => $event]);
    }


	public function edit($id) {
        $event = Event::where('id', $id)->with('type')->first();
        // $event = json_decode(json_encode($event), FALSE);
        $eventType = EventType::all();
        
		return view('admin.event.edit')->with([
            'event' => $event ,
            'eventTypes' => $eventType
        ]);
    }

    public function update($id, Request $req) {
        $requirements = implode(",", $req->requirements);
        $prizes = implode(",", $req->prize);

        $updateData = Event::where('id', $id)->update([
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
            'requirements' => $requirements,
            'prize' => $prizes
        ]);
        
        return redirect()->route('admin.event');
    }

    public function delete($id) {
       Event::where('id', $id)->delete();
       return redirect()->route('admin.event')->with(['message' => "Data berhasil dihapus"]);
    }
}
