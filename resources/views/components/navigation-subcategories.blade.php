@props(['category'])

<div class="grid grid-cols-4 py-4 p-4">
    <div class="col-span-2">
        <p class="text-lg font-bold ml-4 text-trueGray-500 mb-3 border-l-2 pl-2 border-purple-600">Subcategorías</p>

        <ul>
            @if(!empty($category->subcategories))
                @foreach($category->subcategories as $subcategory)
                    <li>
                        <a href="{{ route('posts.category', $category) . '?subcategoria=' . $subcategory->slug}}" class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-purple-500">
                            {{ $subcategory->name }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    
    <div class="col-span-2">
        <img class="h-64 w-full object-cover object-center" src="{{ Storage::url($category->image) }}" alt="{{$category->name}}">
    </div>
</div>