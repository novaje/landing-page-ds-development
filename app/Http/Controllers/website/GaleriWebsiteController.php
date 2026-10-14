<?php

namespace App\Http\Controllers\website;

use App\Models\GaleriWebsite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtGaleri()
    {
        $dt_galeri = GaleriWebsite::all();
        $data = [
            'dt_galeri' => $dt_galeri
        ];
        return view('website.galeri-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        GaleriWebsite::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'upload_gambar' => $upload_gambar->getClientOriginalName(),
        ]);

        return redirect()->route('galeri')->with('success', 'Data Galeri Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editGaleri($id)
    {
        $edit_galeri = GaleriWebsite::find($id);
        $data = [
            'edit_galeri' => $edit_galeri
        ];
        return view('website.edit-galeri-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGaleri(Request $request, $id)
    {
        $update_galeri = GaleriWebsite::find($id);
        $request -> validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        $update_galeri->judul = $request->judul;
        $update_galeri->deskripsi = $request->deskripsi;
        $update_galeri->upload_gambar = $upload_gambar->getClientOriginalName();
        $update_galeri->save();

        return redirect()->route('galeri')->with('success', 'Data Galeri Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyGaleri($id)
    {
        $delete_galeri = GaleriWebsite::find($id);
        $delete_galeri->delete();

        return redirect()->route('galeri')->with('success', 'Data Galeri Berhasil Dihapus');        
    }
}
