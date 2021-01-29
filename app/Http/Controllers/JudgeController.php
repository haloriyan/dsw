<?php

namespace App\Http\Controllers;

use Storage;
use App\Judge;
use Illuminate\Http\Request;

use App\Http\Controllers\EventController as EventCtrl;

class JudgeController extends Controller
{
    public static function get($eventID = NULL) {
        if ($eventID == NULL) {
            return Judge::with('event')->get();
        }
        return Judge::where('event_id', $eventID)->get();
    }
    public function create() {
        $events = EventCtrl::get()->get();

        return view('admin.judge.create', [
            'events' => $events
        ]);
    }
    public function view($id)
    {
        $judge = Judge::where('id' , $id)->first();
        $events = EventCtrl::get()->first();
        return view('admin.judge.view',['judge' => $judge , 'events' => $events]);
    }
    public function edit($id) {
        $judge = Judge::find($id);
        $events = EventCtrl::get()->get();

        return view('admin.judge.edit', [
            'events' => $events,
            'judge' => $judge
        ]);
    }
    public function store(Request $req) {
        $photo = $req->file('photo');
        $photoFileName = $photo->getClientOriginalName();

        $saveData = Judge::create([
            'event_id' => $req->event_id,
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'linkedin_profile' => $req->linkedin_profile,
            'photo' => $photoFileName,
        ]);

        $photo->storeAs('public/judge_photo', $photoFileName);

        return redirect()->route('admin.judge')->with([
            'message' => "Data juri berhasil ditambahkan"
        ]);
    }
    public function update($id, Request $req) {
        $judge = Judge::where('id', $id);

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
            $deleteOldPhoto = Storage::delete('public/judge_photo/'.$judge->first()->photo);
            $uploadNewPhoto = $photo->storeAs('public/judge_photo', $photoFileName);
            $toUpdate['photo'] = $photoFileName;
        }

        $judge->update($toUpdate);

        return redirect()->route('admin.judge')->with([
            'message' => "Data juri berhasil diubah"
        ]);
    }
    public function delete($id, Request $req) {
        $judge = Judge::where('id', $id);
        $deletePhoto = Storage::delete('public/judge_photo/'.$judge->first()->photo);
        $deleteData = $judge->delete();

        return redirect()->route('admin.judge')->with([
            'message' => "Data juri berhasil dihapus"
        ]);
    }
}
