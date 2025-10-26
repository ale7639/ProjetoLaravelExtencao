<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Item do Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('estoque.update', $estoque->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="item_nome" class="block font-medium text-sm text-gray-700">Nome do Item</label>
                            <input type="text" name="item_nome" id="item_nome" 
                                   value="{{ old('item_nome', $estoque->item_nome) }}" 
                                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mt-4">
                            <label for="quantidade" class="block font-medium text-sm text-gray-700">Quantidade</label>
                            <input type="number" name="quantidade" id="quantidade" 
                                   value="{{ old('quantidade', $estoque->quantidade) }}" 
                                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mt-4">
                            <label for="data_recebimento" class="block font-medium text-sm text-gray-700">Data de Recebimento</label>
                            <input type="date" name="data_recebimento" id="data_recebimento" 
                                   value="{{ old('data_recebimento', $estoque->data_recebimento) }}" 
                                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="OKAY" @selected(old('status', $estoque->status) == 'OKAY')>OKAY</option>
                                <option value="INVALIDO" @selected(old('status', $estoque->status) == 'INVALIDO')>INVALIDO</option>
                                <option value="PENDENTE" @selected(old('status', $estoque->status) == 'PENDENTE')>PENDENTE</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Atualizar Item
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>