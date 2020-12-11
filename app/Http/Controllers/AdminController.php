<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Admin;
use Illuminate\Http\Request;

use \App\Http\Controllers\FaqController as FaqCtrl;
use \App\Http\Controllers\EventController as EventCtrl;
use \App\Http\Controllers\JudgeController as JudgeCtrl;
use \App\Http\Controllers\ContactController as ContactCtrl;
use \App\Http\Controllers\SponsorController as SponsorCtrl;
use App\Http\Controllers\SponsorTypeController as SponsorTypeCtrl;
use \App\Http\Controllers\SpeakerController as SpeakerCtrl;
use \App\Http\Controllers\EventTypeController as EventTypeCtrl;

class AdminController extends Controller
{
	public function me() {
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
			'password' => $password,
			'role' => $role
		]);
	}
	public function edit($id) {
		$admin = Admin::find($id);

		return view('admin.admin.edit')->with([
			'admin' => $admin
		]);
	}
	public function delete($id) {
		$deleteData = Admin::where('id', $id)->delete();

		return redirect()->route('admin.admin')->with(['message' => "Data admin berhasil dihapus"]);
	}
	public function faq() {
		$faqs = FaqCtrl::get();
		return view('admin.faq')->with(['faqs' => $faqs]);
    }

	public function contact() {
		$contacts = ContactCtrl::get();
		return view('admin.contact')->with(['contacts' => $contacts]);
    }

    public function sponsorType() {
		$sponsorType = SponsorTypeCtrl::get();
		return view('admin.sponsorType')->with([
			'sponsorType' => $sponsorType,
		]);
	}

	public function sponsor() {
		$sponsorType = SponsorTypeCtrl::get();
		$sponsors = SponsorCtrl::get();
		return view('admin.sponsor')->with([
			'sponsorType' => $sponsorType,
			'sponsors' => $sponsors
		]);
    }

	public function eventType() {
		$eventTypes = EventTypeCtrl::get();
		return view('admin.eventType')->with([
			'eventTypes' => $eventTypes
		]);
	}
	public function event() {
		$eventTypes = EventTypeCtrl::get();
		$events = EventCtrl::get();
		return view('admin.event')->with([
			'eventTypes' => $eventTypes,
			'events' => $events
		]);
	}
	public function speaker() {
		$speakers = SpeakerCtrl::get();
		$events = EventCtrl::get();

		return view('admin.speaker')->with([
			'speakers' => $speakers,
			'events' => $events
		]);
	}
	public function judge() {
		$events = EventCtrl::get();
		$judges = JudgeCtrl::get();

		return view('admin.judge')->with([
			'judges' => $judges,
			'events' => $events
		]);
	}
}

