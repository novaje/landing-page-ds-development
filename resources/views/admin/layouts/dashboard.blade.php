<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DS-SPORT APPAREL</title>
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @include('admin.components.style')
</head>
<body>

    <!-- Sidebar Navigation -->
    @include('admin.components.sidebar')

    <!-- Main Section -->
    <main>
        <header>
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle"><i class="fa-solid fa-bars"></i></button>
                <span id="headerTitle" style="font-weight: 600; color: var(--charcoal);">Dashboard Utama</span>
            </div>
            <div class="user-profile">
                <div class="user-avatar">AD</div>
                <span>Admin Utama</span>
            </div>
        </header>

        <div class="content-body">
            @yield('content')
        </div>
    </main>

    <!-- jQuery & DataTables JS CDN -->
   @include('admin.components.script')
   @stack('scripts')
</body>
</html>