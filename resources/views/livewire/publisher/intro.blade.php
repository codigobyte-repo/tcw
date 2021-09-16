<div>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-2 {{ $currentStep != 1 ? 'hidden' : '' }}">

        <div>
            <img class="w-auto h-full object-cover object-center rounded" src="{{ asset('img/fondo/intro/paso-1.webp') }}" alt="Intro">
        </div>

        <div>
            <h1 class="text-3xl text-center text-gray-600 font-semibold mb-2">Tu perfil es muy importante</h1>
            <h2 class="text-xl font-semibold text-gray-600 text-center mb-10">Pasos para crear un perfil exitoso</h2>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2">
                
                <!--Card 1-->
                <div class="rounded overflow-hidden shadow-lg">
                  <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/pencil.svg') }}" alt="Icon">
                  <div class="px-6 py-2">
                    <p class="text-gray-700 text-base">
                      Dedique tiempo a completar su perfil para que sea como lo desea.
                    </p>
                  </div>
                </div>

                <!--Card 2-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/link.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        Sume credibilidad agregando sus medios sociales.
                      </p>
                    </div>
                </div>
            
                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/notes.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        Describa de forma precisa sus habilidades, experiencia, trayectoria en el servicio que va a publicitar.
                      </p>
                    </div>
                </div>
        
                <!--Card 4-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/proteger.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        Para mantener seguro el sitio le pediremos que verique su identidad.
                      </p>
                    </div>
                </div>
        
            </div>

            <div class="flex mt-4 float-right">
                <x-button-purple-btn wire:click="firstStepSubmit">
                    Continuar
                </x-button-purple-btn>
            </div>

        </div>


    </div>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-2 {{ $currentStep != 2 ? 'hidden' : '' }}">

        <div>
            <img class="w-auto h-full object-cover object-center rounded" src="{{ asset('img/fondo/intro/paso-2.webp') }}" alt="Intro">
        </div>

        <div>
            <h1 class="text-3xl text-center text-gray-600 font-semibold mb-2">Hablemos como mantener la comunidad</h1>
            <h2 class="text-xl font-semibold text-gray-600 text-center mb-10">Para mantener la línea con los estándares de la comunidad</h2>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2">
                
                <!--Card 1-->
                <div class="rounded overflow-hidden shadow-lg">
                  <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/info.svg') }}" alt="Icon">
                  <div class="px-6 py-2">
                    <p class="text-gray-700 text-base">
                      No proporcione información engañosa sobre su identidad.
                    </p>
                  </div>
                </div>

                <!--Card 2-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/speech-bubble.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        No solicite comunicaciones y pagos fuera de Todo Contenido Web.
                      </p>
                    </div>
                </div>
            
                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/lavado-de-dinero.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        No se permite publicar servicios o anuncios ilegales y/o fraudulentos.
                      </p>
                    </div>
                </div>
        
                <!--Card 4-->
                <div class="rounded overflow-hidden shadow-lg">
                    <img class="w-20 h-20 object-cover object-center mx-auto my-8" src="{{ asset('img/icons/el-respeto.svg') }}" alt="Icon">
                    <div class="px-6 py-2">
                      <p class="text-gray-700 text-base">
                        Manéjese con respeto con cada integrante de la comunidad.
                      </p>
                    </div>
                </div>
        
            </div>

            <div class="flex mt-4 float-right">
                <x-button-purple-btn wire:click="back(1)" class="mr-2">
                    Atrás
                </x-button-purple-btn>
                <x-button-purple-btn wire:click="secondStepSubmit">
                    Continuar
                </x-button-purple-btn>
            </div>

        </div>



    </div>

    

</div>
