<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PisosController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');


// pisos

Route::get('pisos', [PisosController::class, 'index'])
    ->name('pisos')
    ->middleware('auth');

Route::get('pisos/create', [PisosController::class, 'create'])
    ->name('pisos.create')
    ->middleware('auth');

Route::post('pisos', [PisosController::class, 'store'])
    ->name('pisos.store')
    ->middleware('auth');

Route::get('pisos/{piso}/edit', [PisosController::class, 'edit'])
    ->name('pisos.edit')
    ->middleware('auth');

Route::put('pisos/{piso}', [PisosController::class, 'update'])
    ->name('pisos.update')
    ->middleware('auth');

Route::get('pisos/{piso}', [PisosController::class, 'showPhotos'])
    ->name('pisos.showPhotos')
    ->middleware('auth');

Route::post('pisos/{piso}/add-photos', [PisosController::class, 'addPhoto'])
    ->name('pisos.addPhoto')
    ->middleware('auth');

Route::delete('pisos/{piso}/delete-photo/{fotoId}', [PisosController::class, 'deletePhoto'])
    ->name('pisos.deletePhoto')
    ->middleware('auth');

Route::delete('pisos/{piso}', [PisosController::class, 'destroy'])
    ->name('pisos.destroy')
    ->middleware('auth');

Route::put('pisos/{piso}/restore', [PisosController::class, 'restore'])
    ->name('pisos.restore')
    ->middleware('auth');


// Clientes

Route::get('clientes', [ClientesController::class, 'index'])
    ->name('clientes')
    ->middleware('auth');

Route::get('clientes/create', [ClientesController::class, 'create'])
    ->name('clientes.create')
    ->middleware('auth');

Route::post('clientes', [ClientesController::class, 'store'])
    ->name('clientes.store')
    ->middleware('auth');

Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])
    ->name('clientes.edit')
    ->middleware('auth');

Route::put('clientes/{cliente}', [ClientesController::class, 'update'])
    ->name('clientes.update')
    ->middleware('auth');

Route::put('clientes/{cliente}/restore', [ClientesController::class, 'restore'])
    ->name('clientes.restore')
    ->middleware('auth');

Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])
    ->name('clientes.destroy')
    ->middleware('auth');


// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
