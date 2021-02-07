<?php

namespace App\Http\Controllers;

use Mail;
use App\TicketOrder;
use App\Mail\CheckoutTicket;

use Illuminate\Http\Request;
use \App\Http\Controllers\UserController as UserCtrl;

class TicketOrderController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new TicketOrder;
        }
        return TicketOrder::where($filter);
    }
    public function buy(Request $req) {
        $myData = UserCtrl::me();
        $ticket = TicketCtrl::get([
            ['id', '=', $req->ticket_id]
        ])->first();

        $status = $ticket->price > 0 ? 0 : 1;

        $order = TicketOrder::create([
            'user_id' => $req->user_id,
            'ticket_id' => $req->ticket_id,
            'qty' => $req->qty,
            'total_pay' => $req->total_pay,
            'status' => $status
        ]);

        return response()->json($order);
    }
    public function completeOrder(Request $req) {
        $id = $req->orderID;

        $data = TicketOrder::where('id', $id);
        $completing = $data->update([
            'status' => 1
        ]);

        $order = $data->with('ticket.event')->first();
        $ticket = $order->ticket;
        $event = $order->ticket->event;

        Mail::to()
        ->send(new CheckoutTicket([
            'event' => $event,
            'ticket' => $ticket,
            'order' => $order,
        ]));

        return response()->json([
            'status' => 200,
            'data' => $id
        ]);
    }
}
