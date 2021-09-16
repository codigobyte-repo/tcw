<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        /* where('status', '<>', 1); significa todas las ordenes diferentes de status 1 */
        $orders = Order::query()->where('status', '<>', 1)->where('vendedor_user_id', auth()->user()->id);
        if(request('status')){
            $orders->where('status', request('status'));
        }
        $orders = $orders->get();

        
        $pendiente = Order::where('status', 1)->where('vendedor_user_id', auth()->user()->id)->count();
        $proceso = Order::where('status', 2)->where('vendedor_user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 3)->where('vendedor_user_id', auth()->user()->id)->count();
        $finalizado = Order::where('status', 4)->where('vendedor_user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('vendedor_user_id', auth()->user()->id)->count();

        return view('publisher.orders.index', compact('orders','pendiente','proceso','recibido','finalizado','anulado'));
    }

    public function show(Order $order)
    {
        return view('publisher.orders.show', compact('order'));
    }
}
