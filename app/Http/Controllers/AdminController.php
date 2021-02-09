<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Session;
use App\Admin;
use App\EventType;
use Illuminate\Http\Request;

use \App\Http\Controllers\FaqController as FaqCtrl;
use \App\Http\Controllers\UserController as UserCtrl;
use \App\Http\Controllers\TeamController as TeamCtrl;
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
	public static $menuIcons = [
		"ticket" => "fas fa-tags",
		"sponsor" => "fas fa-ad",
		"sponsorType" => "fas fa-ad",
		"faq" => "fas fa-question",
		"role" => "fas fa-cogs",
		"event" => "fas fa-calendar",
		"eventType" => "fas fa-calendar",
		"judge" => "fas fa-users",
		"speaker" => "fas fa-users",
		"team" => "fas fa-users",
		"participant" => "fas fa-users",
		"rundown" => "fas fa-calendar-alt",
		"timeline" => "fas fa-calendar-alt",
		"dashboard" => "fas fa-home",
		"admin" => "fas fa-home",
	];

	public static function splitCamelCase($string) {
		return implode(preg_split('/(?<=\\w)(?=[A-Z])/', $string), " ");
	}
	public static function getMenus($role) {
		$menus = RoleCtrl::get([
			['role', '=', $role]
		])
		->groupBy('module')
		->orderBy('module', 'ASC')
		->get();

		$ret = [];
		foreach ($menus as $menu) {
			$menu->icon = self::$menuIcons[$menu->module];
			$menu->module_display = str_replace("-", " ", $menu->module);
			$menu->module_display = ucwords($menu->module_display);
			$menu->module_display = self::splitCamelCase($menu->module_display);
			$ret[] = $menu;
		}

		return $ret;
	}
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
		$myData = self::me();
		$menus = self::getMenus($myData->role);

		return view('admin.dashboard', [
			'menus' => $menus,
			'myData' => $myData
		]);
	}
	public function profile() {
		$myData = self::me();
		$message = Session::get('message');
		$menus = self::getMenus($myData->role);

		return view('admin.profile', [
			'myData' => $myData,
			'menus' => $menus,
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

		$updateData = Admin::where('id', $myData->id)->update([
			'password' => bcrypt($new_password)
		]);

		if ($updateData) {
			$this->logout();

			return redirect()->route('admin.loginPage')->with([
				'message' => "Profil berhasil diupdate. Silahkan login kembali"
			]);
		}
	}
	public function add() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);

		return view('admin.admin.add', [
			'menus' => $menus,
			'myData' => $myData
		]);
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
            'created_at' => date('Y-m-d H:i:s'),
		]);

		return redirect()->route('admin.admin')->with([
			'message' => "Admin baru berhasil ditambahkan"
		]);
	}
	public function edit($id) {
		$admin = Admin::find($id);

		$myData = self::me();
		$menus = self::getMenus($myData->role);

		return view('admin.admin.edit', [
			'admin' => $admin,
			'menus' => $menus,
			'myData' => $myData,
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
		$myData = self::me();
		$menus = self::getMenus($myData->role);

		return view('admin.admin.create', [
			'menus' => $menus,
			'myData' => $myData,
		]);
	}
	public function delete($id) {
		$deleteData = Admin::where('id', $id)->delete();

		return redirect()->route('admin.admin')->with(['message' => "Data admin berhasil dihapus"]);
	}
	public function faq() {
		$myData = self::me();
		$faqs = FaqCtrl::get();
		$menus = self::getMenus($myData->role);
		
		return view('admin.faq.index')->with([
			'faqs' => $faqs,
			'myData' => $myData,
			'menus' => $menus,
		]);
    }

	public function contact() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$contacts = ContactCtrl::get();

		return view('admin.contact.index')->with([
			'contacts' => $contacts,
			'menus' => $menus,
			'myData' => $myData,
		]);
    }

    public function sponsorType() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$sponsorTypes = SponsorTypeCtrl::get();

		return view('admin.sponsorType.index')->with([
			'sponsorTypes' => $sponsorTypes,
			'myData' => $myData,
			'menus' => $menus,
		]);
	}

	public function sponsor() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$sponsors = SponsorCtrl::get();

		return view('admin.sponsor.index')->with([
			'sponsors' => $sponsors,
			'myData' => $myData,
			'menus' => $menus
		]);
    }

	public function eventType() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$eventTypes = EventTypeCtrl::get()->get();

		return view('admin.eventType.index')->with([
			'eventTypes' => $eventTypes,
			'menus' => $menus,
			'myData' => $myData
		]);
	}
	public function event($rundownID = NULL) {
		$myData = self::me();
		$menus = self::getMenus($myData->role);

		$rundown = "";
		$eventTypes = EventTypeCtrl::get();
		if ($rundownID == NULL) {
			$events = EventCtrl::get()->with('tickets')->get();
		}else {
			$events = EventCtrl::get([
				['rundown_id', '=', $rundownID]
			])
			->with('tickets')
			->get();
			$rundown = RundownCtrl::get([
				['id', '=', $rundownID]
			])->first();
		}

		return view('admin.event.index')->with([
			'eventTypes' => $eventTypes,
			'events' => $events,
			'menus' => $menus,
			'myData' => $myData,
			'rundown' => $rundown
		]);
	}
	public function speaker() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$speakers = SpeakerCtrl::get();
		$events = EventCtrl::get()->get();

		return view('admin.speaker.index')->with([
			'speakers' => $speakers,
			'myData' => $myData,
			'menus' => $menus,
			'events' => $events
		]);
	}
	public function judge() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$events = EventCtrl::get()->get();
		$judges = JudgeCtrl::get();

		return view('admin.judge.index')->with([
			'judges' => $judges,
			'myData' => $myData,
			'menus' => $menus,
			'events' => $events
		]);
	}
	public function timeline($eventID = NULL) {
		$myData = self::me();
		$menus = self::getMenus($myData->role);

		$event = "";
		if ($eventID == NULL) {
			$timelines = TimelineCtrl::get();
		}else {
			$event = EventCtrl::get([
				['id', '=', $eventID]
			])->first();

			$timelines = TimelineCtrl::get([
				['event_id', '=', $eventID]
			]);
		}

		return view('admin.timeline.index', [
			'timelines' => $timelines,
			'menus' => $menus,
			'myData' => $myData,
			'event' => $event
		]);
	}
	public function rundown() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$rundowns = RundownCtrl::get()->get();

		return view('admin.rundown.index', [
			'rundowns' => $rundowns,
			'menus' => $menus,
			'myData' => $myData,
		]);
	}
	public function ticketType() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$types = TicketTypeCtrl::get();

		return view('admin.ticketType.index', [
			'types' => $types,
			'menus' => $menus,
			'myData' => $myData,
		]);
	}
	public function ticket($typeID = NULL) {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$type = new \stdClass();
		$type->name = "";
		if ($typeID == NULL) {
			$tickets = TicketCtrl::get()->with('event')->get();
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
			'menus' => $menus,
			'myData' => $myData,
			'type' => $type
		]);
	}
	public function role() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$roles = RoleCtrl::get()->get();

		return view('admin.role.index', [
			'menus' => $menus,
			'myData' => $myData,
			'roles' => $roles
		]);
	}
	public function admin() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$admins = Admin::all();

		return view('admin.admin.index', [
			'admins' => $admins,
			'menus' => $menus,
			'myData' => $myData,
		]);
	}
	public function team() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$teams = TeamCtrl::get()
		->with(['chief','firstMember','secondMember'])
		->get();

		$teams = json_decode(json_encode($teams), FALSE);

		$toExport = [];
		foreach ($teams as $team) {
			$firstMember = $team->first_member != NULL ? $team->first_member->name : "";
			$secondMember = $team->second_member != NULL ? $team->second_member->name : "";
			array_push($toExport, [
				'ID' => $team->id,
				'Nama Team' => $team->name,
				'Ketua' => $team->chief->name,
				'Anggota 1' => $firstMember,
				'Anggota 2' => $secondMember
			]);
		}
		$toExport = json_encode($toExport);

		return view('admin.team.index', [
			'teams' => $teams,
			'menus' => $menus,
			'myData' => $myData,
			'toExport' => $toExport
		]);
	}
	public function participant() {
		$myData = self::me();
		$menus = self::getMenus($myData->role);
		$particpants = UserCtrl::get()
		->orderBy('created_at', 'DESC')
		->get();

		$toExport = [];
		foreach ($particpants as $user) {
			$hasJoinedDSI = $user->has_joined_dsi == 1 ? "Sudah" : "Belum";
			if ($user->interested_with_dsi == 1) {
                $interestedWithDSI = "Ya";
            }else if ($user->interested_with_dsi === 0) {
                $interestedWithDSI = "Tidak";
            }else {
                $interestedWithDSI = "";
            }

			array_push($toExport, [
				'Nama' => $user->name,
				'Email' => $user->email,
				'Telepon' => $user->phone,
				'Instansi' => $user->instance,
				'Status' => $user->employment_status,
				'Alasan Mengikuti DSW' => $user->reason,
				'Gender' => $user->gender,
				'Alamat' => $user->address,
				'LinkedIn' => $user->social_linkedin,
				'Medium' => $user->social_medium,
				'Facebook' => $user->social_facebook,
				'Instagram' => $user->social_instagram,
				'Sudah bergabung dengan DSI?' => $hasJoinedDSI,
				'Tertarik bergabung dengan DSI?' => $interestedWithDSI
			]);
		}

		$toExport = json_encode($toExport);

		return view('admin.participant.index', [
			'participants' => $particpants,
			'menus' => $menus,
			'myData' => $myData,
			'toExport' => $toExport
		]);
	}
	public function errorPage($errorCode) {
		if ($errorCode == 403) {
			$message = "Maaf, Anda tidak bisa mengakses halaman ini";
		}else if ($errorCode == 404) {
			$message = "Maaf, Halaman yang Anda cari tidak ditemukan";
		}

		return view("admin.error", [
			'code' => $errorCode,
			'message' => $message
		]);
	}
}
