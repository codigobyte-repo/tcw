<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $order->content = Cart::content();

        $order->save();
        Cart::destroy();

        return redirect()->route('orders.payment', $order);
    }
}
