<?php

namespace App\Http\Controllers;

use App\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public static function get() {
        return EventType::all();
    }
    public function store(Request $req) {
        $saveData = EventType::create([
            'name' => $req->name,
        ]);
        
        return redirect()->route('admin.eventType')->with([
            'message' => "Data berhasil ditambahkan"
        ]);
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $deleteData = EventType::where('id', $id)->delete();

        return redirect()->route('admin.eventType')->with([
            'message' => "Data berhasil dihapus"
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
}
