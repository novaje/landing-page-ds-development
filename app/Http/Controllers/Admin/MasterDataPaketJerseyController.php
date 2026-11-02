<?php

namespace App\Http\Controllers\Admin;

use App\Models\MasterDataPaketJersey;
use App\Http\Controllers\Admin\MasterDataAddOnController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterDataPaketJerseyController extends Controller
{
    public function dtPaketJersey()
    {
        $dt_paket_jersey = MasterDataPaketJersey::all();
        $dt_add_on = MasterDataAddOnController::getAddOnData();
        $data = [
            'dt_paket_jersey' => $dt_paket_jersey,
            'dt_add_on' => $dt_add_on,
        ];
        return view('admin.MasterData', $data);
    }

    public static function getPaketJerseyData()
    {
        return MasterDataPaketJersey::all();
    }

    public function storePaketJersey(Request $request)
    {
        try {
            $request->validate([
                'nm_paket' => 'required|string|max:255',
                'harga_jual' => 'required|numeric|min:0|max:999999999999',
                'modal_vendor' => 'required|numeric|min:0|max:999999999999',
                'ongkir_pcs' => 'required|numeric|min:0|max:999999999999',
                'margin_pcs' => 'required|numeric|min:0|max:999999999999',
            ]);

            MasterDataPaketJersey::create([
                'nm_paket' => $request->nm_paket,
                'harga_jual' => $request->harga_jual,
                'modal_vendor' => $request->modal_vendor,
                'ongkir_pcs' => $request->ongkir_pcs,
                'margin_pcs' => $request->margin_pcs,
            ]);
            return redirect()->back()->with('success', 'Data Paket Jersey berhasil disimpan.')->with('activeTab', 'paket');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data Paket Jersey.');
        }
    }

    public function editPaketJersey($id)
    {
        $paketJersey = MasterDataPaketJersey::findOrFail($id);
        $data = [
            'title' => 'Edit Data Paket Jersey',
            'paketJersey' => $paketJersey,
        ];
        return view('admin.MasterData', $data);
    }

    public function updatePaketJersey(Request $request, $id)
    {
        try {
            $request->validate([
                'nm_paket' => 'required|string|max:255',
                'harga_jual' => 'required|numeric|min:0|max:999999999999',
                'modal_vendor' => 'required|numeric|min:0|max:999999999999',
                'ongkir_pcs' => 'required|numeric|min:0|max:999999999999',
                'margin_pcs' => 'required|numeric|min:0|max:999999999999',
            ]);

            $paketJersey = MasterDataPaketJersey::findOrFail($id);
            $paketJersey->update([
                'nm_paket' => $request->nm_paket,
                'harga_jual' => $request->harga_jual,
                'modal_vendor' => $request->modal_vendor,
                'ongkir_pcs' => $request->ongkir_pcs,
                'margin_pcs' => $request->margin_pcs,
            ]);
            return redirect()->back()->with('success', 'Data Paket Jersey berhasil diperbarui.')->with('activeTab', 'paket');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data Paket Jersey.');
        }
    }

    public function deletePaketJersey($id)
    {
        try {
            $paketJersey = MasterDataPaketJersey::findOrFail($id);
            $paketJersey->delete();
            return redirect()->back()->with('success', 'Data Paket Jersey berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Paket Jersey.');
        }
    }
}
