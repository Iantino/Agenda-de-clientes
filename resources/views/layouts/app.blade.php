<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inicio') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body class="app-body">
<div class="app-shell">

    {{-- Menú lateral --}}
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">A</span> Agenda de clientes
        </a>

        @auth
            <nav class="side-nav">
                <a href="{{ route('home') }}"
                   class="side-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> Inicio
                </a>
                <a href="{{ route('clientes.index') }}"
                   class="side-link {{ request()->routeIs('clientes.index', 'clientes.edit') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Clientes
                </a>
                <a href="{{ route('clientes.create') }}"
                   class="side-link {{ request()->routeIs('clientes.create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus"></i> Nuevo cliente
                </a>
            </nav>

            <div class="side-footer">
                <div class="side-user">
                    <span class="avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                    <div class="side-user-text">
                        <strong>{{ Auth::user()->name }}</strong>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="side-link side-logout">
                        <i class="bi bi-box-arrow-left"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        @endauth
    </aside>
    <div class="sidebar-backdrop" data-sidebar-close></div>

    {{-- Contenido --}}
    <div class="app-main">
        <header class="topbar">
            <button type="button" class="btn-icon d-lg-none" data-sidebar-toggle aria-label="Abrir menú">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="topbar-title">@yield('title', 'Inicio')</h1>
            <div class="topbar-actions">@yield('actions')</div>
        </header>

        <main class="app-content">
            @if (session('ok'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" data-autoclose>
                    <i class="bi bi-check-circle me-1"></i> {{ session('ok') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset('js/panel.js') }}"></script>
@stack('scripts')
</body>
</html>
