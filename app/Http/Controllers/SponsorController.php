<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Sponsor::all();
        }
        return Sponsor::where($filter)->get();
    }
    public function store(Request $req) {
        $logo = $req->file('logo');
        $logoFileName = $logo->getClientOriginalName();

        $saveData = Sponsor::create([
            'type_id' => $req->type_id,
            'name' => $req->name,
            'address' => $req->address,
            'bidang_kerja' => $req->bidang_kerja,
            'phone' => $req->phone,
            'link' => $req->link,
            'logo' => $logoFileName
        ]);

        $logo->storeAs('storage/sponsor/logo', $logoFileName);

        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor baru berhasil ditambahkan"]);
    }

    public function update(Request $req) {
        $id = $req->data_id;
        $sponsor = Sponsor::where('id', $id);

        $updateData = [
            'type_id' => $req->type_id,
            'name' => $req->name,
            'address' => $req->address,
            'bidang_kerja' => $req->bidang_kerja,
            'phone' => $req->phone,
            'link' => $req->link,
        ];

        $logo = $req->file('logo');
        if ($logo) {
            $photoFileName = $logo->getClientOriginalName();
            $deleteOldPhoto = Storage::delete('storage/sponsor/logo/'.$sponsor->first()->photo);
            $uploadNewPhoto = $logo->storeAs('storage/sponsor/logo', $photoFileName);
            $updateData['logo'] = $photoFileName;
        }

        $sponsor->update($updateData);

        return redirect()->route('admin.sponsor')->with([
            'message' => "Data sponsor berhasil diubah"
        ]);

        return redirect()->route('admin.event');
    }

    public function delete(Request $req) {
        $id = $req->sponsor_id;
        $deleteData = Sponsor::where('id', $id)->delete();
        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor berhasil dihapus"]);
    }
}
