<style>
        :root {
            --bg-body: #f4f6f8;
            --sidebar-bg: #1a1a1a;
            --sidebar-text: #b0b0b0;
            --sidebar-hover: #2c2c2c;
            --sidebar-active: #007bff;
            --card-bg: #ffffff;
            --text-main: #333333;
            --text-muted: #777777;
            --border-color: #e5e7eb;
            --charcoal: #222222;
            --accent: #007bff;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styling */
        aside {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ffffff;
            background-color: var(--charcoal);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #333;
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            overflow-y: auto;
            flex-grow: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.95rem;
            transition: 0.2s;
            border-left: 4px solid transparent;
        }

        .sidebar-menu li a:hover, 
        .sidebar-menu li.active a {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            border-left-color: var(--accent);
        }

        /* Main Content Area */
        main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        header {
            height: 60px;
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--charcoal);
            display: none;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--charcoal);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Dynamic View Container */
        .content-body {
            flex-grow: 1;
            padding: 25px;
            overflow-y: auto;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--charcoal);
        }

        /* Cards and Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .card-value {
            font-size: 1.6rem;
            font-weight: bold;
            color: var(--charcoal);
        }

        .card-icon {
            font-size: 1.8rem;
            color: var(--accent);
        }

        /* Tables */
        .table-container {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            margin-bottom: 20px;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        /* Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        .badge-success { background-color: #d1fae5; color: #065f46; }
        .badge-warning { background-color: #fef3c7; color: #92400e; }
        .badge-danger { background-color: #fee2e2; color: #991b1b; }
        .badge-info { background-color: #e0f2fe; color: #0369a1; }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-primary { background-color: var(--charcoal); color: white; }
        .btn-primary:hover { background-color: #000; }
        .btn-accent { background-color: var(--accent); color: white; }
        .btn-accent:hover { background-color: #0056b3; }
        .btn-danger { background-color: var(--danger); color: white; }
        .btn-success { background-color: var(--success); color: white; }

        /* POS / Kasir Layout */
        .pos-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .pos-products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 15px;
            max-height: 500px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .pos-item-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .pos-item-card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .pos-item-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .pos-cart {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            height: 500px;
        }

        .cart-items {
            flex-grow: 1;
            overflow-y: auto;
            margin-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border-color);
            font-size: 0.85rem;
        }

        /* Charts Simulation */
        .chart-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 200px;
            border-bottom: 2px solid var(--charcoal);
            padding-top: 20px;
            gap: 10px;
        }

        .bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .bar {
            width: 100%;
            max-width: 45px;
            background-color: var(--charcoal);
            border-radius: 4px 4px 0 0;
            transition: height 0.5s ease;
        }

        .bar-label {
            font-size: 0.75rem;
            margin-top: 8px;
            color: var(--text-muted);
        }

        /* Form elements */
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 12px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            aside {
                position: fixed;
                height: 100%;
                left: -260px;
            }
            aside.show {
                left: 0;
            }
            .menu-toggle {
                display: block;
            }
            .pos-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>