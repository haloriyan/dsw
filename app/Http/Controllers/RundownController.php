<?php

namespace App\Http\Controllers;

use App\Rundown;
use Illuminate\Http\Request;

class RundownController extends Controller
{
    public function store(Request $req) {
        $saveData = Rundown::create([
            ''
        ]);

        return redirect()->route('admin')->with([
            'message' => "Data rundown berhasil ditambahkan"
        ]);
    }
    public function delete(Request $req) {
        $id = $req->data_id;
        $deleteData = Rundown::where('id', $id)->delete();
        
        return redirect()->route('admin')->with([
            'message' => "Data rundown berhasil dihapus"
        ]);
    }
}
