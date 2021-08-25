<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
/* FUNCIONAMIENTO POLICY https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26768472#questions/15494104/ */
class OrderPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Order $order)
    {
        if($order->user_id == $user->id){
            return true;
        }else{
            return false;
        }
    }

    public function payment(User $user, Order $order)
    {
        if($order->status == 2){
            return false;
        }else{
            return true;
        }
    }
}
