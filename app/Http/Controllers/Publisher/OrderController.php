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
        $orders = Order::query()->where('status', '<>', 1);
        if(request('status')){
            $orders->where('status', request('status'));
        }
        $orders = $orders->get();
        
        $pendiente = Order::where('status', 1)->count();
        $proceso = Order::where('status', 2)->count();
        $recibido = Order::where('status', 3)->count();
        $finalizado = Order::where('status', 4)->count();
        $anulado = Order::where('status', 5)->count();

        return view('publisher.orders.index', compact('orders','pendiente','proceso','recibido','finalizado','anulado'));
    }

    public function show(Order $order)
    {
        return view('publisher.orders.show', compact('order'));
    }
}
