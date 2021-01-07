<?php

namespace App\Http\Controllers;

use App\TicketOrder;

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

        $order = TicketOrder::create([
            'user_id' => $req->user_id,
            'ticket_id' => $req->ticket_id,
            'qty' => $req->qty,
            'total_pay' => $req->total_pay,
            'status' => 0
        ]);

        return response()->json($order);
    }
    public function completeOrder(Request $req) {
        $id = $req->orderID;

        $completing = TicketOrder::where('id', $id)->update([
            'status' => 1
        ]);

        return response()->json([
            'status' => 200,
            'data' => $id
        ]);
    }
}
