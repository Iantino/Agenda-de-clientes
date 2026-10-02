<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Acceso') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Tipografías e iconos del template --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Bootstrap 5 (compilado por Vite) y luego los estilos propios --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body class="auth-body">
    <main class="auth-shell">
        <aside class="auth-side">
            <a href="{{ url('/') }}" class="brand brand-light">
                <span class="brand-mark">A</span> Agenda de clientes
            </a>

            <div class="auth-side-copy">
                <h2>Tus clientes, ordenados de la A a la Z.</h2>
                <p>Registra nombre y correo, búscalos en segundos y mantén la lista al día.</p>
            </div>

            {{-- Índice alfabético decorativo, como el de una agenda de papel --}}
            <ul class="az-index" aria-hidden="true">
                @foreach (range('A', 'Z') as $letra)
                    <li>{{ $letra }}</li>
                @endforeach
            </ul>
        </aside>

        <section class="auth-main">
            <div class="auth-card">
                @yield('content')
            </div>
        </section>
    </main>

    <script src="{{ asset('js/panel.js') }}"></script>
</body>
</html>
