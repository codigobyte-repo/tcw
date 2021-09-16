<div>
    
    <div class="container py-8">
        <h1 class="text-3xl text-center font-semibold mb-8">¿Listo para comenzar a publicar?</h1>
        <h2 class="font-semibold text-center">Empecemos creando un perfil éxitoso</h2>

        <div class="bg-white shadow-xl rounded-lg p-6">

            
            {{-- Dedicas --}}
            <div class="mb-4">
                <x-jet-label value="¿Que habilidades profesionales tiene?" />
                
                <x-jet-input type="text"
                wire:model="title"
                class="w-full" placeholder="Ingrese sobre lo que va a publicar" />

                <x-jet-input-error for="title" />

            </div>

            {{-- Biografía --}}
            <div class="mb-4">

                <div wire:ignore>
                    <div class="flex items-center">
                        <x-jet-label value="Biografía" />
                        <p class="text-xs text-gray-500 pl-2">¡Tu primera impresión importa! Crea un perfil que se destaque entre la multitud</p>
                    </div>

                    {{-- Agregamos CKEDITOR --}}
                    {{-- INFO:https://www.youtube.com/watch?v=oL3otBeMfWI --}}
                    <textarea id="editorProfile" wire:model="biography"></textarea>
                </div>
                <x-jet-input-error for="biography" />        

            </div>

            
            <div class="grid grid-cols-2 mb-4 gap-6">
                
                <div>
                    <x-jet-label value="¿De que país eres?" />

                    <select wire:model="pais" class="w-full rounded-md hover:border-1 hover:border-purple-400">
                        <option selected disabled value="">Seleccione un país</option>

                        @foreach ($paises as $pais)
                            <option value="{{ $pais->nombre }}">{{ $pais->nombre }}</option>
                        @endforeach
                    </select>

                    <x-jet-input-error for="pais" />
                </div>

                <div>
                    <x-jet-label value="¿Tiene Website?" />
                    <x-jet-input
                    type="text"
                    wire:model="website"
                    class="w-full"
                    placeholder="Ingrese su dirección web" />

                    <x-jet-input-error for="website" />
                </div>

            </div>

            <div class="grid grid-cols-2 mb-4 gap-6">
                
                <div>
                    <x-jet-label value="¿Tiene cuenta de Facebook?" />
                    <x-jet-input
                    type="text"
                    wire:model="facebook"
                    class="w-full"
                    placeholder="Ingrese su dirección de Facebook" />

                    <x-jet-input-error for="facebook" />
                </div>

                <div>
                    <x-jet-label value="¿Tiene cuenta de Instagram?" />
                    <x-jet-input
                    type="text"
                    wire:model="instagram"
                    class="w-full"
                    placeholder="Ingrese su dirección de Instagram" />

                    <x-jet-input-error for="instagram" />
                </div>

            </div>

            <div class="grid grid-cols-2 mb-4 gap-6">
                
                <div>
                    <x-jet-label value="¿Tiene cuenta de Twitter?" />
                    <x-jet-input
                    type="text"
                    wire:model="twitter"
                    class="w-full"
                    placeholder="Ingrese su dirección de Twitter" />

                    <x-jet-input-error for="twitter" />
                </div>

                <div>
                    <x-jet-label value="¿Tiene canal de Youtube?" />
                    <x-jet-input
                    type="text"
                    wire:model="youtube"
                    class="w-full"
                    placeholder="Ingrese su dirección de Youtube" />

                    <x-jet-input-error for="youtube" />
                </div>

            </div>

            <div class="grid grid-cols-2 mb-4 gap-6">
                
                <div>
                    <x-jet-label value="¿Tiene cuenta de Linkedin?" />
                    <x-jet-input
                    type="text"
                    wire:model="linkedin"
                    class="w-full"
                    placeholder="Ingrese su dirección de Linkedin" />

                    <x-jet-input-error for="linkedin" />
                </div>

            </div>

            <div class="flex mt-4">
                <x-button-purple-btn
                    wire:loading.attr="disabled"
                    wire:target="save"
                    wire:click="save"
                    class="ml-auto">
                    Crear perfil
                </x-button-purple-btn>
            </div>
        
        </div>
        
    </div>

    @push('js')

        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

        {{-- CKEDITOR --}}
        <script>
        ClassicEditor
            .create( document.querySelector( '#editorProfile' ), {
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
                    @this.set('biography', editor.getData());
                })
            })
            .catch( error => {
                console.log( error );
            } );
        </script>
        
    @endpush

</div>
