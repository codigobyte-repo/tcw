<div>
    
    <button class="text-center font-bold text-green-600 mr-6" wire:click="$set('formAprobar', true)">Aprobar <i class="ml-2 fas fa-check-circle"></i></button>
    <button class="text-center font-bold text-red-600" wire:click="$set('formRechazar', true)">Rechazar <i class="ml-2 fas fa-times"></i></button>
    

    @if($formAprobar)
        <div class="my-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
            
                <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                
                <div class="flex justify-between">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Aprobar publicación</h3>
                    <i  wire:click="$set('formAprobar', false)" class="text-red-600 far fa-times-circle"></i>
                </div>

                <p class="mt-1 text-sm text-gray-600">
                    ¡Muchas gracias por validar la compra!
                </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-1">
                        
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">¿Que le pareció el servicio?</label>
                            <textarea wire:model="commentAprobar" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="" id="" cols="30" rows="10"></textarea>
                        </div>
                        <x-jet-input-error for="commentAprobar" />

                        
                        <div class="flex items-center">
    
                            <ul class="flex items-center">
                                <li class="mr-1 cursor-pointer" wire:click="$set('rating', 1)">
                                    <i class="fas fa-star text-{{ $rating >= 1 ? 'yellow' : 'gray'}}-300"></i>
                                </li>
                                <li class="mr-1 cursor-pointer" wire:click="$set('rating',2 )">
                                    <i class="fas fa-star text-{{ $rating >= 2 ? 'yellow' : 'gray'}}-300"></i>
                                </li>
                                <li class="mr-1 cursor-pointer" wire:click="$set('rating', 3)">
                                    <i class="fas fa-star text-{{ $rating >= 3 ? 'yellow' : 'gray'}}-300"></i>
                                </li>
                                <li class="mr-1 cursor-pointer" wire:click="$set('rating', 4)">
                                    <i class="fas fa-star text-{{ $rating >= 4 ? 'yellow' : 'gray'}}-300"></i>
                                </li>
                                <li class="mr-1 cursor-pointer" wire:click="$set('rating', 5)">
                                    <i class="fas fa-star text-{{ $rating == 5 ? 'yellow' : 'gray'}}-300"></i>
                                </li>
                            </ul>
                        </div>

        
                       
                        <button wire:click="aprobarPublicacion" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 mt-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Aprobar publicación
                        </button>

                    </div>
                </div>
                
            </div>
            </div>
        </div>
    @endif

    @if($formRechazar)
        <div class="my-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
            
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                    
                        <div class="flex justify-between">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Rechazar publicación</h3>
                            <i  wire:click="$set('formRechazar', false)" class="text-red-600 far fa-times-circle"></i>
                        </div>

                        <p class="mt-1 text-sm text-gray-600">
                            ¿Que problema tuvo? al rechazar la publicación, el vendedor está perdiendo puntos y pasará a ser sancionado.
                        </p>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-1">
                            
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first_name" class="block text-base font-medium text-gray-700">¡Su dinero está resguardado!</label>
                                <p class="text-sm text-gray-500 mb-4">Antes de llevar a cabo la devolución de su dinero necesitamos saber que pasó. Muchas gracias.</p>
                                <p class="text-base font-medium text-gray-900">Contanos que problema tuviste</p>
                                <textarea wire:model="commentRechazar" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="" id="" cols="30" rows="5"></textarea>
                            </div>
                            <x-jet-input-error for="commentRechazar" />

                            <div class="col-span-6 sm:col-span-3 mt-4">
                                
                                <fieldset>
                                    <div>
                                      <legend class="text-base font-medium text-gray-900">Detallanos un poco más</legend>
                                    </div>
                                    <div class="mt-4 space-y-4">

                                      <div class="flex items-center">
                                        <input wire:model="recibioProyecto" id="push-everything" name="push-notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                                          ¿Recibió el proyecto?
                                        </label>
                                      </div>

                                      <div class="flex items-center">
                                        <input wire:model="maltrato" id="push-email" name="push-notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                                          ¿Recibió un maltrato o discriminación?
                                        </label>
                                      </div>

                                      <div class="flex items-center">
                                        <input wire:model="fueraDeTiempo" id="push-nothing" name="push-notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                          ¿Los tiempos estuvieron fuera de término?
                                        </label>
                                      </div>

                                      <div class="flex items-center">
                                        <input wire:model="conciliacion" id="push-nothing" name="push-notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                          ¿Aceptarías una conciliación?
                                        </label>
                                      </div>

                                      <div class="flex items-center">
                                        <input wire:model="cancelarProyecto" id="push-nothing" name="push-notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                                          Quiero cancelar el proyecto 
                                        </label>
                                      </div>

                                    </div>
                                  </fieldset>

                            </div>
            
                        
                            <button wire:click="rechazarPublicacion" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 mt-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Rechazar publicación
                            </button>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif

</div>
