<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class ViviendasController extends Controller
{
    public function index()
    {
        return Inertia::render('Viviendas/Index', [
            'filters' => Request::all('search'),
            'viviendas' => Vivienda::query()
                ->orderBy('ref', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($vivienda) => [
                    'id' => $vivienda->id,
                    'ref' => $vivienda->ref,
                    'fecha' => $vivienda->fecha,
                    'nota' => $vivienda->nota,
                    'tipo' => $vivienda->tipo,
                    'propietario' => $vivienda->propietario,
                    'telefono' => $vivienda->telefono,
                    'zona' => $vivienda->zona,
                    'zona_2' => $vivienda->zona_2,
                    'precio_prop' => $vivienda->precio_prop,
                    'precio_venta' => $vivienda->precio_venta,
                    'terraza' => $vivienda->terraza,
                    'num_hab' => $vivienda->num_hab,
                    'num_banos' => $vivienda->num_banos,
                    'ascensor' => $vivienda->ascensor,
                    'altura_planta' => $vivienda->altura_planta,
                    'coladuria' => $vivienda->coladuria,
                    'garaje' => $vivienda->garaje,
                    'piscina' => $vivienda->piscina,
                    'balcon' => $vivienda->balcon,
                    'm2' => $vivienda->m2,
                    'estado' => $vivienda->estado,
                    'muebles' => $vivienda->muebles,
                    'carpinteria_int' => $vivienda->carpinteria_int,
                    'carpinteria_ext' => $vivienda->carpinteria_ext,
                    'zona_comunitaria' => $vivienda->zona_comunitaria,
                    'antiguedad' => $vivienda->antiguedad,
                    'direccion' => $vivienda->direccion,
                    'descripcion' => $vivienda->descripcion,
                    'deleted_at' => $vivienda->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Viviendas/Create');
    }

    public function store()
    {
        $vivienda = Vivienda::create(
            Request::validate([
                'ref' => ['required', 'max:10'],
                'fecha' => ['required', 'max:10'],
                'nota' => ['required', 'max:10'],
                'tipo' => ['required', 'max:10'],
                'propietario' => ['required', 'max:10'],
                'telefono' => ['required', 'max:10'],
                'zona' => ['required', 'max:10'],
                'zona_2' => ['required', 'max:10'],
                'precio_prop' => ['required', 'max:10'],
                'precio_venta' => ['required', 'max:10'],
                'terraza' => ['required', 'max:10'],
                'num_hab' => ['required', 'max:10'],
                'num_banos' => ['required', 'max:10'],
                'ascensor' => ['required', 'max:10'],
                'altura_planta' => ['required', 'max:10'],
                'coladuria' => ['required', 'max:10'],
                'garaje' => ['required', 'max:10'],
                'piscina' => ['required', 'max:10'],
                'balcon' => ['required', 'max:10'],
                'm2' => ['required', 'max:10'],
                'estado' => ['required', 'max:10'],
                'muebles' => ['required', 'max:10'],
                'carpinteria_int' => ['required', 'max:10'],
                'carpinteria_ext' => ['required', 'max:10'],
                'zona_comunitaria' => ['required', 'max:10'],
                'antiguedad' => ['required', 'max:10'],
                'direccion' => ['required', 'max:10'],
                'descripcion' => ['required', 'max:10'],
            ])
        );

        return Redirect::route('viviendas')->with('success', 'Vivienda añadida correctamente.');
    }

    public function edit(Vivienda $vivienda)
    {
        return Inertia::render('Viviendas/Edit', [
            'vivienda' => [
                'id' => $vivienda->id,
                'ref' => $vivienda->ref,
                'fecha' => $vivienda->fecha,
                'nota' => $vivienda->nota,
                'tipo' => $vivienda->tipo,
                'propietario' => $vivienda->propietario,
                'telefono' => $vivienda->telefono,
                'zona' => $vivienda->zona,
                'zona_2' => $vivienda->zona_2,
                'precio_prop' => $vivienda->precio_prop,
                'precio_venta' => $vivienda->precio_venta,
                'terraza' => $vivienda->terraza,
                'num_hab' => $vivienda->num_hab,
                'num_banos' => $vivienda->num_banos,
                'ascensor' => $vivienda->ascensor,
                'altura_planta' => $vivienda->altura_planta,
                'coladuria' => $vivienda->coladuria,
                'garaje' => $vivienda->garaje,
                'piscina' => $vivienda->piscina,
                'balcon' => $vivienda->balcon,
                'm2' => $vivienda->m2,
                'estado' => $vivienda->estado,
                'muebles' => $vivienda->muebles,
                'carpinteria_int' => $vivienda->carpinteria_int,
                'carpinteria_ext' => $vivienda->carpinteria_ext,
                'zona_comunitaria' => $vivienda->zona_comunitaria,
                'antiguedad' => $vivienda->antiguedad,
                'direccion' => $vivienda->direccion,
                'descripcion' => $vivienda->descripcion,
                'deleted_at' => $vivienda->deleted_at,
            ],
        ]);
    }

    public function update(Vivienda $vivienda)
    {
        $vivienda->update(
            Request::validate([
                'ref' => ['required', 'max:10'],
                'fecha' => ['required', 'max:10'],
                'nota' => ['required', 'max:10'],
                'tipo' => ['required', 'max:10'],
                'propietario' => ['required', 'max:10'],
                'telefono' => ['required', 'max:10'],
                'zona' => ['required', 'max:10'],
                'zona_2' => ['required', 'max:10'],
                'precio_prop' => ['required', 'max:10'],
                'precio_venta' => ['required', 'max:10'],
                'terraza' => ['required', 'max:10'],
                'num_hab' => ['required', 'max:10'],
                'num_banos' => ['required', 'max:10'],
                'ascensor' => ['required', 'max:10'],
                'altura_planta' => ['required', 'max:10'],
                'coladuria' => ['required', 'max:10'],
                'garaje' => ['required', 'max:10'],
                'piscina' => ['required', 'max:10'],
                'balcon' => ['required', 'max:10'],
                'm2' => ['required', 'max:10'],
                'estado' => ['required', 'max:10'],
                'muebles' => ['required', 'max:10'],
                'carpinteria_int' => ['required', 'max:10'],
                'carpinteria_ext' => ['required', 'max:10'],
                'zona_comunitaria' => ['required', 'max:10'],
                'antiguedad' => ['required', 'max:10'],
                'direccion' => ['required', 'max:10'],
                'descripcion' => ['required', 'max:10'],
            ])
        );

        return Redirect::back()->with('success', 'Vivienda actualizada correctamente.');
    }

    public function restore(Vivienda $vivienda)
    {
        $vivienda->restore();

        return Redirect::back()->with('success', 'Vivienda restaurada correctamente.');
    }

    public function destroy(Vivienda $vivienda)
    {
        $vivienda->delete();

        return Redirect::back()->with('success', 'Vivienda eliminada correctamente.');
    }
}
