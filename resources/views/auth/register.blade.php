@extends('layouts.auth')

@section('title', 'Crear cuenta')

@section('content')
<h1 class="auth-title">Crear cuenta</h1>
<p class="auth-lead">Con tu cuenta podrás registrar clientes y consultar la lista.</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}"
               class="form-control @error('name') is-invalid @enderror"
               required autocomplete="name" autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               required autocomplete="email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <div class="input-group has-validation">
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="new-password">
            <button class="btn btn-toggle-pass" type="button" data-toggle-password="password" aria-label="Mostrar contraseña">
                <i class="bi bi-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-text">Mínimo 8 caracteres.</div>
    </div>

    <div class="mb-4">
        <label for="password-confirm" class="form-label">Repite la contraseña</label>
        <input id="password-confirm" type="password" name="password_confirmation"
               class="form-control" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>
</form>

<p class="auth-switch">¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
@endsection
