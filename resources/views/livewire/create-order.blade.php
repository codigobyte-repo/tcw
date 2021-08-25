<div>

    <div class="container py-8 grid grid-cols-1 md:grid-cols-5 gap-6">
        
        <div class="col-span-3">

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-lg font-semibold">Resumen:</p>
                <ul>
                    {{-- Uso de shopincart https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26256356#notes --}}
                    @forelse (Cart::content() as $item)
                        <li class="flex p-2 border-b border-gray-200">
                            <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="Imagen del servicio">
                            <article class="flex-1">
                                <h1 class="font-bold text-purple-600">{{ $item->name }}</h1>
                                <p class="font-bold">USD {{ $item->price }}</p>
                            </article>
                        </li>
                    @empty
    
                        <li class="py-6 px-4">
                            <p class="text-center text-purple-600">
                                No tiene agregado ningún item en el carrito
                            </p>
                        </li>
                        
                    @endforelse
                </ul>

                <hr class="mt-4 mb-3">

                <div class="text-gray-700">
                    <p class="flex justify-between items-center">
                        <span class="text-lg font-semibold">Subtotal</span>
                        <span class="font-semibold">USD {{ Cart::subtotal() }}</span>
                    </p>
                    <p class="flex justify-between items-center">
                        <span>Tarifa del servicio <span class="text-gray-500 text-sm">(Tarifa aplicada por operar de forma asegurada)</span></span>
                        <span class="font-semibold">
                            8% 
                        </span>
                    </p>
                    <p class="flex justify-between items-center text-bold text-xl mt-8">
                        <span class="text-lg font-semibold">Total</span>
                        <span class="font-semibold">USD {{ ( (Cart::subtotal(1) * $commission) / 100 + Cart::subtotal(1) ) }}</span>
                        
                    </p>
                </div>

            </div>

        </div>

        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-lg font-semibold">Total:</p>
                <p class="text-3xl text-purple-600 font-bold">USD {{ ( (Cart::subtotal(1) * $commission) / 100 + Cart::subtotal(1) ) }}</p>

                <hr class="mt-4 mb-3">
                
                <div class="my-4">
                    <button
                        wire:loading.attr="disabled"
                        wire:target="create_order"
                        wire:click="create_order" 
                        class="w-full text-center bg-purple-600 text-white px-4 py-2 rounded-md font-bold text-lg uppercase tracking-widest hover:bg-purple-800 active:bg-purple-400 disabled:opacity-25 transition">
                        CONTINUAR CON LA COMPRA
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>
