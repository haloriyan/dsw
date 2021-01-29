<?php

namespace App\Http\Controllers;

use App\Event;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\EventController as EventCtrl;

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

            $validateData = $this->validate($req, [
                'event_id' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'linkedin_profile' => 'required',
                'photo' =>  'required|max:4096',
            ]);

            $saveData = Speaker::create([
                'event_id' => $req->event_id,
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
                'photo' => $photoFileName,
            ]);

            $photo->storeAs('public/speaker_photo', $photoFileName);

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
        $speaker = Speaker::where('id' , $id)->first();
        $events = EventCtrl::get()->first();
        return view('admin.speaker.view',['speaker' => $speaker , 'events' => $events]);
    }


	public function edit($id) {
        $speaker = Speaker::where('id', $id)->first();
        $events = EventCtrl::get()->get();

		return view('admin.speaker.edit')->with([
            'speaker' => $speaker,
            'events' => $events,
        ]);
    }

    public function update(Request $req) {

        DB::beginTransaction();
        try {
            $id = $req->id;
            $validateData = $this->validate($req, [
                'event_id' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'linkedin_profile' => 'required',
                'photo' =>  'max:4096',
            ]);

            $speaker = Speaker::where('id', $id)->first();
            // echo'<pre>'; var_dump($speaker); die;

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
