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
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #ccc;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            color: #fff;
            background-color: #495057;
        }
        .sidebar .active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} ({{ Auth::user()->role->name ?? 'User' }})
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                    Dashboard Home
                                </a>
                            </li>
                            
                            @if(auth()->user()->hasRole('super_admin'))
                                <li class="nav-item">
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                      <span>Super Admin</span>
                                    </h6>
                                    <a class="nav-link {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}" href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">User Management</a>
                                    <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles & Permissions</a>
                                    <a class="nav-link {{ request()->routeIs('super_admin.settings.*') ? 'active' : '' }}" href="{{ route('super_admin.settings.index') }}">System Settings</a>
                                </li>
                            @endif

                            @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                      <span>Administration</span>
                                    </h6>
                                    @if(auth()->user()->hasRole('admin'))
                                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                    @endif
                                    <a class="nav-link {{ request()->routeIs('admin.candidates.*') ? 'active' : '' }}" href="{{ route('admin.candidates.index') }}">Candidates</a>
                                    <a class="nav-link {{ request()->routeIs('admin.subscription-plans.*') ? 'active' : '' }}" href="{{ route('admin.subscription-plans.index') }}">Subscription Plans</a>
                                    <a class="nav-link {{ request()->routeIs('admin.subscription-plans.*') ? 'active' : '' }}" href="{{ route('admin.subscription-plans.index') }}">Subscription Plans</a>
                                    <a class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}" href="{{ route('admin.jobs.index') }}">Jobs</a>
                                    <a class="nav-link {{ request()->routeIs('admin.master_data.*') ? 'active' : '' }}" href="{{ route('admin.master_data.index') }}">Master Data</a>
                                </li>
                            @endif

                            @if(auth()->user()->hasRole('hr') || auth()->user()->hasRole('super_admin'))
                                <li class="nav-item">
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                      <span>HR Management</span>
                                    </h6>
                                    <a class="nav-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }}" href="{{ route('hr.dashboard') }}">Dashboard</a>
                                    <a class="nav-link {{ request()->routeIs('hr.applications.index') ? 'active' : '' }}" href="{{ route('hr.applications.index') }}">Applications</a>
                                </li>
                            @endif

                             @if(auth()->user()->hasRole('accountant') || auth()->user()->hasRole('super_admin'))
                                <li class="nav-item">
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                      <span>Finance</span>
                                    </h6>
                                    <a class="nav-link {{ request()->routeIs('accountant.dashboard') ? 'active' : '' }}" href="{{ route('accountant.dashboard') }}">Dashboard</a>
                                    <a class="nav-link" href="#">Invoices</a>
                                </li>
                            @endif                           
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
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
                </main>
            </div>
        </div>
    </div>
</body>
</html>
