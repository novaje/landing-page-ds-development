<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DS Sport Apparel — Management System V4</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            dark: '#0f172a',
                            navy: '#1e293b',
                            accent: '#3b82f6',
                            emerald: '#10b981',
                            amber: '#f59e0b',
                            rose: '#ef4444'
                        }
                    }
                }
            }
        }
    </script>
    
    @include('admin.components.style')
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Navigation Toggle Bar -->
    <div class="md:hidden bg-slate-900 border-b border-slate-800 p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-white shadow-lg shadow-blue-500/30">DS</div>
            <span class="font-bold text-lg tracking-wide text-white">DS SPORT V4</span>
        </div>
        <button id="mobileMenuBtn" class="p-2 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    @include('admin.components.sidebar')

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top App Bar -->
        <header class="bg-slate-900/80 backdrop-blur border-b border-slate-800 px-6 py-4 sticky top-0 z-30 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <h2 id="pageTitle" class="text-xl font-bold text-white tracking-wide">{{ $title ?? 'Dashboard' }}</h2>
            </div>
            
            <div class="flex items-center gap-4 flex-wrap">
                <!-- User Profile -->
                <div class="flex items-center gap-3 bg-slate-950 border border-slate-800 rounded-lg px-3 py-1.5">
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white text-sm">AD</div>
                    <span class="text-xs font-semibold text-white">Admin Utama</span>
                </div>
            </div>
        </header>

        <!-- Dynamic View Containers -->
        <div class="p-6 space-y-6 flex-1">
            @yield('content')
        </div>
    </main>

    <!-- jQuery & DataTables JS CDN -->
    @include('admin.components.script')
    @stack('scripts')
</body>
</html>