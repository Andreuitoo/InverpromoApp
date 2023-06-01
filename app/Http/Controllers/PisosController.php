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
                ->get()
                ->transform(fn ($piso) => [
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

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function restore()
    {

    }
}

