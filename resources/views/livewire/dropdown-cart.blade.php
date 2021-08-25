<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block mr-8 mt-3 cursor-pointer">
                <img class="h-7 w-7" src="{{ asset('img/icons/shopping-cart-white.svg') }}" alt="Cart">

                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-purple-100 transform translate-x-1/2 -translate-y-1/2 bg-blue-400 rounded-full">{{ Cart::count() }}</span>
                @else
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-blue-400 rounded-full"></span>
                @endif
            </span>
        </x-slot>

        <x-slot name="content">
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

            @if(Cart::count())
                <div class="py-2 px-4 text-center">
                    <p class="text-2xl font-bold my-2">Total: USD {{ Cart::subtotal() }}</p>

                    <div>
                        <a href="{{ route('shopping-cart') }}" type="button" class="w-full bg-purple-600 text-sm px-4 py-3 rounded text-white font-bold hover:bg-purple-800 transition duration-200 each-in-out">
                            Ir a la cesta de compras
                        </a>
                    </div>

                </div>
            @endif

        </x-slot>
    </x-jet-dropdown>
</div>
