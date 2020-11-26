<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public static function get() {
        return Event::all();
    }
    public function store(Request $req) {
        $saveData = Event::create([
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
            'requirements' => $req->requirements,
            'prize' => $req->prize
        ]);

        return redirect()->route('admin.event');
    }
    public function update(Request $req) {
        $id = $req->data_id;

        $updateData = Event::where('id', $id)->update([
            'type_id' => $req->type_id,
            'title' => $req->title,
            'description' => $req->description,
            'requirements' => $req->requirements,
            'prize' => $req->prize
        ]);
        
        return redirect()->route('admin.event');
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $deleteData = Event::find($id)->delete();

        return redirect()->route('admin.event');
    }
}
