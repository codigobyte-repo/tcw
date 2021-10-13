<?php

namespace App\Http\Livewire\Admin\Proveedores;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
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
        /* $pagos = Order::where('status', 2)->paginate(10); */

        $pagos = Order::where('status', 6)
                    ->orWhere('created_at', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('totalConComision', 'LIKE', '%' . $this->search . '%')
                    ->latest('id') 
                    ->paginate(5);

        
        return view('livewire.admin.proveedores.pagos', compact('pagos'));
    }
}
