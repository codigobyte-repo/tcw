<div>
    {{-- Seccion categoria con grilla de cambio de vista --}}
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-2 flex justify-between items-center">
            
            <h1 class="xs:text-sm md:text-2xl font-bold my-6 text-purple-600">{{ $category->name }}</h1>

            <div class="hidden md:block grid grid-cols-2 border border-gray-200 rounded divide-x divide-gray-200 text-gray-500">
                <i wire:click="$set('view', 'grid')" class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-purple-600' : '' }}"></i>
                <i wire:click="$set('view', 'list')" class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-purple-600' : '' }}"></i>
            </div>

        </div>
    </div>
    {{-- Fin Seccion categoria con grilla de cambio de vista --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <aside>

            <h2 class="xs:text-sm md:text-lg font-bold text-purple-600 py-2 border-l-2 pl-2 mb-6 border-purple-600">Explora en la plataforma</h2>
            
            <ul class="divide-y divide-gray-200">
                @foreach($category->subcategories as $subcategory)
                    <li class="py-2">
                        <a class="cursor-pointer hover:text-purple-600 {{ $subcategoria == $subcategory->slug ? 'text-purple-600 font-bold' : '' }}" 
                            {{-- Método mágico livewire: Seteamos la propiedad subcategoria con el nombre de la subcategoria --}}
                            wire:click="$set('subcategoria', '{{$subcategory->slug}}') " >
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="xs:text-sm md:text-lg font-bold text-purple-600 py-2 border-l-2 pl-2 mt-4 mb-6 border-purple-600">Explora en profundidad</h2>
            
            <ul class="divide-y divide-gray-200">
                @foreach($category->brands as $brand)
                    <li class="py-2">
                        <a class="cursor-pointer hover:text-purple-600 {{ $marca == $brand->name ? 'text-purple-600 font-bold' : '' }}" 
                            {{-- Método mágico livewire: Seteamos la propiedad subcategoria con el nombre de la subcategoria --}}
                            wire:click="$set('marca', '{{$brand->name}}') " >
                            {{ $brand->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <x-jet-button wire:click="limpiar" class="mt-4 bg-purple-600 hover:bg-purple-500 text-white">
                Eliminar filtros
            </x-jet-button>

        </aside>

        <div class="md:col-span-2 lg:col-span-4">
            {{-- Mostramos la vista con grid o list --}}
            @if ($view == 'grid')
                {{-- grid --}}
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($posts as $post)
                        <li class="bg-purple-600 rounded-lg shadow">
                            <article>
                                <figure>
                                    <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{ Storage::url($post->images->first()->url) }}" alt="{{$post->name}}">
                                </figure>

                                <div class="py-4 px-6">
                                    <h1 class="text-lg text-white font-semibold">
                                        <a href="{{ route('posts.show', $post) }}">
                                            {{ ucfirst(Str::limit($post->name, 20)) }}
                                        </a>
                                    </h1>

                                    <p class="font-bold text-white">
                                        US$ {{ $post->price }}
                                    </p>
                                </div>

                                <div class="flex space-x-4 pl-6 py-2">
                                    <a href="/" aria-label="Likes" class="flex items-start text-white transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                                    <div class="mr-2">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        class="w-5 h-5 text-white transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                                        >
                                        <polyline points="6 23 1 23 1 12 6 12" fill="none" stroke-miterlimit="10"></polyline>
                                        <path d="M6,12,9,1H9a3,3,0,0,1,3,3v6h7.5a3,3,0,0,1,2.965,3.456l-1.077,7A3,3,0,0,1,18.426,23H6Z" fill="none" stroke="currentColor" stroke-miterlimit="10"></path>
                                        </svg>
                                    </div>
                                    <p class="font-semibold">7.4K</p>
                                    </a>
                                    <a href="/" aria-label="Comments" class="flex items-start text-white transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                                    <div class="mr-2">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-white transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                                        >
                                        <polyline points="23 5 23 18 19 18 19 22 13 18 12 18" fill="none" stroke-miterlimit="10"></polyline>
                                        <polygon points="19 2 1 2 1 14 5 14 5 19 12 14 19 14 19 2" fill="none" stroke="currentColor" stroke-miterlimit="10"></polygon>
                                        </svg>
                                    </div>
                                    <p class="font-semibold">81</p>
                                    </a>
                                </div>

                            </article>
                        </li>
                    @empty 
                        
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Upss!</strong>
                                <span class="block sm:inline">No existe ningun registro con ese filtro.</span>
                            </div>
                        </li>

                    @endforelse
                </ul>

            @else
                {{-- list --}}
                <ul>
                    @forelse($posts as $post)
                        
                        {{-- llamamos al componente view->components->pos-list --}}
                        <x-post-list :post="$post" />
                    
                    @empty

                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Upss!</strong>
                            <span class="block sm:inline">No existe ningun registro con ese filtro.</span>
                        </div>

                    @endforelse
                </ul>
                
            @endif
            

            <div class="mt-4">
                {{$posts->links()}}
            </div>
            
        </div>

    </div>


</div>
