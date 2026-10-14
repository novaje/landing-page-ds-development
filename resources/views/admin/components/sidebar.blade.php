<style>
    .sidebar-heading {
        list-style: none;
        padding: 20px 20px 8px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        color: #94a3b8;
        text-transform: uppercase;
        pointer-events: none;
    }

    /* Judul kelompok pertama */
    .sidebar-heading:first-child {
        padding-top: 25px;
    }

    /* Pastikan judul tidak memiliki efek hover */
    .sidebar-menu .sidebar-heading:hover {
        background: transparent;
    }
</style>

<aside id="sidebar">
    <!-- BRAND -->
    <div class="sidebar-brand">
        <i class="fa-solid fa-store"></i>
        <span>DS SPORT APPAREL</span>
    </div>

    <ul class="sidebar-menu">

        <!-- MAIN MENU -->
        <li class="sidebar-heading">MAIN MENU</li>

        <li class="{{ request()->is('dashboard-admin') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->is('kasir') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-cash-register"></i>
                <span>Kasir / POS</span>
            </a>
        </li>

        <li class="{{ request()->is('data-pesanan*') ? 'active' : '' }}">
            <a href="{{ route('datapesanan') }}">
                <i class="fa-solid fa-file-invoice"></i>
                <span>Pesanan Custom</span>
            </a>
        </li>

        <li class="{{ request()->is('produk-stok') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Produk & Stok</span>
            </a>
        </li>

        <li class="{{ request()->is('pelanggan') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-users"></i>
                <span>Pelanggan</span>
            </a>
        </li>

        <li class="{{ request()->is('pembayaran') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-wallet"></i>
                <span>Pembayaran</span>
            </a>
        </li>

        <li class="{{ request()->is('pembelian') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-truck-ramp-box"></i>
                <span>Pembelian & Pemasokan</span>
            </a>
        </li>

        <li class="{{ request()->is('laporan') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Laporan</span>
            </a>
        </li>


        <!-- WEBSITE -->
        <li class="sidebar-heading">WEBSITE</li>

        <li class="{{ request()->is('beranda-website') ? 'active' : '' }}">
            <a href="{{ route('beranda') }}">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>
        </li>

        <li class="{{ request()->is('tentang-website') ? 'active' : '' }}">
            <a href="{{ route('tentang') }}">
                <i class="fa-solid fa-circle-info"></i>
                <span>Tentang Kami</span>
            </a>
        </li>

        <li class="{{ request()->is('koleksi-website') ? 'active' : '' }}">
            <a href="{{ route('koleksi') }}">
                <i class="fa-solid fa-shirt"></i>
                <span>Koleksi</span>
            </a>
        </li>

        <li class="{{ request()->is('galeri-website') ? 'active' : '' }}">
            <a href="{{ route('galeri') }}">
                <i class="fa-solid fa-images"></i>
                <span>Galeri</span>
            </a>
        </li>

        <li class="{{ request()->is('klien-website') ? 'active' : '' }}">
            <a href="{{ route('klien') }}">
                <i class="fa-solid fa-handshake"></i>
                <span>Klien</span>
            </a>
        </li>

        <li class="{{ request()->is('kontak') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-envelope"></i>
                <span>Kontak</span>
            </a>
        </li>

    </ul>
</aside>
