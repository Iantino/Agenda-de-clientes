@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')
<h1 class="auth-title">Iniciar sesión</h1>
<p class="auth-lead">Entra con tu correo para ver y registrar clientes.</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-baseline">
            <label for="password" class="form-label">Contraseña</label>
            @if (Route::has('password.request'))
                <a class="small-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
        </div>
        <div class="input-group has-validation">
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            <button class="btn btn-toggle-pass" type="button" data-toggle-password="password" aria-label="Mostrar contraseña">
                <i class="bi bi-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Mantener la sesión abierta</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Entrar</button>
</form>

@if (Route::has('register'))
    <p class="auth-switch">¿No tienes cuenta? <a href="{{ route('register') }}">Crear cuenta</a></p>
@endif
@endsection
