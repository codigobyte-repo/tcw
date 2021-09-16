<div>

    <header class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-purple-600 leading-tight">
                    {{$post->name}}
                </h1>

                <x-jet-danger-button wire:click="$emit('deletePost')">
                    Eliminar publicación
                </x-jet-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <h1 class="text-3xl text-center font-semibold mb-8 text-purple-600">Bienvenido, vamos a verificar la publicación.</h1>

        {{-- REVISION --}}
        @livewire('admin.status-post', ['post' => $post], key($post->id))


        <h1 class="text-2xl text-center font-semibold mt-6 mb-2">Imágenes de la publicación</h1>

        <div class="mb-4" wire:ignore>
            {{-- DROPZONE --}}
            <form action="{{route('publisher.posts.files', $post)}}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
        </div>

        @if ($post->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                

                <ul class="flex flex-wrap">
                @foreach($post->images as $image)
                    <li class="relative" wire:key="image-{{ $image->id }}">
                        <img class="w-32 h-20 object-cover mx-1" src="{{ Storage::url($image->url) }}" alt="Imagen del servicio"> 
                        <x-jet-danger-button class="absolute right-2 top-2"
                        wire:click="deleteImage({{$image->id}})"
                        wire:loading.attr="disabled"
                        wire:target="deleteImage({{$image->id}})">
                            x
                        </x-jet-danger-button>
                    </li>
                @endforeach 
                </ul>
            </section>
        @endif


        <div class="bg-white shadow-xl rounded-lg p-6">

            <div class="grid grid-cols-2 gap-6 mb-4">

                {{-- CATEGORIA --}}
                <div>
                    
                    <x-jet-label value="Categorías" />
                    <select class="w-full rounded-md hover:border-1 hover:border-purple-400" wire:model="category_id">
                        <option selected disabled value="">Seleccione una categoría</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="category_id" />

                </div>

                {{-- SUBCATEGORIA --}}
                <div>

                    <x-jet-label value="Subcategorías" />
                    <select class="w-full rounded-md hover:border-1 hover:border-purple-400" wire:model="post.subcategory_id">
                        <option selected disabled value="">Seleccione una Subcategoría</option>

                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="post.subcategory_id" />

                </div>

            </div>

            {{-- Nombre del servicio --}}
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                
                <x-jet-input type="text"
                wire:model="post.name"
                class="w-full" placeholder="Ingrese el nombre del servicio" />

                <x-jet-input-error for="post.name" />

            </div>

            {{-- SLig del servicio --}}
            <div class="mb-4">
                
                <div class="flex items-center">
                    <x-jet-label value="Slug | Url" />
                    <p class="text-xs text-gray-500 pl-2">(Dirección de la publicación)</p>
                </div>

                <x-jet-input type="text" 
                wire:model="post.slug"
                disabled
                class="w-full bg-gray-200" placeholder="Slug del servicio" />

                <x-jet-input-error for="post.slug" />

            </div>

            {{-- Descripción --}}
            <div class="mb-4">

                <div wire:ignore>
                    <div class="flex items-center">
                        <x-jet-label value="Descripción" />
                        <p class="text-xs text-gray-500 pl-2">(No incluir datos de contactos)</p>
                    </div>

                    {{-- Agregamos CKEDITOR CON ALPINE --}}
                    {{-- INFO: https://www.udemy.com/course/crea-un-ecommerce-con-laravel-livewire-tailwind-y-alpine/learn/lecture/26944668?start=15#notes --}}
                    <textarea class="w-full rounded-lg border-1 border-gray-300" cols="30" rows="10"
                        wire:model="post.description"
                        x-data 
                        x-init="
                        ClassicEditor.create( $refs.miEditor )
                        .then(function(editor){
                            editor.model.document.on('change:data', () =>{
                                @this.set('post.description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                        " x-ref="miEditor">
                    </textarea>
                </div>
                <x-jet-input-error for="post.description" />        

            </div>

            {{-- Marca --}}
            <div class="mb-4">
                <x-jet-label value="Marca" />
                
                <select class="w-full rounded-lg border-1 border-gray-300" wire:model="post.brand_id">
                    <option value="" selected disabled>Seleccione una marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach

                </select>

                <x-jet-input-error for="post.brand_id" />

            </div>

            {{-- Tiempo y Precio --}}
            <div class="grid grid-cols-2 mb-4 gap-6">

                {{-- Tiempo --}}
                <div>
                    <x-jet-label value="Tiempo de entrega" />
                    <x-jet-input 
                    type="number"
                    min="1"
                    wire:model="post.tiempo_entrega"
                    class="w-full" placeholder="Ingrese el tiempo de entrega" />

                    <x-jet-input-error for="post.tiempo_entrega" />
                </div>

                {{-- Precio --}}
                <div>
                    <x-jet-label value="Precio del servicio" />
                    <x-jet-input 
                    type="number"
                    min="1"
                    wire:model="post.price"
                    class="w-full"
                    step=".01"
                    placeholder="Ingrese el precio del servicio" />

                    <x-jet-input-error for="post.price" />
                </div>

            </div>

            <div class="flex justify-end items-center mt-4">

                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado correctamente
                </x-jet-action-message>

                <x-button-purple-btn
                    wire:loading.attr="disabled"
                    wire:target="save"
                    wire:click="save">
                    Actualizar servicio
                </x-button-purple-btn>
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

            <script>
                Livewire.on('deletePost', () => {
                    
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

                            Livewire.emitTo('publisher.edit-post', 'delete');

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

        @push('js')
            <script>
                Dropzone.options.myAwesomeDropzone = {
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    dictDefaultMessage:"<b>Agregar imágenes:</b> Arrastre una imagen o haga clic aquí",
                    acceptedFiles: 'image/*',
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    complete: function(file){
                        this.removeFile(file);
                    },
                    queuecomplete: function(){
                        Livewire.emit('refreshPost');
                    }
                };
            </script>
        @endpush

    </div>

</div>