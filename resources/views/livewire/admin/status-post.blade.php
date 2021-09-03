<div class="bg-white shadow-xl rounded-lg p-6 my-4">
    <h1 class="text-2xl text-center font-semibold mb-6">Estado de la publicación</h1>
        
    <div class="flex">

        @switch($post->status)
            @case(1)

            <div class="flex justify-end items-center m-auto">
        
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado correctamente
                </x-jet-action-message>
        
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
