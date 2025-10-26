<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard do Doador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ __("Bem-vindo, Doador!") }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <a href="{{ route('doador.doacoes.create') }}" class="bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600 transition-colors">
                            <h4 class="text-xl font-semibold">{{ __('+ Adicionar Doação') }}</h4>
                            <p class="mt-2">{{ __('Registrar uma nova doação que você fez.') }}</p>
                        </a>
                        
                        <a href="{{ route('doador.historico') }}" class="bg-gray-200 p-6 rounded-lg shadow hover:bg-gray-300 transition-colors">
                            <h4 class="text-xl font-semibold text-gray-800">{{ __('Meu Histórico') }}</h4>
                            <p class="mt-2 text-gray-600">{{ __('Ver todas as suas doações registadas.') }}</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>