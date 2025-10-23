<tbody class="bg-white divide-y divide-gray-200">

    @forelse ($estoques as $item)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->item_nome }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantidade }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->data_recebimento)->format('d/m/Y') }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                </td>

            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                <a href="{{ route('estoque.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">
                    Editar
                </a>

                <form action="{{ route('estoque.destroy', $item->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Tem certeza que deseja apagar este item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                        Apagar
                    </button>
                </form>

            </td>
        </tr>
    @empty
        @endforelse

</tbody>