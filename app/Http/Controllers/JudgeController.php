<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Facades\Storage;
use App\Judge;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContactController as ContactCtrl;

class JudgeController extends Controller
{
    public static function get($eventID = NULL) {
        if ($eventID == NULL) {
            return Judge::get();
        }
        return Judge::where('event_id', $eventID)->get();
    }

    public function create()
    {
        $events = Event::all();
        return view('admin.judge.create')->with([
			'events' => $events
		]);
    }

    public function store(Request $req) {

        DB::beginTransaction();

        try {
            $photo = $req->file('photo');
            $photoFileName = $photo->getClientOriginalName();

            $judge = Judge::create([
                'event_id' => $req->event_id,
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
                'photo' => $photoFileName,
            ]);

            $contactsIcon = $req->judges_contacts_icon;
            $contactsName = $req->judges_contacts_name;
            $contactsValue = $req->judges_contacts_value;

            $c = 0;
            foreach ($contactsIcon as $icon) {
                $iPP = $c++;

                if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                    $saveContact = ContactCtrl::stored([
                        'judges_id' => $judge->id,
                        'icon' => $icon,
                        'name' => $contactsName[$iPP],
                        'value' => $contactsValue[$iPP],
                    ]);
                }
            }

            $photo->storeAs('public/judge_photo', $photoFileName);

            DB::commit();

            return redirect()->route('admin.judge')->with([
                'message' => "Data juri berhasil ditambahkan"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function view($id)
    {
        $judge = Judge::where('id' , $id)
        ->with('contacts')
        ->with('event')
        ->first();

        return view('admin.judge.view',['judge' => $judge]);
    }


	public function edit($id) {
        $judge = Judge::where('id', $id)
        ->with(['event','contacts'])
        ->first();
        $events = Event::all();

		return view('admin.judge.edit')->with([
            'judge' => $judge,
            'events' => $events,
        ]);
    }

    public function update(Request $req) {

        DB::beginTransaction();
        try {
            $id = $req->id;

            $judge = Judge::where('id', $id)->first();

            $judgeUpdate = [
                'event_id' => $req->event_id,
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
            ];

            $photo = $req->file('photo');
            if ($photo) {
                $photoFileName = $photo->getClientOriginalName();
                $deleteOldPhoto = Storage::delete('public/judge_photo/'.$judge->photo);
                $uploadNewPhoto = $photo->storeAs('public/judge_photo', $photoFileName);
                $judgeUpdate['photo'] = $photoFileName;
            }
            $judge->update($judgeUpdate);


            if ($req->is_updating_contact == 1) {
                // delete contact, then create the new contacts
                $deleteContacts = ContactCtrl::deleted($id);

                $contactsIcon = $req->judges_contacts_icon;
                $contactsName = $req->judges_contacts_name;
                $contactsValue = $req->judges_contacts_value;

                $c = 0;
                foreach ($contactsIcon as $icon) {
                    $iPP = $c++;

                    if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                        $saveContact = ContactCtrl::stored([
                            'judges_id' => $judge->id,
                            'icon' => $icon,
                            'name' => $contactsName[$iPP],
                            'value' => $contactsValue[$iPP],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.judge')->with([
                'message' => "Data juri berhasil diupdate"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete($id) {
        $judge = Judge::where('id', $id);
        $deletePhoto = Storage::delete('public/judge_photo/'.$judge->first()->photo);
        $deleteData = $judge->delete();

        return redirect()->route('admin.judge')->with([
            'message' => "Data juri berhasil dihapus"
        ]);
    }
}
