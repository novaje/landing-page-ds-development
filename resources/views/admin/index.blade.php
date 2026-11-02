@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<!-- Dashboard -->
<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass-panel p-5 rounded-2xl border border-slate-800 relative overflow-hidden">
            <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Pendapatan Bulan Ini</div>
            <div class="text-2xl font-black text-white">Rp 45.850.000</div>
            <div class="absolute right-3 top-3 w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-rupiah-sign"></i>
            </div>
        </div>

        <div class="glass-panel p-5 rounded-2xl border border-slate-800 relative overflow-hidden">
            <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Pesanan</div>
            <div class="text-2xl font-black text-white">328</div>
            <div class="absolute right-3 top-3 w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
        </div>

        <div class="glass-panel p-5 rounded-2xl border border-slate-800 relative overflow-hidden">
            <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Produk Terjual</div>
            <div class="text-2xl font-black text-white">1,420</div>
            <div class="absolute right-3 top-3 w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-box"></i>
            </div>
        </div>

        <div class="glass-panel p-5 rounded-2xl border border-slate-800 relative overflow-hidden">
            <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Pelanggan Aktif</div>
            <div class="text-2xl font-black text-white">1,120</div>
            <div class="absolute right-3 top-3 w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-lg">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>
    </div>
</div>
@endsection
