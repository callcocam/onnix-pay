<div class="p-4 sm:p-6 lg:p-8 w-full">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Minhas Rifas</h1>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Descrição</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sub Total</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>

                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                <span class="sr-only">#</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($sales as $sale)
                        <tr class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3"><a href="{{ route('rifas.show', ['record'=>$sale->rifa]) }}" class="text-indigo-600 hover:text-indigo-900">{{ $sale->rifa->name }}</a></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ money($sale->subtotal) }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ money($sale->total) }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $sale->status }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                @if($sale->status == 'pending')
                                <a href="{{ route('checkout-success', $sale) }}" class="text-indigo-600 hover:text-indigo-900">Efetur pagamento </a>
                                @elseif(in_array($sale->status, ['paid', 'completed']))
                                <a href="{{ route('sorteio', ['rifa'=>$sale->rifa]) }}" class="text-indigo-600 hover:text-indigo-900">Visualizar </a>
                                @else
                                Você selecionou {{ str_pad($sale->numbers->count(), 2, '0', STR_PAD_LEFT)  }} número(s) de {{ str_pad($sale->rifa->quantity, 2, '0', STR_PAD_LEFT) }} número(s).
                                <a href="{{ route('orders.show', $sale) }}" class="text-indigo-600 hover:text-indigo-900">Finalizar a compra</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>