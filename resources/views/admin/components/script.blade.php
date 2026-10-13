<script>
    // Toggle Sidebar Mobile
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar
            .classList
            .toggle('-translate-x-full');
    }

    // Generic Toggle Dropdown
    function toggleDropdown(dropdownId, chevronId) {
        const dropdown = document.getElementById(dropdownId);
        const chevron = document.getElementById(chevronId);
        dropdown
            .classList
            .toggle('hidden');
        chevron
            .classList
            .toggle('rotate-180');
    }

    // Switch Tabs Function
    function switchTab(tabName) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.add('hidden'));

        const target = document.getElementById('tab-' + tabName);
        if (target) 
            target
                .classList
                .remove('hidden');
        
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link
                .classList
                .remove('bg-sport-dark', 'text-white', 'border', 'border-sport-border');
            link
                .classList
                .add('text-sport-graytext');
        });

        // Update Header Title
        const titles = {
            'dashboard': 'Dashboard Overview',
            'products-satuan': 'Manajemen Produk Baju Bola - Satuan',
            'products-custom': 'Manajemen Produk Baju Bola - Custom',
            'categories': 'Kategori Klub & Liga',
            'orders': 'Daftar Pesanan / Order',
            'customers': 'Data Pelanggan DS Sport',
            'settings': 'Pengaturan Toko'
        };
        document
            .getElementById('page-title')
            .innerText = titles[tabName] || 'Admin Dashboard';

        if (window.innerWidth < 1024) {
            document
                .getElementById('sidebar')
                .classList
                .add('-translate-x-full');
        }
    }

    // Modal Controls
    function openProductModal() {
        document
            .getElementById('product-modal')
            .classList
            .remove('hidden');
    }
    function closeProductModal() {
        document
            .getElementById('product-modal')
            .classList
            .add('hidden');
    }
    function saveProduct(e) {
        e.preventDefault();
        closeProductModal();
        showToast('Produk baju bola berhasil ditambahkan!');
    }

    // Toast Helper
    function showToast(msg) {
        const toast = document.getElementById('toast');
        document
            .getElementById('toast-message')
            .innerText = msg;
        toast
            .classList
            .remove('translate-y-20', 'opacity-0');
        setTimeout(() => {
            toast
                .classList
                .add('translate-y-20', 'opacity-0');
        }, 3000);
    }

    // Initialize DataTables and Chart.js on Window Load
    $(document).ready(function () {
        // Inisialisasi DataTables pada tabel pesanan - hanya jika elemen ada
        if ($('#ordersTable').length) {
            $('#ordersTable').DataTable({
                "language": {
                    "search": "Cari data:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50]
            });
        }

        // Inisialisasi Chart.js - hanya jika elemen ada
        if ($('#revenueChart').length) {
            const ctx = document
                .getElementById('revenueChart')
                .getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'Mei',
                        'Jun',
                        'Jul',
                        'Agu',
                        'Sep',
                        'Okt',
                        'Nov',
                        'Des'
                    ],
                    datasets: [
                        {
                            label: 'Pendapatan (Rp)',
                            data: [
                                15000000,
                                22000000,
                                18000000,
                                29000000,
                                35000000,
                                42000000,
                                38000000,
                                45000000,
                                41000000,
                                48250000,
                                0,
                                0
                            ],
                            borderColor: '#ffffff',
                            backgroundColor: 'rgba(255, 255, 255, 0.05)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#000000',
                            pointBorderWidth: 2,
                            pointRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: '#1a1a1a'
                            },
                            ticks: {
                                color: '#888888'
                            }
                        },
                        y: {
                            grid: {
                                color: '#1a1a1a'
                            },
                            ticks: {
                                color: '#888888',
                                callback: function (value) {
                                    return 'Rp ' + (
                                        value / 1000000
                                    ) + 'jt';
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>