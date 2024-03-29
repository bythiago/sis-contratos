<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'produtos'], function(){
    Route::get('/', [
        ProdutoController::class, 'autocompleteProdutoByName'
    ])->name('api.autocomplete.produtos');

    Route::get('/dataTableProducts', [
        ProdutoController::class, 'dataTableProducts'
    ])->name('api.dataTableProducts.produtos');
});

Route::group(['prefix' => 'clientes'], function(){
    Route::get('/dataTableClients', [
        ClienteController::class, 'dataTableClients'
    ])->name('api.dataTableClients.clientes');
});

