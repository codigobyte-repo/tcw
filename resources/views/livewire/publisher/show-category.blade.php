<div class="container py-12">
    
    {{-- FORMULARIO CREAR NUEVA SUBCATEGORIA --}}
    <x-jet-form-section submit="save" class="mb-6">
        {{-- Creamos formulario con jetstream, INFO:https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/27329962#questions --}}
        <x-slot name="title">
            Crear nueva Subcategoría para <b>{{ $category->name }}.</b>
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva Subcategoría.
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
                    Slug | Dirección de la Subcategoría
                </x-jet-label>

                <x-jet-input disabled wire:model="createForm.slug" type="text" class="w-full mt-1 bg-gray-100" />

                <x-jet-input-error for="createForm.slug" />
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

    {{-- LISTA DE SUBCATEGORIAS --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de Subcategorías
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las Subcategorías agregadas
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
                    @foreach($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                <span class="uppercase">
                                    {{ $subcategory->name}}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a wire:click="edit('{{ $subcategory->slug }}')" class="pr-2 text-blue-600 hover:text-blue-800 cursor-pointer"><i class="fas fa-edit"></i></a>
                                    {{-- Para enviar por parametro el slug que e suna cadena lo ponemos entre comillas simples '{{ $subcategory->slug }}' --}}
                                    <a wire:click="$emit('deleteSubcategory', '{{ $subcategory->slug }}')" class="pl-2 text-red-600 hover:text-red-800 cursor-pointer"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

    </x-jet-action-section>
    {{-- FIN LISTA DE SUBCATEGORIAS --}}

    {{-- MODAL DE EDICION DE SUBCATEGORIA --}}
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Subcategoría
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

                <div>
                    <x-jet-label>
                        Slug | Dirección de la categoría
                    </x-jet-label>

                    <x-jet-input disabled wire:model="editForm.slug" type="text" class="w-full mt-1 bg-gray-100" />

                    <x-jet-input-error for="editForm.slug" />
                </div>
            
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button-purple-btn wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-button-purple-btn>
        </x-slot>

    </x-jet-dialog-modal>
    {{-- FIN MODAL DE EDICION DE SUBCATEGORIA --}}


    {{-- SCRIPTS --}}
    @push('script')
            <script>
                Livewire.on('saved', post => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Subcategoría creada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            </script>

            <script>
                Livewire.on('deleteSubcategory', subcategorySlug => {
                    
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

                            Livewire.emitTo('publisher.show-category', 'delete', subcategorySlug);

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
