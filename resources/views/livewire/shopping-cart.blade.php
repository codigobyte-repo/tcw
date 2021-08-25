<div class="container py-8">

    <section class="text-center bg-purple-600 rounded-lg shadow-lg pt-10 mb-2">
        <h1 class="text-4xl font-semibold text-white h-20 mx-6">
            Cesta de compras
            @if(Cart::count() == 0)
                vacío, <a class="cursor-pointer text-blue-400 hover:text-white" href="{{ url('/') }}"> explorar contenidos aquí.</a>
            @endif
        </h1>
    </section>
    
    <div>
        <p>
            @if(Cart::count() == 1) 
                <p class="font-semibold text-purple-600">{{Cart::count()}}  producto en la cesta</p>
            @else
                <p class="font-semibold text-purple-600">{{Cart::count()}}  productos en la cesta</p>
            @endif
        </p>
    </div>

    @if(Cart::count())
        <x-table-responsive>
            <table class="min-w-full divide-y divide-gray-200 text-purple-600">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(Cart::content() as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $item->options->image }}" alt="Imagen del producto">
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                USD {{ $item->price }}
                                <a wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')"
                                    class="ml-6 cursor-pointer hover:text-red-600">
                                    <i class="fas fa-trash ml-2"></i>
                                </a>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"> {{ $item->qty }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    USD {{ $item->price * $item->qty }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-table-responsive>
        
        <div class="text-red-600 font-bold">
            <a wire:click="destroy" class="text-sm cursor-pointer hover:underline ml-8 my-3 inline-block"> <i class="fas fa-trash"></i> Vaciar toda la cesta</a>
        </div>

    @endif
  

    @if (Cart::count())
        
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                
                <div>
                    <p class="text-purple-600">
                        <span class="font-bold text-lg">Total:</span>
                        USD {{ Cart::subTotal() }}
                    </p>
                </div>
                
                <div>
                    <a href="{{ route('orders.create') }}" class="bg-purple-600 text-white inline-flex items-center px-4 py-2 rounded-md font-bold text-xs uppercase tracking-widest hover:bg-purple-800 active:bg-purple-400 disabled:opacity-25 transition">
                        Continuar
                    </a>
                </div>

            </div>
        </div>

    @endif

</div>
