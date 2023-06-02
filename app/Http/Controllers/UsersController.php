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
                    'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
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
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->users()->create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'direccion' => Request::get('direccion'),
            'telefono' => Request::get('telefono'),
            'password' => Request::get('password'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
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
                'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
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
            'photo' => ['nullable', 'image'],
        ]);

        $user->update(Request::only('name', 'email', 'direccion', 'telefono'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

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
