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

                <div>
                    @livewire('add-cart-item', ['post' => $post])
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
        
        {{-- USUARIO --}}
        @livewire('publisher.post-profile-user', ['user' => $post->user, 'post' => $post], key($post->user->id))

        @if($similares->count())

            <div class="mt-10 md:mt-20">
                <h2 class="font-bold text-lg">Servicios similares</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach($similares as $similar)

                        <a href="{{ route('posts.show', $similar) }}">
                            <div class="max-w-sm rounded overflow-hidden shadow-lg">

                                @if (count($similar->images))
                                    <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($similar->images->first()->url) }}" alt="Imagen Post">
                                @else
                                    <img class="w-full" src="{{asset('img/fondo/fondoPost.webp')}}" alt="Imagen Post">
                                @endif
                                
                                <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $similar->name }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{$similar->subcategory->name}}
                                    </p>
                                </div>

                                <div class="flex p-4 justify-between">
                                    <div class="flex items-center space-x-2">
                                      <img class="w-10 rounded-full" src="{{$similar->user->profile_photo_url}}" alt="Foto Usuario" />
                                      <h2 class="text-gray-800 font-bold cursor-pointer">{{$similar->user->name}}</h2>
                                    </div>
                                    <div class="flex space-x-2">
                                      <div class="flex space-x-1 items-center font-bold">
                                        <span>
                                          USD
                                        </span>
                                        <span>{{$similar->price}}</span>
                                      </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                        
                    @endforeach
                </div>
            </div>

        @endif

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
    @endpush

</x-app-layout>