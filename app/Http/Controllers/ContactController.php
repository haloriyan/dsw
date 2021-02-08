<?php

namespace App\Http\Controllers;

use App\Contact;
use App\JudgeContact;
use App\SpeakerContact;

use Illuminate\Http\Request;
use \App\Http\Controllers\AdminController as AdminCtrl;

class ContactController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Contact::all();
        }
        return Contact::where($filter)->get();
    }

    public function create()
    {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        return view('admin.contact.create', [
            'menus' => $menus,
            'myData' => $myData
        ]);
    }

    public static function store($type, $data) {
        if ($type == "speaker") {
            $saveData = SpeakerContact::create([
                'speaker_id' => $data['speaker_id'],
                'icon' => $data['icon'],
                'name' => $data['name'],
                'value' => $data['value'],
            ]);
        }else {
            $saveData = JudgeContact::create([
                'judge_id' => $data['judge_id'],
                'icon' => $data['icon'],
                'name' => $data['name'],
                'value' => $data['value'],
            ]);
        }

        return $saveData;
    }
    public function storesss(Request $req) {
        $saveData = Contact::create([
            'icon' => $req->icon,
            'name' => $req->name,
            'value' => $req->value,
        ]);

        return redirect()->route('admin.contact')->with(['message' => "Kontak berhasil ditambahkan"]);
    }

    public function view($id)
    {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $contact = Contact::where('id' , $id)->first();

        return view('admin.contact.view', [
            'contact' => $contact,
            'menus' => $menus,
            'myData' => $myData
        ]);
    }


	public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
		$contact = Contact::find($id);

		return view('admin.contact.edit')->with([
            'contact' => $contact,
            'menus' => $menus,
            'myData' => $myData
		]);
    }

    public function updatesss(Request $req) {
        $id = $req->contact_id;

        $saveData = Contact::where('id', $id)
		->update([
            'icon' => $req->icon,
            'name' => $req->name,
            'value' => $req->value,
        ]);

        return redirect()->route('admin.contact')->with(['message' => "Kontak berhasil ditambahkan"]);
    }

    public static function delete($type, $userID) {
        if ($type == "speaker") {
            return SpeakerContact::where('speaker_id', $userID)->delete();
        }else {
            return JudgeContact::where('judge_id', $userID)->delete();
        }
    }
}
