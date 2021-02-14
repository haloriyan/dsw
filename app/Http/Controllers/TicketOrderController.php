<?php

namespace App\Http\Controllers;

use Mail;
use Carbon\Carbon;
use App\TicketOrder;
use App\Mail\CheckoutTicket;

use Illuminate\Http\Request;
use \App\Http\Controllers\UserController as UserCtrl;
use \App\Http\Controllers\TicketController as TicketCtrl;

class TicketOrderController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new TicketOrder;
        }
        return TicketOrder::where($filter);
    }
    public function buy(Request $req) {
        date_default_timezone_set('Asia/Jakarta');
        $myData = UserCtrl::me();
        $ticket = TicketCtrl::get([
            ['id', '=', $req->ticket_id]
        ])->first();

        $tiketOrder = TicketOrder::where('user_id', $myData->id)->where('ticket_id', $req->ticket_id)->first();
        // dd($tiketOrder);

        $dateNow = date('Y-m-d H:i:s');
        $dueDate = Carbon::parse($dateNow)->addHours(24);

        $status = $ticket->price > 0 ? 0 : 1;

        if(empty($tiketOrder)) {
                $order = TicketOrder::create([
                'user_id' => $myData->id,
                'ticket_id' => $req->ticket_id,
                'qty' => $req->qty,
                'total_pay' => $ticket->price,
                'status' => $status,
                'due_date' => $dueDate
            ]);
    
            return redirect()->route('user.myTicket')->with([
                'message' => "Order Completed"
            ]);
        } else {
            return redirect()->route('user.myTicket')->with([
                'message' => "Sorry just can buy one ticket for one event"
            ]);
        }
        
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
