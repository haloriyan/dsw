<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Illuminate\Http\Request;

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
            'name' => $req->name,
            'address' => $req->address,
            'field' => $req->field,
            'phone' => $req->phone,
            'link' => $req->link,
            'logo' => $logoFileName
        ]);

        $logo->storeAs('public/logo', $logoFileName);

        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor baru berhasil ditambahkan"]);
    }
    public function delete(Request $req) {
        $id = $req->sponsor_id;
        $deleteData = Sponsor::where('id', $id)->delete();
        return redirect()->route('admin.sponsor')->with(['message' => "Sponsor berhasil dihapus"]);
    }
}
