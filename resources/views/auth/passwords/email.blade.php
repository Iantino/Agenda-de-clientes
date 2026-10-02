@extends('layouts.auth')

@section('title', 'Recuperar contraseña')

@section('content')
<h1 class="auth-title">Recuperar contraseña</h1>
<p class="auth-lead">Escribe el correo de tu cuenta y te enviaremos un enlace para crear una contraseña nueva.</p>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        <i class="bi bi-envelope-check me-1"></i> {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Enviar enlace</button>
</form>

<p class="auth-switch"><a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Volver a iniciar sesión</a></p>
@endsection
