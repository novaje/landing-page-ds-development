@extends('admin.layouts.dashboard')
@section('title', 'PESANAN CUSTOM')
@section('content')

<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold text-white mb-0">PESANAN CUSTOM</h1>
        <button onclick="openModal()" class="py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg shadow-blue-600/30 transition-all">
            <i class="fa-solid fa-plus"></i> Tambah Pesanan
        </button>
    </div>
    <div class="glass-panel rounded-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="productTable" class="display">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Order</th>
                    <th>Kode</th>
                    <th>Nama Team</th>
                    <th>Paket</th>
                    <th>Qty</th>
                    <th>Add-On</th>
                    <th>DP Pembayaran</th>
                    <th>DP Masuk</th>
                    <th>Tgl Selesai</th>
                    <th>Tgl Pelunasan</th>
                    <th>Nominal Pelunasan</th>
                    <th>Status Order</th>
                    <th>Status Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                
                <tbody>
                    @foreach($dt_pesanan as $index => $pesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ date('d-m-Y', strtotime($pesanan->tgl_pesanan)) }}</td>
                        <td>{{ $pesanan->kode_pesanan }}</td>
                        <td>{{ $pesanan->nama_team }}</td>
                        <td>{{ $pesanan->jenis_pesanan }}</td>
                        <td>{{ $pesanan->qty_pesanan }}</td>
                        <td>{{ $pesanan->add_on_pesanan ?? '-' }}</td>
                        <td>{{ $pesanan->dp_pembayaran }}%</td>
                        <td>Rp {{ number_format($pesanan->dp_masuk, 0, ',', '.') }}</td>
                        <td>{{ $pesanan->tgl_selesai ? date('d-m-Y', strtotime($pesanan->tgl_selesai)) : '-' }}</td>
                        <td>{{ $pesanan->tgl_pelunasan ? date('d-m-Y', strtotime($pesanan->tgl_pelunasan)) : '-' }}</td>
                        <td>Rp {{ number_format($pesanan->nominal_pelunasan ?? 0, 0, ',', '.') }}</td>
                        <td>
                            @if($pesanan->status_order == 'Selesai')
                                <span class="px-2 py-1 text-xs bg-emerald-500/20 text-emerald-400 rounded">
                                    Selesai
                                </span>
                            @elseif($pesanan->status_order == 'Pending')
                                <span class="px-2 py-1 text-xs bg-amber-500/20 text-amber-400 rounded">
                                    Pending
                                </span>
                            @elseif($pesanan->status_order == 'Proses')
                                <span class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded">
                                    Proses
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-rose-500/20 text-rose-400 rounded">
                                    {{ $pesanan->status_order }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($pesanan->status_pesanan == 'Lunas')
                                <span class="px-2 py-1 text-xs bg-emerald-500/20 text-emerald-400 rounded">
                                    Lunas
                                </span>
                            @elseif($pesanan->status_pesanan == 'DP Masuk')
                                <span class="px-2 py-1 text-xs bg-amber-500/20 text-amber-400 rounded">
                                    DP Masuk
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-slate-500/20 text-slate-400 rounded">
                                    {{ $pesanan->status_pesanan }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('datapesanan.edit', $pesanan->id_pesanan) }}"
                            class="py-1.5 px-3 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold inline-flex items-center gap-1 mr-2">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('datapesanan.destroy', $pesanan->id_pesanan) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Hapus pesanan ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="py-1.5 px-3 rounded-lg bg-rose-600 hover:bg-rose-500 text-white text-xs font-semibold inline-flex items-center gap-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pesanan -->
