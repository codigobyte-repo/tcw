<div>

    <a class="relative text-gray-300 pt-2" wire:click="deleteStatus" href="{{ url('contactos') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
        </svg>

        @if($status >= 1)
            <span class="absolute top-0 left-4 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-purple-100 transform translate-x-1/2 -translate-y-1/2 bg-blue-400 rounded-full">{{ $status }}</span>
        @else
            <span class="absolute top-1 left-6 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-blue-400 rounded-full"></span>
        @endif

    </a>
    

</div>
