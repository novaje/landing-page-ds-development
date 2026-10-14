<?php

namespace App\Http\Controllers\website;

use App\Models\TentangWebsite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TentangWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dtTentang()
    {
        $dt_tentang = TentangWebsite::all();
        $data = [
            'dt_tentang' => $dt_tentang
        ];

        return view('website.tentang-website', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTentang(Request $request)
    {
        $request->validate([
           'judul' => 'required|string|max:255',
           'deskripsi' => 'required|string|max:255',
           'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        TentangWebsite::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'upload_gambar' => $upload_gambar->getClientOriginalName(),
        ]);

        return redirect()->route('tentang')->with('success', 'Data Tentang Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTentang($id)
    {
        $edit_tentang = TentangWebsite::find($id);
        $data = [
            'title' => 'Edit Data Tentang',
            'edit_tentang' => $edit_tentang
        ];
        return view('website.tentang-website', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTentang(Request $request, $id)
    {
        $update_tentang = TentangWebsite::find($id);
        $request -> validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $upload_gambar = $request->file('upload_gambar');
        $upload_gambar->move(public_path('images'), $upload_gambar->getClientOriginalName());

        $update_tentang->judul = $request->judul;
        $update_tentang->deskripsi = $request->deskripsi;
        $update_tentang->upload_gambar = $upload_gambar->getClientOriginalName();
        $update_tentang->save();

        return redirect()->route('tentang')->with('success', 'Data Tentang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyTentang(string $id)
    {
        $delete_tentang = TentangWebsite::find($id);
        $delete_tentang->delete();

        return redirect()->route('tentang')->with('success', 'Data Tentang Berhasil Dihapus');
    }
}
