<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
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

Route::group(['prefix' => 'clientes'], function (){
    Route::get('/', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/create', [ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::get('/show/{id}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::delete('/destroy/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
});

Route::group(['prefix' => 'produtos'], function(){
    Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/create', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/store', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produto.update');
    Route::get('/show/{id}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::delete('/destroy/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');
});

//Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
