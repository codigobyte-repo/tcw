<x-app-layout>
    
    <nav class="container bg-grey-light p-3 rounded font-sans w-full ">
        <ol class="list-reset flex text-grey-dark">
            <li>
                <a href="{{ route('posts.index') }}" class="text-blue font-bold">Inicio</a>
            </li>
          
            <li><span class="mx-2 text-gray-800 font-bold">></span></li>

            <li>
                <a href="{{ route('posts.category', $post->subcategory->category->slug) }}" class="text-blue-500 font-bold">{{$post->subcategory->category->name}}</a>
            </li>
        </ol>
    </nav>

    <div class="container py-2">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            {{-- Columna 1 --}}
            <div>
                {{-- Galería FlexSlider --}}
                <div class="flexslider">
                    <ul class="slides">
                      @forelse($post->images as $image)
                          
                        <li data-thumb="{{ Storage::url($image->url) }}">
                            <img src="{{ Storage::url($image->url) }}" />
                        </li>
                      @empty
                        <li data-thumb="{{asset('img/fondo/fondoPost.webp')}}">
                            <img src="{{asset('img/fondo/fondoPost.webp')}}" />
                        </li>
                      @endforelse
                    </ul>
                </div>

                
            </div>
            
            {{-- Columna 2 --}}
            <div>
                
                <div class="flex items-center justify-between gap-x-8 my-10">
                    <p class="text-2xl">{{ $post->name }}</p>
                    <p class="text-3xl font-bold">USD {{ $post->price }} </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <a href="#resenas">
                        <span class="text-xl font-bold mr-2">Reseñas:</span>
                        <span class="relative inline-block">
                            <svg class="w-6 h-6 text-purple-600 fill-current" viewBox="0 0 20 20"><path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $post->reviews_count }}</span>
                        </span>
                    </a>

                    
                    <div class="flex items-center">
                            
                        <span class="text-xl font-bold">Calificación:</span>
    
                        <ul class="flex items-center">
                            <li class="mr-1 cursor-pointer">
                                <i class="fas fa-star text-{{ $rating >= 1 ? 'yellow' : 'gray'}}-300"></i>
                            </li>
                            <li class="mr-1 cursor-pointer">
                                <i class="fas fa-star text-{{ $rating >= 2 ? 'yellow' : 'gray'}}-300"></i>
                            </li>
                            <li class="mr-1 cursor-pointer">
                                <i class="fas fa-star text-{{ $rating >= 3 ? 'yellow' : 'gray'}}-300"></i>
                            </li>
                            <li class="mr-1 cursor-pointer">
                                <i class="fas fa-star text-{{ $rating >= 4 ? 'yellow' : 'gray'}}-300"></i>
                            </li>
                            <li class="mr-1 cursor-pointer">
                                <i class="fas fa-star text-{{ $rating == 5 ? 'yellow' : 'gray'}}-300"></i>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                
                <div class="grid grid-cols-1 my-8">
                    <div class="flex items-center">
                        <p class="text-purple-600 mr-2 text-sm font-semibold">Publicado por:</p>
                        <img class="h-8 w-8 rounded-full" src="{{ $post->user->profile_photo_url }}" alt="Imagen de perfil">
                        <p>
                           <a class="text-blue-600 ml-2 text-lg" href="#resenas"> {{ $post->user->name }} </a>
                        </p>
                    </div>
                    <div class="mt-4">
                        <i class="far fa-clock text-sm text-gray-500"></i>
                        Fecha de entrega <b>{{ $post->tiempo_entrega }}</b> días
                    </div>
                    <div class="mt-4">
                        <i class="far fa-clock text-sm text-gray-500"></i>
                        Públicado {{ $post->created_at->diffForHumans(); }}
                    </div>
                </div>

                <div class="rounded overflow-hidden shadow-lg my-6 px-4">
                    <div class="flex items-center justify-between gap-x-8 my-10">
                        <p class="text-2xl text-purple-600 text-center mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Vendé este servicio 
                        </p>
                        
                    </div>
                    <input type="text" disabled value="http://localhost:8000/seller/{{$post->id}}/{{auth()->user()->uuid}}" id="myInput"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button onclick="myFunction()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block my-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="underline hover:text-blue-600" id="copiado"> Copia aquí la URL y compártela </span>
                    </button>
                </div>
                
                

            </div>

        </div>

        <div class="rounded overflow-hidden shadow-lg my-6 -mt-10">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">Acerca de este servicio</div>
              <p class="text-gray-700 text-base">
                {!! $post->description !!}
              </p> 
            </div>        
        </div>
        

        <div class="rounded overflow-hidden shadow-lg my-6">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">Tiempo de entrega</div>
              <p class="text-gray-700 text-base">
                <p><i class="far fa-clock text-gray-400"></i> {!! $post->tiempo_entrega !!} DÍAS</p>
              </p> 
            </div>        
        </div>

        
        {{-- VALORACIONES --}}
        <div class="mb-4" id="resenas">
        </div>
        
        @livewire('post-reviews', ['post' => $post], key($post->id))

        <div class="rounded overflow-hidden shadow-lg my-6 px-4">
            <div class="flex items-center justify-between gap-x-8 my-10">
                <p class="text-2xl text-purple-600 text-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Vendé este servicio 
                </p>
                
            </div>
            <input type="text" disabled value="http://localhost:8000/{{$post->id}}/{{auth()->user()->uuid}}" id="myInput"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <button onclick="myFunction()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block my-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="underline hover:text-blue-600" id="copiadoDos"> Copia aquí la URL y compártela </span>
            </button>
        </div>
        
        {{-- USUARIO --}}
        @livewire('publisher.post-profile-user', ['user' => $post->user, 'post' => $post], key($post->user->id))
        
        

    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                
                });
            });
        </script>

        <script>
            /*Función para copiar la url para el vendedor*/
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("myInput");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                document.getElementById("copiado").textContent="Copiado!";
                document.getElementById("copiadoDos").textContent="Copiado!";

            }
        </script>
    @endpush

</x-app-layout>