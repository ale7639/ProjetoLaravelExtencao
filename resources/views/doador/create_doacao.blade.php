<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Nova Doação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('doador.doacoes.store') }}">
                        @csrf

                        <div>
                            <label for="instituicao_id" class="block font-medium text-sm text-gray-700">
                                Para qual instituição você deseja doar?
                            </label>
                            <select name="instituicao_id" id="instituicao_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Selecione uma instituição</option>
                                
                                @foreach ($instituicoes as $instituicao)
                                    <option value="{{ $instituicao->id }}">
                                        {{ $instituicao->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="data_doacao" class="block font-medium text-sm text-gray-700">Data da Doação</label>
                            <input type="date" name="data_doacao" id="data_doacao" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mt-4">
                            <label for="itens_doados" class="block font-medium text-sm text-gray-700">Itens que você irá doar (Ex: 10 Livros, 5 Cadernos)</label>
                            <textarea name="itens_doados" id="itens_doados" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Confirmar Doação
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>