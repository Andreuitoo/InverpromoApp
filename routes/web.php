<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PisosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ViviendasController;
use App\Http\Controllers\DemandasController;
use Illuminate\Support\Facades\Route;


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


// Pisos

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


// Demandas

Route::get('demandas', [DemandasController::class, 'index'])
    ->name('demandas')
    ->middleware('auth');

Route::get('demandas/create', [DemandasController::class, 'create'])
    ->name('demandas.create')
    ->middleware('auth');

Route::post('demandas', [DemandasController::class, 'store'])
    ->name('demandas.store')
    ->middleware('auth');

Route::get('demandas/{demanda}/edit', [DemandasController::class, 'edit'])
    ->name('demandas.edit')
    ->middleware('auth');

Route::put('demandas/{demanda}', [DemandasController::class, 'update'])
    ->name('demandas.update')
    ->middleware('auth');

Route::put('demandas/{demanda}/restore', [DemandasController::class, 'restore'])
    ->name('demandas.restore')
    ->middleware('auth');

Route::delete('demandas/{demanda}', [DemandasController::class, 'destroy'])
    ->name('demandas.destroy')
    ->middleware('auth');


// Viviendas

Route::get('viviendas', [ViviendasController::class, 'index'])
    ->name('viviendas')
    ->middleware('auth');

Route::get('viviendas/create', [ViviendasController::class, 'create'])
    ->name('viviendas.create')
    ->middleware('auth');

Route::post('viviendas', [ViviendasController::class, 'store'])
    ->name('viviendas.store')
    ->middleware('auth');

Route::get('viviendas/{vivienda}/edit', [ViviendasController::class, 'edit'])
    ->name('viviendas.edit')
    ->middleware('auth');

Route::get('viviendas/{vivienda}/show', [ViviendasController::class, 'show'])
    ->name('viviendas.show')
    ->middleware('auth');

Route::put('viviendas/{vivienda}', [ViviendasController::class, 'update'])
    ->name('viviendas.update')
    ->middleware('auth');

Route::get('viviendas/{vivienda}/fotos', [ViviendasController::class, 'showPhotos'])
    ->name('viviendas.showPhotos')
    ->middleware('auth');

Route::post('viviendas/{vivienda}/add-photos', [ViviendasController::class, 'addPhoto'])
    ->name('viviendas.addPhoto')
    ->middleware('auth');

Route::delete('viviendas/{vivienda}/delete-photo/{fotoId}', [ViviendasController::class, 'deletePhoto'])
    ->name('viviendas.deletePhoto')
    ->middleware('auth');

Route::put('viviendas/{vivienda}/restore', [ViviendasController::class, 'restore'])
    ->name('viviendas.restore')
    ->middleware('auth');

Route::delete('viviendas/{vivienda}', [ViviendasController::class, 'destroy'])
    ->name('viviendas.destroy')
    ->middleware('auth');


// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
