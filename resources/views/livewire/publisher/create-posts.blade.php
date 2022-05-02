<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if(auth()->user()->information)
    
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

            {{-- Marca --}}
            {{-- x-cloak se utiliza para que no de PARPADEO el modal cuando se carga la pantalla --}}
            <style>
                [x-cloak] {
                    display: none;
                }
            </style>

            <div class="box-content h-auto w-auto p-4 border-4">
                <div class="mb-4">
                    <h1 class="text-2xl font-bold mt-8 mb-2 text-center">Permitir vendedores</h1>


                    <div class="flex items-center justify-center" x-data="{ open: false }" x-cloak>
                        <div class="px-4 py-2 bg-gray-400 hover:bg-gray-700 text-white text-xl font-serif rounded-full border-none focus:outline-none cursor-pointer"
                          @click="open = true">¡Más información!</div>
                        <div class="fixed z-1 w-full h-full top-0 left-0 flex items-center justify-center" x-cloak x-show="open">
                          <div class="fixed w-full h-full bg-gray-500 opacity-50"></div>
                          <div class="relative z-2 w-3/12 bg-white p-8 mx-auto rounded-xl flex flex-col items-center" @click.away="open = false">
                            <p class="text-xl font-serif pb-4">
                                Los vendedores son personas interesadas en vender para usted el servicio que va a publicar. <br>
                                Al aceptar la opción, los vendedores acceden a ver su producto y venderlos por sus propios medios.
                                <br>
                                Usted debe saber en primer lugar que al aceptar: <strong> el 10% del valor de su servicio será para el vendedor </strong>.
                                <strong>Le recordamos que nuestro servicio también tiene un costo del 8%.</strong>
                                <br>
                                ¡Ofrecer esta opción hará que incremente sus ventas! 
                            </p>
                            <button class="px-4 py-2 bg-red-400 hover:bg-red-700 text-white text-xl font-serif rounded-full border-none focus:outline-none"
                              @click="open = false">¡Cerrar info!</button>
                          </div>
                        </div>
                    </div>


                    <p class="text-xs text-gray-500 pl-2 mt-4">Si selecciona SI está aceptando que otras personas vendan su producto y ganen una comisión por cada venta</p>
                    <select class="w-full rounded-lg border-1 border-gray-300" wire:model="seller">
                        <option value="">Seleccione una opción</option>
                        <option value="0">NO</option>
                        <option value="1">SI</option>
                    </select>

                    <x-jet-input-error for="seller" />

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

    @else

        @livewire('publisher.intro')

    @endif

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
