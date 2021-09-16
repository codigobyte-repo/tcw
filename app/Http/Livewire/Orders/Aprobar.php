<?php

namespace App\Http\Livewire\Orders;

use App\Models\RejectPost;
use App\Models\Order;
use App\Models\Post;
use App\Models\RejectePost;
use Livewire\Component;

class Aprobar extends Component
{
    public $formAprobar = false;
    public $formRechazar = false;

    /* APROBADO */
    public $commentAprobar;

    /* RECHAZADO */
    public $commentRechazar;
    public $recibioProyecto;
    public $maltrato;
    public $fueraDeTiempo;
    public $conciliacion;
    public $cancelarProyecto;

    public $order;
    public $post;

    public $rating = 5;

    protected $validationAttributes = [
        'commentAprobar' => 'comentario',
        'commentRechazar' => 'comentario'
    ];

    public function mount(Order $order, Post $post)
    {
        $this->order = $order;
        $this->post = $post;
    }
    
    public function render()
    {
        return view('livewire.orders.aprobar');
    }

    public function aprobarPublicacion()
    {
        
        $this->validate([
            'commentAprobar' => 'required',
        ]);

        $post = Post::find($this->post->id);
        
        $post->reviews()->create([
            'comment' => $this->commentAprobar,
            'rating' => $this->rating,
            'user_id' => auth()->user()->id
        ]);

        $this->order->status = 6;
        $this->order->save();        
        
    }

    public function rechazarPublicacion()
    {
        $this->validate([
            'commentRechazar' => 'required',
        ]);

        $rechazar = new RejectePost();
        $rechazar->comment = $this->commentRechazar;
        $rechazar->recibioProyecto = $this->recibioProyecto;
        $rechazar->maltrato = $this->maltrato;
        $rechazar->fueraDeTiempo = $this->fueraDeTiempo;
        $rechazar->conciliacion = $this->conciliacion;
        $rechazar->cancelarProyecto = $this->cancelarProyecto;
        $rechazar->user_id = auth()->user()->id;
        $rechazar->post_id = $this->post->id;
        $rechazar->order_id = $this->order->id;

        $rechazar->save();
        
        $this->order->status = 7;
        $this->order->save();
        
        session()->flash('message', 'Lamentamos que hayas tenido que rechazar tu pedido. Lo resolveremos en 48 horas.');
        return redirect()->route('orders.index');

    }
}
