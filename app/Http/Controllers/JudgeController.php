<?php

namespace App\Http\Controllers;

use Storage;
use App\Judge;
use Illuminate\Http\Request;

use \App\Http\Controllers\AdminController as AdminCtrl;
use App\Http\Controllers\EventController as EventCtrl;
use App\Http\Controllers\ContactController as ContactCtrl;

class JudgeController extends Controller
{
    public static function get($eventID = NULL) {
        if ($eventID == NULL) {
            return Judge::with('event')->get();
        }
        return Judge::where('event_id', $eventID)->get();
    }
    public function create() {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $events = EventCtrl::get()->get();

        return view('admin.judge.create', [
            'events' => $events,
            'menus' => $menus,
            'myData' => $myData
        ]);
    }
    public function edit($id) {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
        $judge = Judge::where('id', $id)->with('contacts')->first();
        $events = EventCtrl::get()->get();

        return view('admin.judge.edit', [
            'events' => $events,
            'menus' => $menus,
            'myData' => $myData,
            'judge' => $judge
        ]);
    }
    public function store(Request $req) {
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

        $photo->storeAs('public/judge_photo', $photoFileName);

        $contactsIcon = $req->judge_contacts_icon;
        $contactsName = $req->judge_contacts_name;
        $contactsValue = $req->judge_contacts_value;

        $c = 0;
        foreach ($contactsIcon as $icon) {
            $iPP = $c++;

            if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                $saveContact = ContactCtrl::store('judge', [
                    'judge_id' => $judge->id,
                    'icon' => $icon,
                    'name' => $contactsName[$iPP],
                    'value' => $contactsValue[$iPP],
                ]);
            }
        }

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
        $judge = $judge->first();

        if ($req->is_updating_contact == 1) {
            // delete contact, then create the new contacts
            $deleteContacts = ContactCtrl::delete('judge', $id);
            
            $contactsIcon = $req->judge_contacts_icon;
            $contactsName = $req->judge_contacts_name;
            $contactsValue = $req->judge_contacts_value;

            $c = 0;
            foreach ($contactsIcon as $icon) {
                $iPP = $c++;

                if ($icon != "" || $contactsName[$iPP] != "" || $contactsValue != "") {
                    $saveContact = ContactCtrl::store('judge', [
                        'judge_id' => $judge->id,
                        'icon' => $icon,
                        'name' => $contactsName[$iPP],
                        'value' => $contactsValue[$iPP],
                    ]);
                }
            }
        }
        
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
