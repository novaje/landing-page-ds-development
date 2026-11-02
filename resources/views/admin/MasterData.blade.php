@extends('admin.layouts.dashboard')
@section('title', 'Master Data Paket Jersey')
@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div>
        <h4 class="text-lg font-bold text-white">Master Data Management</h4>
        <p class="text-xs text-slate-400 mt-1">Kelola data master untuk sistem</p>
    </div>

    <!-- Master Navigation Tabs -->
    <div class="flex border-b border-slate-800 gap-4 text-xs font-bold">
        <button onclick="switchMasterTab('paket')" id="tab-master-paket" class="pb-3 border-b-2 border-blue-500 text-blue-400 transition-colors">Master Paket Jersey</button>
        <button onclick="switchMasterTab('addon')" id="tab-master-addon" class="pb-3 border-b-2 border-transparent text-slate-400 hover:text-white transition-colors">Master Add-On</button>
        <button onclick="switchMasterTab('fixedcost')" id="tab-master-fixedcost" class="pb-3 border-b-2 border-transparent text-slate-400 hover:text-white transition-colors">Fixed Cost Operasional</button>
    </div>

    <!-- Master Paket View -->
    <div id="master-sub-paket" class="space-y-4">
        <div class="flex justify-between items-center">
            <h4 class="text-sm font-bold text-white">Katalog Paket Apparel</h4>
            <button onclick="openPaketModal()" class="py-1.5 px-3 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs flex items-center gap-1">
                <i class="fa-solid fa-plus"></i> Paket Baru
            </button>
        </div>
        <div class="glass-panel rounded-xl border border-slate-800 overflow-hidden">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-900 text-slate-400 uppercase font-bold border-b border-slate-800">
                    <tr>
                        <th class="p-3">Nama Paket</th>
                        <th class="p-3 text-right">Harga Jual / pcs</th>
                        <th class="p-3 text-right">Modal Vendor / pcs</th>
                        <th class="p-3 text-right">Ongkir / pcs</th>
                        <th class="p-3 text-right">Margin / pcs</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($dt_paket_jersey as $paket)
                    <tr class="hover:bg-slate-800/30 transition-colors">
                        <td class="p-3 font-semibold text-white">{{ $paket->nm_paket }}</td>
                        <td class="p-3 text-right font-mono">{{ number_format($paket->harga_jual, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-mono text-slate-400">{{ number_format($paket->modal_vendor, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-mono text-slate-400">{{ number_format($paket->ongkir_pcs, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-mono">
                            <span class="{{ $paket->margin_pcs >= 25000 ? 'text-emerald-400' : ($paket->margin_pcs >= 15000 ? 'text-amber-400' : 'text-rose-400') }}">
                                {{ number_format($paket->margin_pcs, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditPaketModal({{ $paket->id_paket }}, '{{ $paket->nm_paket }}', {{ $paket->harga_jual }}, {{ $paket->modal_vendor }}, {{ $paket->ongkir_pcs }}, {{ $paket->margin_pcs }})" class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('deletePaketJersey', $paket->id_paket) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 transition-colors" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-400">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-solid fa-box-open text-2xl text-slate-600"></i>
                                <span>Belum ada data paket jersey</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Master Add-On View -->
    <div id="master-sub-addon" class="hidden space-y-4">
        <div class="flex justify-between items-center">
            <h4 class="text-sm font-bold text-white">Katalog Variation & Add-On</h4>
            <button onclick="openAddonModal()" class="py-1.5 px-3 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs flex items-center gap-1">
                <i class="fa-solid fa-plus"></i> Add-On Baru
            </button>
        </div>
        <div class="glass-panel rounded-xl border border-slate-800 overflow-hidden">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-900 text-slate-400 uppercase font-bold border-b border-slate-800">
                    <tr>
                        <th class="p-3">Nama Add-On</th>
                        <th class="p-3 text-right">Harga Jual / pcs</th>
                        <th class="p-3 text-right">Modal Vendor / pcs</th>
                        <th class="p-3">Catatan</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($dt_add_on as $addon)
                    <tr class="hover:bg-slate-800/30 transition-colors">
                        <td class="p-3 font-semibold text-white">{{ $addon->nm_add_on }}</td>
                        <td class="p-3 text-right font-mono">{{ number_format($addon->harga_jual, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-mono text-slate-400">{{ number_format($addon->modal_vendor, 0, ',', '.') }}</td>
                        <td class="p-3 text-slate-400">{{ $addon->catatan ?? '-' }}</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditAddonModal({{ $addon->id_add_on }}, '{{ $addon->nm_add_on }}', {{ $addon->harga_jual }}, {{ $addon->modal_vendor }}, '{{ $addon->catatan ?? '' }}')" class="p-2 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('deleteAddOn', $addon->id_add_on) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus add-on ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 transition-colors" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-slate-400">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-solid fa-box-open text-2xl text-slate-600"></i>
                                <span>Belum ada data add-on</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Master Fixed Cost View -->
    <div id="master-sub-fixedcost" class="hidden space-y-4">
        <div class="glass-panel p-6 rounded-2xl border border-slate-800 max-w-xl">
            <h4 class="text-sm font-bold text-white mb-4">Pengaturan Fixed Cost Bulanan</h4>
            <form class="space-y-4 text-xs">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Gaji Karyawan (Rp)</label>
                    <input type="number" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Gaji Desainer (Rp)</label>
                    <input type="number" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Operasional Toko & Utility (Rp)</label>
                    <input type="number" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="pt-2 border-t border-slate-800 flex justify-between items-center">
                    <div>
                        <span class="text-slate-400 block">Total Fixed Cost:</span>
                        <span class="text-base font-extrabold text-amber-400">Rp 0</span>
                    </div>
                    <button type="submit" class="py-2 px-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg shadow">
                        Simpan Fixed Cost
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div id="paketModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-lg max-h-[90vh] flex flex-col shadow-2xl">
        <div class="p-5 border-b border-slate-800 flex justify-between items-center bg-slate-900/90 rounded-t-2xl">
            <h3 id="paketModalTitle" class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-shirt text-blue-400"></i> Tambah Paket Jersey Baru
            </h3>
            <button onclick="closePaketModal()" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="paketForm" action="{{ route('storePaketJersey') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1 text-xs">
            @csrf
            <input type="hidden" name="id" id="paketId" value="">
            <input type="hidden" name="_method" id="paketMethod" value="POST">

            <div>
                <label class="block text-slate-400 mb-1 font-semibold">Nama Paket *</label>
                <input type="text" name="nm_paket" id="nm_paket" required placeholder="Contoh: Paket Premium Jersey" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Harga Jual / pcs (Rp) *</label>
                    <input type="number" name="harga_jual" id="harga_jual" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Modal Vendor / pcs (Rp) *</label>
                    <input type="number" name="modal_vendor" id="modal_vendor" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Ongkir / pcs (Rp) *</label>
                    <input type="number" name="ongkir_pcs" id="ongkir_pcs" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Margin / pcs (Rp) *</label>
                    <input type="number" name="margin_pcs" id="margin_pcs" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                <button type="button" onclick="closePaketModal()" class="py-2 px-4 rounded-lg bg-slate-800 hover:bg-slate-700 text-white font-semibold transition-colors">
                    Batal
                </button>
                <button type="submit" id="paketSubmitBtn" class="py-2 px-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg shadow-lg shadow-blue-600/30 transition-all">
                    Simpan Paket
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Add-On -->
<div id="addonModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-lg max-h-[90vh] flex flex-col shadow-2xl">
        <div class="p-5 border-b border-slate-800 flex justify-between items-center bg-slate-900/90 rounded-t-2xl">
            <h3 id="addonModalTitle" class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-blue-400"></i> Tambah Add-On Baru
            </h3>
            <button onclick="closeAddonModal()" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="addonForm" action="{{ route('storeAddOn') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1 text-xs">
            @csrf
            <input type="hidden" name="id" id="addonId" value="">
            <input type="hidden" name="_method" id="addonMethod" value="POST">

            <div>
                <label class="block text-slate-400 mb-1 font-semibold">Nama Add-On *</label>
                <input type="text" name="nm_add_on" id="nm_add_on" required placeholder="Contoh: Nama Custom" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Harga Jual / pcs (Rp) *</label>
                    <input type="number" name="harga_jual" id="harga_jual_addon" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Modal Vendor / pcs (Rp) *</label>
                    <input type="number" name="modal_vendor" id="modal_vendor_addon" required min="0" placeholder="0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-slate-400 mb-1 font-semibold">Catatan</label>
                <textarea name="catatan" id="catatan" rows="3" placeholder="Catatan tambahan..." class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                <button type="button" onclick="closeAddonModal()" class="py-2 px-4 rounded-lg bg-slate-800 hover:bg-slate-700 text-white font-semibold transition-colors">
                    Batal
                </button>
                <button type="submit" id="addonSubmitBtn" class="py-2 px-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg shadow-lg shadow-blue-600/30 transition-all">
                    Simpan Add-On
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function switchMasterTab(tab) {
    // Hide all sections
    document.getElementById('master-sub-paket').classList.add('hidden');
    document.getElementById('master-sub-addon').classList.add('hidden');
    document.getElementById('master-sub-fixedcost').classList.add('hidden');

    // Reset all tabs
    document.getElementById('tab-master-paket').classList.remove('border-blue-500', 'text-blue-400');
    document.getElementById('tab-master-paket').classList.add('border-transparent', 'text-slate-400');
    document.getElementById('tab-master-addon').classList.remove('border-blue-500', 'text-blue-400');
    document.getElementById('tab-master-addon').classList.add('border-transparent', 'text-slate-400');
    document.getElementById('tab-master-fixedcost').classList.remove('border-blue-500', 'text-blue-400');
    document.getElementById('tab-master-fixedcost').classList.add('border-transparent', 'text-slate-400');

    // Show selected section and activate tab
    document.getElementById('master-sub-' + tab).classList.remove('hidden');
    document.getElementById('tab-master-' + tab).classList.remove('border-transparent', 'text-slate-400');
    document.getElementById('tab-master-' + tab).classList.add('border-blue-500', 'text-blue-400');
}

// Check for activeTab from session and switch to that tab
document.addEventListener('DOMContentLoaded', function() {
    @if(session('activeTab'))
        switchMasterTab('{{ session('activeTab') }}');
    @endif
});

function openPaketModal() {
    document.getElementById('paketModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    document.getElementById('paketModalTitle').innerHTML = '<i class="fa-solid fa-shirt text-blue-400"></i> Tambah Paket Jersey Baru';
    document.getElementById('paketSubmitBtn').textContent = 'Simpan Paket';
    document.getElementById('paketForm').action = '{{ route('storePaketJersey') }}';
    document.getElementById('paketMethod').value = 'POST';
    document.getElementById('paketId').value = '';
    document.getElementById('nm_paket').value = '';
    document.getElementById('harga_jual').value = '';
    document.getElementById('modal_vendor').value = '';
    document.getElementById('ongkir_pcs').value = '';
    document.getElementById('margin_pcs').value = '';
}

function openEditPaketModal(id, nm_paket, harga_jual, modal_vendor, ongkir_pcs, margin_pcs) {
    document.getElementById('paketModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    document.getElementById('paketModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square text-blue-400"></i> Edit Paket Jersey';
    document.getElementById('paketSubmitBtn').textContent = 'Update Paket';
    document.getElementById('paketForm').action = '/master-data-paket-jersey/' + id;
    document.getElementById('paketMethod').value = 'PUT';
    document.getElementById('paketId').value = id;
    document.getElementById('nm_paket').value = nm_paket;
    document.getElementById('harga_jual').value = harga_jual;
    document.getElementById('modal_vendor').value = modal_vendor;
    document.getElementById('ongkir_pcs').value = ongkir_pcs;
    document.getElementById('margin_pcs').value = margin_pcs;
}

function closePaketModal() {
    document.getElementById('paketModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openAddonModal() {
    document.getElementById('addonModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    document.getElementById('addonModalTitle').innerHTML = '<i class="fa-solid fa-plus-circle text-blue-400"></i> Tambah Add-On Baru';
    document.getElementById('addonSubmitBtn').textContent = 'Simpan Add-On';
    document.getElementById('addonForm').action = '{{ route('storeAddOn') }}';
    document.getElementById('addonMethod').value = 'POST';
    document.getElementById('addonId').value = '';
    document.getElementById('nm_add_on').value = '';
    document.getElementById('harga_jual_addon').value = '';
    document.getElementById('modal_vendor_addon').value = '';
    document.getElementById('catatan').value = '';
}

function openEditAddonModal(id, nm_add_on, harga_jual, modal_vendor, catatan) {
    document.getElementById('addonModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    document.getElementById('addonModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square text-blue-400"></i> Edit Add-On';
    document.getElementById('addonSubmitBtn').textContent = 'Update Add-On';
    document.getElementById('addonForm').action = '/master-data-add-on/' + id;
    document.getElementById('addonMethod').value = 'PUT';
    document.getElementById('addonId').value = id;
    document.getElementById('nm_add_on').value = nm_add_on;
    document.getElementById('harga_jual_addon').value = harga_jual;
    document.getElementById('modal_vendor_addon').value = modal_vendor;
    document.getElementById('catatan').value = catatan;
}

function closeAddonModal() {
    document.getElementById('addonModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modals on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePaketModal();
        closeAddonModal();
    }
});
</script>
@endsection