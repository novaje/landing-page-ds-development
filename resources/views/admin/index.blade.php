@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<!-- Dashboard -->
<div>
    <h1 class="page-title">Dashboard</h1>
    <div class="card-grid">
        <div class="card">
            <div class="card-header-flex">
                <span class="card-title">Pendapatan Bulan Ini</span>
                <i class="fa-solid fa-rupiah-sign card-icon"></i>
            </div>
            <div class="card-value">Rp 45.850.000</div>
        </div>
        <div class="card">
            <div class="card-header-flex">
                <span class="card-title">Total Pesanan</span>
                <i class="fa-solid fa-bag-shopping card-icon"></i>
            </div>
            <div class="card-value">328</div>
        </div>
        <div class="card">
            <div class="card-header-flex">
                <span class="card-title">Produk Terjual</span>
                <i class="fa-solid fa-box card-icon"></i>
            </div>
            <div class="card-value">1,420</div>
        </div>
        <div class="card">
            <div class="card-header-flex">
                <span class="card-title">Pelanggan Aktif</span>
                <i class="fa-solid fa-user-check card-icon"></i>
            </div>
            <div class="card-value">1,120</div>
        </div>
    </div>
</div>
@endsection
