<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-purple-600">
    
    <h1 class="text-3xl text-center font-semibold mb-8">Bienvenido, vamos a crear una publicación.</h1>

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
                <select class="w-full rounded-md hover:border-1 hover:border-purple-400" wire:model="subcategory_id">
                    <option selected disabled value="">Seleccione una Subcategoría</option>

                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="subcategory_id" />

            </div>

        </div>

        {{-- Nombre del servicio --}}
        <div class="mb-4">
            <x-jet-label value="Nombre" />
            
            <x-jet-input type="text"
            wire:model="name"
            class="w-full" placeholder="Ingrese el nombre del servicio" />

            <x-jet-input-error for="name" />

        </div>

        {{-- SLig del servicio --}}
        <div class="mb-4">
            
            <div class="flex items-center">
                <x-jet-label value="Slug | Url" />
                <p class="text-xs text-gray-500 pl-2">(Dirección de la publicación)</p>
            </div>

            <x-jet-input type="text" 
            wire:model="slug"
            disabled
            class="w-full bg-gray-200" placeholder="Slug del servicio" />

            <x-jet-input-error for="slug" />

        </div>

        {{-- Descripción --}}
        <div class="mb-4">

            <div wire:ignore>
                <div class="flex items-center">
                    <x-jet-label value="Descripción" />
                    <p class="text-xs text-gray-500 pl-2">(No incluir datos de contactos)</p>
                </div>

                {{-- Agregamos CKEDITOR --}}
                {{-- INFO:https://www.youtube.com/watch?v=oL3otBeMfWI --}}
                <textarea id="editor" wire:model="description"></textarea>
            </div>
            <x-jet-input-error for="description" />        

        </div>

        {{-- Marca --}}
        <div class="mb-4">
            <x-jet-label value="Marca" />
            
            <select class="w-full rounded-lg border-1 border-gray-300" wire:model="brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach

            </select>

            <x-jet-input-error for="brand_id" />

        </div>

        {{-- Tiempo y Precio --}}
        <div class="grid grid-cols-2 mb-4 gap-6">

            {{-- Tiempo --}}
            <div>
                <x-jet-label value="Tiempo de entrega" />
                <x-jet-input 
                type="number"
                min="1"
                wire:model="tiempo_entrega"
                class="w-full" placeholder="Ingrese el tiempo de entrega" />

                <x-jet-input-error for="tiempo_entrega" />
            </div>

            {{-- Precio --}}
            <div>
                <x-jet-label value="Precio del servicio" />
                <x-jet-input 
                type="number"
                min="1"
                wire:model="price"
                class="w-full"
                step=".01"
                placeholder="Ingrese el precio del servicio" />

                <x-jet-input-error for="price" />
            </div>

        </div>

        <h1 class="text-2xl font-bold mt-8 mb-2">Imagen de la publicación</h1>
        
        <div class="grid grid-cols-2 gap-4">
            
            <figure>
                @if ($photo)
                    <img class="w-full h-64 object-cover object-center" src="{{ $photo->temporaryUrl() }}">
                    <p class="text-sm">Previsualización</p>
                @else
                    <img class="w-full h-64 object-cover object-center" src="{{asset('img/fondo/fondoPost.webp')}}" alt="Imagen por defecto">
                    <p class="text-sm">Imagen por defecto</p>
                @endif
            </figure>
            
            <div>
                <input type="file" accept="image/*" 
                wire:model="photo"
                wire:loading.attr="disabled"
                >
                <x-jet-input-error for="photo" />
                
                <div wire:loading wire:target="photo">
                    <p class="text-gray-600 text-xs">Cargando imagen ...</p>
                </div>

                <p class="mt-2">Seleccione una imagen de portada de su publicación, si lo desea en editar publicación puede agregar más imágenes</p>
            </div>

        </div>

        <div class="flex mt-4">
            <x-button-purple-btn
                wire:loading.attr="disabled"
                wire:target="save"
                wire:click="save"
                class="ml-auto">
                Solicitar revisión
            </x-button-purple-btn>
        </div>
    
    </div>

    @push('js')

        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

        {{-- CKEDITOR --}}
        <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            } )
            .then(function(editor){
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                })
            })
            .catch( error => {
                console.log( error );
            } );
        </script>
        
    @endpush

</div>
