<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;

class UserChat extends Component
{
    
    public $chat;
    public $userCurrent;
    public $uuid;

    protected $listeners = ['messageSent' => 'refresh'];

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->user = User::where('uuid',$uuid)->first();


        $this->chat = new Chat();
        $this->userChatid = $this->user->id;
        $this->userCurrent = auth()->user()->id;

    }

    /* En este caso llamamos desde el evento listeners a esta funcion vacia para que renderize el componente */
    public function refresh(){}

    public function render()
    {
        /* INFO: https://www.udemy.com/course/crea-un-chat-en-vivo-con-laravel-livewire-y-tailwind-css/learn/lecture/23719340?start=15#overview */
        return view('livewire.chat.user-chat',
            [
                'chats' => $this->chat->with([
                    'usersent:id,name,profile_photo_path',
                    'userrecive:id,name,profile_photo_path',
                    'messages' => function($query){
                        $query->latest();
                    }
                ])->where('user_sent', $this->userCurrent)
                ->orWhere('user_recive', $this->userCurrent)
                ->get()
            ]
        );
    }
}
