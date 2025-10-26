<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ role: 'doador' }">
        @csrf

        <div>
            <label for="role" class="block font-medium text-sm text-gray-700">Eu sou...</label>
            <select name="role" id="role" 
                    x-model="role"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="doador">Doador (Pessoa Física ou Jurídica)</option>
                <option value="instituicao">Instituição (ONG, Abrigo, etc.)</option>
            </select>
        </div>

        <div class="mt-4">
            <label for="name" class="block font-medium text-sm text-gray-700" 
                   x-text="role === 'doador' ? 'Nome Completo' : 'Nome da Instituição (Razão Social)'"></label>
            
            <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                   type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <label for="documento" class="block font-medium text-sm text-gray-700"
                   x-text="role === 'doador' ? 'CPF/CNPJ' : 'CNPJ (Obrigatório)'"></label>
            
            <input id="documento" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                   type="text" name="documento" :value="old('documento')" />
        </div>

        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">E-mail</label>
            <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                   type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <label for="telefone" class="block font-medium text-sm text-gray-700">Telefone</label>
            <input id="telefone" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                   type="text" name="telefone" :value="old('telefone')" />
        </div>

        <div class="mt-4">
            <label for="endereco" class="block font-medium text-sm text-gray-700">Endereço</label>
            <input id="endereco" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                   type="text" name="endereco" :value="old('endereco')" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Senha</label>
            <input id="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar Senha</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                Já tem conta?
            </a>

            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md fontsemibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Cadastrar
            </button>
        </div>
    </form>
</x-guest-layout>