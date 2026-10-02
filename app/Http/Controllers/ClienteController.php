<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    // READ: tabla de clientes con búsqueda y paginación
    public function index(Request $request)
    {
        $buscar = trim((string) $request->query('buscar', ''));

        $clientes = Cliente::query()
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('nombre', 'like', "%{$buscar}%")
                      ->orWhere('correo', 'like', "%{$buscar}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes', 'buscar'));
    }

    // CREATE: formulario vacío
    public function create()
    {
        return view('clientes.create', ['cliente' => new Cliente()]);
    }

    // CREATE: guardar en la base
    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        $cliente = Cliente::create($datos);

        return redirect()
            ->route('clientes.index')
            ->with('ok', "Cliente guardado: {$cliente->nombre} ({$cliente->correo})");
    }

    // UPDATE: formulario con los datos actuales
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // UPDATE: guardar cambios
    public function update(Request $request, Cliente $cliente)
    {
        $datos = $request->validate($this->reglas($cliente), $this->mensajes());

        $cliente->update($datos);

        return redirect()
            ->route('clientes.index')
            ->with('ok', "Cliente actualizado: {$cliente->nombre}");
    }

    // DELETE: eliminar
    public function destroy(Cliente $cliente)
    {
        $nombre = $cliente->nombre;
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('ok', "Cliente eliminado: {$nombre}");
    }

    // Al editar, el correo del propio cliente no cuenta como repetido
    private function reglas(?Cliente $cliente = null): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => [
                'required', 'email', 'max:255',
                Rule::unique('clientes', 'correo')->ignore($cliente?->id),
            ],
        ];
    }

    private function mensajes(): array
    {
        return [
            'nombre.required' => 'Escribe el nombre del cliente.',
            'nombre.max'      => 'El nombre no puede pasar de 255 caracteres.',
            'correo.required' => 'Escribe el correo del cliente.',
            'correo.email'    => 'El correo no tiene un formato válido.',
            'correo.unique'   => 'Ya hay un cliente con ese correo.',
        ];
    }
}
