<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{
    use AuthorizesRequests;

    public $order;
    protected $listeners = ['payOrder'];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function payOrder()
    {
        $this->order->status = 2;
        $this->order->save();

        return redirect()->route('orders.show', $this->order);
    }

    public function render()
    {
        /* dd($this->order); */
        /* Usamos las policies. INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26768472#questions/15494104/ */
        $this->authorize('author', $this->order);
        /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26768472#notes */
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        return view('livewire.payment-order', compact('items'));
    }
}
