<?php

namespace App\Http\Controllers;

use App\Rundown;
use Illuminate\Http\Request;

use \App\Http\Controllers\AdminController as AdminCtrl;

class RundownController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Rundown;
        }
        return Rundown::where($filter);
    }
    public function create() {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        return view('admin.rundown.create', [
            'myData' => $myData,
            'menus' => $menus,
        ]);
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $rundown = Rundown::find($id);

        return view('admin.rundown.edit', [
            'rundown' => $rundown,
            'menus' => $menus,
            'myData' => $myData
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $rundown = Rundown::find($id);

        return view('admin.rundown.view', [
            'rundown' => $rundown,
            'myData' => $myData,
            'menus' => $menus
        ]);
    }
}
