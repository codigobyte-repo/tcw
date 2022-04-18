<div class="py-6 px-20 overflow-auto h-3/4" id="chatScrollDown">

            {{-- Cabecera de la lista de mensajes --}}
            <div class="px-20 py-2 border-b mb-6">
                <div class="flex mb-4">
            
                    <div class="flex flex-grow">
                        
                        @if(isset($user))
                            <img class="h-12 w-12 rounded-full object-cover mr-2" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                            <p class="self-center font-medium mr-2">{{ $user->name }}</p>
                        @else
                            <img class="h-12 w-12 rounded-full object-cover mr-2" 
                            src="{{ $chats->userrecive->id == $userCurrent ? $chats->usersent->profile_photo_url : $chats->userrecive->profile_photo_url }}"
                            alt="{{ $chats->userrecive->id == $userCurrent ? $chats->usersent->name : $chats->userrecive->name }}" />

                            <p class="self-center font-medium mr-2">{{ $chats->userrecive->id == $userCurrent ? $chats->usersent->name : $chats->userrecive->name }}</p>
                        @endif
                        
                    </div>

                    <div class="flex self-center">
                        <svg class="w-6 text-gray-500 mr-4" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            {{-- Fin Cabecera de la lista de mensajes --}}

            {{-- Lista de mensajes --}}
            @if(isset($user))
                <div class="w-full text-base text-center">No hay conversaciones</div>
            @else

                @foreach($chats->messages as $message)

                    <div class="flex mb-12 {{ $message->user_id == $userCurrent ? 'justify-end' : 'justify-start' }} px-56 ">
                        
                            <div class="flex flex-col">
                                <div class="p-6 w-96 rounded-3xl {{ $message->user_id == $userCurrent ? 'rounded-br-none bg-green-600' : 'rounded-bl-none bg-gray-600' }} shadow-sm mb-2">
                                    
                                    <small class="text-white font-light">{{ $message->message }}</small>
                                </div>
                                <small class="text-gray-500 font-light">{{ ($message->created_at)->diffForHumans() }}</small>
                            </div>
                        
                    </div>
                @endforeach

            @endif

            <div id="content-typing" class="w-full">
                <div id="user-typing" class="text-sm text-gray-500"></div>
            </div>
            {{-- fin de Lista de mensajes --}}

            {{-- INPUT Envío de Mensajes principales lado derecho --}}
            @livewire('chat.chat-form', ['userChatid' => $userChatid, 'userAuth' => $userAuth])
            {{-- INPUT Fin Envío de Mensajes principales lado derecho--}}
        {{-- @endif --}}

</div>

@push('script')
    <script>

        /* Funcionalidad explicada https://www.udemy.com/course/crea-un-chat-en-vivo-con-laravel-livewire-y-tailwind-css/learn/lecture/23719470#notes */

        const userTyping = document.querySelector('#user-typing');
        const contentTyping = document.querySelector('#content-typing');
        const inputmessage = document.querySelector('#message');
        const chatId = {!! isset($user) ? $user->id : $chats->id !!};

        /* Código de canales de pusher */
        var pusher = new Pusher('80b329a9e40bdf97a6bb', {
        cluster: 'sa1'
        });

        var channel = pusher.subscribe('livechat-channel');
        channel.bind('livechat-event', function(data) {
            this.Livewire.emit('reciveMessage');
        });
        /* Fin Código de canales de pusher */

        inputmessage.addEventListener('keyup', (event) => {

            const chat = window.Echo.private(`chat.${chatId}`);

            setTimeout(() => {
                
                chat.whisper('typing', {
                    user: {!! auth()->user() !!},
                    typing: true,
                    chatId: chatId
                });

            }, 300);

        });

        Echo.private(`chat.${chatId}`)
        .listenForWhisper('typing', (e) => {
            /* console.log(e); */
            if(e.chatId === chatId){
                userTyping.innerHTML = `${e.user.name} está escribiendo ...`;
                e.typing ? contentTyping.style.display = "block" : contentTyping.style.display = "none";

                setTimeout(() => {
                    contentTyping.style.display = "none";
                }, 1000);
            }
        });

    </script>

    <script>
        /* Mantiene el scroll del chat abajo  */
        var objDiv = document.getElementById("chatScrollDown");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
@endpush
