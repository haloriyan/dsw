<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Session;
use App\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;

use App\Mail\ContactForm;
use App\Mail\ResetPassword;
use App\Mail\NewUserNotification;

use \Midtrans\Snap as Snap;
use \Midtrans\Config as Config;

use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\FaqController as FaqCtrl;
use App\Http\Controllers\TeamController as TeamCtrl;
use App\Http\Controllers\AdminController as AdminCtrl;
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
            ])->withErrors(['Wrong entered email and/or password']);
        }
        if ($req->ref != "") {
            return redirect($req->ref);
        }

        return redirect()->route('user.index');
    }
    public function register(Request $req) {
        $name = $req->name;
        $email = $req->email;

        $this->validate($req, [
            'email' => "unique:users"
        ]);

        if ($req->via == "") {
            $datas = [
                'name' => $name,
                'email' => $email,
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
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($req->password),
                'gender' => $req->gender,
                'is_active' => 0
            ];
        }
        
        Mail::to($email)
        ->send(new NewUserNotification(
            [
                'name' => $name,
                'email' => $email,
            ]
        ));
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
            'message' => "You are registered now. Please login or verify your email first"
        ]);
    }
    public function logout() {
        $loggingOut = Auth::guard('user')->logout();
        return redirect()->route('user.loginPage')->with([
            'message' => "Successfully logged out"
        ]);
    }
    public function forgotPassword() {
        $message = Session::get('message');

        return view('user.forgotPassword', [
            'message' => $message
        ]);
    }
    public function forgotPasswordProcess(Request $req) {
        $email = $req->email;
        $encodedEmail = base64_encode($email);

        $user = User::where('email', $email)->first();
        if ($user == "") {
            return redirect()->route('user.forgotPassword')->withErrors([
                "Sorry, we could not recognize your email address"
            ]);
        }

        $send = Mail::to($email)
        ->send(new ResetPassword([
            'user' => $user,
            'encodedEmail' => $encodedEmail
        ]));

        return redirect()->route('user.forgotPassword')->with([
            'message' => "We has sent instruction to reset your password"
        ]);
    }
    public function resetPassword($encodedEmail) {
        $message = Session::get('message');
        $email = base64_decode($encodedEmail);
        $user = User::where('email', $email)->first();
        
        if ($user == '') {
            return redirect()->route('user.error', 403);
        }

        return view('user.resetPassword', [
            'message' => $message,
            'encodedEmail' => $encodedEmail
        ]);
    }
    public function resetPasswordProcess(Request $req) {
        $email = base64_decode($req->encodedEmail);
        $password = $req->password;
        $passwordRetype = $req->passwordRetype;
        
        if ($password != $passwordRetype) {
            return redirect()->route('user.resetPassword', $req->encodedEmail)->withErrors([
                "Both of password is not same. Please try again"
            ]);
            
        } elseif ($password == $passwordRetype) {
                $updateData = User::where('email', $email)->update([
                'password' => bcrypt($password)
            ]);
        }

        return redirect()->route('user.loginPage')->with([
            'message' => "New password has been set. Please login using your new password"
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
        ->paginate(3);

        $faqs = FaqCtrl::get()->get();
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
        $message = Session::get('message');

        return view('pages.contact-us.index', [
            'eventTypes' => $this->eventTypes,
            'message' => $message,
            'myData' => $this->myData
        ]);
    }
    public function contactSend(Request $req) {
        $send = Mail::to(env("MAIL_RECIPIENT_ADDRESS"))->send(new ContactForm([
            'name' => $req->name,
            'email' => $req->email,
            'subject' => $req->subject,
            'message' => $req->message,
        ]));

        return redirect()->route('user.contact')->with([
            'message' => "We glad to hear this message from you. We will reply as soon as we can"
        ]);
    }
    public function event($id) {
        $this->myData = self::me();
        $event = EventCtrl::get([
            ['id', '=', $id]
        ])
        ->with('timeline')
        ->first();

        $event->timeline->fields = json_decode($event->timeline->fields, FALSE);

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
		$lastName = $name[count($name) - 1];

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
            'social_tablue'   => $req->social_tablue,
            'social_medium' => $req->social_medium,
           // 'social_instagram' => $req->social_instagram,
           // 'social_facebook' => $req->social_facebook,
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
    public function view($userID) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        $participant = User::where('id', $userID)
        ->first();

        return view('admin.participant.view', [
            'participant' => $participant,
            'myData' => $myData,
            'menus' => $menus
        ]);
    }
    public function export() {
        $filename = "users_".date('Y-m-d')."_".time().".xlsx";
        
        $download = Excel::download(new UserExport, $filename);

        if ($download) {
            return redirect()->route('admin.participant');
        }
    }
    public function emailVerification($email) {
        $email = base64_decode($email);

        $updateData = User::where('email', $email)->update([
            'is_active' => 1
        ]);

        return redirect()->route('user.loginPage')->with([
            'message' => "Your account has been activated, you can login now"
        ]);
    }
    public function delete($userID) {
        $deleteData = User::where('id', $userID)->delete();

        return redirect()->route('admin.participant')->with([
            'message' => "Peserta berhasil dihapus"
        ]);
    }
    public function faq() {
        $faqs = FaqCtrl::get()
        ->orderBy('type', 'ASC')
        ->get();
        $myData = self::me();

        return view('pages.faq', [
            'faqs' => $faqs,
            'eventTypes' => $this->eventTypes,
            'myData' => $myData,
        ]);
    }
}
