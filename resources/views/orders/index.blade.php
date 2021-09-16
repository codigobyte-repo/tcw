<x-app-layout>

    
    <div class="container py-12">
        
        @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold mb-4 px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <section class="grid lg:grid-cols-7 gap-2 text-white">
            
            <a href="{{ route('orders.index') . "?status=1" }}" class="bg-orange-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $pendiente }}
                </p>
                <p class="uppercase text-center">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=2" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $proceso }}
                </p>
                <p class="uppercase text-center">Proceso</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=3" }}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $recibido }}
                </p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=4" }}" class="bg-indigo-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $finalizado }}
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=5" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $anulado }}
                </p>
                <p class="uppercase text-center">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=6" }}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $cerrado }}
                </p>
                <p class="uppercase text-center">Cerrado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="far fa-thumbs-up"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=7" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $rechazado }}
                </p>
                <p class="uppercase text-center">Rechazado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-meh"></i>
                </p>
            </a>

        </section>

        @if ($orders->count())
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Pedidos recientes</h1>

                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <a href="{{ route('orders.show', $order) }}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(1)
                                            <i class="fas fa-business-time text-orange-500 opacity-50"></i>
                                            @break
                                        @case(2)
                                            <i class="fas fa-credit-card text-gray-500 opacity-50"></i>                                        
                                            @break
                                        @case(3)
                                            <i class="fas fa-truck text-yellow-500 opacity-50"></i>                                        
                                            @break
                                        @case(4)
                                            <i class="fas fa-check-circle text-pink-500 opacity-50"></i>                                        
                                            @break
                                        @case(5)
                                            <i class="fas fa-times-circle text-red-500 opacity-50"></i>                                        
                                            @break
                                        @case(6)
                                            <i class="far fa-thumbs-up text-green-500 opacity-50"></i>                                        
                                            @break
                                        @case(7)
                                            <i class="fas fa-meh text-red-500 opacity-50"></i>                                        
                                            @break
                                        
                                        @default
                                            
                                    @endswitch
                                </span>

                                <span>
                                    Orden: {{ $order->id }}
                                    <br>
                                    {{ $order->created_at->format('d/m/y') }}
                                </span>

                                <div class="ml-auto">
                                    <span class="font-bold">
                                        @switch($order->status)
                                            @case(1)
                                                Pendiente
                                                @break
                                            @case(2)
                                                En proceso
                                                @break
                                            @case(3)
                                                Recibido
                                                @break
                                            @case(4)
                                                Finalizado
                                                @break
                                            @case(5)
                                                Anulado
                                                @break
                                            @case(6)
                                                Cerrado
                                                @break
                                            @case(7)
                                                Rechazado
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                    
                                    <br>

                                    <span class="text-sm">
                                        USD {{ $order->total }}
                                    </span>
                                </div>

                                <span>
                                    <i class="fas fa-angle-right ml-6"></i>
                                </span>

                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <span class="font-bold text-lg">
                    No existe registro de ordenes
                </span>
            </div>
        @endif

    </div>

</x-app-layout>