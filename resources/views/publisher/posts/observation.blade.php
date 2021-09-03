<x-publisher-layout>
    <div class="container py-12">
        
        <header class="bg-white shadow">
            <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                
                <h1 class="font-semibold text-xl text-gray-600 leading-tight text-center">
                    Debe corregir la publicación: <strong>{{$post->name}}</strong>  
                </h1>
                
                <hr class="mt-2 mb-6">

                <div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                    <span class="absolute inset-y-0 left-0 flex items-center ml-4">
                      <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    </span>
                    <p class="ml-6">Soluciona por favor los siguientes ítems y vuelve a solicitar la revisión. ¡Muchas gracias!</p>
                </div>

                <div class="mt-6 ml-4">
                    {!!$post->observation->body!!}
                </div>

                <div class="mt-6">
                    <x-button-purple href="{{ route('publisher.posts.edit', $post) }}">
                        solucionar 
                    </x-button-purple>
                </div>
                
            </div>
        </header>

    </div>
</x-publisher-layout>