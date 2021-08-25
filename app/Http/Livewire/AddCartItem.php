<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $post;
    public $options = [];

    public function mount()
    {
        $this->options['image'] = Storage::url($this->post->images->first()->url);
        $this->options['price_total'] = round($this->post->price_total, 1);
        $this->options['fee'] = round($this->post->fee, 1);
    }
    
    public function render()
    {
        return view('livewire.add-cart-item');
    }

    public function addItem()
    {
        Cart::add([ 'id' => $this->post->id, 
                    'name' => $this->post->name, 
                    'qty' => 1, 
                    'price' => $this->post->price,
                    'weight' => 550,
                    'options' => $this->options
                ]);
        /* emitTo renderizar el componente del carrito */
        /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26256754#notes */
        $this->emitTo('dropdown-cart', 'render');
    }
}
