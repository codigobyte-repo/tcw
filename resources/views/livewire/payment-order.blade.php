<div>
    
    <style>
        button.mercadopago-button {
            background-color: #3498db;
            color: #fff;
        }
        button.mercadopago-button:hover {
            background: #3cb0fd;
        }
    </style>

    @php    

        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->options->price_total;

            $products[] = $item;
        }

        $preference->back_urls = array(
        "success" => route('orders.pay', $order),
        "failure" => "http://www.tu-sitio/failure",
        "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";

        $preference->items = $products;
        $preference->save();

    @endphp

    <div class="grid grid-cols-1 container py-8">

        <div class="xl:col-span-3">
            
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-4">
                <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span> Orden-{{ $order->id }}</p>
            </div>

            <x-table-responsive>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Comisión
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $item->options->image }}" alt="Imagen del servicio">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <h1 class="font-bold">{{ $item->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    8%
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->qty }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        USD {{ $item->price }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-table-responsive>
        </div>
        
        <div class="xl:col-span-2 mt-4">

            <div class="bg-white rounded-lg shadow-lg px-6">
                <div class="p-6 mb-4 flex justify-between items-center">
                    <p class="text-3xl font-semibold text-purple-600">Total:</p>
                    <p class="text-3xl text-purple-600 font-bold">USD {{ $order->totalConComision }}</p>            
                </div>

                <div>
                    <article class="py-4">
                        <p class="text-sm text-gray-500 font-semibold">PAGO SEGURO SSL</p>
                        <p class="text-sm text-gray-500">Su información está protegida por cifrado SSL de 256 bits</p>
                    </article>
                </div>
    
                {{-- BOTON PAGAR MERCADO LIBRE --}}
                {{-- <div class="bg-white px-4 py-4 flex justify-between items-center">
                    <img class="h-10" src="{{ asset('img/pasarelas/MP.png') }}" alt="MercadoPago">

                    <div>
                        <a class="cho-container">
                        </a>
                    </div>
                </div> --}}

                <hr class="py-2 px-4">

                <div class="bg-white px-4 py-2 flex justify-between items-center">
                    <img class="h-10 -mt-6" src="{{ asset('img/pasarelas/PayPal.jpg') }}" alt="PayPal">

                    <div>
                        {{-- BOTON PAGAR MERCADO LIBRE --}}
                        <div id="paypal-button-container"></div>
                    </div>
                </div>

            </div>

        </div>
    
    </div>


    @push('script')        
    

        {{-- SDK MercadoPago.js V2 --}}
        {{-- <script src="https://sdk.mercadopago.com/js/v2"></script>

        <script>
            
            const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                    locale: 'es-AR'
            });
            
            // Inicializa el checkout
            mp.checkout({
                preference: {
                    id: '{{ $preference->id }}'
                },
                render: {
                        container: '.cho-container',
                        label: 'Pagar', 
                },
            });
        </script> --}}

        {{-- SDK PAypal --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"></script>
        
        <script>
            paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: "{{ $order->totalConComision }}"
                    }
                }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {

                    Livewire.emit('payOrder');
                // This function shows a transaction success message to your buyer.
                /* alert('Transaction completed by ' + details.payer.name.given_name); */
                });
            }
            }).render('#paypal-button-container');
            //This function displays Smart Payment Buttons on your web page.
        </script>


    @endpush


</div>
