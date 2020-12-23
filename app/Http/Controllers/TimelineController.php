<?php

namespace App\Http\Controllers;

use App\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Timeline::all();
        }
        return Timeline::where($filter)->get();
    }
    public function store(Request $req) {
        $saveData = Timeline::create([
            ''
        ]);

        return redirect()->route('admin')->with([
            'message' => "Data timeline berhasil ditambahkan"
        ]);
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $deleteData = Timeline::where('id', $id)->delete();

        return redirect()->route('admin')->with([
            'message' => "Data timeline berhasil dihapus"
        ]);
    }
}
