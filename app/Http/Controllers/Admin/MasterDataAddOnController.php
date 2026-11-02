<?php

namespace App\Http\Controllers\Admin;

use App\Models\MasterDataAddOn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterDataAddOnController extends Controller
{
    public function dtAddOn()
    {
        $dt_add_on = MasterDataAddOn::all();
        $data = [
            'title' => 'Master Data Add-On',
            'dt_add_on' => $dt_add_on,
        ];
        return view('admin.MasterDataAddOn', $data);
    }

    public static function getAddOnData()
    {
        return MasterDataAddOn::all();
    }

    public function storeAddOn(Request $request)
    {
        try {
            $request->validate([
                'nm_add_on' => 'required|string|max:255',
                'harga_jual' => 'required|numeric|min:0|max:999999999999',
                'modal_vendor' => 'required|numeric|min:0|max:999999999999',
                'catatan' => 'nullable|string|max:255',
            ]);

            MasterDataAddOn::create([
                'nm_add_on' => $request->nm_add_on,
                'harga_jual' => $request->harga_jual,
                'modal_vendor' => $request->modal_vendor,
                'catatan' => $request->catatan,
            ]);
            return redirect()->back()->with('success', 'Data Add-On berhasil disimpan.')->with('activeTab', 'addon');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data Add-On.');
        }
    }

    public function editAddOn($id)
    {
        $addOn = MasterDataAddOn::findOrFail($id);
        $data = [
            'title' => 'Edit Data Add-On',
            'addOn' => $addOn,
        ];
        return view('admin.MasterDataAddOn', $data);
    }

    public function updateAddOn(Request $request, $id)
    {
        try {
            $request->validate([
                'nm_add_on' => 'required|string|max:255',
                'harga_jual' => 'required|numeric|min:0|max:999999999999',
                'modal_vendor' => 'required|numeric|min:0|max:999999999999',
                'catatan' => 'nullable|string|max:255',
            ]);

            $addOn = MasterDataAddOn::findOrFail($id);
            $addOn->update([
                'nm_add_on' => $request->nm_add_on,
                'harga_jual' => $request->harga_jual,
                'modal_vendor' => $request->modal_vendor,
                'catatan' => $request->catatan,
            ]);
            return redirect()->back()->with('success', 'Data Add-On berhasil diperbarui.')->with('activeTab', 'addon');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data Add-On.');
        }
    }

    public function deleteAddOn($id)
    {
        try {
            $addOn = MasterDataAddOn::findOrFail($id);
            $addOn->delete();
            return redirect()->back()->with('success', 'Data Add-On berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Add-On.');
        }
    }
}
