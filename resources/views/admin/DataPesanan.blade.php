@extends('admin.layouts.dashboard')
@section('title', 'PRODUK DAN STOK')
@section('content')

<div>
    <div
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="page-title" style="margin-bottom: 0;">Produk & Stok</h1>
        <button class="btn btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i>
            Tambah Produk</button>
    </div>
    <div class="table-container">
        <table id="productTable" class="display">
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Team</th>
                <th>Jenis</th>
                <th>Qty</th>
                <th>Modal</th>
                <th>Jual</th>
                <th>Sisa</th>
                <th>Status</th>
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
                    <td>Rp {{ number_format($pesanan->total_modal_pesanan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pesanan->total_jual, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pesanan->sisa, 0, ',', '.') }}</td>
                    <td>
                        @if($pesanan->status_pesanan == 'Selesai')
                            <span class="px-2 py-1 text-xs bg-green-500/20 text-green-400 rounded">
                                Selesai
                            </span>
                        @elseif($pesanan->status_pesanan == 'Pending')
                            <span class="px-2 py-1 text-xs bg-yellow-500/20 text-yellow-400 rounded">
                                Pending
                            </span>
                        @elseif($pesanan->status_pesanan == 'Proses')
                            <span class="px-2 py-1 text-xs bg-blue-500/20 text-blue-400 rounded">
                                Proses
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs bg-red-500/20 text-red-400 rounded">
                                {{ $pesanan->status_pesanan }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('datapesanan.edit', $pesanan->id_pesanan) }}"
                        class="btn btn-accent"
                        style="padding: 4px 8px;">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('datapesanan.destroy', $pesanan->id_pesanan) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger"
                                    style="padding: 4px 8px;">
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

<!-- Modal Tambah Pesanan -->
<div id="modal-tambah-pesanan" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Pesanan</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <form action="{{ route('datapesanan.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tanggal Pesanan</label>
                        <input type="date" name="tgl_pesanan" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Pesanan</label>
                        <input type="text" name="kode_pesanan" value="{{ $kode_pesanan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Team</label>
                        <input type="text" name="nama_team" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pesanan</label>
                        <select name="jenis_pesanan" required>
                            <option value="">Pilih Jenis Pesanan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jersey Atasan">Jersey Atasan</option>
                            <option value="Jersey Setelan">Jersey Setelan</option>
                            <option value="Trackpants & Tracktop">Trackpants & Tracktop</option>
                            <option value="Third Kit">Third Kit</option>
                            <option value="Training Kit">Training Kit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" name="qty_pesanan" required>
                    </div>
                    <div class="form-group">
                        <label>Total Modal</label>
                        <input type="number" name="total_modal_pesanan" required>
                    </div>
                    <div class="form-group">
                        <label>Total Jual</label>
                        <input type="number" name="total_jual" required>
                    </div>
                    <div class="form-group">
                        <label>Sisa</label>
                        <input type="number" name="sisa" required>
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Status Pesanan</label>
                        <select name="status_pesanan" required>
                            <option value="">Pilih Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
</script>

<style>
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 0;
        border-radius: 8px;
        width: 90%;
        max-width: 700px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .modal-header {
        padding: 15px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: var(--charcoal);
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #777;
    }

    .modal-close:hover {
        color: #333;
    }

    .modal-body {
        padding: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: var(--text-main);
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--accent);
    }

    .form-group input[readonly] {
        background-color: #f9f9f9;
        cursor: not-allowed;
    }

    .modal-footer {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
@endpush
@endsection