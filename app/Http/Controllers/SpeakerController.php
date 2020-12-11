<?php

namespace App\Http\Controllers;

use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
    public static function get($eventID = NULL) {
        if ($eventID == NULL) {
            return Speaker::with('event')->get();
        }
        return Speaker::where('event_id', $eventID)->get();
    }
    public function store(Request $req) {
        $photo = $req->file('photo');
        $photoFileName = $photo->getClientOriginalName();

        $saveData = Speaker::create([
            'event_id' => $req->event_id,
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'linkedin_profile' => $req->linkedin_profile,
            'photo' => $photoFileName,
        ]);

        $photo->storeAs('public/speaker_photo', $photoFileName);

        return redirect()->route('admin.speaker')->with([
            'message' => "Data speaker berhasil ditambahkan"
        ]);
    }
    public function update(Request $req) {
        $id = $req->data_id;
        $speaker = Speaker::where('id', $id);

        $toUpdate = [
            'event_id' => $req->event_id,
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'linkedin_profile' => $req->linkedin_profile,
        ];

        $photo = $req->file('photo');
        if ($photo) {
            $photoFileName = $photo->getClientOriginalName();
            $deleteOldPhoto = Storage::delete('public/speaker_photo/'.$speaker->first()->photo);
            $uploadNewPhoto = $photo->storeAs('public/speaker_photo', $photoFileName);
            $toUpdate['photo'] = $photoFileName;
        }

        $speaker->update($toUpdate);

        return redirect()->route('admin.speaker')->with([
            'message' => "Data speaker berhasil diubah"
        ]);
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
