<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
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
                ->paginate(50)
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
                'nota' => ['nullable', 'max:100'],
                'tipo' => ['nullable', 'max:4'],
                'propietario' => ['nullable', 'max:35'],
                'telefono' => ['nullable', 'max:9'],
                'zona' => ['nullable', 'max:30'],
                'zona_2' => ['nullable', 'max:30'],
                'precio_prop' => ['nullable', 'max:10'],
                'precio_venta' => ['nullable', 'max:10'],
                'terraza' => ['nullable', 'max:10'],
                'num_hab' => ['nullable', 'max:2'],
                'num_banos' => ['nullable', 'max:2'],
                'ascensor' => ['nullable', 'max:2'],
                'altura_planta' => ['nullable', 'max:4'],
                'coladuria' => ['nullable', 'max:4'],
                'garaje' => ['nullable', 'max:4'],
                'piscina' => ['nullable', 'max:4'],
                'balcon' => ['nullable', 'max:10'],
                'm2' => ['nullable', 'max:10'],
                'estado' => ['nullable', 'max:15'],
                'muebles' => ['nullable', 'max:5'],
                'carpinteria_int' => ['nullable', 'max:20'],
                'carpinteria_ext' => ['nullable', 'max:20'],
                'zona_comunitaria' => ['nullable', 'max:20'],
                'antiguedad' => ['nullable', 'max:20'],
                'direccion' => ['nullable', 'max:200'],
                'descripcion' => ['nullable', 'max:1000'],
            ])
        );

        $fotos = Request::file('fotos');
        
        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotosViviendas');
                $vivienda->fotosVivienda()->create(['ruta' => $ruta,]);
            }
        }

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
                'nota' => ['nullable', 'max:100'],
                'tipo' => ['nullable', 'max:4'],
                'propietario' => ['nullable', 'max:35'],
                'telefono' => ['nullable', 'max:9'],
                'zona' => ['nullable', 'max:30'],
                'zona_2' => ['nullable', 'max:30'],
                'precio_prop' => ['nullable', 'max:10'],
                'precio_venta' => ['nullable', 'max:10'],
                'terraza' => ['nullable', 'max:10'],
                'num_hab' => ['nullable', 'max:2'],
                'num_banos' => ['nullable', 'max:2'],
                'ascensor' => ['nullable', 'max:2'],
                'altura_planta' => ['nullable', 'max:4'],
                'coladuria' => ['nullable', 'max:4'],
                'garaje' => ['nullable', 'max:4'],
                'piscina' => ['nullable', 'max:4'],
                'balcon' => ['nullable', 'max:10'],
                'm2' => ['nullable', 'max:10'],
                'estado' => ['nullable', 'max:15'],
                'muebles' => ['nullable', 'max:5'],
                'carpinteria_int' => ['nullable', 'max:20'],
                'carpinteria_ext' => ['nullable', 'max:20'],
                'zona_comunitaria' => ['nullable', 'max:20'],
                'antiguedad' => ['nullable', 'max:20'],
                'direccion' => ['nullable', 'max:200'],
                'descripcion' => ['nullable', 'max:3000'],
            ])
        );

        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotosViviendas');
                $vivienda->fotosVivienda()->create(['ruta' => $ruta,]);
            }
        }

        return Redirect::back()->with('success', 'Vivienda actualizada correctamente.');
    }

    public function show (Vivienda $vivienda)
    {
        return Inertia::render('Viviendas/Show', [
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

    public function showPhotos(Vivienda $vivienda)
    {
        $fotos = $vivienda->fotosVivienda()->get(['id', 'ruta']);

        $fotosUrls = $fotos->map(function ($foto) {
            return [
                'id' => $foto->id,
                'ruta' => $foto->ruta ? URL::route('image', ['path' => $foto->ruta]) : null,
            ];
        });

        return Inertia::render('Viviendas/Fotos', [
            'vivienda' => [
                'id' => $vivienda->id,
                'ref' => $vivienda->ref,
                'fotos' => $fotosUrls,
            ],
        ]);
    }

    public function addPhoto(Vivienda $vivienda)
    {
        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotosViviendas');
                $vivienda->fotosVivienda()->create(['ruta' => $ruta]);
            }
        }

        return Redirect::back()->with('success', 'Foto añadida correctamente.');
    }

    public function deletePhoto(Vivienda $vivienda, $fotoId)
    {
        $fotoEliminada = $vivienda->fotosVivienda()->where('id', $fotoId)->delete();

        if ($fotoEliminada) {
            return Redirect::back()->with('success', 'Foto eliminada correctamente.');
        } else {
            return Redirect::back()->with('error', 'No se pudo eliminar la foto.');
        }
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
