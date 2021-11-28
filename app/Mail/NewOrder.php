<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $usuario)
    {
        $this->order = $order;
        $this->usuarios = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-order')
                ->subject('www.todocontenidoweb.com - ¡Felicitaciones! Vendiste un servicio');
    }
}
