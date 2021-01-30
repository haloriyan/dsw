<?php

namespace App\Http\Controllers;

use App\Event;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\ContactController as ContactCtrl;

class SpeakerController extends Controller
{
    public static function get($eventID = NULL) {
        if ($eventID == NULL) {
            return Speaker::get();
        }
        return Speaker::where('event_id', $eventID)->get();
    }

    public function create()
    {
        $events = Event::all();
        return view('admin.speaker.create')->with([
			'events' => $events
		]);
    }

    public function store(Request $req) {

        DB::beginTransaction();

        try {
            $photo = $req->file('photo');
            $photoFileName = $photo->getClientOriginalName();

            // $validateData = $this->validate($req, [
            //     'event_id' => $req->event_id,
            //     'name' => 'required',
            //     'phone' => 'required',
            //     'email' => 'required',
            //     'linkedin_profile' => 'required',
            //     'photo' =>  'required|max:4096',
            // ]);

            $speaker = Speaker::create([
                'event_id' => $req->event_id,
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
                'photo' => $photoFileName,
            ]);

            $contactsIcon = $req->speaker_contacts_icon;
            $contactsName = $req->speaker_contacts_name;
            $contactsValue = $req->speaker_contacts_value;

            $c = 0;
            foreach ($contactsIcon as $icon) {
                $iPP = $c++;

                if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                    $saveContact = ContactCtrl::store([
                        'speaker_id' => $speaker->id,
                        'icon' => $icon,
                        'name' => $contactsName[$iPP],
                        'value' => $contactsValue[$iPP],
                    ]);
                }
            }

            $photo->storeAs('public/speaker_photo', $photoFileName);

            // $finalArray = array();
            //     foreach($req->event as $value){
            //         array_push($finalArray, array(
            //                 'events_id' =>  $value,
            //                 'speaker_id' =>  $speaker->id,
            //                 'created_at' => date('Y-m-d H:i:s')
            //             )
            //         );
            //     };

            // EventSpeaker::insert($finalArray);

            DB::commit();

            return redirect()->route('admin.speaker')->with([
                'message' => "Data speaker berhasil ditambahkan"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function view($id)
    {
        $speaker = Speaker::where('id' , $id)
        ->with('contacts')
        ->with('event')
        ->first();

        return view('admin.speaker.view',['speaker' => $speaker]);
    }


	public function edit($id) {
        $speaker = Speaker::where('id', $id)
        ->with(['event','contacts'])
        ->first();
        $events = Event::all();

		return view('admin.speaker.edit')->with([
            'speaker' => $speaker,
            'events' => $events,
        ]);
    }

    public function update(Request $req) {

        DB::beginTransaction();
        try {
            $id = $req->id;

            $speaker = Speaker::where('id', $id)->first();

            $speakerUpdate = [
                'event_id' => $req->event_id,
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
            ];

            $photo = $req->file('photo');
            if ($photo) {
                $photoFileName = $photo->getClientOriginalName();
                $deleteOldPhoto = Storage::delete('public/speaker_photo/'.$speaker->photo);
                $uploadNewPhoto = $photo->storeAs('public/speaker_photo', $photoFileName);
                $speakerUpdate['photo'] = $photoFileName;
            }
            $speaker->update($speakerUpdate);


            if ($req->is_updating_contact == 1) {
                // delete contact, then create the new contacts
                $deleteContacts = ContactCtrl::delete($id);

                $contactsIcon = $req->speaker_contacts_icon;
                $contactsName = $req->speaker_contacts_name;
                $contactsValue = $req->speaker_contacts_value;

                $c = 0;
                foreach ($contactsIcon as $icon) {
                    $iPP = $c++;

                    if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                        $saveContact = ContactCtrl::store([
                            'speaker_id' => $speaker->id,
                            'icon' => $icon,
                            'name' => $contactsName[$iPP],
                            'value' => $contactsValue[$iPP],
                        ]);
                    }
                }
            }

            // $eventspeaker = EventSpeaker::where('speaker_id', $speaker->id);

            // $eventspeaker->delete();

            // $finalArray = array();
            // foreach($req->event as $value){
            //     array_push($finalArray, array(
            //         'events_id' =>  $value,
            //         'speaker_id' =>  $speaker->id,
            //         'created_at' => $speaker->created_at,
            //         'updated_at' => date('Y-m-d H:i:s')
            //         )
            //     );
            // };

            // EventSpeaker::insert($finalArray);

            DB::commit();

            return redirect()->route('admin.speaker')->with([
                'message' => "Data speaker berhasil diupdate"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete($id) {
        $speaker = Speaker::where('id', $id);
        $deletePhoto = Storage::delete('public/speaker_photo/'.$speaker->first()->photo);
        $deleteData = $speaker->delete();

        return redirect()->route('admin.speaker')->with([
            'message' => "Data speaker berhasil dihapus"
        ]);
    }
}
