<div class="chat-body">
    <div class="chat-box-header mt-5">
        <div class="flex justify-center items-center mt-8 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <div class="text-2xl ml-2">CONTACTOS</div>
        </div>        
    </div>
    <div class="chat-box-content" wire:poll.keep-alive>
        <div class="conversation-group">
            @forelse ($contacts as $user)
                @if ($user->user->id != auth()->id())
                    
                    <a href="{{ route('chat_with', $user->user->uuid) }}">
                        
                        <div class="contact flow-root">
                            
                            <div class="float-left">
                                @if($user->profile_photo_url)
                                    <img class="contact_image" src="{{ $user->profile_photo_url }}" alt="Perfil" />
                                @else
                                    <div class="contact_image">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <p class="contact_name text-2xl">{{ $user->user->name }}</p>
                                <div class="text-sm">{{ ($user->created_at)->diffForHumans() }}</div>
                            </div>
                            
                            <div class="float-right pt-3 mr-2">
                                <a class="hover:text-red-600" wire:click="elimarContact({{$user->user->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </a>
                    
                @endif
            @empty
                <center>No hay datos</center>
            @endforelse
        </div>
    </div>
</div>
