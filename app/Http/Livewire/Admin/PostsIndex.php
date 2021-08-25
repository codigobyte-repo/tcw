<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    /* Con  paginationTheme le indicamos a Laravel que use los estilos de bootstrap en adminLTE*/
    protected $paginationTheme = "bootstrap";

    public $search;

    /* updatingSearch() se activa cuando la propiedad $search cambie: Esto se usa dado que paginate debe ser reseteado para buscar un post */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
                        ->where('name', 'LIKE', '%' . $this->search . '%')
                        ->latest('id')    
                        ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
