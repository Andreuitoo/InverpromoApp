<?php

namespace App\Http\Controllers;

use App\Models\Demanda;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;


class DemandasController extends Controller
{
    public function index()
    {
        return Inertia::render('Demandas/Index', [
            'filters' => Request::all('search'),
            'demandas' => Demanda::query()
                ->orderBy('ref', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($demanda) => [
                    'id' => $demanda->id,
                    'ref' => $demanda->ref,
                    'nombre' => $demanda->nombre,
                    'fecha' => $demanda->fecha,
                    'telefono' => $demanda->telefono,
                    'telefono_2' => $demanda->telefono_2,
                    'zona' => $demanda->zona,
                    'zona_2' => $demanda->zona_2,
                    'num_hab' => $demanda->num_hab,
                    'num_hab_2' => $demanda->num_hab_2,
                    'precio' => $demanda->precio,
                    'precio_2' => $demanda->precio_2,
                    'descripcion' => $demanda->descripcion,
                    'deleted_at' => $demanda->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Demandas/Create');
    }

    public function store()
    {
        $demanda = Demanda::create(
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
                'descripcion' => ['nullable', 'max:1000'],
            ])
        );

        return Redirect::route('demandas')->with('success', 'Demanda creada.');
    }

    public function edit(Demanda $demanda)
    {
        return Inertia::render('Demandas/Edit', [
            'demanda' => [
                'id' => $demanda->id,
                'ref' => $demanda->ref,
                'nombre' => $demanda->nombre,
                'fecha' => $demanda->fecha,
                'telefono' => $demanda->telefono,
                'telefono_2' => $demanda->telefono_2,
                'zona' => $demanda->zona,
                'zona_2' => $demanda->zona_2,
                'num_hab' => $demanda->num_hab,
                'num_hab_2' => $demanda->num_hab_2,
                'precio' => $demanda->precio,
                'precio_2' => $demanda->precio_2,
                'descripcion' => $demanda->descripcion,
                'deleted_at' => $demanda->deleted_at,
            ],
        ]);
    }

    public function update(Demanda $demanda)
    {
        $demanda->update(
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
                'descripcion' => ['nullable', 'max:3000'],
            ])
        );

        return Redirect::back()->with('success', 'Demanda actualizada.');
    }

    public function restore(Demanda $demanda)
    {
        $demanda->restore();

        return Redirect::back()->with('success', 'Demanda restaurada.');
    }

    public function destroy(Demanda $demanda)
    {
        $demanda->delete();

        return Redirect::back()->with('success', 'Demanda eliminada.');
    }
}

