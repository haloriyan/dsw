<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
	public static function get($filter = NULL) {
		if ($filter == NULL) {
			return Faq::all();
		}
		return Faq::where($filter)->get();
    }

    public function create()
    {
        return view('admin.faq.create');
    }

	public function store(Request $req) {
		$validateData = $this->validate($req, [
			'question' => 'required',
			'answer' => 'required'
		]);

		$question = $req->question;
		$answer   = $req->answer;

		$saveData = Faq::create([
			'question' => $question,
			'answer' => $answer
		]);

		return redirect()->route('admin.faq')->with(['message' => "Data baru berhasil ditambahkan"]);
    }


    public function view($id)
    {
        $faq = Faq::where('id' , $id)->first();
        return view('admin.faq.view',['faq' => $faq]);
    }


	public function edit($id) {
		$faq = Faq::find($id);
		return view('admin.faq.edit')->with(['faq' => $faq]);
    }

	public function update(Request $req) {
		$id = $req->faq_id;

		$validateData = $this->validate($req, [
			'question' => 'required',
			'answer' => 'required'
		]);

		$question = $req->question;
		$answer   = $req->answer;

		$saveData = Faq::where('id', $id)
		->update([
			'question' => $question,
			'answer' => $answer
		]);
		return redirect()->route('admin.faq')->with(['message' => "Data berhasil diubah"]);
    }

	public function delete($id) {
        Faq::where('id', $id)->delete();
        return redirect()->route('admin.faq')->with(['message' => "Data berhasil dihapus"]);
	}
}
