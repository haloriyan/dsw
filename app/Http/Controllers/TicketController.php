<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketType;
use App\TicketOrder;
use Illuminate\Http\Request;

use \App\Http\Controllers\EventController as EventCtrl;
use \App\Http\Controllers\TicketTypeController as TicketTypeCtrl;
use \App\Http\Controllers\TicketOrderController as TicketOrderCtrl;

class TicketController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Ticket;
        }
        return Ticket::where($filter);
    }
    public function create() {
        // $types = TicketTypeCtrl::get()->get();
        $events = EventCtrl::get()->get();
        
        return view('admin.ticket.create', [
            'events' => $events
        ]);
    }
    public function store(Request $req) {
        $saveData = Ticket::create([
            'event_id' => $req->event_id,
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
        $events = EventCtrl::get()->get();

        return view('admin.ticket.edit', [
            'ticket' => $ticket,
            'events' => $events
        ]);
    }
    public function update($id, Request $req) {
        $updateData = Ticket::where('id', $id)->update([
            'event_id' => $req->event_id,
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
    public function participant($ticketID) {
        $ticket = self::get([
            ['id', '=', $ticketID]
        ])
        ->with('event')
        ->first();

        $participants = TicketOrderCtrl::get([
            ['ticket_id', '=', $ticketID]
        ])
        ->with('user')
        ->get();

        return view('admin.ticket.participant', [
            'participants' => $participants,
            'ticket' => $ticket,
        ]);
    }
}
