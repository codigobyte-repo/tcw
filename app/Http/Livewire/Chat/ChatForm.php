<?php

namespace App\Http\Livewire\Chat;

use App\Events\SendMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Notification as ModelsNotification;
use App\Models\User;
use App\Models\Notification;
use Livewire\Component;

class ChatForm extends Component
{
    public $text;
    /* Usuario a quién contacto */
    public $userChatid;
    /* Usuario que envía */
    public $userCurrent;
    public $userAuth;
    public $chat;

    protected $rules = [
        'text' => 'required'
    ];

    public function mount($userChatid, $userAuth)
    {
        $this->text = '';
        $this->userChatid = $userChatid;        
        $this->userCurrent = $userAuth;

        if (Chat::where('user_recive', $this->userChatid)->where('user_sent', $this->userAuth)->exists()) {
            
            $this->chat = Chat::select('id')
            ->where('user_recive', $this->userChatid)
            ->where('user_sent', $this->userAuth)
            ->first();

        }elseif (Chat::where('user_recive', $this->userAuth)->where('user_sent', $this->userChatid)->exists()) {
            $this->chat = Chat::select('id')
            ->where('user_recive', $this->userAuth)
            ->where('user_sent', $this->userChatid)
            ->first();
        }else{
            $this->chat = null;
        }

    }

    /* Evaluar */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMessage()
    {

        $this->validate();

        if($this->chat == null) {
            $this->chat = Chat::create([
                'user_sent' => $this->userCurrent,
                'user_recive' => $this->userChatid
            ]);
        }

        Message::create([
            'chat_id' => $this->chat->id,
            'user_id' => $this->userCurrent,
            'message' => $this->text
        ]);

        Notification::create([
            'user_sent' => $this->userCurrent,
            'user_recive' => $this->userChatid,
            'status' => 1
        ]);

        $this->text = "";

        $this->emit("messageSent");

        event(new SendMessage($this->userCurrent, $this->text));
    }

    public function render()
    {
        return view('livewire.chat.chat-form');
    }
}
