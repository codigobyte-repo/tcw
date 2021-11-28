<?php

namespace App\Http\Livewire;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CreateOrder extends Component
{
    
    public $commission = 8, $totalConComision;

    public function render()
    {

        return view('livewire.create-order');
    }

    public function create_order()
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->commission = $this->commission;
        $order->total = Cart::subtotal();
        $order->totalConComision = (Cart::subtotal(1) * $this->commission) / 100 + Cart::subtotal(1);
        $contenido = $order->content = Cart::content();

        $array = json_decode($contenido, true);
        
        foreach($array as $item){
            $contenido = $item;
        }

        $order->vendedor_user_id = $contenido['options']['vendedor_user_id'];

        
        $order->save();
        
        //Envía el mail
        $usuario = User::find($order->vendedor_user_id);    
        /* dd($usuario->name); */
        $mail = new NewOrder($order, $usuario);
        Mail::to($usuario->email)->queue($mail);
        
        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }
}
