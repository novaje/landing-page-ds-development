<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataPesanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPesananController extends Controller
{

    private function generateKode()
    {
        $lastData = DataPesanan::orderBy('id_pesanan', 'desc')->first();

        if ($lastData) {
            $lastKode = $lastData->kode_pesanan;
            $lastNumber = (int) substr($lastKode, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'DS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display a listing of the resource.
     */
    public function dtPesanan()
    {
        $dt_pesanan = DataPesanan::all();
        $data = [
            'dt_pesanan' => $dt_pesanan,
            'kode_pesanan' => $this->generateKode()
        ];

        return view('admin.DataPesanan', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePesanan(Request $request)
    {
        $request->validate([
            'tgl_pesanan' => 'required|string|max:255',
            'kode_pesanan' => 'required',
            'nama_team' => 'required|string|max:255',
            'jenis_pesanan' => 'required|string|max:255',
            'qty_pesanan' => 'required|integer|min:1',
            'total_modal_pesanan' => 'required|numeric|min:0|max:999999999999',
            'total_jual' => 'required|numeric|min:0|max:999999999999',
            'sisa' => 'required|numeric|min:0|max:999999999999',
            'status_pesanan' => 'required|string|max:255'
        ]);

        DataPesanan::create([
            'tgl_pesanan' => $request->tgl_pesanan,
            'kode_pesanan' => $request->kode_pesanan,
            'nama_team' => $request->nama_team,
            'jenis_pesanan' => $request->jenis_pesanan,
            'qty_pesanan' => $request->qty_pesanan,
            'total_modal_pesanan' => $request->total_modal_pesanan,
            'total_jual' => $request->total_jual,
            'sisa' => $request->sisa,
            'status_pesanan' => $request->status_pesanan
        ]);

        return redirect()->route('datapesanan')->with('success', 'Data Pesanan Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPesanan($id_pesanan)
    {
        $edit_pesanan = DataPesanan::find($id_pesanan);
        $dt_pesanan = DataPesanan::all();
        $data = [
            "title" => "Edit Data Pesanan",
            "edit_pesanan" => $edit_pesanan,
            "dt_pesanan" => $dt_pesanan,
            "kode_pesanan" => $this->generateKode()
        ];

        return view('admin.DataPesanan', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePesanan(Request $request, $id_pesanan)
    {
        $update_pesanan = DataPesanan::find($id_pesanan);
        $request->validate([
            'tgl_pesanan' => 'required|string|max:255',
            'kode_pesanan' => 'required',
            'nama_team' => 'required|string|max:255',
            'jenis_pesanan' => 'required|string|max:255',
            'qty_pesanan' => 'required|integer|min:1',
            'total_modal_pesanan' => 'required|numeric|min:0|max:999999999999',
            'total_jual' => 'required|numeric|min:0|max:999999999999',
            'sisa' => 'required|numeric|min:0|max:999999999999',
            'status_pesanan' => 'required|string|max:255'
        ]);

        $update_pesanan->nama_team = $request->nama_team;
        $update_pesanan->jenis_pesanan = $request->jenis_pesanan;
        $update_pesanan->qty_pesanan = $request->qty_pesanan;
        $update_pesanan->total_modal_pesanan = $request->total_modal_pesanan;
        $update_pesanan->total_jual = $request->total_jual;
        $update_pesanan->sisa = $request->sisa;
        $update_pesanan->status_pesanan = $request->status_pesanan;
        $update_pesanan->save();

        return redirect()->route('datapesanan')->with('success', 'Data Pesanan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPesanan($id_pesanan)
    {
        $delete_pesanan = DataPesanan::find($id_pesanan);
        $delete_pesanan->delete();

        return redirect()->route('datapesanan')->with('success', 'Data Pesanan Berhasil Dihapus');
    }
}
