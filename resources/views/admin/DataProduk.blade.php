@extends('admin.layouts.dashboard')
@section('title', 'PRODUK DAN STOK')
@section('content')

@if(session('success'))
<div id="toast-success" class="toast toast-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="toast-error" class="toast toast-error">
    {{ session('error') }}
</div>
@endif

@if($errors->any())
<div id="toast-error" class="toast toast-error">
    @foreach($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
@endif

<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold text-white mb-0">Manajemen Produk & Stok</h1>
        <button onclick="openModal()" class="py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs flex items-center gap-2 shadow-lg shadow-blue-600/30 transition-all">
            <i class="fa-solid fa-plus"></i> Tambah Produk
        </button>
    </div>
    <div class="glass-panel rounded-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="productTable" class="display">
                <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Ukuran</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Sisa Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                
                <tbody>
                    @foreach($dt_produk as $index => $produk)
                    <tr class="main-row" data-id="{{ $produk->id_produk }}">
                        <td>
                            @if($produk->upload_gambar && $produk->upload_gambar != '')
                                <img src="{{ asset('images/' . $produk->upload_gambar) }}" alt="{{ $produk->nm_produk }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <span class="text-slate-500 text-xs">No img</span>
                            @endif
                        </td>
                        <td>{{ $produk->kode_produk }}</td>
                        <td>{{ $produk->nm_produk }}</td>
                        <td>{{ $produk->ukuran }}</td>
                        <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>{{ $produk->sisa }}</td>
                        <td>
                            <a href="{{ route('dtProduk.edit', $produk->id_produk) }}"
                            class="py-1.5 px-3 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold inline-flex items-center gap-1 mr-2">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('dtProduk.destroy', $produk->id_produk) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Hapus produk ini?')">
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
<div id="modal-tambah-pesanan" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Produk</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <form action="{{ route('dtProduk.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1;">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" name="kode_produk" value="{{ $kode_produk }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nm_produk" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan</label>
                        <input type="text" name="nm_bahan" required>
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" name="ukuran" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" required>
                    </div>
                    <div class="form-group">
                        <label>Motif</label>
                        <input type="text" name="motif" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label>Sisa</label>
                        <input type="number" name="sisa" required>
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Upload Gambar</label>
                        <input type="file" name="upload_gambar" accept="image/*">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="py-2 px-4 rounded-lg bg-slate-700 hover:bg-slate-600 text-white text-sm font-semibold" onclick="closeModal()">Batal</button>
                <button type="submit" class="py-2 px-4 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            columnDefs: [
                { className: 'dt-center', targets: '_all' }
            ]
        });
    });

    function openModal() {
        document.getElementById('modal-tambah-pesanan').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modal-tambah-pesanan').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modal-tambah-pesanan');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Show toast notifications
    function showToast() {
        const successToast = document.getElementById('toast-success');
        const errorToast = document.getElementById('toast-error');
        
        if (successToast) {
            successToast.style.display = 'block';
            setTimeout(() => {
                successToast.style.display = 'none';
            }, 3000);
        }
        
        if (errorToast) {
            errorToast.style.display = 'block';
            setTimeout(() => {
                errorToast.style.display = 'none';
            }, 5000);
        }
    }
    
    // Show toast on page load
    window.onload = showToast;
</script>
@endpush
@endsection