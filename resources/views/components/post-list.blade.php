@props(['post'])

<li class="bg-purple-600 rounded-lg shadow mb-4">
    <article class="md:flex">
        <figure>
            <img class="rounded-l-lg h-48 w-full md:w-56 object-cover object-center" src="{{ Storage::url($post->images->first()->url) }}" alt="{{$post->name}}">
        </figure>

        <div class="flex-1 px-4 py-6 flex flex-col">

            <div class="lg:flex justify-between">
                <div>
                    <h1 class="text-lg text-white font-bold">
                        <a href="{{ route('posts.show', $post) }}">
                            {{ $post->name }}
                        </a>
                    </h1>
                    <p class="text-white font-bold">US$ {{ $post->price }} </p>
                </div>

                <div class="flex items-center">
                    <ul class="flex text-sm">
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                        </li>
                    </ul>

                    <span class="text-white text-sm">(24)</span>
                </div>

            </div>
            
            <div class="mt-4 md:mt-auto">
                {{-- Es un boton componente que creamos nosotros. view > components > button-enlace.blade.php ahí se cambian los estilos --}}
                <x-button-enlace href="{{ route('posts.show', $post) }}">
                    Más información
                </x-button-enlace>
            </div>

        </div>

    </article>
</li>