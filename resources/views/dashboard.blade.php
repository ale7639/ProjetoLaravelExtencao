<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard da Instituição') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <a href="{{ route('doacoes.create') }}" class="bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600 transition-colors">
                    <h4 class="text-xl font-semibold">{{ __('+ Adicionar Doação') }}</h4>
                    <p class="mt-2">{{ __('Registrar uma nova doação recebida.') }}</p>
                </a>

                <a href="{{ route('estoque.index') }}" class="bg-green-500 text-white p-6 rounded-lg shadow hover:bg-green-600 transition-colors">
                    <h4 class="text-xl font-semibold">{{ __('Gerenciar Estoque') }}</h4>
                    <p class="mt-2">{{ __('Visualizar e atualizar os itens disponíveis.') }}</p>
                </a>

                <a href="{{ route('doacoes.index') }}" class="bg-gray-200 p-6 rounded-lg shadow hover:bg-gray-300 transition-colors">
                    <h4 class="text-xl font-semibold text-gray-800">{{ __('Histórico de Doações') }}</h4>
                    <p class="mt-2 text-gray-600">{{ __('Visualizar o histórico de doações recebidas.') }}</p>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Total de Itens no Estoque
                    </h4>
                    <p class="text-3xl font-semibold text-gray-900 mt-2">
                        {{ $totalEstoque }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        Total de Doadores Registrados
                    </h4>
                    <p class="text-3xl font-semibold text-gray-900 mt-2">
                        {{ $totalDoadores }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Últimas Doações Recebidas
                    </h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doador</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Itens</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($ultimasDoacoes as $doacao)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($doacao->data_doacao)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $doacao->doador->name ?? $doacao->doador_nome ?? 'Anônimo' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $doacao->itens_doados }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        Nenhuma doação recebida ainda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>