<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownCart extends Component
{
    protected $listeners = ['render'];
    /* rederizar el componente del carrito desde AddCardItem se le envía emitTo */
    /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26256754#notes */
    /* protected $listeners = ['render']; esto ejecuta el método render  */

    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}
