<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return Contact::all();
        }
        return Contact::where($filter)->get();
    }
    public function store(Request $req) {
        $saveData = Contact::create([
            'icon' => $req->icon,
            'name' => $req->name,
            'value' => $req->value,
        ]);
        
        return redirect()->route('admin.contact')->with(['message' => "Kontak berhasil ditambahkan"]);
    }
    public function delete(Request $req) {
        $id = $req->contact_id;
        $deleteData = Contact::where('id', $id)->delete();
        
        return redirect()->route('admin.contact')->with(['message' => "Kontak berhasil dihapus"]);
    }
}
