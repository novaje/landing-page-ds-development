<!DOCTYPE html>
<html lang="id" class="h-full bg-black">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DS SPORT - APPAREL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="css/style.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        premium: {
                            black: '#000000',
                            charcoal: '#1a1a1a',
                            gray: '#4a4a4a',
                            lightgray: '#8a8a8a',
                            white: '#ffffff',
                            border: '#2d2d2d'
                        }
                    }
                }
            }
        }
    </script>

</head>

<body class="h-full text-slate-100 flex overflow-hidden">

    @include('admin.components.sidebar')

    <div class="flex-1 flex flex-col min-w-0 lg:pl-64 h-full bg-premium-black">
        <!-- Top Navbar -->
        <header
            class="h-20 bg-premium-charcoal/90 backdrop-blur-md border-b border-premium-border flex items-center justify-between px-6 sticky top-0 z-40">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()"
                    class="lg:hidden text-premium-lightgray hover:text-white p-2 rounded-lg bg-premium-charcoal border border-premium-border">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <div>
                    <h1 id="page-title" class="text-xl font-bold text-white tracking-tight">DS - SPORT APPAREL</h1>
                </div>
            </div>
        </header>

        <!-- Main Scrollable Content Area -->
        <main class="flex-1 overflow-y-auto p-6 space-y-6">
            @yield('content')
        </main>
    </div>

    <!-- MODAL TAMBAH PRODUK -->
    <div id="product-modal"
        class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-premium-charcoal border border-premium-border rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-premium-border">
                <h3 class="font-bold text-white text-base">Tambah Produk Baju Bola Baru</h3>
                <button onclick="closeProductModal()" class="text-premium-lightgray hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form onsubmit="saveProduct(event)" class="space-y-4 pt-4">
                <div>
                    <label class="block text-xs font-semibold text-premium-lightgray mb-1">Nama Jersey</label>
                    <input type="text" placeholder="Contoh: Jersey Real Madrid Away" required
                        class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Jenis</label>
                        <select
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none">
                            <option>Satuan (Ready Stock)</option>
                            <option>Custom (Tim / Sablon)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-premium-lightgray mb-1">Harga (Rp)</label>
                        <input type="number" placeholder="165000" required
                            class="w-full bg-premium-black border border-premium-border rounded-xl px-4 py-2.5 text-sm text-white outline-none">
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-premium-border">
                    <button type="button" onclick="closeProductModal()"
                        class="px-4 py-2.5 rounded-xl border border-premium-border text-premium-lightgray hover:text-white text-sm">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-white text-black font-bold text-sm shadow">Simpan
                        Produk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed bottom-5 right-5 z-50 bg-premium-charcoal border border-premium-border text-white px-5 py-3 rounded-xl shadow-2xl transform translate-y-20 opacity-0 transition-all duration-300 flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-white text-lg"></i>
        <span id="toast-message" class="text-sm font-medium">Berhasil menyimpan</span>
    </div>

    <!-- jQuery & DataTables JS CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @if(!isset($skipComponents))
    @include('admin.components.script')
    @endif
    @yield('scripts')
</body>

</html>