<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;


class PisosController extends Controller
{
    public function index()
    {
        return Inertia::render('Pisos/Index', [
            'filters' => Request::all('search'),
            'pisos' => Piso::query()
                ->orderBy('nombre')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($piso) => [
                    'id' => $piso->id,
                    'nombre' => $piso->nombre,
                    'fecha' => $piso->fecha,
                    'tipo_piso' => $piso->tipo_piso,
                    'zona' => $piso->zona,
                    'precio' => $piso->precio,
                    'num_hab' => $piso->num_hab,
                    'muebles' => $piso->muebles,
                    'descripcion' => $piso->descripcion,
                    'telefono' => $piso->telefono,
                    'propietario' => $piso->propietario,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Pisos/Create');
    }

    public function store()
    {
        Piso::create(
            Request::validate([
                'nombre' => ['required', 'max:50'],
                'fecha' => ['required', 'max:50'],
                'tipo_piso' => ['required', 'max:50'],
                'zona' => ['required', 'max:50'],
                'precio' => ['required', 'max:50'],
                'num_hab' => ['required', 'max:50'],
                'muebles' => ['required', 'max:50'],
                'descripcion' => ['required', 'max:150'],
                'telefono' => ['required', 'max:50'],
                'propietario' => ['required', 'max:50'],
            ])
        );
        return Redirect::route('Pisos')->with('success', 'Piso añadido correctamente.');
    }

    public function edit(Piso $piso)
    {
        return Inertia::render('Pisos/Edit', [
            'piso' => [
                'id' => $piso->id,
                'nombre' => $piso->nombre,
                'fecha' => $piso->fecha,
                'tipo_piso' => $piso->tipo_piso,
                'zona' => $piso->zona,
                'precio' => $piso->precio,
                'num_hab' => $piso->num_hab,
                'muebles' => $piso->muebles,
                'descripcion' => $piso->descripcion,
                'telefono' => $piso->telefono,
                'propietario' => $piso->propietario,
            ],
        ]);
    }

    public function update(Piso $piso)
    {
        $piso->update(
            Request::validate([
                'nombre' => ['required', 'max:50'],
                'fecha' => ['required', 'max:50'],
                'tipo_piso' => ['required', 'max:50'],
                'zona' => ['required', 'max:50'],
                'precio' => ['required', 'max:50'],
                'num_hab' => ['required', 'max:50'],
                'muebles' => ['required', 'max:50'],
                'descripcion' => ['required', 'max:50'],
                'telefono' => ['required', 'max:50'],
                'propietario' => ['required', 'max:50'],
            ])
        );

        return Redirect::back()->with('success', 'Piso actualizado correctamente.');
    }

    public function restore(Piso $piso)
    {
        $piso->restore();

        return Redirect::back()->with('success', 'Piso restaurado correctamente.');
    }

    public function destroy(Piso $piso)
    {
        $piso->delete();

        return Redirect::back()->with('success', 'Piso eliminado correctamente.');
    }
}

