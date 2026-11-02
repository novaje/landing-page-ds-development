<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataProduk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataProdukController extends Controller
{
    private function generateKode()
    {
        $lastData = DataProduk::orderBy('id_produk', 'desc')->first();
        if ($lastData) {
            $lastKode = $lastData->kode_produk;
            $lastNumber = (int) substr($lastKode, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'P' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function dtProduk()
    {
        $dt_produk = DataProduk::all();
        $data = [
            'dt_produk' => $dt_produk,
            'kode_produk' => $this->generateKode()
        ];
        return view('admin.DataProduk', $data);
    }

    public function storeProduk(Request $request)
    {
        try {
            $request->validate([
                'nm_produk' => 'required|string|max:255',
                'nm_bahan' => 'required|string|max:255',
                'ukuran' => 'required|string|max:255',
                'harga_jual' => 'required|numeric|min:0|max:999999999999',
                'motif' => 'required|string|max:255',
                'stok' => 'required|integer',
                'status' => 'required|string|max:255',
                'sisa' => 'required|integer',
                'upload_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $fileName = '';
            if ($request->hasFile('upload_gambar')) {
                $upload_gambar = $request->file('upload_gambar');
                $fileName = time() . '_' . $upload_gambar->getClientOriginalName();
                $upload_gambar->move(public_path('images'), $fileName);
            }

            DataProduk::create([
                'kode_produk' => $this->generateKode(),
                'nm_produk' => $request->nm_produk,
                'nm_bahan' => $request->nm_bahan,
                'ukuran' => $request->ukuran,
                'harga_jual' => $request->harga_jual,
                'motif' => $request->motif,
                'stok' => $request->stok,
                'status' => $request->status,
                'sisa' => $request->sisa,
                'upload_gambar' => $fileName,
            ]);

            return redirect()->route('dtProduk')->with('success', 'Data Produk Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('dtProduk')->with('error', 'Gagal menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function editProduk($id_produk)
    {
        $edit_produk = DataProduk::find($id_produk);
        $data = [
            'title' => 'Edit Data Produk',
            'edit_produk' => $edit_produk,
        ];
        return view('admin.DataProduk', $data);
    }

    public function updateProduk(Request $request, string $id_produk)
    {
        $update_produk = DataProduk::find($id_produk);
        $request->validate([
            'nm_produk' => 'required|string|max:255',
            'nm_bahan' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0|max:999999999999',
            'motif' => 'required|string|max:255',
            'stok' => 'required|integer',
            'status' => 'required|string|max:255',
            'sisa' => 'required|integer',
            'upload_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = $update_produk->upload_gambar;
        if ($request->hasFile('upload_gambar')) {
            $upload_gambar = $request->file('upload_gambar');
            $fileName = time() . '_' . $upload_gambar->getClientOriginalName();
            $upload_gambar->move(public_path('images'), $fileName);
        }

        $update_produk->update([
            'nm_produk' => $request->nm_produk,
            'nm_bahan' => $request->nm_bahan,
            'ukuran' => $request->ukuran,
            'harga_jual' => $request->harga_jual,
            'motif' => $request->motif,
            'stok' => $request->stok,
            'status' => $request->status,
            'sisa' => $request->sisa,
            'upload_gambar' => $fileName,
        ]);

        return redirect()->route('dtProduk')->with('success', 'Data Produk Berhasil Diubah');
    }

    public function destroyProduk($id_produk)
    {
        $delete_produk = DataProduk::find($id_produk);
        $delete_produk->delete();

        return redirect()->route('dtProduk')->with('success', 'Data Produk Berhasil Dihapus');
    }
}
