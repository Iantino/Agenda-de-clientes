@extends('layouts.app')

@section('title', 'Nuevo cliente')

@section('content')
<div class="panel panel-form">
    <p class="panel-intro">Completa los dos campos. No puede haber dos clientes con el mismo correo.</p>

    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        @include('clientes._form')

        <div class="form-actions">
            <a href="{{ route('clientes.index') }}" class="btn btn-ghost">Cancelar</a>
            <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Guardar cliente</button>
        </div>
    </form>
</div>
@endsection
