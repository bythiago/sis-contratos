<?php

use App\Http\Controllers\ClienteController;
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

//get
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/novo', [ClienteController::class, 'novo'])->name('cliente.novo');
Route::get('/clientes/lista', [ClienteController::class, 'lista'])->name('cliente.lista');

//post
Route::post('/clientes/salvar', [ClienteController::class, 'salvar'])->name('cliente.salvar');

//delete
Route::delete('/clientes/excluir/{id}', [ClienteController::class, 'excluir'])->name('cliente.excluir');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
