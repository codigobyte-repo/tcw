<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryPosts extends Component
{
    /* La propiedad category viene de la vista posts\index.blade.php y trae todas las categorías */
    public $category;
    
    public $posts = [];
    /* INFO loadPosts https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26123942#notes */
    public function loadPosts()
    {
        $this->posts = $this->category->posts()->where('status', 2)->take(15)->get();

        /* Emitimos el evento para recargar los posts INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26123942#notes*/
        /* Posteriormente para que todas las categorias carguen el script agregamos el id INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26124564#notes */
        $this->emit('glider', $this->category->id);
    }
    public function render()
    {
        return view('livewire.category-posts');
    }
}
