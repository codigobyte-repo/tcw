<x-app-layout>

    {{-- HEADER --}}
    @if (!auth()->user())

        <div id="bg-animation" class="w-full h-screen bg-no-repeat bg-cover bg-left bg-fixed filter"

            style="background-image: url({{asset('img/fondo/bg-principal4.jpg')}});">
            
            <div class="grid grid-cols-1 h-screen justify-center items-center">
                <div class="text-center">
                    
                    <h1 class="hidden md:block z-40 text-5xl text-white font-extrabold animate__animated animate__backInDown py-4"><span class="xl:text-6xl sm:text-4xl">CONTRATÁ</span> <span class="xl:text-7xl sm:text-4xl text-purple-600 bg-white px-4">ON-LINE</span></h1>
                    <h1 class="md:hidden z-40 text-5xl text-white font-extrabold animate__animated animate__backInDown py-4">CONTRATÁ ON-LINE</span></h1>
                    <h1 class="z-40 sm:text-3xl text-white font-extrabold animate__animated animate__backInDown">EL MEJOR PROYECTO A TU MEDIDA</h1>

                    <div class="py-10">
                        <a href="#home_section" class="bg-purple-600 hover:bg-blue-500 text-white font-semibold hover:text-white py-2 hover:border-transparent px-6 rounded-full xl:text-3xl lg:text-2xl md:text-2xl sm:text-1xl">
                            Explorar soluciones
                        </a>
                        <img class="h-12 w-12 mt-10 mx-auto animate__animated animate__bounce" src="{{ asset('img/icons/scroll.svg') }}" alt="Scroll">
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- FIN HEADER --}}

        <section id="home_section">
            <div class="bg-wave-pattern h-6 bg-repeat-x relative -top-2"></div>
        </section>

    @endif

    <div class="container py-8">
        
        
        {{-- LOGO PRINCIPAL --}}
        <img class="mx-auto w-28 py-6" src="{{ asset('img/logo.png') }}" alt="Logo">
        {{-- FIN LOGO PRINCIPAL --}}

        {{-- BUSCADOR --}}
        <div class="mb-4">
            @livewire('search')
        </div>
        {{-- FIN BUSCADOR --}}
        
        {{-- POST PRINCIPALES --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post) }}">
                    <article class="w-full mb-20 h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" 
                        style="
                            @isset($post->images)
                                @forelse($post->images as $img)
                                    background-image:url({{ Storage::url($img->url) }}) 
                                @empty
                                    background-image:url({{asset('img/fondo/fondoPost.webp')}}) 
                                @endforelse
                            @else 
                                background-image:url({{asset('img/fondo/fondoPost.webp')}}) 
                            @endisset
                            ">
                        
                        <div class="w-full h-full px-8 flex flex-col justify-center">
                            
                            <div>
                                @foreach($post->tags as $tag)
                                    
                                    <a href="{{ route('posts.tag', $tag) }}" class="bg-{{$tag->color}}-600 inline-block my-1 px-3 h-6 text-white rounded-full">{{$tag->name}}</a>

                                @endforeach
                            </div>

                            {{-- <h1 class="text-4xl text-white leading-8 font-bold mt-2">
                                <a class="capitalize" href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
                            </h1> --}}

                        </div>
                        
                        <div class="w-full h-14 pl-4 pt-3 pb-20 border-b-4  border-purple-600">
                            
                                <h1 class="text-gray-700 text-2xl mt-2"><b>{{ $post->name }}</b></h1>
                            
                                <h1 class="text-gray-700 text-lg"><b>Precio: ${{ $post->price }}</b></h1>
                            
                        </div>

                    </article>
                </a>
            @endforeach

        </div>
        {{-- POST PRINCIPALES --}}
    </div>


    {{-- MOSTRAMOS TODAS LAS CATEGORÍAS --}}
    <div class="container py-8">
        @foreach($categories as $category)    

            <section class="mb-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold my-6 text-gray-700">
                        {{ $category->name }}
                    </h1>

                    <a href="{{ route('posts.category', $category) }}" class="text-lg text-purple-600 hover:text-purple-400 hover:underline ml-2 font-bold">Ver más</a>
                </div>

                @livewire('category-posts', ['category' => $category])

            </section>

        @endforeach
    </div>
    {{-- MOSTRAMOS TODAS LAS CATEGORÍAS --}}

    {{-- La directiva script está en app.blade.php esto permite que al cargar la pagína principal de la plantilla se ejecute el js en ese momento --}}
    @push('script')
        <script>

            Livewire.on('glider', function(id){

                /* USO GLIDER.JS INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26111342#notes */
                /* SOLUCION BOTONES DEL SLIDER: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26135280#notes */
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings:{
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings:{
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings:{
                                slidesToShow: 4,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings:{
                                slidesToShow: 4,
                                slidesToScroll: 4,
                            }
                        },
                    ]
                });

            });
        </script>

        <script>

            /* Vanta js seleccionar el diseño aquí y cambiar también en app.blade.php */

            /* VANTA.WAVES({
            el: "#bg-animation",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00
            }) */

            /* VANTA.GLOBE({
            el: "#bg-animation",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3fe8ff,
            backgroundColor: 0x5d29bb
            }) */

            VANTA.NET({
            el: "#bg-animation",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3f82ff,
            points: 12.00,
            spacing: 14.00
            })

            /* VANTA.HALO({
            el: "#bg-animation",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00
            }) */
        </script>
        
    @endpush

</x-app-layout>