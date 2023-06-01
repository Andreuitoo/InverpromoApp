<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search'),
            'users' => User::query()
                ->orderByName()
                ->filter(Request::only('search'))
                ->get()
                ->transform(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'direccion' => $user->direccion,
                    'telefono' => $user->telefono,
                    'deleted_at' => $user->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'direccion' => ['required', 'max:50'],
            'telefono' => ['required', 'max:50'],
            'password' => ['nullable'],
        ]);

        return Redirect::route('users')->with('success', 'Usuario creado.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'direccion' => $user->direccion,
                'telefono' => $user->telefono,
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'direccion' => ['required', 'max:50'],
            'telefono' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
        ]);

        return Redirect::back()->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {

        if ($user->name == 'Carmen Gaitán') {
            return Redirect::back()->with('error', 'No se puede eliminar este usuario.');
        }

        $user->delete();

        return Redirect::back()->with('success', 'Usuario eliminado.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'Usuario restaurado.');
    }
}
