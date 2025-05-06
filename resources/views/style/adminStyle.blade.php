<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #8B0000;
        --secondary-color: #D32F2F;
        --text-light: #FFFFFF;
        --text-dark: #333333;
        --bg-gray: #F5F5F5;
    }

    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
    }

    /* Sidebar Styles */
    .sidebar {
        background-color: #f8f9fa;
        height: 100vh;
        border-right: 1px solid #dee2e6;
        position: fixed;
    }

    .logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    .navbar-brand {
        color: var(--primary-color);
        font-weight: bold;
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        color: var(--primary-color);
        font-weight: bold;
    }

    /* Notification Styles */
    .notification-badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .notification-icon {
        position: relative;
    }

    /* Profile Styles */
    .profile-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
    }

    /* Link Styles */
    .logout {
        color: red;
    }

    a {
        text-decoration: none;
    }

    /* Table Styles */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .table-light {
        background-color: #f8f9fa;
    }

    /* Badge Styles */
    .badge {
        font-size: 0.9rem;
    }

    .bg-success {
        background-color: #198754 !important;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: var(--text-dark) !important;
    }

    .bg-danger {
        background-color: #dc3545 !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    /* Button Styles */
    .btn-danger {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-danger:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-danger {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-danger:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* Card Styles */
    .card {
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Form Styles */
    .form-control, .form-select {
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
    }

    /* Input Group Styles */
    .input-group-text {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }

    /* Pagination Styles */
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .page-link {
        color: var(--primary-color);
    }

    /* Text Styles */
    .text-danger {
        color: var(--primary-color) !important;
    }

    .text-success {
        color: #198754 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    /* Background Styles */
    .bg-white {
        background-color: white !important;
    }

    /* Data Bahan Section */
    .data-bahan {
        background: #f8f9fa;
    }

    /* Rounded Card Styles */
    .rounded-4 {
        border-radius: 0.5rem !important;
    }

    /* Shadow Styles */
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    /* Alignment Styles */
    .align-middle {
        vertical-align: middle !important;
    }

    /* Small Text Styles */
    .small {
        font-size: 0.875em !important;
    }

    /* Text Uppercase */
    .text-uppercase {
        text-transform: uppercase !important;
    }

    /* Disabled State */
    .disabled {
        pointer-events: none;
        opacity: 0.65;
    }

    /* Responsive Table */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Nav Tabs */
    .nav-tabs .nav-link {
        color: var(--text-dark);
        border: 1px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    /* List Group */
    .list-group-item-action {
        transition: background-color 0.15s ease;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 0.5rem;
    }

    /* Input Group Addon */
    .input-group-text {
        color: #495057;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
</style>
