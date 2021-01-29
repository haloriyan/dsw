<?php

namespace App\Http\Controllers;

use App\SponsorType;
use Illuminate\Http\Request;

class SponsorTypeController extends Controller
{
    public static function get() {
        return SponsorType::all();
    }

    public function create()
    {
        return view('admin.sponsorType.create');
    }

    public function store(Request $req) {
        $saveData = SponsorType::create([
            'name' => $req->name,
        ]);

        return redirect()->route('admin.sponsorType')->with([
            'message' => "Data berhasil ditambahkan"
        ]);
    }

	public function edit($id) {
		$SponsorType = SponsorType::find($id);

		return view('admin.sponsorType.edit')->with([
			'sponsorType' => $SponsorType
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

    public function delete($id) {
        SponsorType::where('id', $id)->delete();
        return redirect()->route('admin.sponsorType')->with(['message' => "Data berhasil dihapus"]);
	}
}
