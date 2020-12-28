<?php

namespace App\Http\Controllers;

use App\Rundown;
use Illuminate\Http\Request;

class RundownController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Rundown::all();
        }
        return Rundown::where($filter);
    }
    public function create() {
        return view('admin.rundown.create');
    }
    public function store(Request $req) {
        $saveData = Rundown::create([
            'title' => $req->title,
            'date' => $req->date,
            'start_time' => $req->start_time,
            'end_time' => $req->end_time,
            'notes' => $req->notes,
        ]);

        return redirect()->route('admin.rundown')->with([
            'message' => "Data rundown berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $rundown = Rundown::find($id);

        return view('admin.rundown.edit', [
            'rundown' => $rundown
        ]);
    }
    public function update($id, Request $req) {
        $updateData = Rundown::where('id', $id)->update([
            'title' => $req->title,
            'date' => $req->date,
            'start_time' => $req->start_time,
            'end_time' => $req->end_time,
            'notes' => $req->notes,
        ]);

        return redirect()->route('admin.rundown')->with([
            'message' => "Data rundown berhasil diubah"
        ]);
    }
    public function delete($id) {
        $deleteData = Rundown::where('id', $id)->delete();
        
        return redirect()->route('admin.rundown')->with([
            'message' => "Data rundown berhasil dihapus"
        ]);
    }
    public function view($id) {
        $rundown = Rundown::find($id);

        return view('admin.rundown.view', [
            'rundown' => $rundown
        ]);
    }
}
