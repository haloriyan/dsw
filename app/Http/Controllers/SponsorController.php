<?php

namespace App\Http\Controllers;

use App\Sponsor;
use App\SponsorType;
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

    public function create()
    {
        $sponsorType = SponsorType::all();
        return view('admin.sponsor.create')->with([
			'sponsorType' => $sponsorType
		]);
    }


    public function store(Request $req) {
        $logo = $req->file('logo');
        $logoFileName = $logo->getClientOriginalName();

        $saveData = Sponsor::create([
            'type_id' => $req->type_id,
            'name' => $req->name,
            'address' => $req->address,
            'field' => $req->bidang_kerja,
            'phone' => $req->phone,
            'link' => $req->link,
            'logo' => $logoFileName
        ]);

        $logo->storeAs('public/sponsor/logo', $logoFileName);

        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor baru berhasil ditambahkan"]);
    }

    public function view($id)
    {
        $sponsor = Sponsor::where('id', $id)->with('type')->first();
        return view('admin.sponsor.view')->with([
            'sponsor' => $sponsor ,
        ]);
    }


	public function edit($id) {
        $sponsor = Sponsor::where('id', $id)->with('type')->first();
        $sponsorType = SponsorType::all();
		return view('admin.sponsor.edit')->with([
            'sponsor' => $sponsor ,
            'sponsorType' => $sponsorType
        ]);
    }

    public function update(Request $req) {
        $id = $req->data_id;
        $sponsor = Sponsor::where('id', $id);

        $updateData = [
            'type_id' => $req->type_id,
            'name' => $req->name,
            'address' => $req->address,
            'field' => $req->bidang_kerja,
            'phone' => $req->phone,
            'link' => $req->link,
        ];

        $logo = $req->file('logo');
        if ($logo) {
            $photoFileName = $logo->getClientOriginalName();
            $deleteOldPhoto = Storage::delete('public/sponsor/logo/'.$sponsor->first()->photo);
            $uploadNewPhoto = $logo->storeAs('public/sponsor/logo', $photoFileName);
            $updateData['logo'] = $photoFileName;
        }

        $sponsor->update($updateData);

        return redirect()->route('admin.sponsor')->with([
            'message' => "Data sponsor berhasil diubah"
        ]);

        return redirect()->route('admin.event');
    }

    public function delete($id) {
        Sponsor::where('id', $id)->delete();
        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor berhasil dihapus"]);
    }
}
