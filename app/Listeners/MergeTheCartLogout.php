<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Gloudemans\Shoppingcart\Facades\Cart;

class MergeTheCartLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        /* Con este metodo asociamos los productos que seleccionó el usuario y los guardamos en la base de dato en la tabla shoppingcart */
        /* INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26474110#questions */
        
        //Eliminar registro
        Cart::erase(auth()->user()->id);

        //Nuevo registro
        Cart::store(auth()->user()->id);
    }
}
