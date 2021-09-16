<div>    
    
    <div class="rounded overflow-hidden shadow-lg my-6">
        <div class="flex justify-center pb-10">
            <img src="{{ $user->profile_photo_url }}" class="h-40 w-40 rounded-full object-cover" alt="Usuario"/>

            <div class="ml-10">
                <div class="flex items-center">
                    <h2 class="block leading-relaxed font-light text-gray-700 text-3xl">{{ $user->name }}</h2>
                    {{-- <a class="cursor-pointer px-3 ml-3 py-1 outline-none border-transparent text-center rounded border bg-blue-500 hover:bg-blue-600 text-white bg-transparent font-semibold">Enviar mensaje</a> --}}
                </div>
                <ul class="flex justify-content-around items-center">
                    <li>
                        <span class="block text-base flex"><span class="font-bold mr-2">
                        {{ $user->posts_count }}
                        </span> Publicaciones</span>
                    </li>
                    <li>
                        <div class="flex items-center">
    
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
                    </li>
                </ul>
                <br>
                <div class="">
                    <h1 class="text-base font-bold font-light">Especialista en:</h1>
                    <span class="text-base">{{$user->information->title}}</span>
                    
                </div>
            </div>
        </div>

        <div class="border-b border-gray-300"></div>

        <div class="flex justify-center pb-10">
            <div class="ml-10">
                <div class="my-6">
                    {{-- <h1 class="text-xl my-8 text-center font-bold font-light">Biografía</h1> --}}
                    <div class="font-bold text-xl my-8 text-center">Biografía</div>
                    <span class="text-base">{!! $user->information->biography !!}</span>
                    
                </div>
            </div>
        </div>
        
        <div class="border-b border-gray-300"></div>

        @if (!empty($postsUsuario))
            
            <div class="font-bold text-xl my-8 text-center">Más servicios de {{ $user->name }}</div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-4 py-6">
                @foreach($postsUsuario as $post)

                    <a href="{{ route('posts.show', $post) }}">
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">

                            @if (count($post->images))
                                <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($post->images->first()->url) }}" alt="Imagen Post">
                            @else
                                <img class="w-full" src="{{asset('img/fondo/fondoPost.webp')}}" alt="Imagen Post">
                            @endif
                            
                            <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $post->name }}</div>
                                <p class="text-gray-700 text-base">
                                    {{$post->subcategory->name}}
                                </p>
                            </div>

                            <div class="flex p-4 justify-between">
                                <div class="flex items-center space-x-2">
                                  <img class="w-10 rounded-full" src="{{$post->user->profile_photo_url}}" alt="Foto Usuario" />
                                  <h2 class="text-gray-800 font-bold cursor-pointer">{{$post->user->name}}</h2>
                                </div>
                                <div class="flex space-x-2">
                                  <div class="flex space-x-1 items-center font-bold">
                                    <span>
                                      USD
                                    </span>
                                    <span>{{$post->price}}</span>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </a>
                    
                @endforeach
            </div>
            
        @endif
        
    </div>


</div>
