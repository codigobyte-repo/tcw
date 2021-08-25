<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {
        /* Consultas anidadas en query: Info: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26823736#notes */
        /* Al agregar Query basicamente permite poder mandar parametros por la url y ahi hacer el if, luego podemos generar la colección. */
        $orders = Order::query()->where('user_id', auth()->user()->id);
        if(request('status')){
            $orders->where('status', request('status'));
        }
        $orders = $orders->get();
        
        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $proceso = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $finalizado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();



        return view('orders.index', compact('orders','pendiente','proceso','recibido','finalizado','anulado'));
    }

    public function show(Order $order)
    {
        /* Usamos las policies. INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26768472#questions/15494104/ */
        $this->authorize('author', $order);

        $items = json_decode($order->content);

        /* Iteramos items para obtener el id del post y así buscar los datos del mismo */
        foreach($items as $item) {
            $post_id = $item->id;
        }
        $post = Post::where('id', $post_id)->first();

        return view('orders.show', compact('order', 'items', 'post'));
    }

    public function pay(Order $order, Request $request)
    {
        $this->authorize('author', $order);
        
        $payment_id = $request->get('payment_id');
        //INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26699698#notes

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-1040215025571348-072823-a4269392aa0eed5237bb0b6b8114a0b7-798592290");

        $response = json_decode($response);
        $status = $response->status;

        if($status == 'approved'){
            $order->status = 2;
            $order->save();
        }
        return redirect()->route('orders.show', $order);
    }
}
