<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public $open = false;

    /* Propiedad a la escucha de si search cambia */
    /* INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26366812#notes */
    public function updatedSearch($value)
    {
        if($value){
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function render()
    {
        if($this->search){
            $posts = Post::where('name', 'LIKE', "%" . $this->search . "%")
                         ->where('status', 2)
                         ->take(8)
                         ->get();
        }else{
            $posts = [];
        }

        return view('livewire.search', compact('posts'));
    }
}