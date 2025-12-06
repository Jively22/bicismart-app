<div x-data="{ open: false }" class="inline-block">
    <button @click="open = true" class="text-red-600 font-bold hover:underline">
        {{ $label }}
    </button>
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="surface-card rounded-2xl shadow-xl p-8 w-96 border border-green-50">
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $title }}</h2>
            <p class="text-gray-600 mb-6 text-sm">{{ $message }}</p>
            <div class="flex justify-end space-x-4">
                <button @click="open = false"
                        class="btn-ghost text-sm px-4">Cancelar</button>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-brand text-sm px-4">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
