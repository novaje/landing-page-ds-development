<aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="p-6 border-b border-slate-800/80 hidden md:flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-xl text-white shadow-lg shadow-blue-500/20">DS</div>
        <div>
            <h1 class="font-extrabold text-base tracking-wider text-white leading-tight">DS SPORT</h1>
            <p class="text-xs text-blue-400 font-medium">Apparel System V4</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard-admin') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->is('dashboard-admin') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-cash-register w-5"></i> Kasir / POS
        </a>
        <a href="{{ route('datapesanan') }}" class="nav-link {{ request()->is('data-pesanan*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('data-pesanan*') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-cart-shopping w-5"></i> Order & Transaksi
        </a>
        <a href="{{ route('dtProduk') }}" class="nav-link {{ request()->is('data-produk') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('data-produk') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-boxes-stacked w-5"></i> Produk & Stok
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-users w-5"></i> Pelanggan
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-wallet w-5"></i> Pembayaran
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-truck-ramp-box w-5"></i> Pembelian & Pemasokan
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-chart-pie w-5"></i> Laporan
        </a>

        <a href="{{ route ('dtPaketJersey') }}" class="nav-link {{ request()->is('master-data-paket-jersey') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-chart-pie w-5"></i> Master Data
        </a>
        
        <div class="pt-4 pb-2 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Website</div>
        
        <a href="{{ route('beranda') }}" class="nav-link {{ request()->is('beranda-website') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('beranda-website') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-house w-5"></i> Beranda
        </a>
        <a href="{{ route('tentang') }}" class="nav-link {{ request()->is('tentang-website') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('tentang-website') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-circle-info w-5"></i> Tentang Kami
        </a>
        <a href="{{ route('koleksi') }}" class="nav-link {{ request()->is('koleksi-website') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('koleksi-website') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-shirt w-5"></i> Koleksi
        </a>
        <a href="{{ route('galeri') }}" class="nav-link {{ request()->is('galeri-website') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('galeri-website') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-images w-5"></i> Galeri
        </a>
        <a href="{{ route('klien') }}" class="nav-link {{ request()->is('klien-website') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->is('klien-website') ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
            <i class="fa-solid fa-handshake w-5"></i> Klien
        </a>
        <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all text-slate-400 hover:text-white hover:bg-slate-800/60">
            <i class="fa-solid fa-envelope w-5"></i> Kontak
        </a>
    </nav>

    <div class="p-4 border-t border-slate-800/80">
        <button class="w-full py-2 px-3 rounded-lg bg-slate-800 hover:bg-rose-900/30 hover:text-rose-400 text-xs text-slate-400 transition-colors flex items-center justify-center gap-2 border border-slate-700/50">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
    </div>
</aside>
