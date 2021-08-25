<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white rounded-md font-bold text-xs text-purple-600 uppercase tracking-widest hover:bg-gray-200 active:bg-purple-400 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</a>