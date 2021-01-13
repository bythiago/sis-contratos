<?php

namespace App\Providers;

use App\Models\Pedido;
use App\Observers\PedidoObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Pedido::observe(PedidoObserver::class);
    }
}
