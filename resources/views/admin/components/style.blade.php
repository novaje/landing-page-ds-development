<style>
    /* Custom scrollbars */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #0f172a; }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #475569; }
    
    .glass-panel {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    /* DataTables Dark Theme Override */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #94a3b8 !important;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        background-color: #0f172a !important;
        border: 1px solid #334155 !important;
        color: #f1f5f9 !important;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        background-color: #0f172a !important;
        border: 1px solid #334155 !important;
        color: #f1f5f9 !important;
        border-radius: 0.5rem;
        padding: 0.5rem;
    }
    
    table.dataTable thead th,
    table.dataTable thead td {
        background-color: #1e293b !important;
        color: #94a3b8 !important;
        border-bottom: 1px solid #334155 !important;
    }
    
    table.dataTable tbody tr {
        background-color: transparent !important;
    }
    
    table.dataTable tbody tr:hover {
        background-color: rgba(30, 41, 59, 0.5) !important;
    }
    
    table.dataTable tbody td {
        color: #e2e8f0 !important;
        border-bottom: 1px solid #334155 !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #94a3b8 !important;
        border: 1px solid #334155 !important;
        border-radius: 0.375rem !important;
        padding: 0.375rem 0.75rem !important;
        margin: 0 0.125rem !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #3b82f6 !important;
        color: white !important;
        border: 1px solid #3b82f6 !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #334155 !important;
        color: white !important;
        border: 1px solid #475569 !important;
    }
    
    /* Modal styles for dark theme */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }

    .modal-content {
        background-color: #1e293b;
        margin: 5% auto;
        padding: 0;
        border-radius: 1rem;
        width: 90%;
        max-width: 700px;
        max-height: 90vh;
        overflow-y: auto;
        border: 1px solid #334155;
    }

    .modal-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #334155;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
        color: #f1f5f9;
        font-weight: 600;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #94a3b8;
        transition: color 0.2s;
    }

    .modal-close:hover {
        color: #f1f5f9;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #334155;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        background-color: #0f172a;
        color: #f1f5f9;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-group input[readonly] {
        background-color: #1e293b;
        cursor: not-allowed;
        color: #64748b;
    }

    .modal-footer {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid #334155;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    /* Toast notifications */
    .toast {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.25rem;
        border-radius: 0.5rem;
        color: white;
        z-index: 10000;
        min-width: 300px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        font-weight: 500;
    }

    .toast-success {
        background-color: #10b981;
    }

    .toast-error {
        background-color: #ef4444;
    }
</style>