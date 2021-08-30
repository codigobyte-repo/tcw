<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public $search;

    /* Cada vez que se modifique la propiedad $search se va a activar estemétodo */
    public function updatingSearch()
    {
        $this->resetPage();
        //Este metodo resetea el paginador y lo lleva a la página 1
        /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26926458?start=15#questions */
    }
    
    public function render()
    {
        $posts = Post::where('name', 'like', '%'.$this->search.'%')
                        ->where('user_id', auth()->user()->id)
                        ->latest('id')
                        ->paginate(10);

        /* layout('layouts.publisher'); con esto le indicamos a livewire que debe usar por default la plantilla
        creada por nosotros resource->view->layouts->publisher.blade.php */
        return view('livewire.publisher.show-posts', compact('posts'))->layout('layouts.publisher');
    }
}
