<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KoleksiWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtKoleksi()
    {
        $dt_koleksi = DataKoleksi::all();
        $data = [
            'dt_koleksi' => $dt_koleksi
        ];
        return view('website.koleksi-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeKoleksi(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        DataKoleksi::create([
            'judul' => $request->judul,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'upload_gambar' => $upload_gambar->getClientOriginalName(),
        ]);

        return redirect()->route('koleksi')->with('success', 'Data Koleksi Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit_koleksi = DataKoleksi::find($id);
        $data = [
            'title' => 'Edit Data Koleksi',
            'edit_koleksi' => $edit_koleksi
        ];
        return view('website.koleksi-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateKoleksi(Request $request, $id)
    {
        $update_koleksi = DataKoleksi::find($id);
        $request -> validate([
            'judul' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        $update_koleksi->judul = $request->judul;
        $update_koleksi->harga = $request->harga;
        $update_koleksi->deskripsi = $request->deskripsi;
        $update_koleksi->upload_gambar = $upload_gambar->getClientOriginalName();
        $update_koleksi->save();

        return redirect()->route('koleksi')->with('success', 'Data Koleksi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete_koleksi = DataKoleksi::find($id);
        $delete_koleksi->delete();
        return redirect()->route('koleksi')->with('success', 'Data Koleksi Berhasil Dihapus');
    }
}
