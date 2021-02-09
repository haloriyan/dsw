<?php

namespace App\Http\Controllers;

use App\EventType;

use Illuminate\Http\Request;
use \App\Http\Controllers\AdminController as AdminCtrl;

class EventTypeController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new EventType;
        }
        return EventType::where($filter);
    }

    public function create()
    {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        return view('admin.eventType.create', [
            'myData' => $myData,
            'menus' => $menus,
        ]);
    }

    public function store(Request $req) {
        $saveData = EventType::create([
            'name' => $req->name,
        ]);
        
        return redirect()->route('admin.eventType')->with([
            'message' => "Data berhasil ditambahkan"
        ]);
    }

    public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
		$EventType = EventType::find($id);

		return view('admin.eventType.edit')->with([
            'eventType' => $EventType,
            'menus' => $menus,
            'myData' => $myData,
		]);
    }

    public function update(Request $req) {
        $id = $req->data_id;
        $updateData = EventType::find($id)->update([
            'name' => $req->name
        ]);

        return redirect()->route('admin.eventType')->with([
            'message' => "Data berhasil diubah"
        ]);
    }

    public function delete($id) {
        EventType::where('id', $id)->delete();
        return redirect()->route('admin.eventType')->with(['message' => "Data berhasil dihapus"]);
    }
}
