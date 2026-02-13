<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard IKU')</title>

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">

    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                <span class="nav-link text-muted">
                    Sistem Informasi Kinerja BPS Kota Jambi
                </span>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Tahun: {{ session('tahun_aktif', 2026) }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    @foreach([2024,2025,2026] as $t)
                        <form action="{{ route('set.tahun') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tahun" value="{{ $t }}">
                            <button class="dropdown-item">
                                {{ $t }}
                            </button>
                        </form>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
        <i class="fas fa-user"></i> {{ auth()->user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-right">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>

    </div>
</li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">
                📊 SIKAT 1571
            </span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('laporan.create') }}"
                           class="nav-link {{ request()->routeIs('laporan.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>Upload Laporan</p>
                        </a>
                    </li>

                    @auth
@if(auth()->user()->isAdmin())

<li class="nav-header">ADMIN</li>

        {{-- MASTER DATA --}}
        <li class="nav-item has-treeview 
            {{ request()->routeIs('admin.iku.*') ? 'menu-open' : '' }}">

            <a href="#" class="nav-link 
                {{ request()->routeIs('admin.iku.*') ? 'active' : '' }}">

                <i class="nav-icon fas fa-database"></i>
                <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('admin.iku.index') }}"
                    class="nav-link {{ request()->routeIs('admin.iku.*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>IKU</p>
                    </a>
                </li>

            </ul>
        </li>


        {{-- MANAJEMEN USER --}}
        <li class="nav-item has-treeview 
            {{ request()->routeIs('admin.users.*') ? 'menu-open' : '' }}">

            <a href="#" class="nav-link 
                {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Manajemen User
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data User</p>
                    </a>
                </li>

            </ul>
        </li>

        @endif
        @endauth



                </ul>
            </nav>
        </div>
    </aside>

    {{-- Content Wrapper --}}
    <div class="content-wrapper">

        {{-- Page Header --}}
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('page-title')</h1>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>

    </div>

    {{-- Footer --}}
    <footer class="main-footer text-center text-sm">
        <strong>© {{ date('Y') }} Sistem Informasi Kinerja BPS Kota Jambi</strong>
    </footer>

</div>

{{-- AdminLTE JS --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@stack('js')
@stack('scripts')

</body>
</html>
