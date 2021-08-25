<div class="container py-12">
    
    {{-- FORMULARIO CREAR NUEVA MARCA --}}
    <x-jet-form-section submit="save" class="mb-6">
        {{-- Creamos formulario con jetstream, INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27329962#questions --}}
        <x-slot name="title">
            Crear nueva marca
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva marca.
        </x-slot>

        <x-slot name="form">            
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name"/>
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
    {{-- FIN FORMULARIO CREAR NUEVA MARCA --}}

    
    {{-- LISTA DE MARCAS --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de marcas
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las marcas agregadas
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
                    @foreach($brands as $brand)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!! $brand->icon !!}
                                </span>

                                <span class="uppercase">
                                    <a class="text-blue-600 hover:text-blue-800" href="{{ route('publisher.categories.show', $brand) }}">{{ $brand->name}}</a>
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a wire:click="edit({{ $brand->id }})" class="pr-2 text-blue-600 hover:text-blue-800 cursor-pointer"><i class="fas fa-edit"></i></a>
                                    <a wire:click="$emit('deleteBrand', {{ $brand->id }})" class="pl-2 text-red-600 hover:text-red-800 cursor-pointer"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

    </x-jet-action-section>
    {{-- FIN LISTA DE MARCAS --}}

    {{-- MODAL DE EDICION DE MARCA --}}
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar marca
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.name"/>
                </div>
            
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button-purple-btn wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-button-purple-btn>
        </x-slot>

    </x-jet-dialog-modal>
    {{-- FIN MODAL DE EDICION DE MARCA --}}

    {{-- SCRIPTS --}}
    @push('script')
            <script>
                Livewire.on('saved', post => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Marca creada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            </script>

            <script>
                Livewire.on('deleteBrand', brandId => {
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

                            Livewire.emitTo('publisher.brand-component', 'delete', brandId);

                            Swal.fire(
                            'Eliminado!',
                            'Marca eliminada correctamente.',
                            'success'
                            )
                        }
                    })
                });
            </script>
    @endpush
    {{-- FIN SCRIPTS --}}

</div>
