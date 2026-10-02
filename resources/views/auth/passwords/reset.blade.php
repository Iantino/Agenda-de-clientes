@extends('layouts.auth')

@section('title', 'Nueva contraseña')

@section('content')
<h1 class="auth-title">Nueva contraseña</h1>
<p class="auth-lead">Elige una contraseña nueva para tu cuenta.</p>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               required autocomplete="email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña nueva</label>
        <div class="input-group has-validation">
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="new-password" autofocus>
            <button class="btn btn-toggle-pass" type="button" data-toggle-password="password" aria-label="Mostrar contraseña">
                <i class="bi bi-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="password-confirm" class="form-label">Repite la contraseña</label>
        <input id="password-confirm" type="password" name="password_confirmation"
               class="form-control" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary w-100">Guardar contraseña</button>
</form>
@endsection
