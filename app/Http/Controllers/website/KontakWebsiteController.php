<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontakWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtKontak()
    {
        $dt_kontak = DataKontak::all();
        $data = [
            'dt_kontak' => $dt_kontak
        ];
        return view('website.kontak-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeKontak(Request $request)
    {
        $request->validate([
            'nm_kontak' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pesan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        DataKontak::create([
            'nm_kontak' => $request->nm_kontak,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('kontak')->with('success', 'Data Kontak Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editKontak($id)
    {
        $edit_kontak = DataKontak::find($id);
        $data = [
            'title' => 'Edit Data Kontak',
            'edit_kontak' => $edit_kontak
        ];
        return view('website.kontak-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateKontak(Request $request, $id)
    {
        $update_kontak = DataKontak::find($id);
        $request -> validate([
            'nm_kontak' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pesan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $update_kontak->nm_kontak = $request->nm_kontak;
        $update_kontak->email = $request->email;
        $update_kontak->pesan = $request->pesan;
        $update_kontak->alamat = $request->alamat;
        $update_kontak->save();

        return redirect()->route('kontak')->with('success', 'Data Kontak Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyKontak($id)
    {
        $delete_kontak = DataKontak::find($id);
        $delete_kontak->delete();

        return redirect()->route('kontak')->with('success', 'Data Kontak Berhasil Dihapus');
    }
}
