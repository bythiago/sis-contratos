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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function(){
        Route::resource('clientes', ClienteController::class);
        Route::resource('produtos', ProdutoController::class);
        Route::resource('pedidos', PedidoController::class);
        Route::resource('orcamentos', OrcamentoController::class);
    });
});