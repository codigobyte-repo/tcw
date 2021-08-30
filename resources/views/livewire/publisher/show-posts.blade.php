<div>
    
    <x-slot name="header">
        <div class="flex items-center">
            {{-- Usamos el slot de la vista publisher.blade.php --}}
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de publicaciones
            </h2>

            <x-button-purple class="ml-auto" href="{{ route('publisher.posts.create')}}">
                Crear nueva publicación
            </x-button-purple>
        </div>
    </x-slot>

    <div class="container py-12">
        <div class="flex flex-col">
            
            {{-- Este componente esta en view->components->table-responsive.php --}}
            {{-- Se hizo este componente para limpiar un poc los estilos --}}
            {{-- INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26891884#questions --}}
            <x-table-responsive>

                <div class="px-6 py-4">
                    <x-jet-input type="text"
                    wire:model="search"
                    class="w-full"
                    placeholder="Ingrese el nombre del servicio que quiere buscar" />
                </div>

                @if ($posts->count())
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Calificación
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Operación
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        
                            @foreach($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($post->images->count())
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($post->images->first()->url) }}" alt="Imagen de post">
                                                @else
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('img/fondo/triangles.png') }}" alt="Imagen de post">
                                                @endif
                                            </div>
                                            
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $post->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $post->subcategory->category->name }}</div>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap flex items-center">
                                            <ul class="flex text-sm">
                                                <li class="mr-1">
                                                    <i class="fas fa-star text-{{ $post->rating >= 1 ? 'yellow' : 'gray'}}-400"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star text-{{ $post->rating >= 2 ? 'yellow' : 'gray'}}-400"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star text-{{ $post->rating >= 3 ? 'yellow' : 'gray'}}-400"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star text-{{ $post->rating >= 4 ? 'yellow' : 'gray'}}-400"></i>
                                                </li>
                                                <li class="mr-1">
                                                    <i class="fas fa-star text-{{ $post->rating == 5 ? 'yellow' : 'gray'}}-400"></i>
                                                </li>
                                            </ul>
                                        </p>
                                        <div class="text-sm text-gray-500">
                                            Valoración del servicio
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($post->status)
                                            @case(1)

                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                                Borrador
                                            </span>
                                            
                                                @break
                                            @case(2)
                                            
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                                Publicado
                                            </span>

                                                @break
                                            @default
                                                
                                        @endswitch
                                        
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    USD {{ $post->price }}
                                    </td>

                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- <a href="{{ route('publisher.posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> --}}
                                        <x-button-purple href="{{ route('publisher.posts.edit', $post) }}">Editar publicación</x-button-purple>
                                    </td>
                                </tr>
                            @endforeach        
                        
                        </tbody>
                    </table>

                @else
                    
                    <div class="px-6 py-4">
                        No hay registros coincidentes
                    </div>
                    
                @endif


                {{-- Preguntamos si existe paginación hasPages() si no existe no usamos el espacio class="px-6 py-4"--}}
                @if ($posts->hasPages())
                    <div class="px-6 py-4">
                        {{ $posts->links() }}
                    </div>                    
                @endif
                
            </x-table-responsive>
                    
        </div>
    </div>  

</div>
