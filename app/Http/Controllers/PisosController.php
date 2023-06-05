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
                ->orderBy('ref', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($piso) => [
                    'id' => $piso->id,
                    'ref' => $piso->ref,
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
        $piso = Piso::create(
            Request::validate([
                'ref' => ['required', 'max:50'],
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

        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotos', 'public');
                $piso->fotos()->create(['ruta' => $ruta]);
            }
        }
        return Redirect::route('Pisos')->with('success', 'Piso añadido correctamente.');
    }

    public function edit(Piso $piso)
    {
        $fotos = $piso->fotos()->get(['id', 'ruta']);

        return Inertia::render('Pisos/Edit', [
            'piso' => [
                'id' => $piso->id,
                'ref' => $piso->ref,
                'fecha' => $piso->fecha,
                'tipo_piso' => $piso->tipo_piso,
                'zona' => $piso->zona,
                'precio' => $piso->precio,
                'num_hab' => $piso->num_hab,
                'muebles' => $piso->muebles,
                'descripcion' => $piso->descripcion,
                'telefono' => $piso->telefono,
                'propietario' => $piso->propietario,
                'fotos' => $fotos,
            ],
        ]);
    }

    public function update(Piso $piso)
    {
        $piso->update(
            Request::validate([
                'ref' => ['required', 'max:50'],
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

        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotos', 'public');
                $piso->fotos()->create(['ruta' => $ruta]);
            }
        }

        return Redirect::back()->with('success', 'Piso actualizado correctamente.');
    }

    public function showPhotos(Piso $piso)
    {
        $fotos = $piso->fotos()->get(['ruta']);

        return Inertia::render('Pisos/Fotos', [
            'piso' => [
                'id' => $piso->id,
                'ref' => $piso->ref,
                'fecha' => $piso->fecha,
                'tipo_piso' => $piso->tipo_piso,
                'zona' => $piso->zona,
                'precio' => $piso->precio,
                'num_hab' => $piso->num_hab,
                'muebles' => $piso->muebles,
                'descripcion' => $piso->descripcion,
                'telefono' => $piso->telefono,
                'propietario' => $piso->propietario,
                'fotos' => $fotos,
            ],
        ]);
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

