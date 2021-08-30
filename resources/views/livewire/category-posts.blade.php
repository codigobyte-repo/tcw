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
                                  <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{ Storage::url($img->url) }}" alt="{{$post->name}}">
                              @empty
                                  <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="{{$post->name}}">
                              @endforelse
                              {{-- <figure>
                                  <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{ Storage::url($post->images->first()->url) }}" alt="{{$post->name}}">
                              </figure> --}}
                            @else
                              <figure>
                                <img class="rounded-t-lg h-48 w-full object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="{{$post->name}}">
                              </figure>
                            @endif

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
