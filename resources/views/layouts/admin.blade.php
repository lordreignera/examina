<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EXAMINA - Lab Test System')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('examina log.jpeg') }}">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="shortcut icon" href="/admin/assets/images/favicon.png" />
    
    @stack('styles')
    
    <style id="force-light-theme">
        /* DISABLE DARK THEME COMPLETELY */
        * {
            transition: none !important;
        }
        
        /* Light Theme Customization - HIGHEST PRIORITY */
        body {
            background: #f4f5f7 !important;
            color: #343a40 !important;
        }
        
        body.sidebar-icon-only .sidebar,
        body .sidebar {
            background: linear-gradient(180deg, #2196F3 0%, #00BCD4 100%) !important;
        }
        
        /* Sidebar with blue gradient */
        .sidebar {
            background: linear-gradient(180deg, #2196F3 0%, #00BCD4 100%) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100vh !important;
            width: 255px !important;
            z-index: 11 !important;
            display: block !important;
        }
        
        .sidebar-offcanvas {
            display: block !important;
        }
        
        /* Navbar positioning */
        .navbar {
            background: #fff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed !important;
            top: 0 !important;
            right: 0 !important;
            left: 255px !important;
            z-index: 10 !important;
            display: flex !important;
            height: 60px !important;
            padding: 0 !important;
        }
        
        .navbar-brand-wrapper {
            width: 0 !important;
            padding: 0 !important;
        }
        
        .navbar .navbar-brand-wrapper.d-lg-none {
            width: auto !important;
            padding: 0 15px !important;
        }
        
        /* Navbar dropdown positioning */
        .navbar .dropdown-menu {
            position: absolute !important;
            right: 0 !important;
            top: 100% !important;
            left: auto !important;
            margin-top: 0 !important;
            border: 1px solid #e8ecf1 !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08) !important;
            border-radius: 4px !important;
            min-width: 200px !important;
        }
        
        .navbar .dropdown-menu .dropdown-item {
            padding: 0.75rem 1.5rem !important;
            font-size: 0.875rem !important;
            color: #343a40 !important;
        }
        
        .navbar .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa !important;
        }
        
        .navbar .dropdown-menu h6 {
            color: #6c757d !important;
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        
        .navbar-profile {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .navbar-profile img {
            width: 32px !important;
            height: 32px !important;
        }
        
        .navbar-profile-name {
            font-size: 0.875rem !important;
            color: #343a40 !important;
            font-weight: 500 !important;
        }
        
        .navbar-nav-right {
            margin-left: auto !important;
        }
        
        .preview-list .preview-item {
            display: flex !important;
            align-items: center !important;
            padding: 0.75rem 1.5rem !important;
            border-bottom: 1px solid #f2f2f2 !important;
        }
        
        .preview-list .preview-item:last-child {
            border-bottom: none !important;
        }
        
        .preview-thumbnail {
            margin-right: 1rem !important;
        }
        
        .preview-icon {
            width: 40px !important;
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 1.25rem !important;
        }
        
        .preview-item-content {
            flex: 1 !important;
        }
        
        .preview-subject {
            font-size: 0.875rem !important;
            color: #343a40 !important;
            margin: 0 !important;
        }
        
        .navbar-menu-wrapper {
            display: flex !important;
            width: 100% !important;
            align-items: center !important;
            padding: 0 1.5rem !important;
        }
        
        .navbar .search {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .navbar .search .form-control {
            border: 1px solid #e8ecf1 !important;
            background: #f8f9fa !important;
            height: 40px !important;
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
        }
        
        /* Main panel positioning */
        .page-body-wrapper {
            padding-left: 255px !important;
            padding-top: 60px !important;
            min-height: calc(100vh - 60px) !important;
        }
        
        .main-panel {
            width: 100% !important;
            display: block !important;
        }
        
        .content-wrapper {
            padding: 2rem !important;
        }
        
        /* Sidebar brand */
        .sidebar-brand-wrapper {
            height: 60px !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 1rem !important;
            background: rgba(0, 0, 0, 0.1) !important;
            position: relative !important;
        }
        
        .sidebar .sidebar-brand-wrapper {
            width: 255px !important;
            left: 0 !important;
        }
        
        /* Show only full logo, hide mini logo by default */
        .sidebar .brand-logo {
            display: flex !important;
        }
        
        .sidebar .brand-logo-mini {
            display: none !important;
        }
        
        /* When sidebar is minimized, swap logos */
        .sidebar.sidebar-icon-only .brand-logo {
            display: none !important;
        }
        
        .sidebar.sidebar-icon-only .brand-logo-mini {
            display: flex !important;
        }
        
        .sidebar .nav .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
        }
        
        .sidebar .nav .nav-item .nav-link:hover,
        .sidebar .nav .nav-item.active > .nav-link {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
        }
        
        .sidebar .nav .nav-item .nav-link i.menu-icon {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .sidebar-brand-wrapper {
            background: rgba(0, 0, 0, 0.1) !important;
        }
        
        .sidebar .nav .nav-item .nav-link .menu-title {
            color: rgba(255, 255, 255, 0.9);
        }
        
        /* Main content area - light */
        .main-panel {
            background: #f4f5f7;
        }
        
        .content-wrapper {
            background: #f4f5f7;
        }
        
        /* Navbar - light */
        .navbar {
            background: #fff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar .navbar-menu-wrapper {
            background: #fff;
            color: #343a40;
        }
        
        .navbar .navbar-nav .nav-item .nav-link {
            color: #343a40;
        }
        
        /* Cards - light */
        .card {
            background: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .card .card-body {
            color: #343a40;
        }
        
        /* Tables - NUCLEAR OPTION - FORCE OVERRIDE EVERYTHING */
        .table,
        table.table,
        .card .table,
        .card-body .table,
        .table-responsive .table,
        .table-responsive table,
        div .table,
        .content-wrapper .table {
            color: #212529 !important;
            background-color: #ffffff !important;
        }
        
        .table thead th,
        table.table thead th,
        .table thead tr th,
        table thead th {
            border-bottom: 2px solid #dee2e6 !important;
            color: #212529 !important;
            background-color: #f8f9fa !important;
            font-weight: 600 !important;
        }
        
        .table tbody tr,
        table.table tbody tr,
        .table tbody tr td,
        table tbody tr,
        table tbody tr td {
            background-color: #ffffff !important;
            color: #212529 !important;
        }
        
        /* HOVER STATE - MAXIMUM PRIORITY */
        .table tbody tr:hover,
        table.table tbody tr:hover,
        .table-hover tbody tr:hover,
        .table.table-hover tbody tr:hover,
        .card .table tbody tr:hover,
        .card-body .table tbody tr:hover,
        div table tbody tr:hover {
            background-color: #e9ecef !important;
            background: #e9ecef !important;
        }
        
        .table tbody tr:hover td,
        table.table tbody tr:hover td,
        .table-hover tbody tr:hover td,
        .table.table-hover tbody tr:hover td,
        .table tbody tr:hover th,
        table.table tbody tr:hover th,
        .card .table tbody tr:hover td,
        .card-body .table tbody tr:hover td,
        div table tbody tr:hover td {
            background-color: #e9ecef !important;
            background: #e9ecef !important;
            color: #212529 !important;
        }
        
        .table td, 
        .table th,
        table.table td,
        table.table th,
        table td,
        table th {
            color: #212529 !important;
        }
        
        .table tbody tr td strong,
        .table tbody tr td span:not(.badge),
        table tbody tr td strong,
        table tbody tr td span:not(.badge) {
            color: #212529 !important;
        }
        
        .table tbody tr:hover td strong,
        .table tbody tr:hover td span:not(.badge),
        table tbody tr:hover td strong,
        table tbody tr:hover td span:not(.badge) {
            color: #212529 !important;
        }
        
        /* Navbar elements */
        .navbar .navbar-nav .nav-item .nav-link:hover {
            background-color: #f8f9fa !important;
            color: #343a40 !important;
        }
        
        .navbar .search input.form-control {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            color: #343a40 !important;
        }
        
        .navbar .search input.form-control::placeholder {
            color: #6c757d !important;
        }
        
        .navbar .search input.form-control:focus {
            background-color: #fff !important;
            border-color: #2196F3 !important;
            color: #343a40 !important;
        }
        
        /* Dropdown menus */
        .dropdown-menu {
            background-color: #fff !important;
            border: 1px solid #dee2e6 !important;
        }
        
        .dropdown-item {
            color: #343a40 !important;
        }
        
        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #f8f9fa !important;
            color: #343a40 !important;
        }
        
        .dropdown-item .preview-item-content p {
            color: #343a40 !important;
        }
        
        .dropdown-divider {
            border-top-color: #dee2e6 !important;
        }
        
        /* Profile section in sidebar */
        .sidebar .nav .nav-item.profile {
            background: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav .nav-item.profile .profile-name h5,
        .sidebar .nav .nav-item.profile .profile-name span {
            color: #fff !important;
        }
        
        /* Footer */
        .footer {
            background: #fff;
            border-top: 1px solid #e0e0e0;
        }
        
        /* Page header */
        .page-header {
            margin-bottom: 25px;
        }
        
        .page-header .page-title {
            color: #343a40;
        }
        
        /* Gradient cards keep their colors */
        .bg-gradient-danger,
        .bg-gradient-info,
        .bg-gradient-success {
            color: #fff !important;
        }
        
        /* ULTRA AGGRESSIVE TABLE HOVER FIX */
        .card .table tbody tr:hover,
        .card .table-responsive .table tbody tr:hover,
        .card-body .table tbody tr:hover,
        .table-responsive table tbody tr:hover {
            background-color: #e9ecef !important;
        }
        
        .card .table tbody tr:hover td,
        .card .table tbody tr:hover td *,
        .card .table-responsive .table tbody tr:hover td,
        .card .table-responsive .table tbody tr:hover td *,
        .card-body .table tbody tr:hover td,
        .card-body .table tbody tr:hover td *,
        .table-responsive table tbody tr:hover td,
        .table-responsive table tbody tr:hover td * {
            background-color: #e9ecef !important;
            color: #212529 !important;
        }
        
        /* Force all table text to be dark */
        .table td strong,
        .table td span,
        .table td label:not(.badge),
        .table td a,
        .table td i {
            color: #212529 !important;
        }
        
        /* Ensure badges keep their colors */
        .table td .badge {
            color: #fff !important;
        }
        
        /* Make action buttons visible */
        .btn-gradient-primary,
        .btn.btn-gradient-primary {
            background: linear-gradient(to right, #2196F3, #00BCD4) !important;
            border: none !important;
            color: #fff !important;
            font-weight: 500 !important;
            padding: 8px 16px !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 5px !important;
        }
        
        .btn-gradient-primary:hover,
        .btn.btn-gradient-primary:hover {
            background: linear-gradient(to right, #1976D2, #0097A7) !important;
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3) !important;
        }
        
        .btn-gradient-info {
            background: linear-gradient(to right, #00BCD4, #0097A7) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .btn-gradient-danger {
            background: linear-gradient(to right, #f44336, #d32f2f) !important;
            border: none !important;
            color: #fff !important;
        }
        
        .btn-gradient-success {
            background: linear-gradient(to right, #4CAF50, #388E3C) !important;
            border: none !important;
            color: #fff !important;
        }
    </style>
    
    <script>
        // ULTRA AGGRESSIVE - Force light theme and fix table hover
        (function() {
            function forceTableColors() {
                // Remove any dark theme classes
                document.body.classList.remove('dark-theme', 'sidebar-dark');
                document.documentElement.classList.remove('dark-theme');
                
                // Force all tables to have proper hover
                const tables = document.querySelectorAll('.table, table');
                tables.forEach(table => {
                    // Set base table styles
                    table.style.backgroundColor = '#ffffff';
                    table.style.color = '#212529';
                    
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        // Set base row styles
                        row.style.backgroundColor = '#ffffff';
                        row.style.color = '#212529';
                        
                        const cells = row.querySelectorAll('td, th');
                        cells.forEach(cell => {
                            cell.style.backgroundColor = '#ffffff';
                            cell.style.color = '#212529';
                        });
                        
                        // Add hover listeners with inline styles (highest priority)
                        row.addEventListener('mouseenter', function(e) {
                            e.stopPropagation();
                            this.style.setProperty('background-color', '#e9ecef', 'important');
                            this.style.setProperty('background', '#e9ecef', 'important');
                            
                            const cells = this.querySelectorAll('td, th');
                            cells.forEach(cell => {
                                cell.style.setProperty('background-color', '#e9ecef', 'important');
                                cell.style.setProperty('background', '#e9ecef', 'important');
                                cell.style.setProperty('color', '#212529', 'important');
                                
                                // Force all text elements to be dark
                                const textElements = cell.querySelectorAll('strong, span:not(.badge), a, i, p, div');
                                textElements.forEach(el => {
                                    el.style.setProperty('color', '#212529', 'important');
                                });
                            });
                        }, true);
                        
                        row.addEventListener('mouseleave', function(e) {
                            e.stopPropagation();
                            this.style.setProperty('background-color', '#ffffff', 'important');
                            this.style.setProperty('background', '#ffffff', 'important');
                            
                            const cells = this.querySelectorAll('td, th');
                            cells.forEach(cell => {
                                cell.style.setProperty('background-color', '#ffffff', 'important');
                                cell.style.setProperty('background', '#ffffff', 'important');
                                cell.style.setProperty('color', '#212529', 'important');
                                
                                const textElements = cell.querySelectorAll('strong, span:not(.badge), a, i, p, div');
                                textElements.forEach(el => {
                                    el.style.setProperty('color', '#343a40', 'important');
                                });
                            });
                        }, true);
                    });
                });
            }
            
            // Run immediately
            forceTableColors();
            
            // Run on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', forceTableColors);
            }
            
            // Run after all assets load
            window.addEventListener('load', function() {
                setTimeout(forceTableColors, 100);
                setTimeout(forceTableColors, 500);
            });
            
            // Watch for any new tables added dynamically
            const observer = new MutationObserver(function(mutations) {
                forceTableColors();
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        })();
    </script>
    
    @stack('styles')
  </head>
  <body>
    <div class="container-scroller">
      <!-- Sidebar -->
      @include('admin.partials.sidebar')
      
      <div class="container-fluid page-body-wrapper">
        <!-- Navbar -->
        @include('admin.partials.navbar')
        
        <!-- Main Content -->
        <div class="main-panel">
          <div class="content-wrapper">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            
            @yield('content')
          </div>
          
          <!-- Footer -->
          @include('admin.partials.footer')
        </div>
      </div>
    </div>

    <!-- jQuery (required for some admin template scripts) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    
    @stack('scripts')
  </body>
</html>
