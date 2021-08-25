<x-app-layout>
    
    <div class="container py-8">
        <ul>
            @forelse($posts as $post)
                {{-- llamamos al componente view->components->pos-list --}}
                <x-post-list :post="$post" />
            @empty

                <li class="bg-white rounded-lg shadow-lg">
                    <div class="p-4 text-center">
                        <p class="text-2xl text-purple-600 font-bold"> <i class="fas fa-exclamation-circle text-2xl text-purple-600"></i> No hay registros coincidentes</p>
                    </div>
                </li>

            @endforelse
        </ul>
        
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>


</x-app-layout>