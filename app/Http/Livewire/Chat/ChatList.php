<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class ChatList extends Component
{
    
    public $userChatid;
    public $userCurrent;
    public $uuid;

    protected $listeners = ['reciveMessage' => 'refresh'];

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->user = User::where('uuid',$uuid)->first();

        $this->userChatid = $this->user->id;
        $this->userCurrent = auth()->user()->id;
    }

    public function refresh(){}

    public function render()
    { 
        if(Chat::where('user_recive', (int)$this->userChatid)->orWhere('user_sent', $this->userChatid)->exists()){

            return view('livewire.chat.chat-list',
                [
                    'chats' => Chat::with([
                        'usersent:id,name,profile_photo_path',
                        'userrecive:id,name,profile_photo_path',
                        'messages' => function($query){
                            $query->oldest();
                        }
                    ])->where('user_sent', $this->userChatid)
                    ->orWhere('user_recive', $this->userChatid)
                    ->first()
                    ],

            )->layout('layouts.publisher');

        }else{

            return view('livewire.chat.chat-list',[
                'user' => User::find($this->userChatid)
            ]);

        }

    }
}
