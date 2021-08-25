<div class="cursor-default">

    {{-- FORMULARIO CREAR NUEVA CATEGORIA --}}
    <x-jet-form-section submit="save" class="mb-6">
        {{-- Creamos formulario con jetstream, INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27329962#questions --}}
        <x-slot name="title">
            Crear nueva categoría
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva categoría.
        </x-slot>

        <x-slot name="form">            
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Slug | Dirección de la categoría
                </x-jet-label>

                <x-jet-input disabled wire:model="createForm.slug" type="text" class="w-full mt-1 bg-gray-100" />

                <x-jet-input-error for="createForm.slug" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Ícono - Seleccionar ícono de : <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank" rel="noopener noreferrer"><b class="text-blue-500">ÍCONOS</b></a>
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.icon" placeholder="ejemplo: <i class='fab fa-adn'></i>" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.icon" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Marca
                </x-jet-label>

                <div class="grid grid-cols-4">
                    @foreach($brands as $brand)
                    
                        <x-jet-label>
                            <x-jet-checkbox 
                            wire:model.defer="createForm.brands" 
                            name="brands[]" 
                            value="{{ $brand->id }}" />
                            {{$brand->name}}
                        </x-jet-label>

                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen
                </x-jet-label>

                <x-jet-input wire:model="createForm.image" accept="image/*" type="file" class="w-full mt-1" name="" id="{{ $rand }}" />

                <x-jet-input-error for="createForm.image" />
            </div>

        </x-slot>

        <x-slot name="actions">
            
            <x-jet-action-message class="mr-3" on="saved">
                Actualizado correctamente
            </x-jet-action-message>

            <x-button-purple-btn>
                Agregar
            </x-button-purple-btn>

        </x-slot>
    </x-jet-form-section>
    {{-- FIN FORMULARIO CREAR NUEVA CATEGORIA --}}

    
    {{-- LISTA DE CATEGORIAS --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de categorías
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las categorías agregadas
        </x-slot>

        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!! $category->icon !!}
                                </span>

                                <span class="uppercase">
                                    <a class="text-blue-600 hover:text-blue-800" href="{{ route('publisher.categories.show', $category) }}">{{ $category->name}}</a>
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a wire:click="edit('{{ $category->slug }}')" class="pr-2 text-blue-600 hover:text-blue-800 cursor-pointer"><i class="fas fa-edit"></i></a>
                                    {{-- Para enviar por parametro el slug que e suna cadena lo ponemos entre comillas simples '{{ $category->slug }}' --}}
                                    <a wire:click="$emit('deleteCategory', '{{ $category->slug }}')" class="pl-2 text-red-600 hover:text-red-800 cursor-pointer"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

    </x-jet-action-section>
    {{-- FIN LISTA DE CATEGORIAS --}}

    {{-- MODAL DE EDICION DE CATEGORIA --}}
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar categoría
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="Categoría">
                    @else
                        <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}" alt="Categoría">
                    @endif
                </div>

                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.name"/>
                </div>

                <div>
                    <x-jet-label>
                        Slug | Dirección de la categoría
                    </x-jet-label>

                    <x-jet-input disabled wire:model="editForm.slug" type="text" class="w-full mt-1 bg-gray-100" />

                    <x-jet-input-error for="editForm.slug" />
                </div>

                <div>
                    <x-jet-label>
                        Ícono - Seleccionar ícono de : <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank" rel="noopener noreferrer"><b class="text-blue-500">ÍCONOS</b></a>
                    </x-jet-label>

                    <x-jet-input wire:model.defer="editForm.icon" placeholder="ejemplo: <i class='fab fa-adn'></i>" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="editForm.icon" />
                </div>

                <div>
                    <x-jet-label>
                        Marca
                    </x-jet-label>

                    <div class="grid grid-cols-4">
                        @foreach($brands as $brand)
                        
                            <x-jet-label>
                                <x-jet-checkbox 
                                wire:model.defer="editForm.brands" 
                                name="brands[]" 
                                value="{{ $brand->id }}" />
                                {{$brand->name}}
                            </x-jet-label>

                        @endforeach
                    </div>
                    <x-jet-input-error for="editForm.brands" />
                </div>

                <div>
                    <x-jet-label>
                        Imagen
                    </x-jet-label>

                    <x-jet-input wire:model="editImage" accept="image/*" type="file" class="w-full mt-1" name="" id="{{ $rand }}" />

                    <x-jet-input-error for="editImage" />
                </div>
            
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button-purple-btn wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
            </x-button-purple-btn>
        </x-slot>

    </x-jet-dialog-modal>
    {{-- FIN MODAL DE EDICION DE CATEGORIA --}}

    {{-- SCRIPTS --}}
    @push('script')
            <script>
                Livewire.on('saved', post => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Categoría creada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            </script>

            <script>
                Livewire.on('deleteCategory', categorySlug => {
                    
                    Swal.fire({
                    title: '¿Estás seguro?',
                    text: "La eliminación es irreversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            Livewire.emitTo('publisher.create-category', 'delete', categorySlug);

                            Swal.fire(
                            'Eliminado!',
                            'Publicación eliminada correctamente.',
                            'success'
                            )
                        }
                    })
                });
            </script>
    @endpush
    {{-- FIN SCRIPTS --}}
    
</div>
