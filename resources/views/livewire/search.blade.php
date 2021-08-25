<div class="flex-1 relative" x-data="">
    

    <form action="{{ route('search') }}" autocomplete="off">
        <div class="bg-purple-600 shadow p-2 flex md:rounded-lg sm:rounded-none">
            
            <span class="w-auto flex justify-end items-center text-gray-500 p-2">    
                <img class="hidden lg:block h-12 w-auto material-icons text-3xl" src="{{ asset('img/icons/searchWhite.svg')}}" alt="Lupa">
            </span>

            <input wire:model="search" name="name" class="w-full rounded p-2 text-lg" type="text" placeholder="¿Qué estás buscando?">

            <button type="submit" class="bg-white hover:bg-purple-500 hover:text-white md:rounded sm:rounded-none text-purple-600 ml-3 p-2 pl-4 pr-4">
                <p class="font-semibold text-lg">Buscar</p>
            </button>
            
        </div>
    </form>

    {{-- OCULTAR DIV DEL BUSCADOR CON ALPINE --}}
    {{-- https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26366812#notes --}}
    <div class="absolute w-full mt-1 z-50 hidden" :class="{ 'hidden': !$wire.open }" @click.away="$wire.open = false">
        <div class="bg-white shadow">
            <div class="px-4 py-3 space-y-1">
                
                @forelse($posts as $post)
                    <a href="{{ route('posts.show', $post) }}" class="flex">
                        <img class="w-16 h-12 object-cover" src="{{ Storage::url($post->images->first()->url ) }}" alt="Imagen producto">

                        <div class="ml-4 text-purple-600">
                            <p class="text-lg font-semibold leading-5">{{ $post->name }}</p>
                            <p>Categoría: {{ $post->subcategory->category->name }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg leading-5">No hay resultados coincidentes con: <span class="font-semibold">{{$search}}</span></p>
                @endforelse

            </div>
        </div>
    </div>

</div>
