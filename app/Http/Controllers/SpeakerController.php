<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventSpeaker;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'linkedin_profile' => 'required',
                'photo' =>  'required|max:4096',
            ]);

            $speaker = Speaker::create([
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'linkedin_profile' => $req->linkedin_profile,
                'photo' => $photoFileName,
            ]);

            $photo->storeAs('public/speaker_photo', $photoFileName);

            $finalArray = array();
                foreach($req->event as $value){
                    array_push($finalArray, array(
                            'events_id' =>  $value,
                            'speaker_id' =>  $speaker->id,
                            'created_at' => date('Y-m-d H:i:s')
                        )
                    );
                };

            EventSpeaker::insert($finalArray);

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
        return view('admin.speaker.view',['speaker' => $speaker]);
    }


	public function edit($id) {
        $speaker = Speaker::where('id', $id)->first();
        $eventspeaker = EventSpeaker::all()->where('speaker_id', $speaker->id);
        $events = Event::all();

		return view('admin.speaker.edit')->with([
            'speaker' => $speaker,
            'events' => $events,
            'eventspeaker' => $eventspeaker
        ]);
    }

    public function update(Request $req) {

        DB::beginTransaction();
        try {
            $id = $req->id;

            $validateData = $this->validate($req, [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'linkedin_profile' => 'required',
                'photo' =>  'max:4096',
            ]);

            $speaker = Speaker::where('id', $id)->first();
            // echo'<pre>'; var_dump($speaker); die;

            $speakerUpdate = [
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

            $eventspeaker = EventSpeaker::where('speaker_id', $speaker->id);
            // echo'<pre>'; var_dump($eventspeaker); die;

            $eventspeaker->delete();

            $finalArray = array();
            foreach($req->event as $value){
                array_push($finalArray, array(
                    'events_id' =>  $value,
                    'speaker_id' =>  $speaker->id,
                    'created_at' => $speaker->created_at,
                    'updated_at' => date('Y-m-d H:i:s')
                    )
                );
            };

            EventSpeaker::insert($finalArray);

            DB::commit();

            return redirect()->route('admin.speaker')->with([
                'message' => "Data speaker berhasil ditambahkan"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getLine()]);
        }
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $speaker = Speaker::where('id', $id);
        $deletePhoto = Storage::delete('public/speaker_photo/'.$speaker->first()->photo);
        $deleteData = $speaker->delete();

        return redirect()->route('admin.speaker')->with([
            'message' => "Data speaker berhasil dihapus"
        ]);
    }
}
