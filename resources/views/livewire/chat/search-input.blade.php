<div class="border-b border-gray-200">
        
    <div class="mx-3 my-3">
            
        <div class="relative text-gray-700 focus-within:text-gray-500">
            <span class="absolute inset-y-1 left-0 ml-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input wire:model.debounce.500ms="search" type="search" class="w-full rounded-full border-2 pl-10 py-2 outline-none focus:outline-none" placeholder="Busca tus contactos...">
        </div>

    </div>

    @if (strlen($this->search) > 0)
        
        @if(!empty($users))
            <h2 class="text-base text-gray-600 ml-3 mt-3">Usuarios</h2>
            @foreach($users as $user)
                <a href="{{ url('chat/' . $user->uuid) }}" class="hover:bg-gray-700">
                    <div class="flex bg-gray-100 hover:bg-gray-300 rounded p-4 mb-4 mr-2 mt-4">
                        <img class="h-12 w-12 rounded-full object-cover mr-2" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                        <p class="flex-grow ml-2">{{ $user->name }}</p>
                    </div>
                </a>
            @endforeach
        @else
            <p class="ml-3 text-center">No hay coincidencias</p>
        @endif

    @endif

</div>
