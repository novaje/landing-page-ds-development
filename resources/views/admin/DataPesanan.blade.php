@extends('admin.layouts.dashboard', ['skipComponents' => true])

@section('title', 'Data Pesanan - DS Sport Apparel')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl flex items-center gap-3">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-premium-charcoal border border-premium-border rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold text-white">Daftar Pesanan Custom</h2>
                <p class="text-sm text-sport-graytext mt-1">Kelola semua data pesanan custom jersey</p>
            </div>
            <button onclick="openModal()" class="px-5 py-2.5 rounded-xl bg-white text-black font-bold text-sm shadow hover:bg-gray-100 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Tambah Pesanan
            </button>
        </div>

        <!-- DataTable -->
        <div class="overflow-x-auto" id="table-wrapper" style="display: none;">
            <table id="pesananTable" class="w-full">
                <thead>
                    <tr class="bg-premium-black border-b border-premium-border">
                        <th class="p-3 text-left text-xs text-white">No</th>
                        <th class="p-3 text-left text-xs text-white">Tanggal</th>
                        <th class="p-3 text-left text-xs text-white">Kode</th>
                        <th class="p-3 text-left text-xs text-white">Team</th>
                        <th class="p-3 text-left text-xs text-white">Jenis</th>
                        <th class="p-3 text-left text-xs text-white">Qty</th>
                        <th class="p-3 text-left text-xs text-white">Modal</th>
                        <th class="p-3 text-left text-xs text-white">Jual</th>
                        <th class="p-3 text-left text-xs text-white">Sisa</th>
                        <th class="p-3 text-left text-xs text-white">Status</th>
                        <th class="p-3 text-left text-xs text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dt_pesanan as $index => $pesanan)
                    <tr class="border-b border-premium-border hover:bg-premium-black">
                        <td class="p-3 text-sm text-white">{{ $index + 1 }}</td>
                        <td class="p-3 text-sm text-white">{{ date('d-m-Y', strtotime($pesanan->tgl_pesanan)) }}</td>
                        <td class="p-3 text-sm text-white">{{ $pesanan->kode_pesanan }}</td>
                        <td class="p-3 text-sm text-white">{{ $pesanan->nama_team }}</td>
                        <td class="p-3 text-sm text-white">{{ $pesanan->jenis_pesanan }}</td>
                        <td class="p-3 text-sm text-white">{{ $pesanan->qty_pesanan }}</td>
                        <td class="p-3 text-sm text-white">Rp {{ number_format($pesanan->total_modal_pesanan, 0, ',', '.') }}</td>
                        <td class="p-3 text-sm text-white">Rp {{ number_format($pesanan->total_jual, 0, ',', '.') }}</td>
                        <td class="p-3 text-sm text-white">Rp {{ number_format($pesanan->sisa, 0, ',', '.') }}</td>
                        <td class="p-3 text-sm text-white">
                            @if($pesanan->status_pesanan == 'Selesai')
                            <span class="px-2 py-1 text-xs bg-green-500/20 text-green-400 rounded">Selesai</span>
                            @elseif($pesanan->status_pesanan == 'Pending')
                            <span class="px-2 py-1 text-xs bg-yellow-500/20 text-yellow-400 rounded">Pending</span>
                            @elseif($pesanan->status_pesanan == 'Proses')
                            <span class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded">Proses</span>
                            @else
                            <span class="px-2 py-1 text-xs bg-red-500/20 text-red-400 rounded">{{ $pesanan->status_pesanan }}</span>
                            @endif
                        </td>
                        <td class="p-3 text-sm text-white">
                            <div class="flex gap-2">
                                <a href="{{ route('datapesanan.edit', $pesanan->id_pesanan) }}" class="px-2 py-1 bg-blue-500 text-white rounded text-xs">Edit</a>
                                <form action="{{ route('datapesanan.destroy', $pesanan->id_pesanan) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-2 py-1 bg-red-500 text-white rounded text-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pesanan -->
    <div id="modal-tambah-pesanan" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-premium-charcoal border border-premium-border rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-premium-border">
                <h3 class="font-bold text-white text-base">Tambah Pesanan Custom Baru</h3>
                <button onclick="closeModal()" class="text-premium-lightgray hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('datapesanan.store') }}" method="POST" class="space-y-4 pt-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Tanggal Pesanan</label>
                        <input type="date" name="tgl_pesanan" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Kode Pesanan</label>
                        <input type="text" name="kode_pesanan" value="{{ $kode_pesanan }}" readonly
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none opacity-60">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-premium-lightgray mb-1">Nama Team</label>
                    <input type="text" name="nama_team" placeholder="Contoh: Real Madrid" required
                        class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-premium-lightgray mb-1">Jenis Pesanan</label>
                    <select name="jenis_pesanan" required
                        class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                        <option value="">Pilih Jenis Pesanan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jersey Atasan">Jersey Atasan</option>
                        <option value="Jersey Setelan">Jersey Setelan</option>
                        <option value="Trackpants & Tracktop">Trackpants & Tracktop</option>
                        <option value="Third Kit">Third Kit</option>
                        <option value="Training Kit">Training Kit</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Qty</label>
                        <input type="number" name="qty_pesanan" placeholder="0" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Total Modal</label>
                        <input type="number" name="total_modal_pesanan" placeholder="0" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Total Jual</label>
                        <input type="number" name="total_jual" placeholder="0" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Sisa</label>
                        <input type="number" name="sisa" placeholder="0" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Status Pesanan</label>
                        <select name="status_pesanan" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                            <option value="">Pilih Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-premium-border">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-premium-border text-premium-lightgray rounded text-sm hover:text-white">Batal</button>
                    <button type="submit"
                        class="px-5 py-2 bg-white text-black rounded text-sm font-bold">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($edit_pesanan))
    <!-- Modal Edit Pesanan -->
    <div id="modal-edit-pesanan" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-premium-charcoal border border-premium-border rounded-2xl w-full max-w-2xl p-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-premium-border">
                <h3 class="font-bold text-white text-base">Edit Pesanan Custom</h3>
                <a href="{{ route('datapesanan') }}" class="text-premium-lightgray hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </a>
            </div>
            <form action="{{ route('datapesanan.update', $edit_pesanan->id_pesanan) }}" method="POST" class="space-y-4 pt-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Tanggal Pesanan</label>
                        <input type="date" name="tgl_pesanan" value="{{ $edit_pesanan->tgl_pesanan }}" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Kode Pesanan</label>
                        <input type="text" name="kode_pesanan" value="{{ $edit_pesanan->kode_pesanan }}" readonly
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none opacity-60">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-premium-lightgray mb-1">Nama Team</label>
                    <input type="text" name="nama_team" value="{{ $edit_pesanan->nama_team }}" required
                        class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-premium-lightgray mb-1">Jenis Pesanan</label>
                    <select name="jenis_pesanan" required
                        class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                        <option value="">Pilih Jenis Pesanan</option>
                        <option value="Home Kit" {{ $edit_pesanan->jenis_pesanan == 'Home Kit' ? 'selected' : '' }}>Home Kit</option>
                        <option value="Away Kit" {{ $edit_pesanan->jenis_pesanan == 'Away Kit' ? 'selected' : '' }}>Away Kit</option>
                        <option value="Third Kit" {{ $edit_pesanan->jenis_pesanan == 'Third Kit' ? 'selected' : '' }}>Third Kit</option>
                        <option value="Training Kit" {{ $edit_pesanan->jenis_pesanan == 'Training Kit' ? 'selected' : '' }}>Training Kit</option>
                    </select>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Qty</label>
                        <input type="number" name="qty_pesanan" value="{{ $edit_pesanan->qty_pesanan }}" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Total Modal</label>
                        <input type="number" name="total_modal_pesanan" value="{{ $edit_pesanan->total_modal_pesanan }}" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Total Jual</label>
                        <input type="number" name="total_jual" value="{{ $edit_pesanan->total_jual }}" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Sisa</label>
                        <input type="number" name="sisa" value="{{ $edit_pesanan->sisa }}" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Status Pesanan</label>
                        <select name="status_pesanan" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-white">
                            <option value="">Pilih Status</option>
                            <option value="Pending" {{ $edit_pesanan->status_pesanan == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Proses" {{ $edit_pesanan->status_pesanan == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ $edit_pesanan->status_pesanan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-premium-border">
                    <a href="{{ route('datapesanan') }}"
                        class="px-4 py-2 border border-premium-border text-premium-lightgray rounded text-sm hover:text-white">Batal</a>
                    <button type="submit"
                        class="px-5 py-2 bg-white text-black rounded text-sm font-bold">Update Pesanan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection

@section('scripts')
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#pesananTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                emptyTable: "Tidak ada data tersedia",
                zeroRecords: "Tidak ada data yang cocok"
            },
            initComplete: function() {
                $('#table-wrapper').fadeIn(200);
            }
        });
    });

    // Modal Functions
    function openModal() {
        document.getElementById('modal-tambah-pesanan').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal-tambah-pesanan').classList.add('hidden');
    }
</script>

<style>
    /* DataTable styling for premium theme */
    #pesananTable_wrapper .dataTables_length select,
    #pesananTable_wrapper .dataTables_filter input {
        background-color: #1a1a1a;
        border: 1px solid #2d2d2d;
        color: #ffffff;
        padding: 4px 8px;
        border-radius: 4px;
    }

    #pesananTable_wrapper .dataTables_length label,
    #pesananTable_wrapper .dataTables_filter label {
        color: #8a8a8a;
        font-size: 0.875rem;
    }

    #pesananTable_wrapper .dataTables_paginate .paginate_button {
        color: #ffffff !important;
        background: #1a1a1a !important;
        border: 1px solid #2d2d2d !important;
        border-radius: 4px;
        margin: 0 2px;
    }

    #pesananTable_wrapper .dataTables_paginate .paginate_button.current {
        background: #ffffff !important;
        color: #000000 !important;
        font-weight: bold;
    }

    #pesananTable_wrapper .dataTables_paginate .paginate_button:hover {
        background: #4a4a4a !important;
    }

    #pesananTable_wrapper .dataTables_info {
        color: #8a8a8a;
        font-size: 0.875rem;
    }
</style>
@endsection
