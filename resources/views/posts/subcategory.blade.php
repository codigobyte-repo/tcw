<x-app-layout>

    <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
        
        <h1 class="uppercase text-center text-3xl font-bold">Subcategorías: {{ $subcategory->name }}</h1>

        @foreach($posts as $post)
            <!-- Componente blade: https://youtu.be/TolfLxb-pek?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=185 -->
           {{$post->name}}
        @endforeach

        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>