<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketType;
use App\TicketOrder;
use Illuminate\Http\Request;

use \App\Http\Controllers\AdminController as AdminCtrl;
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        // $types = TicketTypeCtrl::get()->get();
        $events = EventCtrl::get()->get();
        
        return view('admin.ticket.create', [
            'menus' => $menus,
            'myData' => $myData,
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $ticket = Ticket::find($id);
        $events = EventCtrl::get()->get();

        return view('admin.ticket.edit', [
            'ticket' => $ticket,
            'menus' => $menus,
            'myData' => $myData,
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

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

        $toExport = [];
        foreach ($participants as $participant) {
            $status = $participant->status == 1 ? "Sudah dibayar" : "Belum dibayar";
            array_push($toExport, [
                'Tiket' => $ticket->name,
                'Event' => $ticket->event->title,
                'ID Peserta' => $participant->user->id,
                'Nama Peserta' => $participant->user->name,
                "Quantity" => $participant->qty,
                "Total Bayar" => $participant->total_pay,
                "Status" => $status
            ]);
        }
        $toExport = json_encode($toExport);

        return view('admin.ticket.participant', [
            'participants' => $participants,
            'ticket' => $ticket,
            'myData' => $myData,
            'menus' => $menus,
            'toExport' => $toExport,
        ]);
    }
}
