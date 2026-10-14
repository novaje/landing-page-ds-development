@extends('admin.layouts.dashboard')
@section('title', 'PRODUK DAN STOK')
@section('content')

<div>
    <div
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="page-title" style="margin-bottom: 0;">Data Klien Website</h1>

        <button class="btn btn-primary" onclick="openModal()">
            <i class="fa-solid fa-plus"></i>
            Tambah Data
        </button>
    </div>

<div class="table-container">
    <table id="klienTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Klien</th>
                <th>Nama Team</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($dt_klien as $index => $klien)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $klien->nm_klien }}</td>
                    <td>{{ $klien->nm_team }}</td>
                    <td>
                        <form
                            action="{{ route('klien.destroy', $klien->id) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Hapus data klien ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                                style="padding: 4px 8px;"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Data Klien -->
<div id="modal-tambah-klien" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Data Klien</h3>

            <button class="modal-close" onclick="closeModal()">
                &times;
            </button>
        </div>

        <form
            action="{{ route('klien.store') }}"
            method="POST"
        >
            @csrf

            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="nm_klien">Nama Klien</label>
                        <input
                            type="text"
                            id="nm_klien"
                            name="nm_klien"
                            placeholder="Masukkan nama klien"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="nm_team">Nama Team</label>
                        <input
                            type="text"
                            id="nm_team"
                            name="nm_team"
                            placeholder="Masukkan nama team"
                            maxlength="255"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    onclick="closeModal()"
                >
                    Batal
                </button>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#klienTable').DataTable();
    });

    function openModal() {
        document.getElementById('modal-tambah-klien').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modal-tambah-klien').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modal-tambah-klien');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

<style>
    .form-group input,
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        font-family: inherit;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }
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