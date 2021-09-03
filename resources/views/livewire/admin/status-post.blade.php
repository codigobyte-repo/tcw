<div class="bg-white shadow-xl rounded-lg p-6 my-4">
    <h1 class="text-2xl text-center font-semibold mb-6">Estado de la publicación</h1>
        
    <div class="flex">

        @switch($post->status)
            @case(1)

            <div class="flex justify-end items-center m-auto">
        
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado correctamente
                </x-jet-action-message>

                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 mr-4" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p class="flex items-center">
                        Si todo está bien, puedes solicitar la revisión para que sea publicado.
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        
                    </p>
                </div>
        
                <x-button-purple-btn
                wire:loading.attr="disabled"
                        wire:target="save"
                        wire:click="save"
                >
                    Solicitar revisión
                </x-button-purple-btn>
        
            </div>
            
                @break
            @case(2)
            
            <span class="m-auto px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                Esta publicación se encuentra en revisión
            </span>

                @break
            
            @case(3)
            
            <span class="m-auto px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-500 text-white">
                Esta publicación se encuentra publicado
            </span>

                    @break

            @default
                
        @endswitch
    </div>

    @if ($post->observation)        
        <div class="text-center pt-4">
            <div class="text-center py-4 lg:px-4">
                <a href="{{ route('publisher.posts.observation', $post) }}">
                    <div class="p-2 bg-red-500 hover:bg-red-700 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-purple-600 uppercase px-2 py-1 text-xs font-bold mr-3">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>

                    </span>
                    <span class="font-semibold mr-2 text-left flex-auto">Tienes observaciones a solucionar</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                    </div>
                </a>
            </div>

                
        </div>
    @endif

    @push('script')
        <script>
            Livewire.on('saved', post => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>
    @endpush
    
</div>
