@extends('layouts.dashboard')
@section('title', 'Master Jabatan - AMRITA')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .app-toast {
            background: white;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 300px;
            animation: slideIn 0.3s ease-out;
        }
        .app-toast.success {
            border-left: 4px solid #28a745;
        }
        .app-toast.error {
            border-left: 4px solid #dc3545;
        }
        .toast-icon {
            font-size: 20px;
        }
        .app-toast.success .toast-icon {
            color: #28a745;
        }
        .app-toast.error .toast-icon {
            color: #dc3545;
        }
        .toast-message {
            flex: 1;
            font-size: 14px;
            color: #333;
        }
        .toast-close {
            cursor: pointer;
            color: #999;
            font-size: 18px;
        }
        .toast-close:hover {
            color: #333;
        }
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
@endpush

<div class="datatable-container">
    <div class="datatable-header">
        <h2 class="section-title">Master Jabatan</h2>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addJabatanModal">
            <i class="bi bi-plus-lg"></i>
            Tambah Data
        </button>
    </div>

    <div class="table-wrapper">
        <table id="jabatanTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Jabatan</th>
                    <th>Kelompok Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($dt_jabatan) && $dt_jabatan->count() > 0)
                    @foreach($dt_jabatan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode ?? '-' }}</td>
                            <td>{{ $item->nm_jabatan }}</td>
                            <td>{{ $item->kelompok_jabatan }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="action-buttons">
                                    {{-- Tombol Edit --}}
                                    <button type="button"
                                            class="action-btn"
                                            title="Edit Data"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id_jabatan }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('destroyJabatan', $item->id_jabatan) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit --}}
@if(isset($dt_jabatan))
    @foreach($dt_jabatan as $item)
        <div class="modal fade" id="editModal{{ $item->id_jabatan }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('updateJabatan', $item->id_jabatan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h3 class="modal-title">Edit Jabatan</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label>Kode</label>
                                <input type="text" class="form-control" value="{{ $item->kode }}" disabled style="background-color: #f8f9fa;">
                                <small class="text-muted">Kode tidak dapat diubah</small>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jabatan</label>
                                <input type="text" name="nm_jabatan" class="form-control" value="{{ $item->nm_jabatan }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Kelompok Jabatan</label>
                                <select name="kelompok_jabatan" class="form-control" required>
                                    <option value="">-- Pilih Kelompok Jabatan --</option>
                                    @if($dt_kelompok_jabatan && $dt_kelompok_jabatan->count() > 0)
                                        @foreach($dt_kelompok_jabatan as $kelompok)
                                            <option value="{{ $kelompok->nm_kelompok_jabatan }}" {{ $item->kelompok_jabatan == $kelompok->nm_kelompok_jabatan ? 'selected' : '' }}>{{ $kelompok->nm_kelompok_jabatan }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Tidak ada data kelompok jabatan</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

{{-- Toast Container --}}
<div class="toast-container" id="toastContainer"></div>

{{-- Modal Tambah (Bootstrap 5 native modal) --}}
<div class="modal fade" id="addJabatanModal" tabindex="-1" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('storeJabatan') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="addJabatanModalLabel">Tambah Data</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" disabled style="background-color: #f8f9fa;">
                        <small class="text-muted">Kode akan di-generate otomatis</small>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="nm_jabatan" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Kelompok Jabatan</label>
                        <select name="kelompok_jabatan" class="form-control" required>
                            <option value="">-- Pilih Kelompok Jabatan --</option>
                            @if($dt_kelompok_jabatan && $dt_kelompok_jabatan->count() > 0)
                                @foreach($dt_kelompok_jabatan as $kelompok)
                                    <option value="{{ $kelompok->nm_kelompok_jabatan }}">{{ $kelompok->nm_kelompok_jabatan }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Tidak ada data kelompok jabatan</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#jabatanTable')) {
            $('#jabatanTable').DataTable().destroy();
        }
        $('#jabatanTable').DataTable({
            language: {
                emptyTable: "Tidak ada data"
            }
        });

        // Cek session message lalu tampilkan toast
        @if(session('success'))
            showToast('success', '{{ session('success') }}');
        @endif

        @if(session('error'))
            showToast('error', '{{ session('error') }}');
        @endif
    });

    // Toast function
    function showToast(type, message) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `app-toast ${type}`;

        const icon = type === 'success' ? '✓' : '✕';

        toast.innerHTML = `
            <span class="toast-icon">${icon}</span>
            <span class="toast-message">${message}</span>
            <span class="toast-close" onclick="this.parentElement.remove()">×</span>
        `;

        container.appendChild(toast);

        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }, 3000);
    }
</script>
@endpush

@endsection