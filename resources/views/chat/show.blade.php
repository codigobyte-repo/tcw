<x-publisher-layout>

    
    {{-- Con esto agregamos una fuente solo a esta página. Tambien incluimos en x-publisher-layout yield('style') --}}
    @section('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    @stop
{{-- CHAT {{$post->id }} - {{$post->user->name}} --}}

<section style="font-family: 'Poppins', sans-serif;" class="h-screen flex overflow-hidden">

    {{-- SECCION USUARIOS CONTACTADOS --}}
    <div class="bg-white w-3/12 p-6">
       <h3 class="text-2xl mb-4 text-center">Chat en línea</h3>
        
       {{-- Buscador de usuarios contactados lado izquierdo --}}
       @livewire('chat.search-input')
       {{-- Fin Buscador de usuarios contactados lado izquierdo --}}

       {{-- Lista de usuarios contactados lado izquierdo --}}
       <div class="overflow-auto h-4/5">
            <h2 class="text-base text-gray-600 ml-3 mt-3">Chats</h2>
            
            @livewire('chat.user-chat', ['uuid' => $uuid])
            
       </div> 
       {{-- Fin Lista de usuarios contactados lado izquierdo --}}

    </div>

    <div class="bg-gray-100 w-9/12">
        {{-- LISTA DE MENSAJES principales lado derecho--}}
        @livewire('chat.chat-list', ['uuid' => $uuid])
        {{-- Fin LISTA DE MENSAJES principales lado derecho --}}
    </div>

</section>


</x-publisher-layout>