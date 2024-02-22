<div class="w-full p-8">
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 pb-16 pt-4 sm:px-6 sm:pb-24 sm:pt-8 lg:px-8 xl:px-2 xl:pt-14">
            <h1 class="sr-only">Checkout</h1>
            <div class="mx-auto grid max-w-lg grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                <div class="mx-auto w-full max-w-lg">
                    <h2 class="sr-only">Order summary</h2>
                    <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <li class="flex space-x-6 py-6">
                                <a href="{{ route('rifas.show', ['record'=>$rifa]) }}">
                                    <img src="{{ $rifa->image_url }}" alt="{{ $rifa->name }}" class="h-24 w-24 flex-none rounded-md bg-gray-100 object-cover object-center">
                                </a>
                                <div class="flex-auto">
                                    <div class="space-y-1 sm:flex sm:items-start sm:justify-between sm:space-x-6">
                                        <div class="flex-auto space-y-1 text-sm font-medium">
                                            <h3 class="text-gray-900">
                                                <a href="{{ route('rifas.show', ['record'=>$rifa]) }}">{{ $rifa->name }}</a>
                                            </h3>
                                            <p class="text-gray-900">{{ \App\Core\Helpers\Helpers::money($rifa->price) }}</p>
                                            <p class="hidden text-gray-500 sm:block">Gray</p>
                                            <p class="hidden text-gray-500 sm:block">S</p>
                                        </div>
                                        <div class="flex flex-none space-x-4">
                                            <div class="flex border-l border-gray-300 pl-4">
                                                <button type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- More products... -->
                        </ul>
                    </div>

                    <dl class="mt-10 space-y-6 text-sm font-medium text-gray-500">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd class="text-gray-900">{{ \App\Core\Helpers\Helpers::money($sale->subtotal) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Desconto</dt>
                            <dd class="text-gray-900">{{ \App\Core\Helpers\Helpers::money($sale->discount) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Shipping</dt>
                            <dd class="text-gray-900">{{ \App\Core\Helpers\Helpers::money($sale->shipping) }}</dd>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-6 text-gray-900">
                            <dt class="text-base">Total</dt>
                            <dd class="text-base">{{ \App\Core\Helpers\Helpers::money($sale->total) }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mx-auto w-full max-w-lg">
                    <form wire:submit.prevent='submit'>
                        {{ $this->form }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>