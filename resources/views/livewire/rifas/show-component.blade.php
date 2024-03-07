<div class="flex flex-col w-full md:max-w-7xl mx-auto">
    <x-slot name="maxHeight">
        h-[calc(100vh-16rem)]
    </x-slot>
    <x-slot name="header">
        <x-crumb label="Rifas" route="{{ route('rifas.list') }}" active="{{ $rifa->name }}" />
        @if(date_carbom_format($rifa->end_date)->isFuture())
        <div class="bg-pink-400 w-full flex md:max-w-5xl mx-auto flex-col justify-center  rounded-t-xl p-3 ">
            <div class="mx-auto text-white flex">
                Esta competição termina em:
            </div>

            <livewire:count-down :date="$rifa->end_date" />
        </div>
        @endif

    </x-slot>
    <div class="relative w-full flex items-center justify-center mt-50 md:-mt-60">
        <div class="bg-indigo-800 py-10 mb-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto flex max-w-2xl flex-col justify-between gap-16 lg:mx-0 lg:max-w-none lg:flex-row">
                    <div class="w-full lg:max-w-lg lg:flex-auto">
                        <img src="{{ Storage::url($rifa->image) }}" alt="{{ $rifa->name }}" class="  aspect-[6/5] w-full rounded-2xl shadow-lg bg-indigo-400 object-contain lg:aspect-auto lg:h-[34.5rem]">
                    </div>
                    <div class="w-full lg:max-w-xl lg:flex-auto">
                        <h3 class="sr-only"> {{ $rifa->name}}</h3>
                        <ul class="-my-8 divide-y divide-gray-100">
                            <li class="py-8 ">
                                <dl class="relative flex  flex-col flex-wrap gap-x-3">
                                    <dt class="text-yellow-300 text-xl">Entre agora para ter a chance de ganhar</dt>
                                    <dd class="w-full flex-none text-4xl font-semibold tracking-tight text-gray-100 mb-8">
                                        {{ $rifa->name}}
                                    </dd>
                                    <dt class="sr-only">Description</dt>
                                    <dd class="mt-2 w-full flex-none text-base leading-7 text-gray-100 mb-2">{{ $rifa->preview }}</dd>
                                    <dt class="sr-only">Code</dt>
                                    <dd class="mt-2 w-full flex items-center text-gray-100"><span>Código:</span> <span class=" text-2xl text-red-700 font-bold ml-2"> {{ $rifa->code }}</span></dd>
                                    @if($numberProgress = $this->numberProgress )
                                    <dt class="sr-only">Numbers</dt>
                                    <dd class="mt-4 text-base font-semibold leading-7 text-gray-900 flex flex-col ">
                                        <div class="flex justify-between text-gray-100">
                                            <span>{{ data_get($numberProgress, 'value', 0) }}</span>
                                            <span>{{ $rifa->quantity  }} </span>
                                        </div>
                                        <div class="w-full relative h-2 rounded-full bg-slate-300">
                                            @if(data_get($numberProgress, 'total') >=100)
                                            <div class="absolute left-0 h-2  bg-green-400 rounded-full" :style="{width: '{{ data_get($numberProgress, 'total') }}%'}"> </div>
                                            @else
                                            <div class="absolute left-0 h-2  bg-yellow-400 rounded-full" :style="{width: '{{ data_get($numberProgress, 'total') }}%'}"> </div>
                                            @endif
                                        </div>
                                    </dd>
                                    @endif
                                    @if($rifa->type == 'paid')
                                    <dt class="sr-only">Salary</dt>
                                    <dd class="mt-4 text-3xl font-semibold leading-7 text-gray-100 w-full text-right"> {{ money($rifa->price) }}</dd>
                                    @else
                                    <dt class="sr-only">Salary</dt>
                                    <dd class="mt-4 text-3xl font-semibold leading-7 text-gray-100 w-full text-right">Grátis</dd>
                                    @endif
                                    @if($rifa->draw_local)
                                    <dt class="sr-only">Location</dt>
                                    <dd class="mt-4 flex items-center gap-x-2 text-base leading-7 text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        <span class="text-gray-200">Local do sorteio:</span>
                                        <span> {{ $rifa->draw_local }} </span>
                                    </dd>
                                    @endif
                                    <dd class="mt-4 flex items-center gap-x-2 text-base leading-7 text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>

                                        <span class="text-gray-200">Data do sorteio:</span>
                                        <span>A partir de  <span class="text-lg font-bold">{{ translatedFormatLong($rifa->end_date)}}</span>  </span>
                                    </dd>

                                    <dd class="mt-4 flex items-center gap-x-2 text-base leading-7 text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                                        </svg>

                                        <span class="text-gray-200">Link do sorteio:</span>
                                        @if($rifa->draw_local_link)
                                        <span> <a href="{{ $rifa->draw_local_link }}">Click aqui</a> </span>
                                        @else
                                        <span> <a href="{{ route('sorteio', $rifa) }}">Click aqui</a> </span>
                                        @endif
                                    </dd>

                                </dl>
                            </li>
                        </ul>
                        <div class="mt-8 flex flex-col border-t border-gray-100 pt-8 text-gray-50">
                            @if($sale )
                            <div class="flex flex-col items-start">
                                <div class="flex  space-x-2 items-center">
                                    <p class="text-lg font-bold text-green-500">Total de rifas:</p>
                                    <p class="text-sm"> 01 </p>
                                </div>
                                <div class="flex   space-x-2 items-center">
                                    <p class="text-lg font-bold text-green-500">Total de números:</p>
                                    <p class="text-sm">{{ str_pad( $sale->numbers->count(), 3, '0', STR_PAD_LEFT) }} </p>
                                </div>
                                <div class="flex  space-x-2 items-center">
                                    <p class="text-lg font-bold text-green-500">Sub total:</p>
                                    <p class="text-sm">{{ money($sale->subtotal) }} </p>
                                </div>
                                <div class="flex  space-x-2 items-center">
                                    <p class="text-lg font-bold text-green-500">Valor total:</p>
                                    <p class="text-sm">{{ money($sale->total) }} </p>
                                </div>
                                <div class="flex  flex-col  space-x-2 justify-center">
                                    <p class="text-lg font-bold text-green-500">Nemeros:</p>
                                    <ul class="flex gap-2">
                                        @foreach($sale->numbers as $number)
                                        <li class="border-t border-gray-200 py-2">
                                            <span class="mx-auto text-sm flex h-8 w-8 items-center justify-center rounded-full font-semibold bg-navy-600 dark:text-gray-900 dark:bg-gray-100 hover:bg-navy-400 text-white">{{ $number->number }} </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if($sorteio)
                            <div class="flex flex-col space-x-2 items-center justify-center">
                                <p class="text-xl font-bold text-green-500">O sorteio aconteceu no dia </p>
                                <p class="text-2xl">{{ translatedFormatShort($sorteio->drawn_at)  }} </p>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-xl font-bold text-green-500">Número do Concurso:</p>
                                <a href="https://loterias.caixa.gov.br/Paginas/Mega-Sena.aspx" target="_blank" class="text-2xl font-bold">{{ $sorteio->number }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($winners)
    <div class="mx-auto flex w-full flex-col items-center justify-center md:max-w-7xl">
        <div class="mb-4 flex w-full flex-col items-center space-y-2 text-center md:text-left">
            <h2 class="text-yellow-500">Conheça o(s) vencedore(s) do concurso {{ $sorteio->number }}</h2>
            <h1 class="text-4xl font-bold text-slate-500 md:text-6xl">VENCEDORE(S)</h1>
            <p>Verifique a data o prazo de entrega <a class="text-primary" target="_blank" href="{{ route('about') }}">Aqui</a></p>
        </div>
        <div class="flex w-full mb-10 h-36 flex-col items-center overflow-hidden border-b md:max-w-7xl md:flex-row md:justify-between">
            <button class="flex w-full flex-col items-center border-b-4 border-orange-500 py-6">
                <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/1.png" alt="DREAM CAR" />
                <span>CARRO DO SONHOS</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
                <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/2.png" alt="Bike" />
                <span>MOTO</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
                <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/3.png" alt="WATCH" />
                <span>RELOGIO</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
                <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/4.png" alt="LEPTOP" />
                <span>NOTBOOK</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
                <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/5.png" alt="MONEY" />
                <span>DINHEIRO</span>
            </button>
        </div>
        <div class="mx-auto flex w-full flex-col md:max-w-7xl md:flex-row md:space-x-4">
            <div class="w-full md:w-2/6">
                @include('includes.sorteio-instrucao')
            </div>
            <div class="w-full flex-col md:w-4/6">
                @if($winners->count() > 0)
                @foreach($winners as $winner)
                @livewire('winner-component', ['winner' => $winner], key($winner->id))
                @endforeach
                @else
                <div class="flex w-full flex-col items-center justify-center">
                    <p class="text-2xl text-gray-500">Nenhum vencedor encontrado</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @else
        @if(date_carbom_format($rifa->end_date)->isFuture())
            @livewire('rifas.numbers', ['rifa' => $rifa])
        @endif
    @endif
</div>