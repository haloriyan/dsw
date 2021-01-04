<?php

namespace App\Http\Controllers;

use App\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public static function get() {
        return new EventType;
    }

    public function create()
    {
        return view('admin.eventType.create');
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
		$EventType = EventType::find($id);

		return view('admin.eventType.edit')->with([
			'eventType' => $EventType
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
