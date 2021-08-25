<div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">
            
            <div class="relative">
                <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-purple-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>

                <div class="absolute -left-2 mt-0.5">
                    <p>Comienzo</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-purple-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-purple-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>

                <div class="absolute -left-4 mt-0.5">
                    <p>Procesando</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-purple-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-purple-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-2 mt-0.5">
                    <p>Entregado</p>
                </div>
            </div>

        </div>
            
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-4 ">
            <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span> 
                Orden-{{ $order->id }}</p>

            <form wire:submit.prevent="update">
                <div class="flex space-x-3 mt-2">

                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                        RECIBIDO
                    </x-jet-label>

                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="3" class="mr-2">
                        ENVIADO
                    </x-jet-label>

                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="4" class="mr-2">
                        ENTREGADO
                    </x-jet-label>

                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                        ANULADO
                    </x-jet-label>

                </div>

                <div class="flex mt-2">
                    <x-button-purple-btn class="ml-auto">
                        Actualizar
                    </x-button-purple-btn>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Comision</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" 
                                    src="{{ $item->options->image }}" alt="Imagen del servicio">
                                    <article>
                                        <h1 class="font-bold">{{ $item->name }}</h1>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">USD {{ $item->price }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-center">8%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