<div id="modal-tambah-pesanan" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-3xl max-h-[90vh] flex flex-col shadow-2xl">
        <div class="p-5 border-b border-slate-800 flex justify-between items-center bg-slate-900/90 rounded-t-2xl">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-cart-plus text-blue-400"></i> Tambah Pesanan
            </h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-white p-1"><i class="fa-solid fa-xmark text-lg"></i></button>
        </div>

        <form action="{{ route('datapesanan.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1 text-xs">
            @csrf

            <!-- Row 1: Header Info -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Tanggal Pesanan *</label>
                    <input type="date" name="tgl_pesanan" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Kode Pesanan</label>
                    <input type="text" name="kode_pesanan" value="{{ $kode_pesanan }}" readonly class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white font-bold focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Nama Team *</label>
                    <input type="text" name="nama_team" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Row 2: Paket Selection & Pricing -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-xl bg-slate-950/60 border border-slate-800">
                <div class="sm:col-span-1">
                    <label class="block text-slate-400 mb-1 font-semibold">Jenis Paket *</label>
                    <select name="jenis_pesanan" id="jenis_pesanan" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                        <option value="">Pilih Jenis Paket</option>
                        @foreach($dt_paket_jersey as $paket)
                        <option value="{{ $paket->nm_paket }}" data-harga-jual="{{ $paket->harga_jual }}" data-modal-vendor="{{ $paket->modal_vendor }}" data-ongkir="{{ $paket->ongkir_pcs }}">{{ $paket->nm_paket }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Qty *</label>
                    <input type="number" name="qty_pesanan" id="qty_pesanan" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white font-bold text-center focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Diskon (Rp)</label>
                    <input type="number" name="diskon" id="diskon" value="0" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white font-bold text-center focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Add-On Section -->
            <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-slate-300">Detail Add-On Tambahan</span>
                    <button type="button" onclick="addAddonRow()" class="py-1 px-3 bg-slate-800 hover:bg-slate-700 text-blue-400 font-semibold rounded-lg flex items-center gap-1 text-[11px]">
                        <i class="fa-solid fa-plus"></i> Tambah Item Add-On
                    </button>
                </div>
                <div id="addon-container" class="space-y-2">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 addon-row">
                        <div>
                            <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Nama Add-On</label>
                            <select name="addon_name[]" class="addon-select w-full bg-slate-900 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500 text-[11px]">
                                <option value="" data-harga="0">Pilih Add-On</option>
                                @foreach($dt_add_on as $addon)
                                <option value="{{ $addon->nm_add_on }}" data-harga="{{ $addon->harga_jual }}">{{ $addon->nm_add_on }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Qty</label>
                            <input type="number" name="addon_qty[]" value="1" class="addon-qty w-full bg-slate-900 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500 text-[11px]">
                        </div>
                        <div class="flex items-end">
                            <button type="button" onclick="removeAddonRow(this)" class="py-2 px-3 bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 rounded-lg text-[11px]">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calculation Summary Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-blue-950/30 border border-blue-800">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Total Add-On</label>
                    <div id="total_addon" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-blue-400 font-bold text-center">Rp 0</div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Total Order (Omzet Netto)</label>
                    <div id="total_order" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-emerald-400 font-bold text-center">Rp 0</div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Harga Netto Pcs</label>
                    <div id="harga_netto" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-amber-400 font-bold text-center">Rp 0</div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Total HPP Produksi</label>
                    <div id="total_hpp" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-rose-400 font-bold text-center">Rp 0</div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Laba Kotor</label>
                    <div id="laba_kotor" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-emerald-400 font-bold text-center">Rp 0</div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Sisa Piutang</label>
                    <div id="sisa_piutang" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-amber-400 font-bold text-center">Rp 0</div>
                </div>
                <input type="hidden" name="total_order" id="total_order_input">
                <input type="hidden" name="harga_netto" id="harga_netto_input">
                <input type="hidden" name="total_hpp" id="total_hpp_input">
                <input type="hidden" name="laba_kotor" id="laba_kotor_input">
                <input type="hidden" name="sisa_piutang" id="sisa_piutang_input">
            </div>

            <!-- Payment & Target Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-slate-950/60 border border-slate-800">
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">DP Masuk (Nominal Rp) *</label>
                    <input type="number" name="dp_masuk" id="dp_masuk" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-emerald-400 font-bold focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Tanggal Selesai *</label>
                    <input type="date" name="tgl_selesai" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Tanggal Pelunasan</label>
                    <input type="date" name="tgl_pelunasan" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Nominal Pelunasan</label>
                    <input type="number" name="nominal_pelunasan" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-slate-400 mb-1 font-semibold">Status Order *</label>
                    <select name="status_order" required class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2.5 text-white focus:outline-none focus:border-blue-500">
                        <option value="">Pilih Status Order</option>
                        <option value="Pending">Pending</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="py-2 px-4 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold">Batal</button>
                <button type="submit" class="py-2 px-5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold shadow-lg shadow-blue-600/30">Simpan Pesanan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productTable').DataTable();
    });

    function openModal() {
        document.getElementById('modal-tambah-pesanan').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal-tambah-pesanan').classList.add('hidden');
    }

    function addAddonRow() {
        const container = document.getElementById('addon-container');
        const newRow = document.createElement('div');
        newRow.className = 'grid grid-cols-1 sm:grid-cols-3 gap-3 addon-row';
        newRow.innerHTML = `
            <div>
                <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Nama Add-On</label>
                <select name="addon_name[]" class="addon-select w-full bg-slate-900 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500 text-[11px]">
                    <option value="" data-harga="0">Pilih Add-On</option>
                    @foreach($dt_add_on as $addon)
                    <option value="{{ $addon->nm_add_on }}" data-harga="{{ $addon->harga_jual }}">{{ $addon->nm_add_on }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-slate-400 mb-1 font-semibold text-[11px]">Qty</label>
                <input type="number" name="addon_qty[]" value="1" class="addon-qty w-full bg-slate-900 border border-slate-800 rounded-lg p-2 text-white focus:outline-none focus:border-blue-500 text-[11px]">
            </div>
            <div class="flex items-end">
                <button type="button" onclick="removeAddonRow(this)" class="py-2 px-3 bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 rounded-lg text-[11px]">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newRow);
        attachAddonListeners();
    }

    function removeAddonRow(button) {
        const container = document.getElementById('addon-container');
        const rows = container.querySelectorAll('.addon-row');
        if (rows.length > 1) {
            button.closest('.addon-row').remove();
            calculateTotals();
        } else {
            alert('Minimal satu baris add-on harus tersedia');
        }
    }

    function attachAddonListeners() {
        document.querySelectorAll('.addon-select').forEach(select => {
            select.addEventListener('change', calculateTotals);
        });
        document.querySelectorAll('.addon-qty').forEach(input => {
            input.addEventListener('input', calculateTotals);
        });
    }

    function calculateTotals() {
        const jenisPaket = document.getElementById('jenis_pesanan');
        const qtyPesanan = parseFloat(document.getElementById('qty_pesanan').value) || 0;
        const diskon = parseFloat(document.getElementById('diskon').value) || 0;
        const dpMasuk = parseFloat(document.getElementById('dp_masuk').value) || 0;
        
        const selectedOption = jenisPaket.options[jenisPaket.selectedIndex];
        const hargaPaket = parseFloat(selectedOption?.dataset?.hargaJual) || 0;
        const modalVendor = parseFloat(selectedOption?.dataset?.modalVendor) || 0;
        const ongkir = parseFloat(selectedOption?.dataset?.ongkir) || 0;
        
        // Calculate Total Add-On
        let totalAddOn = 0;
        document.querySelectorAll('.addon-row').forEach(row => {
            const select = row.querySelector('.addon-select');
            const qty = parseFloat(row.querySelector('.addon-qty').value) || 0;
            const harga = parseFloat(select.options[select.selectedIndex].dataset.harga) || 0;
            totalAddOn += harga * qty;
        });
        
        // Total Order = Total Paket + Total Add-On - Diskon
        const totalPaket = hargaPaket * qtyPesanan;
        const totalOrder = totalPaket + totalAddOn - diskon;
        
        // Harga Netto Pcs = Total Order / Qty
        const hargaNetto = qtyPesanan > 0 ? totalOrder / qtyPesanan : 0;
        
        // Total HPP = (Modal Vendor + Ongkir) * Qty
        const totalHPP = (modalVendor + ongkir) * qtyPesanan;
        
        // Laba Kotor = Total Order - Total HPP
        const labaKotor = totalOrder - totalHPP;
        
        // Sisa Piutang = Total Order - DP Masuk
        const sisaPiutang = totalOrder - dpMasuk;
        
        // Update display
        document.getElementById('total_addon').textContent = 'Rp ' + totalAddOn.toLocaleString('id-ID');
        document.getElementById('total_order').textContent = 'Rp ' + totalOrder.toLocaleString('id-ID');
        document.getElementById('harga_netto').textContent = 'Rp ' + hargaNetto.toLocaleString('id-ID');
        document.getElementById('total_hpp').textContent = 'Rp ' + totalHPP.toLocaleString('id-ID');
        document.getElementById('laba_kotor').textContent = 'Rp ' + labaKotor.toLocaleString('id-ID');
        document.getElementById('sisa_piutang').textContent = 'Rp ' + sisaPiutang.toLocaleString('id-ID');
        
        // Update hidden inputs
        document.getElementById('total_order_input').value = totalOrder;
        document.getElementById('harga_netto_input').value = hargaNetto;
        document.getElementById('total_hpp_input').value = totalHPP;
        document.getElementById('laba_kotor_input').value = labaKotor;
        document.getElementById('sisa_piutang_input').value = sisaPiutang;
    }

    document.addEventListener('DOMContentLoaded', function() {
        attachAddonListeners();
        document.getElementById('jenis_pesanan').addEventListener('change', calculateTotals);
        document.getElementById('qty_pesanan').addEventListener('input', calculateTotals);
        document.getElementById('diskon').addEventListener('input', calculateTotals);
        document.getElementById('dp_masuk').addEventListener('input', calculateTotals);
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modal-tambah-pesanan');
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection