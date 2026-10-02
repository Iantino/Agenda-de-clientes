@extends('layouts.app')

@section('title', 'Editar cliente')

@section('content')
<div class="panel panel-form">
    <p class="panel-intro">Registrado el {{ $cliente->created_at->format('d/m/Y') }}. Cambia lo que necesites y guarda.</p>

    <form method="POST" action="{{ route('clientes.update', $cliente) }}">
        @csrf
        @method('PUT')
        @include('clientes._form')

        <div class="form-actions">
            <a href="{{ route('clientes.index') }}" class="btn btn-ghost">Cancelar</a>
            <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
