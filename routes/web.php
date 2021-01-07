<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

//
Route::resource('clientes', ClienteController::class);
Route::resource('produtos', ProdutoController::class);

// Route::group(['prefix' => 'produtos'], function(){
//     Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index');
//     Route::get('/create', [ProdutoController::class, 'create'])->name('produtos.create');
//     Route::post('/store', [ProdutoController::class, 'store'])->name('produtos.store');
//     Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
//     Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
//     Route::get('/show/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
//     Route::delete('/destroy/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
// });

// Route::group(['prefix' => 'pedidos'], function(){
//     Route::get('/', [PedidoController::class, 'index'])->name('pedido.index');
//     Route::get('/create', [PedidoController::class, 'create'])->name('pedido.create');
//     Route::post('/store', [PedidoController::class, 'store'])->name('pedido.store');
//     Route::get('/edit/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
//     Route::put('/update/{id}', [PedidoController::class, 'update'])->name('pedido.update');
//     Route::get('/show/{id}', [PedidoController::class, 'show'])->name('pedido.show');
//     Route::delete('/destroy/{id}', [PedidoController::class, 'destroy'])->name('pedido.destroy');
// });

// Route::group(['prefix' => 'orcamentos/pedido'], function(){
//     Route::get('/', [OrcamentoController::class, 'index'])->name('orcamento.index');
//     Route::get('/create', [OrcamentoController::class, 'create'])->name('orcamento.create');
//     Route::post('/store', [OrcamentoController::class, 'store'])->name('orcamento.store');
//     Route::get('/edit/{id}', [OrcamentoController::class, 'edit'])->name('orcamento.edit');
//     Route::put('/update/{id}', [OrcamentoController::class, 'update'])->name('orcamento.update');
//     Route::get('/show/{id}', [OrcamentoController::class, 'show'])->name('orcamento.show');
//     Route::delete('/destroy/{id}', [OrcamentoController::class, 'destroy'])->name('orcamento.destroy');
//     Route::get('/autocomplete', [OrcamentoController::class, 'autocomplete'])->name('orcamento.autocomplete');
// });

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
