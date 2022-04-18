<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\Friend;
use Livewire\Component;

class Contacts extends Component
{
    /* public $userUuid; */
    
    public function render()
    {
        return view('livewire.chat.contacts',[
            'contacts' => Friend::where("friend_id", auth()->id())->latest()->get()
        ])->layout('layouts.publisher');
    }

    public function elimarContact($userId)
    {

        $chatEliminacion = Chat::select('chat_id')->where('friend_id', $userId)->get();
        
        if(Empty($chatEliminacion)){
            foreach ($chatEliminacion as $chat) {
                Friend::where('chat_id', $chat['chat_id'])->delete();
                Chat::where('chat_id', $chat['chat_id'])->delete();
            }
        }else{
            Friend::where('friend_id', $userId)->delete();
            Friend::where('user_id', $userId)->delete();
        }

        return redirect('contactos');
    }
    
    
    
    
}
