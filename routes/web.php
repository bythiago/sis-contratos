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

Route::middleware(['web'])->group(function () {
    Route::group(['prefix' => 'admin'], function(){
        Route::resource('clientes', ClienteController::class);
        Route::resource('produtos', ProdutoController::class);
        Route::resource('pedidos', PedidoController::class);
    });
});

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
