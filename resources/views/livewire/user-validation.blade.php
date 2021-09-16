<div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
        <h1 class="text-3xl text-center font-semibold mb-8">¡Felicidades! ¡Estamos en el ultimo paso!</h1>
        <img class="mx-auto w-32 h-32 mb-10" src="{{ asset('img/icons/clap.svg') }}" alt="Felicitaciones">

        <div>
         <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">Datos personales</h3>
              <p class="mt-1 text-sm text-gray-600">
                Su información es muy valiosa para nosotros y nos comprometemos a mantener de forma segura sus datos.
              </p>
            </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
            
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                  
                    <div class="grid grid-cols-1 md:grid-cols-2 mb-4 gap-6">    
                
                        <div class="mb-4">
                            <x-jet-label value="Nombre" />
                            
                            <x-jet-input type="text"
                            wire:model="nombre"
                            class="w-full" placeholder="Ingrese su nombre completo" />
            
                            <x-jet-input-error for="nombre" />
            
                        </div>
    
                        <div class="mb-4">
                            <x-jet-label value="Apellido" />
                            
                            <x-jet-input type="text"
                            wire:model="apellido"
                            class="w-full" placeholder="Ingrese su apellido" />
            
                            <x-jet-input-error for="apellido" />
            
                        </div>
    
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 mb-4 gap-6">    
                
                        {{-- Nombre del servicio --}}
                        <div class="mb-4">
                            <x-jet-label value="Celular" />
                            
                            <x-jet-input type="number"
                            wire:model="celular"
                            class="w-full" placeholder="Ingrese su celular" />
            
                            <x-jet-input-error for="celular" />
            
                        </div>
    
                        <div class="mb-4">
                            <x-jet-label value="Teléfono" />
                            
                            <x-jet-input type="number"
                            wire:model="telefono"
                            class="w-full" placeholder="Ingrese su teléfono" />
            
                            <x-jet-input-error for="telefono" />
            
                        </div>
    
                    </div>
                </div>
              </div>
            
          </div>
         </div>
        </div>
      
        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
            <div class="border-t border-gray-200"></div>
            </div>
        </div>
      
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Validador de identidad</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Para mantener la comunidad segura requerimos verificar a los publicadores.
                    </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        
                                <figure>
                                    @if ($fotoFrente)
                                        <img class="w-full h-64 object-cover object-center" src="{{ $fotoFrente->temporaryUrl() }}">
                                        <p class="text-sm">Previsualización</p>
                                    @else
                                        <img class="w-full" src="{{asset('img/fondo/documento/Documento-frente.png')}}" alt="Imagen por defecto">
                                    @endif
                                    <p class="mt-2 font-semibold text-gray-600 text-center">Foto frontal de su documento de identidad.</p>
                                    
                                </figure>
                                
                                <div>
                                    <input class="w-full" type="file" accept="image/*" 
                                    wire:model="fotoFrente"
                                    wire:loading.attr="disabled"
                                    >
                                    <x-jet-input-error for="fotoFrente" />
                                    
                                    <div wire:loading wire:target="fotoFrente">
                                        <p class="text-gray-600 text-xs">Cargando imagen ...</p>
                                    </div>
                
                                    <p class="mt-2">Foto del frente de su documento de identidad. Por favor verifique que sea una foto clara y que se lea todo de forma nítida.</p>
                                </div>
                
                            </div>
            
                            <hr class="my-6">
            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-10">
                                
                                <figure>                        
                                    @if ($fotoDorso)
                                        <img class="w-full h-64 object-cover object-center" src="{{ $fotoDorso->temporaryUrl() }}">
                                        <p class="text-sm">Previsualización</p>
                                    @else
                                        <img class="w-full" src="{{asset('img/fondo/documento/Documento-dorso.png')}}" alt="Imagen por defecto">
                                    @endif
                                    <p class="mt-2 font-semibold text-gray-600 text-center">Foto del dorso de su documento de identidad.</p>
                                </figure>
                                
                                <div>
                                    <input class="w-full" type="file" accept="image/*" 
                                    wire:model="fotoDorso"
                                    wire:loading.attr="disabled"
                                    >
                                    <x-jet-input-error for="fotoDorso" />
                                    
                                    <div wire:loading wire:target="fotoDorso">
                                        <p class="text-gray-600 text-xs">Cargando imagen ...</p>
                                    </div>
                
                                    <p class="mt-2">Foto del frente de su documento de identidad. Por favor verifique que sea una foto clara y que se lea todo de forma nítida.</p>
                                    
                                </div>
                
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
      
        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
            <div class="border-t border-gray-200"></div>
            </div>
        </div>
      
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Métodos de cobro</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Selecciona como te gustaría recibir los cobros por venta.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        
                        <div class="grid grid-cols-1 mb-4 gap-6">    
                            <p class="font-bold">Transferencia Paypal</p>
                            <div class="mb-4">
                                <x-jet-label value="Correo electrónico Paypal" />
                                
                                <x-jet-input type="text"
                                wire:model="cobroPaypal"
                                class="w-full" placeholder="Ingrese su correo electrónico de cobro Paypal" />
                
                                <x-jet-input-error for="cobroPaypal" />
                
                            </div>
        
                        </div>

                        <div class="grid grid-cols-1 mb-4 gap-6">    
                            <p class="font-bold">Mercado Pago <b class="text-red-600">(Sólo Argentina)</b></p>
                            <div class="mb-4">
                                <x-jet-label value="Celular Mercado Pago" />
                                
                                <x-jet-input type="text"
                                wire:model="cobroMercadoPago"
                                class="w-full" placeholder="Ingrese su celular de cobro Mercado Pago" />
                
                                <x-jet-input-error for="cobroMercadoPago" />
                
                            </div>
        
                        </div>

                        <fieldset>
                            <div class="grid grid-cols-1 mb-4 gap-6">    
                                <p class="font-bold">Transferencia bancaria <b class="text-red-600">(Sólo Argentina)</b></p>
                                <div class="mb-4">
                                    <x-jet-label value="TITULAR DE LA CUENTA" />
                                    
                                    <x-jet-input type="text"
                                    wire:model="nombreTitular"
                                    class="w-full" placeholder="Titular de la cuenta" />
                    
                                    <x-jet-input-error for="nombreTitular" />
                    
                                </div>

                                <div class="mb-4">
                                    <x-jet-label value="Nº CBU/CVU" />
                                    
                                    <x-jet-input type="text"
                                    wire:model="cbu"
                                    class="w-full" placeholder="Ingresar Nº CBU/CVU" />
                    
                                    <x-jet-input-error for="cbu" />
                    
                                </div>

                                <div class="mb-4">
                                    <x-jet-label value="Nº DE CUENTA" />
                                    
                                    <x-jet-input type="text"
                                    wire:model="cuenta"
                                    class="w-full" placeholder="Ingresar Nº de cuenta" />
                    
                                    <x-jet-input-error for="cuenta" />
                    
                                </div>
            
                            </div>

                        
                            <div>
                            <legend class="text-base font-medium text-gray-900">Tipo de cuenta</legend>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                    <input wire:model="caja" value="1" checked id="push-everything" name="push-notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                                        Caja de ahorro
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="caja" value="2" id="push-email" name="push-notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                                        Cuenta corriente
                                    </label>
                                </div>
                                <x-jet-input-error for="caja" />
                            </div>
                        </fieldset>
                    </div>
                </div>
                
            </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
            <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Aceptar terminos y condiciones</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Para operar en nuestra comunidad es necesario que acepte los términos y condiciones.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <fieldset>
                            <div>
                            <legend class="text-base font-medium text-gray-900">Términos, Condiciones y Notificaciones</legend>
                            <p class="text-sm text-gray-500">Por una comunidad clara y transparente</p>
                            </div>
                            <div class="mt-4 space-y-4">
                            <div class="flex items-center">
                                <input wire:model="aceptoTerminos" checked id="push-everything" name="push-notifications" type="checkbox" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                                    <a class="text-blue-600" href="{{ route('publisher.terminos') }}" target="to_blank">Acepto los Términos y Condiciones</a>
                                    @if($aceptoTerminos != true)
                                        <p class="text-red-600 font-bold text-xs">Aceptar los términos es obligatorio.</p>
                                    @endif
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="notificacionesCorreo" checked id="push-email" name="push-notifications" type="checkbox" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                                Acepto notificaciones por correo electrónico
                                @if($notificacionesCorreo != true)
                                        <p class="text-red-600 font-bold text-xs">Aceptar las notificaciones por correo es obligatorio.</p>
                                    @endif
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input wire:model="notificacionesWhatsapp" checked id="push-nothing" name="push-notifications" type="checkbox" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                Acepto notificaciones por SMS y/o Whatsapp
                                </label>
                            </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        <div class="flex mt-4">
            @if($aceptoTerminos != true || $notificacionesCorreo != true)
            
                <x-button-purple-btn
                    class="ml-auto opacity-50 cursor-not-allowed">
                    Solicitar revisión
                </x-button-purple-btn>

            @else

                <x-button-purple-btn
                    wire:loading.attr="disabled"
                    wire:target="save"
                    wire:click="save"
                    class="ml-auto">
                    Solicitar revisión
                </x-button-purple-btn>

            @endif

        </div>



    </div>

</div>
