<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Post;
use Livewire\Component;

class PostReviews extends Component
{
    public $post_id, $comment;
    public $rating = 5;
    public $habilita_calificaciones = false;

    public function mount(Post $post)
    {
        $this->post_id = $post->id;
    }

    public function render()
    {
        $post = Post::find($this->post_id);
        /* Traemos las Ordenes del usuario cuando el status sea 2 PAGADO y lo enviamos 
        a la vista para verificar que el id del post sea el mismo que el de la orden y asi habilitar los comentarios */
        if(auth()->user()){
            $order = Order::where('user_id', auth()->user()->id)
                            ->where('status', 2)
                            ->first();
        }

        if(!empty($order)){
            foreach(json_decode($order->content) as $item){
                $post_orden_id = $item->id;
            }

            if($post_orden_id == $post->id){
                $this->habilita_calificaciones = true;
            }
        }

        return view('livewire.post-reviews', compact('post'));
    }

    public function store()
    {
        $post = Post::find($this->post_id);

        $post->reviews()->create([
            'comment' => $this->comment,
            'rating' => $this->rating,
            'user_id' => auth()->user()->id
        ]);

        /* return redirect()->route('orders.payment', $order); */
    }
}
