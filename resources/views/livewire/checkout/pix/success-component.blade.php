<!-- component -->
<div class="flex flex-col">
    @if(in_array($sale->status, ['pending' ]))
    <div class="bg-white p-6  md:mx-auto">
        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
            <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
            </path>
        </svg>
        <div class="text-center">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Pedido finalizado, com sucesso!</h3>
            <p class="text-gray-600 my-2">{{ $sale->description }}</p>
            <p class="flex items-center justify-center">
                @if($dataOrder = $this->dataOrder)
                <img src="{{ data_get($dataOrder, 'invoice.qrcode') }} " alt="{{ data_get($dataOrder, 'reference') }}">
                @endif
            </p>
            <div class="py-10 text-center">
                <a href="/" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                    Voltar para a loja
                </a>
            </div>
        </div>
    </div>
    @endif
    <div class="flex flex-col w-full border my-10">

        <div class="flex flex-col md:flex-row md:justify-between  bg-white p-6">
            <div class="flex items-center flex-col  ">
                <div class="flex items-center ">
                    <svg viewBox="0 0 24 24" class="text-green w-8 h-8">
                        <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                        </path>
                    </svg>
                    <h3 class="text-gray-900 font-semibold text-lg ml-2">Pedido {{ $sale->invoice }}</h3>
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
                                    <tr class="even:bg-gray-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ $sale->rifa->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{  money($sale->subtotal) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{  money($sale->total) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $sale->status }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                            <a href="{{ route('rifas.show', ['record'=>$sale->rifa]) }}" class="text-indigo-600 hover:text-indigo-900">Detalhes</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>