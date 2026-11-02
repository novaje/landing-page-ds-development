<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataPesanan;
use App\Http\Controllers\Admin\MasterDataAddOnController;
use App\Http\Controllers\Admin\MasterDataPaketJerseyController;
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
        $dt_add_on = MasterDataAddOnController::getAddOnData();
        $dt_paket_jersey = MasterDataPaketJerseyController::getPaketJerseyData();
        $data = [
            'dt_pesanan' => $dt_pesanan,
            'kode_pesanan' => $this->generateKode(),
            'dt_add_on' => $dt_add_on,
            'dt_paket_jersey' => $dt_paket_jersey
        ];

        return view('admin.DataPesanan', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePesanan(Request $request)
    {
        $request->validate([
            'tgl_pesanan' => 'required|date',
            'kode_pesanan' => 'required',
            'nama_team' => 'required|string|max:255',
            'jenis_pesanan' => 'required|string|max:255',
            'qty_pesanan' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:999999999999',
            'dp_masuk' => 'required|numeric|min:0|max:999999999999',
            'tgl_selesai' => 'required|date',
            'tgl_pelunasan' => 'nullable|date',
            'nominal_pelunasan' => 'nullable|numeric|min:0|max:999999999999',
            'status_order' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:255',
            'total_order' => 'required|numeric|min:0|max:999999999999',
            'harga_netto' => 'required|numeric|min:0|max:999999999999',
            'total_hpp' => 'required|numeric|min:0|max:999999999999',
            'laba_kotor' => 'required|numeric|min:0|max:999999999999',
            'sisa_piutang' => 'required|numeric|min:0|max:999999999999',
        ]);

        // Process add-on data
        $addOnData = [];
        if ($request->has('addon_name')) {
            foreach ($request->addon_name as $key => $name) {
                if ($name && isset($request->addon_qty[$key])) {
                    $addOnData[] = $name . ' (Qty: ' . $request->addon_qty[$key] . ')';
                }
            }
        }
        $addOnString = implode(', ', $addOnData);

        DataPesanan::create([
            'tgl_pesanan' => $request->tgl_pesanan,
            'kode_pesanan' => $request->kode_pesanan,
            'nama_team' => $request->nama_team,
            'jenis_pesanan' => $request->jenis_pesanan,
            'qty_pesanan' => $request->qty_pesanan,
            'add_on_pesanan' => $addOnString ?: null,
            'dp_pembayaran' => $request->diskon ?? 0,
            'dp_masuk' => $request->dp_masuk,
            'tgl_selesai' => $request->tgl_selesai,
            'tgl_pelunasan' => $request->tgl_pelunasan,
            'nominal_pelunasan' => $request->nominal_pelunasan,
            'status_order' => $request->status_order,
            'status_pesanan' => $request->status_pesanan,
            'total_order' => $request->total_order,
            'harga_netto' => $request->harga_netto,
            'total_hpp' => $request->total_hpp,
            'laba_kotor' => $request->laba_kotor,
            'sisa_piutang' => $request->sisa_piutang
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
            'tgl_pesanan' => 'required|date',
            'kode_pesanan' => 'required',
            'nama_team' => 'required|string|max:255',
            'jenis_pesanan' => 'required|string|max:255',
            'qty_pesanan' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:999999999999',
            'dp_masuk' => 'required|numeric|min:0|max:999999999999',
            'tgl_selesai' => 'required|date',
            'tgl_pelunasan' => 'nullable|date',
            'nominal_pelunasan' => 'nullable|numeric|min:0|max:999999999999',
            'status_order' => 'required|string|max:255',
            'status_pesanan' => 'required|string|max:255',
            'total_order' => 'required|numeric|min:0|max:999999999999',
            'harga_netto' => 'required|numeric|min:0|max:999999999999',
            'total_hpp' => 'required|numeric|min:0|max:999999999999',
            'laba_kotor' => 'required|numeric|min:0|max:999999999999',
            'sisa_piutang' => 'required|numeric|min:0|max:999999999999',
        ]);

        // Process add-on data
        $addOnData = [];
        if ($request->has('addon_name')) {
            foreach ($request->addon_name as $key => $name) {
                if ($name && isset($request->addon_qty[$key])) {
                    $addOnData[] = $name . ' (Qty: ' . $request->addon_qty[$key] . ')';
                }
            }
        }
        $addOnString = implode(', ', $addOnData);

        $update_pesanan->nama_team = $request->nama_team;
        $update_pesanan->jenis_pesanan = $request->jenis_pesanan;
        $update_pesanan->qty_pesanan = $request->qty_pesanan;
        $update_pesanan->add_on_pesanan = $addOnString ?: null;
        $update_pesanan->dp_pembayaran = $request->diskon ?? 0;
        $update_pesanan->dp_masuk = $request->dp_masuk;
        $update_pesanan->tgl_selesai = $request->tgl_selesai;
        $update_pesanan->tgl_pelunasan = $request->tgl_pelunasan;
        $update_pesanan->nominal_pelunasan = $request->nominal_pelunasan;
        $update_pesanan->status_order = $request->status_order;
        $update_pesanan->status_pesanan = $request->status_pesanan;
        $update_pesanan->total_order = $request->total_order;
        $update_pesanan->harga_netto = $request->harga_netto;
        $update_pesanan->total_hpp = $request->total_hpp;
        $update_pesanan->laba_kotor = $request->laba_kotor;
        $update_pesanan->sisa_piutang = $request->sisa_piutang;
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
