<div x-data="{ open: false }" class="inline-block">
    <button @click="open = true" class="text-red-600 font-bold hover:underline">
        {{ $label }}
    </button>
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl p-8 w-96">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $title }}</h2>
            <p class="text-gray-600 mb-6">{{ $message }}</p>
            <div class="flex justify-end space-x-4">
                <button @click="open = false"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancelar</button>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
