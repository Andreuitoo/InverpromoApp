<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
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
                    'deleted_at' => $piso->deleted_at,
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
                'ref' => ['required', 'max:10'],
                'fecha' => ['required', 'max:10'],
                'tipo_piso' => ['required', 'max:4'],
                'zona' => ['required', 'max:100'],
                'precio' => ['required', 'max:10'],
                'num_hab' => ['required', 'max:2'],
                'muebles' => ['required', 'max:4'],
                'descripcion' => ['required', 'max:3000'],
                'telefono' => ['required', 'max:9'],
                'propietario' => ['required', 'max:35'],
            ])
        );

        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotos');
                $piso->fotos()->create(['ruta' => $ruta]);
            }
        }

        return Redirect::route('pisos')->with('success', 'Piso añadido correctamente.');
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
                'deleted_at' => $piso->deleted_at,
            ],
        ]);
    }

    public function update(Piso $piso)
    {
        $piso->update(
            Request::validate([
                'ref' => ['required', 'max:10'],
                'fecha' => ['required', 'max:10'],
                'tipo_piso' => ['required', 'max:4'],
                'zona' => ['required', 'max:100'],
                'precio' => ['required', 'max:10'],
                'num_hab' => ['required', 'max:2'],
                'muebles' => ['required', 'max:4'],
                'descripcion' => ['required', 'max:3000'],
                'telefono' => ['required', 'max:9'],
                'propietario' => ['required', 'max:35'],
            ])
        );

        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotos');
                $piso->fotos()->create(['ruta' => $ruta]);
            }
        }

        return Redirect::back()->with('success', 'Piso actualizado correctamente.');
    }

    public function showPhotos(Piso $piso)
    {
        $fotos = $piso->fotos()->get(['id', 'ruta']);

        $fotosUrls = $fotos->map(function ($foto) {
            return [
                'id' => $foto->id,
                'ruta' => $foto->ruta ? URL::route('image', ['path' => $foto->ruta]) : null,
            ];
        });

        return Inertia::render('Pisos/Fotos', [
            'piso' => [
                'id' => $piso->id,
                'ref' => $piso->ref,
                'fotos' => $fotosUrls,
            ],
        ]);
    }

    public function addPhoto(Piso $piso)
    {
        $fotos = Request::file('fotos');

        if ($fotos) {
            foreach ($fotos as $foto) {
                $ruta = $foto->store('fotos');
                $piso->fotos()->create(['ruta' => $ruta]);
            }
        }

        return Redirect::back()->with('success', 'Foto añadida correctamente.');
    }

    public function deletePhoto(Piso $piso, $fotoId)
    {
        $fotoEliminada = $piso->fotos()->where('id', $fotoId)->delete();

        if ($fotoEliminada) {
            return Redirect::back()->with('success', 'Foto eliminada correctamente.');
        } else {
            return Redirect::back()->with('error', 'No se pudo eliminar la foto.');
        }
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

