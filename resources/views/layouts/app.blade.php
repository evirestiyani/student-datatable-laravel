<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons @1.11.3/font/bootstrap-icons.min.css">
    @stack('styles')

    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --primary-color: #ffc6c7;
            --primary-light: #fffffe;
            --secondary-color: #fffffe;
            --sidebar-bg: linear-gradient(135deg, #fffffe 0%, #ffc6c7 100%);
            --content-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --text-primary: #2d3748;
            --text-secondary: #33272a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            padding: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            color: #33272a;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-brand:hover {
            color: #33272a;
            text-decoration: none;
        }

        .sidebar-brand i {
            font-size: 1.8rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 8px;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin: 5px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #33272a;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            font-weight: 500;
            gap: 15px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ff8ba7;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #ff8ba7;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Header */
        .content-header {
            background: white;
            padding: 20px 30px;
            box-shadow: var(--card-shadow);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            color: var(--text-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: #f7fafc;
            border-radius: 25px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: #edf2f7;
            color: var(--text-primary);
            text-decoration: none;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: var(--sidebar-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Content Area */
        .content-body {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            background: white;
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 20px;
            border: none;
        }

        .card-title {
            margin: 0;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .card-body {
            padding: 25px;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            border-radius: 8px;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            border: none;
            border-radius: 8px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            border: none;
            border-radius: 8px;
        }

        /* DataTable Customization */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_filter input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 15px;
        }

        .dataTables_filter input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 1.2rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>Admin Panel</span>
            </a>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('siswa.index') }}"
                    class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <span>Data Siswa</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
            <div class="nav-item" style="margin-top: 30px;">
                <a href="#" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <div class="main-content">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <button class="mobile-toggle me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">@yield('page-title', 'Dashboard Admin')</h1>
            </div>
        </div>

        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.mobile-toggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
