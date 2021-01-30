<?php

namespace App\Http\Controllers;

use App\Contact;
use App\SpeakerContact;
use Illuminate\Http\Request;

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
        return view('admin.contact.create');
    }

    public static function store($data) {
        $saveData = SpeakerContact::create([
            'speaker_id' => $data['speaker_id'],
            'icon' => $data['icon'],
            'name' => $data['name'],
            'value' => $data['value'],
        ]);

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
        $contact = Contact::where('id' , $id)->first();
        return view('admin.contact.view',['contact' => $contact]);
    }


	public function edit($id) {
		$contact = Contact::find($id);

		return view('admin.contact.edit')->with([
			'contact' => $contact
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

    public static function delete($speakerID) {
        return SpeakerContact::where('speaker_id', $speakerID)->delete();
    }
}
