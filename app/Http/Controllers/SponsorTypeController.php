<?php

namespace App\Http\Controllers;

use App\SponsorType;
use Illuminate\Http\Request;

class SponsorTypeController extends Controller
{
    public static function get() {
        return SponsorType::all();
    }
    public function store(Request $req) {
        $saveData = SponsorType::create([
            'name' => $req->name,
        ]);

        return redirect()->route('admin.sponsorType')->with([
            'message' => "Data berhasil ditambahkan"
        ]);
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $deleteData = SponsorType::where('id', $id)->delete();

        return redirect()->route('admin.sponsorType')->with([
            'message' => "Data berhasil dihapus"
        ]);
    }
    public function update(Request $req) {
        $id = $req->data_id;
        $updateData = SponsorType::find($id)->update([
            'name' => $req->name
        ]);

        return redirect()->route('admin.sponsorType')->with([
            'message' => "Data berhasil diubah"
        ]);
    }
}
