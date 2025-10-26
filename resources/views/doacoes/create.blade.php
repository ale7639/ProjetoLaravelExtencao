<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registro de Doação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('doacoes.store') }}">
                        @csrf <div>
                            <label for="doador_nome" class="block font-medium text-sm text-gray-700">Nome do Doador</label>
                            <input type="text" name="doador_nome" id="doador_nome" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label for="doador_telefone" class="block font-medium text-sm text-gray-700">Telefone</label>
                            <input type="text" name="doador_telefone" id="doador_telefone" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="mt-4">
                            <label for="doador_endereco" class="block font-medium text-sm text-gray-700">Endereço</label>
                            <input type="text" name="doador_endereco" id="doador_endereco" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div class="mt-4">
                            <label for="data_doacao" class="block font-medium text-sm text-gray-700">Data da Doação</E-mail>
                            <input type="date" name="data_doacao" id="data_doacao" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mt-4">
                            <label for="itens_doados" class="block font-medium text-sm text-gray-700">Itens Doados (Ex: 10 Livros, 5 Cadernos)</label>
                            <textarea name="itens_doados" id="itens_doados" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Registrar Doação
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>