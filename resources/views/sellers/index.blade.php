<x-app-layout>


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

                @livewire('category-posts', ['category' => $category, 'seller' => 1])

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