 <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>

        let cart = [];

        // Tab Navigation Logic
        $(document).ready(function() {
            // Sidebar Menu Switching
            $('.sidebar-menu li').on('click', function(e) {
                const href = $(this).find('a').attr('href');

                // If menu has a real href (not #), let it navigate normally
                if (href && href !== '#') {
                    return; // Allow default navigation
                }

                e.preventDefault();
                $('.sidebar-menu li').removeClass('active');
                $(this).addClass('active');

                const targetTab = $(this).data('target');
                $('.tab-content').removeClass('active');
                $('#' + targetTab).addClass('active');

                // Update header title
                const titleText = $(this).text().trim();
                $('#headerTitle').text(titleText);

                // Close mobile sidebar if open
                if(window.innerWidth <= 768) {
                    $('#sidebar').removeClass('show');
                }
            });

            // Mobile menu toggle
            $('#menuToggle').on('click', function() {
                $('#sidebar').toggleClass('show');
            });

            // Render POS Product Grid
            renderPOSProducts();
        });

        function renderPOSProducts() {
            const grid = $('#posProductGrid');
            grid.empty();
            posProducts.forEach(prod => {
                grid.append(`
                    <div class="pos-item-card" onclick="addToCart(${prod.id})">
                        <img src="${prod.img}" alt="${prod.name}">
                        <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 4px;">${prod.name}</div>
                        <div style="color: var(--text-muted); font-size: 0.8rem;">Rp ${prod.price.toLocaleString('id-ID')}</div>
                    </div>
                `);
            });
        }

        function addToCart(productId) {
            const prod = posProducts.find(p => p.id === productId);
            const existing = cart.find(item => item.id === productId);
            if(existing) {
                existing.qty++;
            } else {
                cart.push({ ...prod, qty: 1 });
            }
            updateCartDisplay();
        }

        function updateCartDisplay() {
            const container = $('#cartItemsContainer');
            container.empty();
            if(cart.length === 0) {
                container.html('<p style="color: var(--text-muted); text-align: center; margin-top: 40px;">Keranjang masih kosong</p>');
                $('#cartTotal').text('Rp 0');
                return;
            }

            let total = 0;
            cart.forEach((item, index) => {
                const subtotal = item.price * item.qty;
                total += subtotal;
                container.append(`
                    <div class="cart-row">
                        <div>
                            <div>${item.name}</div>
                            <div style="color: var(--text-muted); font-size: 0.75rem;">${item.qty} x Rp ${item.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 600;">Rp ${subtotal.toLocaleString('id-ID')}</span>
                            <button class="btn btn-danger" style="padding: 2px 6px; font-size: 0.7rem;" onclick="removeFromCart(${index})"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                `);
            });
            $('#cartTotal').text('Rp ' + total.toLocaleString('id-ID'));
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
        }

        function prosesBayar() {
            if(cart.length === 0) {
                // Using clean standard message box instead of alert()
                const msgBox = document.createElement('div');
                msgBox.innerHTML = '<div style="position:fixed; top:20px; right:20px; background:#ef4444; color:white; padding:12px 20px; border-radius:6px; z-index:1000; font-size:0.9rem;">Keranjang belanja masih kosong!</div>';
                document.body.appendChild(msgBox);
                setTimeout(() => msgBox.remove(), 2500);
                return;
            }
            const successBox = document.createElement('div');
            successBox.innerHTML = '<div style="position:fixed; top:20px; right:20px; background:#10b981; color:white; padding:12px 20px; border-radius:6px; z-index:1000; font-size:0.9rem;">Pembayaran berhasil diproses! Struk tercetak.</div>';
            document.body.appendChild(successBox);
            setTimeout(() => successBox.remove(), 2500);
            cart = [];
            updateCartDisplay();
        }

        function generateReport() {
            const type = $('#reportType').val();
            const reportBox = document.createElement('div');
            reportBox.innerHTML = `<div style="position:fixed; top:20px; right:20px; background:#007bff; color:white; padding:12px 20px; border-radius:6px; z-index:1000; font-size:0.9rem;">Berhasil mengunduh Laporan ${type.toUpperCase()}!</div>`;
            document.body.appendChild(reportBox);
            setTimeout(() => reportBox.remove(), 2500);
        }
    </script>