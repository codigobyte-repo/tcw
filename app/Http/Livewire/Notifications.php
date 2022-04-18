<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class Notifications extends Component
{
    public $status = 0;
    public $per;
    public $userSent = 0;
    public $userRecive = 0;

    public function render()
    {
        /* Verificamos las notificaciones */

        if(auth()->user()){
            $userReciveNotification = auth()->user()->id;
            $notifications = Notification::where('user_recive', $userReciveNotification)->count();
            $adress = Notification::where('user_recive', $userReciveNotification)->first();
            /* dd($adress); */
            if(!$adress == [] or !$adress == ""){

                $this->userSent = $adress['user_sent'];
                $this->userRecive = $adress['user_recive'];
            }
            
            if($notifications >= 1){
                $this->status = $notifications;
            }
        }

        return view('livewire.notifications');
    }

    public function deleteStatus(){
        $userReciveNotification = auth()->user()->id;
        Notification::where('user_id', $userReciveNotification)->delete();
    }
}
