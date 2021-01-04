<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Session;
use App\Admin;
use Illuminate\Http\Request;

use \App\Http\Controllers\FaqController as FaqCtrl;
use \App\Http\Controllers\RoleController as RoleCtrl;
use \App\Http\Controllers\EventController as EventCtrl;
use \App\Http\Controllers\JudgeController as JudgeCtrl;
use \App\Http\Controllers\TicketController as TicketCtrl;
use \App\Http\Controllers\ContactController as ContactCtrl;
use \App\Http\Controllers\SponsorController as SponsorCtrl;
use \App\Http\Controllers\SpeakerController as SpeakerCtrl;
use \App\Http\Controllers\RundownController as RundownCtrl;
use \App\Http\Controllers\TimelineController as TimelineCtrl;
use \App\Http\Controllers\EventTypeController as EventTypeCtrl;
use \App\Http\Controllers\TicketTypeController as TicketTypeCtrl;
use App\Http\Controllers\SponsorTypeController as SponsorTypeCtrl;

class AdminController extends Controller
{
	public static function me() {
		return Auth::guard('admin')->user();
	}
	public function loginPage() {
		$message = Session::get('message');
		$isErrorMessage = Session::get('isErrorMessage');
		return view('admin.login', [
			'message' => $message,
			'isError' => $isErrorMessage
		]);
	}
	public function login(Request $req) {
		$email = $req->email;
		$password = $req->password;

		$loggingIn = Auth::guard('admin')->attempt([
			'email' => $email,
			'password' => $password
		]);

		if (!$loggingIn) {
			return redirect()->route('admin.loginPage')->withErrors(['Email / Password salah']);
		}

		return redirect()->route('admin.dashboard');
	}
	public function logout() {
		$loggingOut = Auth::guard('admin')->logout();
		return redirect()->route('admin.loginPage')->with(['message' => "Berhasil logout"]);
	}
	public function dashboard() {
		return view('admin.dashboard');
	}
	public function profile() {
		$myData = self::me();
		$message = Session::get('message');

		return view('admin.profile', [
			'myData' => $myData,
			'message' => $message
		]);
	}
	public function updateProfile(Request $req) {
		$myData = self::me();
		$old_password = $req->old_password;
		$new_password = $req->new_password;

		$checkingPassword = Hash::check($old_password, $myData->password);
		if (!$checkingPassword) {
			return redirect()->route('admin.profile')->withErrors(['Old password is not match']);
		}

		$updateData = Admin::where('id', $myData)->update([
			'password' => bcrypt($new_password)
		]);

		return redirect()->route('admin.profile')->with([
			'message' => "Password has been changed"
		]);
	}
	public function add() {
		return view('admin.admin.add');
	}
	public function store(Request $req) {
		$validateData = $this->validate($req, [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'min:6|max:18'
		]);

		$name = $req->name;
		$email = $req->email;
		$password = $req->password;
		$role = $req->role;

		$saveData = Admin::create([
			'name' => $name,
			'email' => $email,
			'password' => bcrypt($password),
			'role' => $role,
			'is_super' => 0,
			'username' => $req->username,
			'phone' => $req->phone,
		]);

		return redirect()->route('admin.admin')->with([
			'message' => "Admin baru berhasil ditambahkan"
		]);
	}
	public function edit($id) {
		$admin = Admin::find($id);

		return view('admin.admin.edit', [
			'admin' => $admin
		]);
	}
	public function update($id, Request $req) {
		$toUpdate = [
			'name' => $req->name,
			'email' => $req->email,
			'role' => $req->role,
			'username' => $req->username,
			'phone' => $req->phone,
		];
		
		if ($req->password != "") {
			$toUpdate['password'] = bcrypt($req->password);
		}

		$updateData = Admin::where('id', $id)->update($toUpdate);
		
		return redirect()->route('admin.admin')->with([
			'message' => "Data admin berhasil diperbarui"
		]);
	}
	public function create() {
		return view('admin.admin.create');
	}
	public function delete($id) {
		$deleteData = Admin::where('id', $id)->delete();

		return redirect()->route('admin.admin')->with(['message' => "Data admin berhasil dihapus"]);
	}
	public function faq() {
		$faqs = FaqCtrl::get();
		return view('admin.faq.index')->with(['faqs' => $faqs]);
    }

	public function contact() {
		$contacts = ContactCtrl::get();
		return view('admin.contact.index')->with(['contacts' => $contacts]);
    }

    public function sponsorType() {
		$sponsorTypes = SponsorTypeCtrl::get();
		return view('admin.sponsorType.index')->with([
			'sponsorTypes' => $sponsorTypes,
		]);
	}

	public function sponsor() {
		$sponsors = SponsorCtrl::get();
		return view('admin.sponsor.index')->with([
			'sponsors' => $sponsors
		]);
    }

	public function eventType() {
		$eventTypes = EventTypeCtrl::get();
		return view('admin.eventType.index')->with([
			'eventTypes' => $eventTypes
		]);
	}
	public function event() {
		$eventTypes = EventTypeCtrl::get();
		$events = EventCtrl::get();
		return view('admin.event.index')->with([
			'eventTypes' => $eventTypes,
			'events' => $events
		]);
	}
	public function speaker() {
		$speakers = SpeakerCtrl::get();
		$events = EventCtrl::get();

		return view('admin.speaker.index')->with([
			'speakers' => $speakers,
			'events' => $events
		]);
	}
	public function judge() {
		$events = EventCtrl::get();
		$judges = JudgeCtrl::get();

		return view('admin.judge.index')->with([
			'judges' => $judges,
			'events' => $events
		]);
	}
	public function timeline() {
		$timelines = TimelineCtrl::get();

		return view('admin.timeline.index', [
			'timelines' => $timelines
		]);
	}
	public function rundown() {
		$rundowns = RundownCtrl::get();
		
		return view('admin.rundown.index', [
			'rundowns' => $rundowns
		]);
	}
	public function ticketType() {
		$types = TicketTypeCtrl::get();

		return view('admin.ticketType.index', [
			'types' => $types
		]);
	}
	public function ticket($typeID = NULL) {
		$type = new \stdClass();
		$type->name = "";
		if ($typeID == NULL) {
			$tickets = TicketCtrl::get()->with('type')->get();
		}else {
			$tickets = TicketCtrl::get([
				['type_id', '=', $typeID]
			])
			->with('type')
			->get();
			
			$type = TicketTypeCtrl::get([
				['id', '=', $typeID]
			])
			->first();
		}
		
		return view('admin.ticket.index', [
			'tickets' => $tickets,
			'type' => $type
		]);
	}
	public function role() {
		$roles = RoleCtrl::get()->get();
		
		return view('admin.role.index', [
			'roles' => $roles
		]);
	}
	public function admin() {
		$admins = Admin::all();

		return view('admin.admin.index', [
			'admins' => $admins
		]);
	}

}
