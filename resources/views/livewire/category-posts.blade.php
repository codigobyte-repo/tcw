<div wire:init="loadPosts">
    
    @if (count($posts))

        {{-- loadPosts indica que queremos que se cargue cuando se haya cargado la vista 
            INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26123942#notes--}}

        {{-- {{$category}} --}}
        {{-- USAMOS GLITER.JS info: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26111342#notes --}}
        <div class="glider-contain">
            
            <ul class="glider-{{$category->id}}">
                @foreach ($posts as $post)
                    {{-- {{ $loop->last ? '' : 'mr-4' }} loop se crea cuando ingresamos a un bucle y preguntamos si estamos en la ultima interaccion: 
                    si no hacemos esto la clase mr-4 al final deja un espacio de esta manera no se aplica el mr-4--}}
                    <li class="bg-purple-600 rounded-lg shadow ml-1 {{ $loop->last ? '' : 'sm:mr-4' }}">
                        <article>
                            @if($post->images)

                              @forelse($post->images as $img)
                                  @if ($loop->first) 
                                    <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{ Storage::url($img->url) }}" alt="{{$post->name}}">
                                  @endif
                              @empty
                                  <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="{{$post->name}}">
                              @endforelse
                            @else
                              <figure>
                                <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="{{$post->name}}">
                              </figure>
                            @endif

                            <div class="py-4 px-6">
                                <h1 class="text-lg text-white font-semibold">
                                    @if($seller == 1)
                                      <a href="{{ route('sellers.show', $post) }}">
                                          {{ ucfirst(Str::limit($post->name, 20)) }}
                                      </a>
                                    @else
                                      <a href="{{ route('posts.show', $post) }}">
                                          {{ ucfirst(Str::limit($post->name, 20)) }}
                                      </a>
                                    @endif
                                </h1>

                                <p class="font-bold text-white">
                                    US$ {{ $post->price }}
                                </p>
                            </div>

                        </article>
                    </li>

                @endforeach
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>

    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
    @endif
</div>
