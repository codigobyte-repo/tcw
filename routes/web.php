<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebhooksController;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\PaymentOrder;
use App\Http\Livewire\ShoppingCart;
use App\Models\Order;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('tag/{tag}', [PostController::class, 'tag'])->name('posts.tag');

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('search', SearchController::class)->name('search');

Route::get('category/{category}', [PostController::class, 'category'])->name('posts.category');

/* Route::get('subcategory/{subcategory}', [PostController::class, 'subcategory'])->name('posts.subcategory'); */

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');


Route::middleware(['auth'])->group(function () {
    /* VISTAS DE ORDENES QUE VE EL USUARIO COMPRADOR */
    Route::get('orders/create', CreateOrder::class)->name('orders.create');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');

    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');

    /* Excluimos esta ruta del csrf para que funcione con ML */
    /* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26684084#notes */
    Route::post('webhooks', WebhooksController::class);

    /* LOG */
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    
});

/* Anula las ordenes pendientes creadas más de 10 minutos */
/*Esta funcion se lleva a cabo de forma automatica desde el app->console->KERNEL.PHP y en produccion se debe ejecutar con un CRON*/
Route::get('anularOrdenes', function(){

    /* Recuperamos la hora de hace 10 minutos */
    /* INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26847240#questions */
    /* now()->subMinute(10) esto indica hace 10 minutos */
    $hora = now()->subMinute(10);

    $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

    foreach ($orders as $order) {
        
        $order->status = 5;
        $order->save();

    }

});

