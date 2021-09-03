<x-app-layout>
    
    <div class="container py-8">


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

                <h1 class="text-4xl font-bold text-purple-600 mb-4 -mt-10 md:-mt-0 capitalize">{{$post->name}}</h1>

                <h2 class="text-xl font-bold text-gray-600 mb-4">{{$post->extract}}</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-y-4">
                    
                    <p class="flex items-center">
                        <span class="text-xl font-bold mr-2">Sección:</span>
                        <a class="capitalize hover:text-purple-600" href="">
                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-lg font-bold leading-none text-white bg-purple-600 rounded-full">
                            {{ $post->brand->name }}
                            </span>
                        </a>
                    </p>

                    <p class="font-bold  mr-2">
                        <span class="text-xl font-bold mr-2">Calificación:</span>
                        <i class="fas fa-star text-2xl text-yellow-400"></i> (5) </p>

                    <a href="">
                        <span class="text-xl font-bold mr-2">Reseñas:</span>
                        <span class="relative inline-block">
                            <svg class="w-6 h-6 text-purple-600 fill-current" viewBox="0 0 20 20"><path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">99</span>
                        </span>
                    </a>
                    
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 my-8">

                    <div class="flex items-center">
                        <p class="text-purple-600 mr-2 text-sm font-semibold">Publicado por:</p>
                        <img class="h-8 w-8 rounded-full" src="{{ $post->user->profile_photo_url }}" alt="Imagen de perfil">
                        <p>{{ $post->user->name }}</p>
                    </div>
                    
                    <div>
                        <i class="far fa-clock text-sm text-gray-500"></i>
                        Públicado {{ $post->created_at->diffForHumans(); }}
                    </div>
                </div>

                <div class="bg-white shadow my-8 text-center place-content-end">
                    <div class="flex justify-between mx-4 py-2">
                        <p class="text-3xl text-black"> Precio</p> 
                        <p class="text-3xl justify-between font-bold">USD{{ $post->price }}</p>

                    </div>
                </div>

                <div>
                    @livewire('add-cart-item', ['post' => $post])
                </div>



            </div>

        </div>

        <div class="rounded overflow-hidden shadow-lg my-6 lg:-mt-10">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">Descripción</div>
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
        @livewire('post-reviews', ['post' => $post], key($post->id))

        @if($similares->count())

            <div class="mt-10 md:mt-20">
                <h2 class="font-bold text-lg">Servicios similares</h2>

                <div class="grid grid-cols-1 md:grid-cols-4">
                    

                    @foreach($similares as $similar)
                        
                        <a class="mb-2 md:mb-0" href="{{ route('posts.show', $similar) }}">
                            
                            @if (count($similar->images))
                                <img class="w-36 h-30 object-cover object-center" src="{{ Storage::url($similar->images->first()->url) }}" alt="Imagen Post">
                            @else
                                <img class="w-36 h-30 object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="Imagen Post">
                            @endif
                            
                            <span class="ml-2 text-gray-800">{{ $similar->name }}</span>
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
                controlNav: "thumbnails"
                });
            });
        </script>
    @endpush

</x-app-layout>