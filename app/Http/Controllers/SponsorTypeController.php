<?php

namespace App\Http\Controllers;

use App\SponsorType;

use Illuminate\Http\Request;
use \App\Http\Controllers\AdminController as AdminCtrl;

class SponsorTypeController extends Controller
{
    public static function get() {
        return SponsorType::all();
    }

    public function create()
    {
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);

        return view('admin.sponsorType.create', [
            'menus' => $menus,
            'myData' => $myData,
        ]);
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
        $myData = AdminCtrl::me();
        $menus = AdminCtrl::getMenus($myData->role);
		$SponsorType = SponsorType::find($id);

		return view('admin.SponsorType.edit')->with([
            'sponsorType' => $SponsorType,
            'myData' => $myData,
            'menus' => $menus,
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
