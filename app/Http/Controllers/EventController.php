<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController as AdminCtrl;
use App\Http\Controllers\RundownController as RundownCtrl;
use App\Http\Controllers\EventTypeController as EventTypeCtrl;

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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $eventTypes = EventTypeCtrl::get()->get();
        $rundowns = RundownCtrl::get()->get();

        return view('admin.event.create')->with([
            'eventTypes' => $eventTypes,
            'menus' => $menus,
            'myData' => $myData,
            'rundowns' => $rundowns
		]);
    }

    public function store(Request $req) {
        $requirements = implode(",", $req->requirements);
        $prize = implode(",", $req->prize);

        $saveData = Event::create([
            'rundown_id' => $req->rundown_id,
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $event = Event::where('id' , $id)->with(['type','timeline','rundown'])->first();
        return view('admin.event.view', [
            'event' => $event,
            'myData' => $myData,
            'menus' => $menus
        ]);
    }


	public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $event = Event::where('id', $id)->with('type')->first();
        $eventType = EventType::all();
        
		return view('admin.event.edit')->with([
            'event' => $event,
            'myData' => $myData,
            'menus' => $menus,
            'eventTypes' => $eventType
        ]);
    }

    public function update($id, Request $req) {
        $requirements = implode(",", $req->requirements);
        $prizes = implode(",", $req->prize);

        $updateData = Event::where('id', $id)->update([
            'rundown_id' => $req->rundown_id,
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
