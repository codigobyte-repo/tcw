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

                    @if($order->status != 4)

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

                    @else
                    
                        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>¡Muchas gracias! el comprador tiene un plazo de 72 hs para aprobar el proyecto.</p>
                        </div>

                    @endif

                    {{-- <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                        ANULADOS
                    </x-jet-label> --}}

                </div>
                @if($order->status != 4)
                    <div class="flex mt-2">
                        <x-button-purple-btn class="ml-auto">
                            Actualizar
                        </x-button-purple-btn>
                    </div>
                @endif
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

    @push('script')
        <script>
            Livewire.on('saved', post => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endpush

</div>
