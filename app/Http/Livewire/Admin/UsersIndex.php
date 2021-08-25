<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    /* Con esto le indicamos a livewire que use los estilos Bootstrap dado que por default usa los de Tailwind*/
    protected $paginationTheme = "bootstrap";

    public $search;

    /* updatingSearch() se activa cuando la propiedad $search cambie: Esto se usa dado que paginate debe ser reseteado para buscar un usuario */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->latest('id') 
                    ->paginate(5);

        return view('livewire.admin.users-index', compact('users'));
    }
}
