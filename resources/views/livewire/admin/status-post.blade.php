<div class="bg-white shadow-xl rounded-lg p-6 my-4">
    <h1 class="text-2xl text-center font-semibold mb-6">Estado de la publicación</h1>
        
    <div class="flex">
        <label class="mr-4">
            <input wire:model.defer="status" type="radio" name="status" value="1">
            Marcar servicio como borrador
        </label>

        <label>
            <input wire:model.defer="status" type="radio" name="status" value="2">
            Marcar servicio como publicado
        </label>
    </div>

    <div class="flex justify-end items-center">
        
        <x-jet-action-message class="mr-3" on="saved">
            Actualizado correctamente
        </x-jet-action-message>

        <x-button-purple-btn
        wire:loading.attr="disabled"
                wire:target="save"
                wire:click="save"
        >
            Actualizar
        </x-button-purple-btn>

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
            })
        </script>
    @endpush
    
</div>
