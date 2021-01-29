<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Mail\NewUserNotification;

use \Midtrans\Snap as Snap;
use \Midtrans\Config as Config;

use App\Http\Controllers\FaqController as FaqCtrl;
use App\Http\Controllers\TeamController as TeamCtrl;
use App\Http\Controllers\EventController as EventCtrl;
use App\Http\Controllers\TicketController as TicketCtrl;
use \App\Http\Controllers\RundownController as RundownCtrl;
use App\Http\Controllers\EventTypeController as EventTypeCtrl;
use App\Http\Controllers\TicketOrderController as TicketOrderCtrl;

class UserController extends Controller
{
    public $eventTypes = [];
    public $myData;

    public function __construct() {
        $this->eventTypes = EventTypeCtrl::get()->with('events')->get();
    }
    public static function me() {
        return Auth::guard('user')->user();
    }
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new User;
        }
        return User::where($filter);
    }
    public function loginPage(Request $req) {
        $ref = $req->ref;
        $message = Session::get('message');

        return view('user.login', [
            'message' => $message,
            'ref' => $ref
        ]);
    }
    public function registerPage() {
        return view('user.register');
    }
    public function login(Request $req) {
        $loggingIn = Auth::guard('user')->attempt([
            'email' => $req->email,
            'password' => $req->password
        ]);

        if (!$loggingIn) {
            return redirect()->route('user.loginPage', [
                'ref' => $req->ref
            ])->withErrors(['Email dan/atau Password salah']);
        }
        if ($req->ref != "") {
            return redirect($req->ref);
        }

        return redirect()->route('user.index');
    }
    public function register(Request $req) {
        if ($req->via == "") {
            Mail::to($req->email)
            ->send(new NewUserNotification());
            $datas = [
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'phone' => $req->phone,
                'instance' => $req->instance,
                'gender' => $req->gender,
                'employment_status' => $req->employment_status,
                'reason' => $req->reason,
                'has_joined_dsi' => $req->has_joined_dsi,
                'interested_with_dsi' => $req->interested_with_dsi,
                'is_active' => 0,
            ];
        }else {
            $datas = [
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'gender' => $req->gender,
                'is_active' => 1
            ];
        }
        $saveData = User::create($datas);

        if ($req->via != "") {
            $myData = self::me();
            $team = User::where('id', $myData->id)->with('myTeam')->first();
            $assign = TeamCtrl::assignUserViaRegister([
                'team_id' => $team->id,
                'user' => $saveData,
                'column' => $req->column
            ]);

            return redirect()->route('user.myTeam');
        }

        return redirect()->route('user.loginPage')->with([
            'message' => "Pendaftaran berhasil. Silahkan login atau verifikasi email terlebih dahulu"
        ]);
    }
    public function testMail() {
        $sen = Mail::to("riyan.satria.619@gmail.com")
        ->send(new NewUserNotification([
            'name' => "Riyan Satria",
            'email' => "riyan.satria.619@gmail.com"
        ]));
        if ($sen) {
            return "done";
        }else {
            return Mail::failures();
        }
        // return view('email.Verification');
    }
    public function activate($email) {
        $email = base64_decode($email);
        $activatingUser = User::where('email', $email)->update([
            'is_active' => 1
        ]);

        return view('user.activate');
    }
    public function index() {
        $this->myData = self::me();
        $tickets = TicketCtrl::get()
        ->with('event')
        ->get();

        $faqs = FaqCtrl::get();
        $rundowns = RundownCtrl::get()->with('events')->get();
        
        return view('pages.index', [
            'eventTypes' => $this->eventTypes,
            'myData' => $this->myData,
            'tickets' => $tickets,
            'faqs' => $faqs,
            'rundowns' => $rundowns
        ]);
    }
    public function contact() {
        $this->myData = self::me();

        return view('pages.contact-us.index', [
            'eventTypes' => $this->eventTypes,
            'myData' => $this->myData
        ]);
    }
    public function event($id) {
        $this->myData = self::me();
        $event = EventCtrl::get([
            ['id', '=', $id]
        ])
        ->with('timeline')
        ->first();

        return view('pages.event', [
            'event' => $event,
            'eventTypes' => $this->eventTypes,
            'myData' => $this->myData
        ]);
    }
    public function ticket() {
        $this->myData = self::me();
        $tickets = TicketCtrl::get()->with('event')->get();
        
        return view('pages.ticket', [
            'tickets' => $tickets,
            'eventTypes' => $this->eventTypes,
            'myData' => $this->myData
        ]);
    }
    public function midtransPrepare($data) {
        $myData = self::me();
        $name = explode(" ", $myData->name);
        $lastName = !$name[1] ? $name[0] : $name[1];

        $merchatID = env('MIDTRANS_MERCHANT_ID');
        $mode = env('MIDTRANS_MODE');
        if ($mode == "SANDBOX") {
            $isProduction = false;
            $clientKey = env('MIDTRANS_CLIENT_KEY_SANDBOX');
            $serverKey = env('MIDTRANS_SERVER_KEY_SANDBOX');
        }else {
            $isProduction = true;
            $clientKey = env('MIDTRANS_CLIENT_KEY_PRODUCTION');
            $serverKey = env('MIDTRANS_SERVER_KEY_PRODUCTION');
        }

        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;

        $transactionDetail = [
            'order_id' => (int)$data->id."_".time(),
            'gross_amount' => $data->total_pay
        ];

        $customerDetail = [
            'first_name' => $name[0],
            'last_name' => $lastName,
            'email' => $myData->email,
            'phone' => $myData->phone,
        ];

        $itemDetails = [
            [
                'id' => $data->id,
                'name' => "Tiket " . $data->ticket->name,
                'price' => $data->ticket->price,
                'quantity' => (int)$data->qty
            ]
        ];

        return Snap::getSnapToken([
            'item_details' => $itemDetails,
            'customer_details' => $customerDetail,
            'transaction_details' => $transactionDetail
        ]);
    }
    public function buyTicket($id) {
        $myData = self::me();
        $ticket = TicketCtrl::get([
            ['id', '=', $id]
        ])
        ->with('event')
        ->first();

        return view('pages.buyTicket', [
            'myData' => $myData,
            'eventTypes' => $this->eventTypes,
            'ticket' => $ticket
        ]);
    }
    public function checkoutTicket(Request $req) {
        $myData = self::me();

        $orderID = $req->orderID;
        $data = TicketOrderCtrl::get([
            ['id', '=', $orderID]
        ])
        ->with('ticket')
        ->first();

        $snapToken = $this->midtransPrepare($data);
        $snapJsURL = "https://app.sandbox.midtrans.com/snap/snap.js";
        if (env('MIDTRANS_MODE') == "PRODUCTION") {
            $snapJsURL = "https://app.midtrans.com/snap/snap.js";
        }

        return view('pages.checkout', [
            'snapToken' => $snapToken,
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
            'data' => $data,
            'snapJsURL' => $snapJsURL,
        ]);
    }
    public function profile() {
        $this->myData = self::me();

        return view('user.profile', [
            'myData' => $this->myData,
            'eventTypes' => $this->eventTypes,
        ]);
    }
    public function updateProfile(Request $req) {
        $myData = self::me();

        $updateData = User::where('id', $myData->id)->update([
            'name' => $req->name,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'instance' => $req->instance,
            'employment_status' => $req->employment_status,
            'social_linkedin' => $req->social_linkedin,
            'social_medium' => $req->social_medium,
            'social_instagram' => $req->social_instagram,
            'social_facebook' => $req->social_facebook,
        ]);

        return redirect()->route('user.profile');
    }
    public function rundown() {
        $myData = self::me();
        $rundowns = RundownCtrl::get()->with('events')->get();

        return view('pages.rundown', [
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
            'rundowns' => $rundowns,
        ]);
    }
    public function invoice() {
        $myData = self::me();
        $invoices = TicketOrderCtrl::get([
            ['user_id', '=', $myData->id],
            ['status', '=', 0]
        ])
        ->with('ticket.event')
        ->get();

        return view('pages.invoice', [
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
            'invoices' => $invoices,
        ]);
    }
    public function myTicket() {
        $myData = self::me();
        
        $tickets = TicketOrderCtrl::get([
            ['user_id', '=', $myData->id],
            ['status', '=',  1]
        ])
        ->with('ticket.event')
        ->get();

        return view('pages.myTicket', [
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
            'tickets' => $tickets,
        ]);
    }
    public function myTeam() {
        $isHaveTeam = true;
        $myData = self::me();
        
        $team = TeamCtrl::isHaveTeam($myData->id);
        if ($team == "") {
            $isHaveTeam = false;
        }

        $team = json_decode(json_encode($team), FALSE);

        return view('pages.team', [
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
            'team' => $team,
            'isHaveTeam' => $isHaveTeam,
        ]);
    }
}