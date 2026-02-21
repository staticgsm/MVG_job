<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --brand-primary: #ef7f1a;
            --sidebar-bg: #232323;
            --sidebar-item-hover: #2d2d2d;
            --text-muted: #9a9a9a;
        }
        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            transition: all 0.3s;
            position: fixed;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar-header {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar-logo {
            max-height: 40px;
        }
        .nav-link {
            padding: 12px 25px;
            color: var(--text-muted) !important;
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .nav-link i {
            width: 20px;
            margin-right: 15px;
            font-size: 16px;
            text-align: center;
        }
        .nav-link:hover {
            color: #fff !important;
            background-color: var(--sidebar-item-hover);
        }
        .nav-link.active {
            color: #fff !important;
            background-color: rgba(239, 127, 26, 0.1);
            border-left-color: var(--brand-primary);
        }
        .nav-link.active i {
            color: var(--brand-primary);
        }
        .sidebar-heading {
            padding: 25px 25px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.3) !important;
            font-weight: 700;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
        }
        .top-navbar {
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .user-profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        .card {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border-radius: 12px;
        }
        .text-base-color { color: var(--brand-primary) !important; }
        .btn-base-color {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #fff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-base-color:hover {
            background-color: #d66a10;
            border-color: #d66a10;
            color: #fff;
        }

        /* Global Professional Table Styles */
        .table {
            color: #444;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
            color: #666;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            padding: 15px 20px;
        }
        .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f2f2f2;
            font-size: 14px;
        }
        .table-hover tbody tr:hover {
            background-color: #fcfcfc;
        }
        
        /* Custom Badges */
        .badge {
            padding: 6px 12px;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 4px;
        }
        .bg-success { background-color: #e6f6ec !important; color: #00a854 !important; }
        .bg-danger { background-color: #fdebed !important; color: #f5222d !important; }
        .bg-warning { background-color: #fffbe6 !important; color: #faad14 !important; }
        .bg-info { background-color: #e6f7ff !important; color: #1890ff !important; }

        /* Card Enhancements */
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 20px 25px;
        }
        .card-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 0;
            font-size: 16px;
        }
        
        /* Form Styling */
        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            padding: 12px 15px;
            border: 1px solid #e4e4e4;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(239, 127, 26, 0.1);
        }
        
        /* Utility */
        .fw-700 { font-weight: 700; }
        .fs-14 { font-size: 14px; }
        .fs-12 { font-size: 12px; }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/MVG_logo .png') }}" alt="MVGC Logo" class="sidebar-logo">
                </a>
            </div>
            
            <div class="pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard Home</span>
                        </a>
                    </li>
                    
                    @if(auth()->user()->hasRole('super_admin'))
                        <li class="nav-item">
                            <h6 class="sidebar-heading">Super Admin</h6>
                            <a class="nav-link {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}" href="{{ route('super_admin.dashboard') }}">
                                <i class="bi bi-grid-fill"></i> Analytics
                            </a>
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i class="bi bi-people-fill"></i> User Management
                            </a>
                            <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                <i class="bi bi-shield-lock-fill"></i> Roles & Permissions
                            </a>
                            <a class="nav-link {{ request()->routeIs('super_admin.settings.*') ? 'active' : '' }}" href="{{ route('super_admin.settings.index') }}">
                                <i class="bi bi-gear-fill"></i> System Settings
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <h6 class="sidebar-heading">Administration</h6>
                            @if(auth()->user()->hasRole('admin'))
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-window-sidebar"></i> Main Dashboard
                                </a>
                            @endif
                            <a class="nav-link {{ request()->routeIs('admin.candidates.*') ? 'active' : '' }}" href="{{ route('admin.candidates.index') }}">
                                <i class="bi bi-person-badge-fill"></i> Candidates
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.subscription-plans.*') ? 'active' : '' }}" href="{{ route('admin.subscription-plans.index') }}">
                                <i class="bi bi-credit-card-2-front-fill"></i> Plans & Pricing
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}" href="{{ route('admin.jobs.index') }}">
                                <i class="bi bi-briefcase-fill"></i> Job Posts
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.master_data.*') ? 'active' : '' }}" href="{{ route('admin.master_data.index') }}">
                                <i class="bi bi-database-fill-gear"></i> Master Data
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->hasRole('hr') || auth()->user()->hasRole('super_admin'))
                        <li class="nav-item">
                            <h6 class="sidebar-heading">Recruitment</h6>
                            <a class="nav-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }}" href="{{ route('hr.dashboard') }}">
                                <i class="bi bi-person-plus-fill"></i> HR Dashboard
                            </a>
                            <a class="nav-link {{ request()->routeIs('hr.applications.index') ? 'active' : '' }}" href="{{ route('hr.applications.index') }}">
                                <i class="bi bi-file-earmark-person-fill"></i> Applications
                            </a>
                        </li>
                    @endif

                     @if(auth()->user()->hasRole('accountant') || auth()->user()->hasRole('super_admin'))
                        <li class="nav-item">
                            <h6 class="sidebar-heading">Finance</h6>
                            <a class="nav-link {{ request()->routeIs('accountant.dashboard') ? 'active' : '' }}" href="{{ route('accountant.dashboard') }}">
                                <i class="bi bi-graph-up-arrow"></i> Analytics
                            </a>
                            <a class="nav-link" href="#">
                                <i class="bi bi-receipt-cutoff"></i> Invoices
                            </a>
                        </li>
                    @endif                           
                </ul>
            </div>
            
            <div class="mt-auto p-4 border-top border-secondary">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger p-0">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="main-content">
            <nav class="navbar navbar-expand-md navbar-light top-navbar">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto align-items-center">
                            @guest
                                <!-- Already handled by middleware, but kept for safety -->
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ Auth::user()->candidateProfile && Auth::user()->candidateProfile->photo_path ? asset('storage/' . Auth::user()->candidateProfile->photo_path) : asset('images/MVG_logo .png') }}" class="user-profile-img">
                                        <div>
                                            <div class="fw-700 fs-14">{{ Auth::user()->name }}</div>
                                            <div class="fs-12 text-muted" style="margin-top: -3px;">{{ Auth::user()->role->name ?? 'User' }}</div>
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end shadow border-0 py-2 mt-2" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item px-4 py-2" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="px-md-5 py-5">
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

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
