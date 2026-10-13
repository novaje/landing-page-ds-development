<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtBeranda()
    {
        $dt_beranda = DataBeranda::all();
        $data = [
            'dt_beranda' => $dt_beranda
        ];

        return view('website.beranda-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBeranda(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        DataBeranda::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'upload_gambar' => $upload_gambar->getClientOriginalName(),
        ]);

        return redirect()->route('beranda')->with('success', 'Data Beranda Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editBeranda($id)
    {
        $edit_beranda = DataBeranda::find($id);
        $data = [
            'title' => 'Edit Data Beranda',
            'edit_beranda' => $edit_beranda,
        ];
        return view('website.beranda-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBeranda(Request $request, string $id)
    {
        $update_beranda = DataBeranda::find($id);
        $request -> validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        $update_beranda->judul = $request->judul;
        $update_beranda->deskripsi = $request->deskripsi;
        $update_beranda->upload_gambar = $upload_gambar->getClientOriginalName();
        $update_beranda->save();

        return redirect()->route('beranda')->with('success', 'Data Beranda Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyBeranda(string $id)
    {
        $delete_beranda = DataBeranda::find($id);
        $delete_beranda->delete();

        return redirect()->route('beranda')->with('success', 'Data Beranda Berhasil Dihapus');
    }
}
