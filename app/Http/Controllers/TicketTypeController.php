<?php

namespace App\Http\Controllers;

use App\TicketType;
use Illuminate\Http\Request;

use \App\Http\Controllers\AdminController as AdminCtrl;

class TicketTypeController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new TicketType;
        }
        return TicketType::where($filter);
    }
    public function create() {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        return view('admin.ticketType.create', [
            'menus' => $menus,
            'myData' => $myData,
        ]);
    }
    public function store(Request $req) {
        $saveData = TicketType::create([
            'name' => $req->name,
            'description' => $req->description,
        ]);
        
        return redirect()->route('admin.ticketType')->with([
            'message' => "Tiket berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $type = TicketType::find($id);

        return view('admin.ticketType.edit', [
            'type' => $type,
            'menus' => $menus,
            'myData' => $myData
        ]);
    }
    public function update($id, Request $req) {
        $updateData = TicketType::where('id', $id)->update([
            'name' => $req->name,
            'description' => $req->description,
        ]);

        return redirect()->route('admin.ticketType')->with([
            'message' => "Tipe tiket berhasil diubah"
        ]);
    }
    public function delete($id) {
        $deleteData = TicketType::where('id', $id)->delete();

        return redirect()->route('admin.ticketType')->with([
            'message' => "Ticket berhasil dihapus"
        ]);
    }
}
