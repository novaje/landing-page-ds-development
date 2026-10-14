<?php

namespace App\Http\Controllers\website;

use App\Models\KlienWebsite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KlienWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtKlien()
    {
        $dt_klien = KlienWebsite::all();
        $data = [
            'dt_klien' => $dt_klien
        ];
        return view('website.klien-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeKlien(Request $request)
    {
        $request->validate([
            'nm_klien' => 'required|string|max:255',
            'nm_team' => 'required|string|max:255',
        ]);

        KlienWebsite::create([
            'nm_klien' => $request->nm_klien,
            'nm_team' => $request->nm_team,
        ]);

        return redirect()->route('klien')->with('success', 'Data Klien Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editKlien($id)
    {
        $edit_klien = KlienWebsite::find($id);
        $data = [
            'title' => 'Edit Data Klien',
            'edit_klien' => $edit_klien
        ];
        return view('website.klien-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateKlien(Request $request, $id)
    {
        $update_klien = KlienWebsite::find($id);
        $request -> validate([
            'nm_klien' => 'required|string|max:255',
            'nm_team' => 'required|string|max:255',
        ]);

        $update_klien->nm_klien = $request->nm_klien;
        $update_klien->nm_team = $request->nm_team;
        $update_klien->save();

        return redirect()->route('klien')->with('success', 'Data Klien Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyKlien($id)
    {
        $delete_klien = KlienWebsite::find($id);
        $delete_klien->delete();

        return redirect()->route('klien')->with('success', 'Data Klien Berhasil Dihapus');
    }
}
