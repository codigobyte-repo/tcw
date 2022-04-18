<div class="chat-body">
    
    <div class="chat-box-header mt-5">
        <img src="{{ $user->profile_photo_url }}" class="employee" style="border-radius: 50%" alt="Perfil">
        <div class="employee-name">{{ $user->name }}</div>
        <div class="top-right-menu-icons">
            
        </div>
        <a href="{{ route('contacts') }}">
            <div class="top-right-menu-last-icons" id="close-chat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M18,12h0a2,2,0,0,0-.59-1.4l-4.29-4.3a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42L15,11H5a1,1,0,0,0,0,2H15l-3.29,3.29a1,1,0,0,0,1.41,1.42l4.29-4.3A2,2,0,0,0,18,12Z" />
                </svg>
            </div>
        </a>
    </div>

    <div class="chat-box-content" wire:poll.keep-alive>
        <div class="conversation-group" id="textContent">
            @forelse ($messages as $message)
                @if ($message->friend_id == auth()->id())
                    <div class="message message-box recived">
                        <p>{{ $message->message }}</p>
                    </div>
                @else
                    <div class="message message-box send">
                        <p>{{ $message->message }}</p>
                    </div>
                @endif
            @empty
                <div class="message message-box recived">
                    <p>Pregúntale {{ $user->name }}</p>
                </div>
            @endforelse
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>

    <div class="input-group">
        <hr />
        <form wire:submit.prevent="send_message">
            <input contenteditable="false" wire:model.lazy="message" id="text-box" rows="1" cols="31"
                placeholder="Escribe tu mensaje" />
        </form>
    </div>

    <div class="chat-box-footer">
        <div>
          
            <svg wire:click="send_message" class="submit-button" class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M20.34,9.32l-14-7a3,3,0,0,0-4.08,3.9l2.4,5.37h0a1.06,1.06,0,0,1,0,.82l-2.4,5.37A3,3,0,0,0,5,22a3.14,3.14,0,0,0,1.35-.32l14-7a3,3,0,0,0,0-5.36Zm-.89,3.57-14,7a1,1,0,0,1-1.35-1.3l2.39-5.37A2,2,0,0,0,6.57,13h6.89a1,1,0,0,0,0-2H6.57a2,2,0,0,0-.08-.22L4.1,5.41a1,1,0,0,1,1.35-1.3l14,7a1,1,0,0,1,0,1.78Z" />
            </svg>
            
        </div>
    </div>

    <script>
        textContentScroll = document.getElementsByClassName('chat-box-content')[0];
        textContentScroll.scrollTop = textContentScroll.scrollHeight;


        let textContent = document.getElementsByClassName('conversation-group')[0];
        let textbox = document.querySelector("#text-box");
        textbox.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                textContentScroll = document.getElementsByClassName('chat-box-content')[0];
                textContentScroll.scrollTop = textContentScroll.scrollHeight + 40;
                return false;
            }
        });
    </script>
</div>

