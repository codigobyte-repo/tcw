<?php

use App\Models\Post;
use Gloudemans\Shoppingcart\Facades\Cart;

/* https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26274780#notes
 */
function qty_added($post_id)
{
    $cart = Cart::content();
    $item = $cart->where('id', $post_id)->first();

    if($item){
        return $item->qty;
    }else{
        return 0;
    }

}