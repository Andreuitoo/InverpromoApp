<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;


class ClientesController extends Controller
{
    public function index()
    {
        return Inertia::render('Clientes/Index', [
            'filters' => Request::all('search'),
            'clientes' => Cliente::query()
                ->orderBy('ref', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($cliente) => [
                    'id' => $cliente->id,
                    'ref' => $cliente->ref,
                    'nombre' => $cliente->nombre,
                    'fecha' => $cliente->fecha,
                    'telefono' => $cliente->telefono,
                    'telefono_2' => $cliente->telefono_2,
                    'zona' => $cliente->zona,
                    'zona_2' => $cliente->zona_2,
                    'num_hab' => $cliente->num_hab,
                    'num_hab_2' => $cliente->num_hab_2,
                    'precio' => $cliente->precio,
                    'precio_2' => $cliente->precio_2,
                    'descripcion' => $cliente->descripcion,
                    'deleted_at' => $cliente->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Clientes/Create');
    }

    public function store()
    {
        $cliente = Cliente::create(
            Request::validate([
                'ref' => ['required', 'max:10'],
                'nombre' => ['required', 'max:35'],
                'fecha' => ['required', 'max:10'],
                'telefono' => ['required', 'max:9'],
                'telefono_2' => ['nullable', 'max:9'],
                'zona' => ['required', 'max:100'],
                'zona_2' => ['nullable', 'max:100'],
                'num_hab' => ['required', 'max:2'],
                'num_hab_2' => ['nullable', 'max:2'],
                'precio' => ['required', 'max:10'],
                'precio_2' => ['nullable', 'max:10'],
                'descripcion' => ['nullable', 'max:250'],
            ])
        );

        return Redirect::route('clientes')->with('success', 'Cliente creado.');
    }

    public function edit(Cliente $cliente)
    {
        return Inertia::render('Clientes/Edit', [
            'cliente' => [
                'id' => $cliente->id,
                'ref' => $cliente->ref,
                'nombre' => $cliente->nombre,
                'fecha' => $cliente->fecha,
                'telefono' => $cliente->telefono,
                'telefono_2' => $cliente->telefono_2,
                'zona' => $cliente->zona,
                'zona_2' => $cliente->zona_2,
                'num_hab' => $cliente->num_hab,
                'num_hab_2' => $cliente->num_hab_2,
                'precio' => $cliente->precio,
                'precio_2' => $cliente->precio_2,
                'descripcion' => $cliente->descripcion,
                'deleted_at' => $cliente->deleted_at,
            ],
        ]);
    }

    public function update(Cliente $cliente)
    {
        $cliente->update(
            Request::validate([
                'ref' => ['required', 'max:10'],
                'nombre' => ['required', 'max:35'],
                'fecha' => ['required', 'max:10'],
                'telefono' => ['required', 'max:9'],
                'telefono_2' => ['nullable', 'max:9'],
                'zona' => ['required', 'max:100'],
                'zona_2' => ['nullable', 'max:100'],
                'num_hab' => ['required', 'max:2'],
                'num_hab_2' => ['nullable', 'max:2'],
                'precio' => ['required', 'max:10'],
                'precio_2' => ['nullable', 'max:10'],
                'descripcion' => ['nullable', 'max:250'],
            ])
        );

        return Redirect::back()->with('success', 'Cliente actualizado.');
    }

    public function restore(Cliente $cliente)
    {
        $cliente->restore();

        return Redirect::back()->with('success', 'Cliente restaurado.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return Redirect::back()->with('success', 'Cliente eliminado.');
    }
}
