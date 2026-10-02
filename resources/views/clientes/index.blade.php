@extends('layouts.app')

@section('title', 'Clientes')

@section('actions')
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Nuevo cliente
    </a>
@endsection

@section('content')
<div class="panel">
    <div class="panel-toolbar">
        <form method="GET" action="{{ route('clientes.index') }}" class="search-box" role="search">
            <i class="bi bi-search"></i>
            <input type="search" name="buscar" value="{{ $buscar }}" class="form-control"
                   placeholder="Buscar por nombre o correo" aria-label="Buscar clientes">
        </form>
        <span class="panel-count">
            {{ $clientes->total() }} {{ $clientes->total() === 1 ? 'cliente' : 'clientes' }}
        </span>
    </div>

    <div class="table-responsive">
        <table class="table tabla-clientes align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Registrado</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td class="text-muted">{{ $cliente->id }}</td>
                        <td>
                            <div class="cliente-nombre">
                                <span class="avatar avatar-sm">{{ mb_strtoupper(mb_substr($cliente->nombre, 0, 1)) }}</span>
                                {{ $cliente->nombre }}
                            </div>
                        </td>
                        <td><a href="mailto:{{ $cliente->correo }}" class="link-correo">{{ $cliente->correo }}</a></td>
                        <td class="text-muted">{{ $cliente->created_at->format('d/m/Y') }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-ghost" title="Editar">
                                <i class="bi bi-pencil"></i><span class="d-none d-md-inline"> Editar</span>
                            </a>
                            <button type="button" class="btn btn-sm btn-ghost-danger" title="Eliminar"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                    data-action="{{ route('clientes.destroy', $cliente) }}"
                                    data-nombre="{{ $cliente->nombre }}">
                                <i class="bi bi-trash"></i><span class="d-none d-md-inline"> Eliminar</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                @if ($buscar !== '')
                                    <p>Ningún cliente coincide con “{{ $buscar }}”.</p>
                                    <a href="{{ route('clientes.index') }}" class="btn btn-ghost">Ver todos</a>
                                @else
                                    <p>Aún no hay clientes. Registra el primero para empezar la lista.</p>
                                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                                        <i class="bi bi-person-plus"></i> Nuevo cliente
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($clientes->hasPages())
        <div class="panel-footer">{{ $clientes->links() }}</div>
    @endif
</div>

{{-- Modal de confirmación (un solo modal; JavaScript le pone el cliente) --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" class="modal-content" id="formEliminar">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalEliminarTitulo">Eliminar cliente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                Se eliminará a <strong data-nombre-cliente></strong>. Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
</div>
@endsection
