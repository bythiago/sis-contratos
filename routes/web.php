<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PedidoController;
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

Route::group(['prefix' => 'pedidos'], function(){
    Route::get('/', [PedidoController::class, 'index'])->name('pedido.index');
    Route::get('/create', [PedidoController::class, 'create'])->name('pedido.create');
    Route::post('/store', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/edit/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
    Route::put('/update/{id}', [PedidoController::class, 'update'])->name('pedido.update');
    Route::get('/show/{id}', [PedidoController::class, 'show'])->name('pedido.show');
    Route::delete('/destroy/{id}', [PedidoController::class, 'destroy'])->name('pedido.destroy');
});

Route::group(['prefix' => 'orcamentos/pedido'], function(){
    Route::get('/', [OrcamentoController::class, 'index'])->name('orcamento.index');
    Route::get('/create', [OrcamentoController::class, 'create'])->name('orcamento.create');
    Route::post('/store', [OrcamentoController::class, 'store'])->name('orcamento.store');
    Route::get('/edit/{id}', [OrcamentoController::class, 'edit'])->name('orcamento.edit');
    Route::put('/update/{id}', [OrcamentoController::class, 'update'])->name('orcamento.update');
    Route::get('/show/{id}', [OrcamentoController::class, 'show'])->name('orcamento.show');
    Route::delete('/destroy/{id}', [OrcamentoController::class, 'destroy'])->name('orcamento.destroy');
});

//Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
