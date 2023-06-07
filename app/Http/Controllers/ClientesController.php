<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;


class ClientesController extends Controller
{
    public function index()
    {
        return Inertia::render('Clientes/Index', [
            'filters' => Request::all('search'),
            'clientes' => Cliente::query()
                ->orderBy('nombre', 'desc')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($cliente) => [
                    'id' => $cliente->id,
                    'nombre' => $cliente->nombre,
                    'apellidos' => $cliente->apellidos,
                    'dni' => $cliente->dni,
                    'telefono' => $cliente->telefono,
                    'email' => $cliente->email,
                    'deleted_at' => $cliente->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Clientes/Create');
    }
}
