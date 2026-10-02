{{-- Campos compartidos por "Nuevo cliente" y "Editar cliente" --}}
<div class="mb-3">
    <label class="form-label" for="nombre">Nombre</label>
    <input id="nombre" name="nombre" type="text"
           value="{{ old('nombre', $cliente->nombre) }}"
           class="form-control @error('nombre') is-invalid @enderror"
           placeholder="Ej. María López" required maxlength="255" autofocus>
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label" for="correo">Correo</label>
    <input id="correo" name="correo" type="email"
           value="{{ old('correo', $cliente->correo) }}"
           class="form-control @error('correo') is-invalid @enderror"
           placeholder="maria@ejemplo.com" required maxlength="255">
    @error('correo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
