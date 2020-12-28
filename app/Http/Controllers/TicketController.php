<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketType;
use Illuminate\Http\Request;

use \App\Http\Controllers\TicketTypeController as TicketTypeCtrl;

class TicketController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Ticket;
        }
        return Ticket::where($filter);
    }
    public function create() {
        $types = TicketTypeCtrl::get();
        
        return view('admin.ticket.create', [
            'types' => $types
        ]);
    }
    public function store(Request $req) {
        $saveData = Ticket::create([
            'type_id' => $req->type_id,
            'name' => $req->name,
            'description' => $req->description,
            'price' => $req->price,
        ]);
        
        return redirect()->route('admin.ticket')->with([
            'message' => "Ticket berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $ticket = Ticket::find($id);
        $types = TicketTypeCtrl::get();

        return view('admin.ticket.edit', [
            'ticket' => $ticket,
            'types' => $types
        ]);
    }
    public function update($id, Request $req) {
        $updateData = Ticket::where('id', $id)->update([
            'type_id' => $req->type_id,
            'name' => $req->name,
            'description' => $req->description,
            'price' => $req->price,
        ]);
        
        return redirect()->route('admin.ticket')->with([
            'message' => "Ticket berhasil diubah"
        ]);
    }
    public function delete($id) {
        $deleteData = Ticket::where('id', $id)->delete();

        return redirect()->route('admin.ticket')->with([
            'message' => "Ticket berhasil dihapus"
        ]);
    }
}
