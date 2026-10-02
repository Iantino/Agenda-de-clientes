@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="home-grid">
    <section class="panel home-hello">
        <h2>Hola, {{ Auth::user()->name }}</h2>
        <p>
            @if ($total === 0)
                Tu agenda está vacía. Empieza registrando a tu primer cliente.
            @else
                Tienes {{ $total }} {{ $total === 1 ? 'cliente registrado' : 'clientes registrados' }}.
            @endif
        </p>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('clientes.create') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Nuevo cliente</a>
            <a href="{{ route('clientes.index') }}" class="btn btn-ghost"><i class="bi bi-people"></i> Ver clientes</a>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Últimos registrados</h2>
        @if ($recientes->isEmpty())
            <p class="text-muted mb-0">Aquí aparecerán los cinco clientes más recientes.</p>
        @else
            <ul class="lista-recientes">
                @foreach ($recientes as $cliente)
                    <li>
                        <span class="avatar avatar-sm">{{ mb_strtoupper(mb_substr($cliente->nombre, 0, 1)) }}</span>
                        <div>
                            <strong>{{ $cliente->nombre }}</strong>
                            <small>{{ $cliente->correo }}</small>
                        </div>
                        <span class="text-muted ms-auto small">{{ $cliente->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
