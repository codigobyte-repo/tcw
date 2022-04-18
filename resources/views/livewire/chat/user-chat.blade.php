<div>
    {{-- USUARIOS CONTACTADOS --}}
    <ul>
        @foreach ($chats as $chat)
            
            <li>
                
                <a href="{{ url('chat/' . $userChatid .'/'. $userAuth ) }}">
                    <div class="flex bg-gray-100 hover:bg-gray-300 rounded p-4 mb-4 mr-2 mt-4">
                        
                        <img class="h-12 w-12 rounded-full object-cover mr-2" 
                        src="{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->profile_photo_url : $chat->userrecive->profile_photo_url }}"
                        alt="{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->name : $chat->userrecive->name }}" />

                        <div class="w-full overflow-hidden">
                            <div class="flex mb-1">
                                <p class="flex-grow">{{ $chat->userrecive->id == $userCurrent ? $chat->usersent->name : $chat->userrecive->name }}</p>
                                <small class="font-light text-gray-500">{{ ($chat->created_at)->diffForHumans() }}</small>
                            </div>

                            <small class="overflow-ellipsis overflow-hidden whitespace-nowrap block font-light text-gray-500">{{ $chat->messages[0]->message }}</small>

                        </div>
                    </div>
                </a>
            </li>
            
        @endforeach
    </ul>

</div>
