<?php

namespace App\Observers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoObserver
{
    /**
     * Handle the Pedido "created" event.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return void
     */
    public function created(Pedido $pedido)
    {
        $pedido->numero = str_pad($pedido->id, 10, 0, STR_PAD_LEFT);
        $pedido->id_user = Auth::user()->id;
        
        $pedido->save();
    }

    /**
     * Handle the Pedido "updated" event.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return void
     */
    public function updated(Pedido $pedido)
    {
        //
    }

    /**
     * Handle the Pedido "deleted" event.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return void
     */
    public function deleted(Pedido $pedido)
    {
        //
    }

    /**
     * Handle the Pedido "restored" event.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return void
     */
    public function restored(Pedido $pedido)
    {
        //
    }

    /**
     * Handle the Pedido "force deleted" event.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return void
     */
    public function forceDeleted(Pedido $pedido)
    {
        //
    }
}
