<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;

use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;
    
    /* Método mágico livewire: Seteamos la propiedad subcategoria con el nombre de la subcategoria */
    public $category, $subcategoria, $marca;

    /* Vista en modo GRID o LIST */
    public $view = "grid";

    /* Esta propiedad la usamos para agregar en la url la información de la subcategorias y de la marca */
    /* INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27445856#notes */
    protected $queryString = ['subcategoria', 'marca'];

    public function limpiar()
    {
        $this->reset(['subcategoria', 'marca', 'page']);
    }

    public function updatedSubcategoria()
    {
        $this->resetPage();
    }

    public function updatedMarca()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        /* $posts = $this->category->posts()
                                ->where('status', 2)
                                ->paginate(20); */
        /* whereHas recupera relaciones en este caso la relación que tiene Post a través de subcategory con categor */
        /* info: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26158768#questions */
        
        $postsQuery = Post::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id', $this->category->id);
        });

        if($this->subcategoria) {
            $postsQuery = $postsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('slug', $this->subcategoria);
            });
        }

        if($this->marca) {
            $postsQuery = $postsQuery->whereHas('brand', function(Builder $query){
                $query->where('name', $this->marca);
            });
        }

        $posts = $postsQuery->where('status', 2)->paginate(20);

        return view('livewire.category-filter', compact('posts'));
    }

}
