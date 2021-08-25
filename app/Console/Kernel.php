<?php

namespace App\Console;

use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    /* Anula las ordenes pendientes creadas más de 10 minutos */
    /* INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26847240#questions */
    /* now()->subMinute(10) esto indica hace 10 minutos */

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $hora = now()->subMinute(10);

            $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

            foreach ($orders as $order) {
                
                $order->status = 5;
                $order->save();

            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
