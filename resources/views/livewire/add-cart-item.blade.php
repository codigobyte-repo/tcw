<div>
    <button wire:click="addItem" wire:loading.attr="disabled" wire:target="addItem"
        type="button" class="w-full border border-purple-600 text-xl px-4 py-3 rounded text-purple-600 font-bold hover:bg-purple-800 hover:text-white transition duration-200 each-in-out">
        Agregar al carrito (USD{{ $post->price }})
    </button>
    <p class="text-center text-xs text-gray-500 font-extrabold">Garantía asegurada. 30 días de reembolso</p>
</div>
