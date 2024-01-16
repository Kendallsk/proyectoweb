<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('validacionpagos', 'livewire.validacionpagos.index')->middleware('auth');
	Route::view('jugadores', 'livewire.jugadores.index')->middleware('auth');
	Route::view('categorias', 'livewire.categorias.index')->middleware('auth');
	Route::view('listas', 'livewire.listas.index')->middleware('auth');
	Route::view('game', 'livewire.game.index')->middleware('auth');
	Route::view('categoria', 'livewire.categoria.index')->middleware('auth');
	Route::view('categoriajuego', 'livewire.categoriajuego.index')->middleware('auth');
	Route::view('carros', 'livewire.carros.index')->middleware('auth');
	Route::view('empleados', 'livewire.empleados.index')->middleware('auth');
	Route::view('categoriajuego', 'livewire.categoriajuegos.index')->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
