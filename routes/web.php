<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestamoController;

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

Route::get('/',[PrestamoController::class,'index'])->name('index');
Route::post('/buscar', [PrestamoController::class, 'busqueda'])->name('busqueda');
Route::get('/equipos/{matricula?}', [PrestamoController::class, 'mostrar'])->name('mostrar');
Route::post('/renovar', [PrestamoController::class, 'renovar'])->name('renovar');
Route::post('/sancion', [PrestamoController::class, 'sancion'])->name('sancion');
Route::post('/eliminar', [PrestamoController::class, 'eliminar'])->name('equipo.eliminar');
