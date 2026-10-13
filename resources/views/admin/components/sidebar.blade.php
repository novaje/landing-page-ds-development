<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-premium-charcoal border-r border-premium-border flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <!-- Brand Logo -->
    <div
        class="h-20 flex items-center px-6 border-b border-premium-border justify-between">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 rounded-xl bg-white text-black flex items-center justify-center font-bold text-xl shadow">
               <img
                    src="{{ asset('template/image/bg-ds.jpeg') }}"
                    alt="Logo DS SPORT"
                    class="w-full h-full object-contain"
                >
            </div>
            <div>
                <span class="font-bold text-lg tracking-wide block text-white">DS SPORT</span>
                <span class="text-xs text-premium-lightgray font-medium tracking-wider">ADMIN PANEL</span>
            </div>
        </div>
        <button
            onclick="toggleSidebar()"
            class="lg:hidden text-premium-lightgray hover:text-white">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <p
            class="px-3 text-xs font-semibold uppercase tracking-wider text-premium-lightgray mb-2">Menu Utama</p>
        <a
            href="{{ route('dashboard') }}"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-premium-black border border-premium-border' : 'text-premium-lightgray hover:bg-premium-black hover:text-white' }} transition-all duration-200">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <a
            href="#categories"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
             <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
            <span>Kasir/ Penjualanan</span>
        </a>

        <a
            href="{{ route('datapesanan') }}"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium {{ request()->routeIs('datapesanan') ? 'text-white bg-premium-black border border-premium-border' : 'text-premium-lightgray hover:bg-premium-black hover:text-white' }} transition-all duration-200">
            <i class="fa fa-list-ul" aria-hidden="true"></i>
            <span>Pesanan Custom</span>
        </a>

        <a
            href="#customers"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <span>Produk & Stok</span>
        </a>

        <a
            href="#customers"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
            <i class="fa-solid fa-users w-5 text-center"></i>
            <span>Pelanggan</span>
        </a>

        <a
            href="#customers"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
            <i class="fa fa-credit-card" aria-hidden="true"></i>
            <span>Pembayaran</span>
        </a>

        <a
            href="#customers"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
            <i class="fa fa-cube" aria-hidden="true"></i>
            <span>Pembelian & Pemasokan</span>
        </a>

        <a
            href="#customers"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
           <i class="fa fa-bar-chart" aria-hidden="true"></i>
            <span>Laporan</span>
        </a>

        <p
            class="px-3 text-xs font-semibold uppercase tracking-wider text-premium-lightgray mt-6 mb-2">Website</p>
        <div>
            <button
                onclick="toggleDropdown('website-dropdown', 'website-chevron')"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
                <div class="flex items-center gap-3.5">
                    <i class="fa fa-asterisk" aria-hidden="true"></i>
                    <span>Data Website
                    </span>
                </div>
                <i
                    id="website-chevron"
                    class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
            </button>

            <div id="website-dropdown" class="hidden pl-11 pr-2 py-2 space-y-1">
                <a
                    href="#products-satuan"
                    onclick="switchTab('products-satuan')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Beranda
                </a>
                <a
                    href="#products-custom"
                    onclick="switchTab('products-custom')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Tentang Kami
                </a>
                <a
                    href="#products-custom"
                    onclick="switchTab('products-custom')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Koleksi
                </a>
                <a
                    href="#products-custom"
                    onclick="switchTab('products-custom')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Galeri
                </a>
                <a
                    href="#products-custom"
                    onclick="switchTab('products-custom')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Klien
                </a>
                <a
                    href="#products-custom"
                    onclick="switchTab('products-custom')"
                    class="block px-3 py-2 rounded-lg text-sm text-premium-lightgray hover:text-white hover:bg-premium-black transition-colors">
                    <i class="fa-solid fa-circle text-[6px] mr-2"></i>
                    Kontak
                </a>
            </div>
        </div>

        <p
            class="px-3 text-xs font-semibold uppercase tracking-wider text-premium-lightgray mt-6 mb-2">Sistem</p>
        <a
            href="#settings"
            class="nav-link flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-premium-lightgray hover:bg-premium-black hover:text-white transition-all duration-200">
            <i class="fa-solid fa-gear w-5 text-center"></i>
            <span>Pengaturan</span>
        </a>
        <a
            href="#"
            onclick="showLogoutModal()"
            class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-red-400 hover:bg-red-500/10 transition-all duration-200 mt-4">
            <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
            <span>Keluar</span>
        </a>
    </nav>

    <!-- Admin Profile Mini -->
    <div
        class="p-4 border-t border-premium-border bg-premium-black/50 flex items-center gap-3">
        <img
            src="https://placehold.co/40x40/FFFFFF/000000?text=DS"
            alt="Admin"
            class="w-10 h-10 rounded-full border border-premium-border object-cover">
            <div class="overflow-hidden">
                <h4 class="text-sm font-semibold truncate text-white">Dimas Store Admin</h4>
                <p class="text-xs text-premium-lightgray truncate">Super Administrator</p>
            </div>
        </div>
    </aside>