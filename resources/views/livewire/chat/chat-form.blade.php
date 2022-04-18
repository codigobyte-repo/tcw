<div>
    
    <div class="py-6 px-20 flex border-t">
        @error('mensaje') <span class="text-xs text-red-500">El campo mensaje es obligatorio.</span> @enderror
        <input autocomplete="off" id="message" wire:model="text" wire:keydown.enter="sendMessage" type="text" class="px-4 py-2 bg-gray-100 w-full border-0 font-light border-transparent focus:border-transparent focus:ring-0" placeholder="Escribe tu mensaje...">
        <button wire:click="sendMessage" class="bg-blue-500 text-white rounded px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
        </button>
    </div>

</div>
