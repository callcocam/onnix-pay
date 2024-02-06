<x-filament::modal id="cart" :slideOver="true">
    <x-slot name="heading">Carrinho</x-slot>
    <div>
        @if( $this->cartItems && $this->cartItems->count())
        <div class="flex-1 px-4 py-6 overflow-y-auto sm:px-6">
            <div class="flow-root">
                <ul role="list" class="-my-6 divide-y divide-gray-200">
                    @foreach ($this->cartItems as $item)
                    <li class="flex py-3">
                        <div class="flex-shrink-0 w-20 h-20 overflow-hidden border border-gray-200 rounded-md">
                            <img src="{{ $item->rifa->image_url }}" alt="{{ $item->rifa->name }}" class="object-cover object-center w-full h-full">
                        </div>

                        <div class="flex flex-col flex-1 ml-4">
                            <div>
                                <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                    <h3>
                                        <a href="{{ route('rifas.show', ['record'=>$item->rifa]) }}">{{ $item->rifa->name }}</a>
                                    </h3>
                                    <p class="ml-4">R$ {{ $item->rifa->price  }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ $item->rifa->category->name  }}</p>
                            </div>
                            <div class="flex items-end justify-between flex-1 text-sm">
                                <p class="text-gray-500 dark:text-gray-300">Quantidade {{ $item->numbers->count()}}</p>

                                <div class="flex">
                                    <button wire:click="removeItem('{{ $item->id }}')" type="button" class="font-medium text-primary-600 hover:text-primary-500">Remove</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="px-4 py-6 border-t border-gray-200 sm:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                <p>Subtotal</p>
                <p>R$ {{ $this->total }}</p>
            </div>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-300"> Frete e impostos calculados na finalização da compra.
            </p>
            <div class="mt-6">
                <button type="button" @click="()=>{$dispatch('close-modal', {id: 'cart'}); $dispatch('open-modal', {id: 'checkout'});}" class="bg-btn flex items-center justify-center w-full px-6 py-3 text-base font-medium text-white border border-transparent rounded-md shadow-sm  hover:bg-primary">
                    Finalizar compra
                </button>
            </div>
            <div class="flex justify-center mt-6 text-sm text-center text-gray-500 dark:text-gray-300">
                <p>
                    Ou
                    <a href="{{ route('rifas.list') }}" class="font-medium text-primary hover:text-primary-focus">
                        Continuar comprando
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </p>
            </div>
        </div>
        @else
        <div class="px-4 py-6 border-t border-gray-200 sm:px-6">

            <div class="flex justify-center mt-6 text-lg text-center text-gray-500 dark:text-gray-300">
                <p class="flex  flex-col">
                    <span>Seu carrinho está vazio.</span>
                    <a href="{{ route('rifas.list') }}" class="font-medium text-primary hover:text-primary-focus">
                        Compre rifas
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </p>
            </div>
        </div>
        @endif
    </div>
</x-filament::modal>