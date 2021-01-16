<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
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

Route::resource('/', ClienteController::class)->middleware('auth');
// Route::get('/calendar', [ClienteController::class, 'calendar'])->middleware('auth');

Route::middleware(['web'])->group(function () {
    Route::group(['prefix' => 'admin'], function(){

        //@home
        Route::resource('home', HomeController::class);

        //@clientes
        Route::resource('clientes', ClienteController::class);

        //@produtos
        Route::resource('produtos', ProdutoController::class);
        
        //@pedidos
        Route::resource('pedidos', PedidoController::class);
        Route::group(['prefix' => 'pedidos'], function(){
            Route::delete('destroy2/{id}/{produto}', [PedidoController::class, 'destroy2'])->name('pedidos.destroy2');
            Route::put('update2/{id}', [PedidoController::class, 'update2'])->name('pedidos.update2');
        });
    });
});