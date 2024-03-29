<div class="flex flex-col w-full md:max-w-7xl mx-auto">
    <x-slot name="maxHeight">
        h-[calc(100vh-16rem)]
    </x-slot>
    <x-slot name="header">
        <x-crumb label="Sorteio" route="" active="{{ $rifa->name}}" />

    </x-slot>
    <div class="relative w-full flex flex-col items-center justify-center mt-30 md:-mt-80">

        <div class="flex w-full flex-col items-center   z-20  mt-50 mb-10">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-6xl font-bold text-white mb-4">Nunca perca um sorteio!</h2>
                <p class="text-gray-100">Maneira fácil de comprar ingressos e ganhar o prêmio dos sonho</p>
                <p class="text-gray-100">E muitos outros a qualquer hora, em qualquer lugar</p>
            </div>
        </div>
        <div class="bg-indigo-800 py-10 mb-12 rounded-md shadow-lg w-full md:max-w-7xl">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 w-full">
                <div class="mx-auto flex max-w-2xl flex-col justify-between gap-16 lg:mx-0 lg:max-w-none lg:flex-row ">
                    <div class="flex flex-col w-full text-slate-300 justify-center items-center">
                        <div class="winner-details-wrapper bg_img" data-background="assets/images/elements/winner-details.jpg" style="background-image: url(&quot;assets/images/elements/winner-details.jpg&quot;);">
                            <div class="left">
                                <img src="{{ Storage::url($rifa->image) }}" alt="{{ $rifa->name }}">
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <p class="contest-number">Código: {{ $rifa->code }}</p>

                                <p class=""><span class="text-green-500 font-bold">O sorteio acontecerá a partir do dia :</span> <span class="font-bold">{{ Helper::translatedFormat($rifa->end_date, 'd M Y') }}</span></p>
                                <div class="line"></div>
                                @if($sales->count() > 0)
                                <h4 class="title mt-4">Seus número(s):</h4>
                                @foreach($sales as $sale)
                                @if($numbers = $sale->numbers)
                                <ul class="flex gap-2 mt-4">
                                    @foreach($numbers as $number)
                                    @if(in_array($number->status, ['paid', 'approved']))
                                    <li class="bg-green-600  hover:bg-green-500 shadow-lg rounded-md flex items-center justify-center h-8 w-8">{{ $number->number }}</li>
                                    @else
                                    <li class="bg-orange-600  hover:bg-orange-500  shadow-lg rounded-md flex items-center justify-center h-8 w-8">{{ $number->number }}</li>
                                    @endif
                                    @endforeach
                                </ul>
                                @if(in_array($sale->status, [ 'draft']))
                                <div class="mt-5">
                                    <a href="{{ route('sales.buy', $sale) }}" class=" bg-primary/90 flex items-center justify-center w-full px-6 py-2 text-base font-medium text-white border border-transparent rounded-full shadow-sm  hover:bg-primary">
                                        Finalizar compra
                                    </a>
                                </div>
                                @elseif(in_array($sale->status, [ 'pending']))
                                <div class="mt-5">
                                    <a href="{{ route('checkout-success', $sale) }}" class=" bg-primary/90 flex items-center justify-center w-full px-6 py-2 text-base font-medium text-white border border-transparent rounded-full shadow-sm  hover:bg-primary">
                                        Efetuar pagamento
                                    </a>
                                </div>
                                @endif
                                @endif
                                @endforeach
                                @endif
                                <div class="mt-5">
                                    <a href="{{ route('rifas.list') }}" class="btn btn-primary">Ver todas as rifas</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @if($sales = $rifa->sales)
        <div class="mx-auto flex w-full flex-col items-center justify-center md:max-w-7xl">
            <div class="mb-4 flex w-full flex-col items-center space-y-2 text-center md:text-left">
                <h2 class="text-yellow-500">Números selecionados para {{ $rifa->name }}</h2>
                <h1 class="text-xl font-bold text-slate-500 md:text-2xl">ÚLTIMOS NÚMEROS ADIQUIRIDO(S)</h1>
                <p>Verifique o número do seu bilhete para ver se você é um ganhador do AFORTUNADOS DA SORTE.</p>
            </div>
            <div class="flex w-full mb-10 h-36 flex-col items-center overflow-hidden border-b md:max-w-7xl md:flex-row md:justify-between">
                @foreach($sales as $sale)
                @if($numbers = $sale->numbers)
                @foreach($numbers as $number)
                @if(in_array($number->status, ['paid', 'approved']))
                <x-number-button type="button" title="Pronto para o sorteio" class="bg-green-600">
                    <span>{{ $number->number }}</span>
                </x-number-button>
                @else
                <x-number-button type="button" title="Pronto para o sorteio" class="bg-blue-600">
                    <span>{{ $number->number }}</span>
                </x-number-button>
                @endif
                @endforeach
                @endif
                @endforeach
            </div>
        </div>
        @endif
        <div class="mx-auto flex w-full flex-col items-center justify-center md:max-w-7xl">
            <div class="mb-4 flex w-full flex-col items-center space-y-2 text-center md:text-left">
                <h2 class="text-yellow-500">Conheça o vencedor do concurso favorito</h2>
                <h1 class="text-4xl font-bold text-slate-500 md:text-6xl">ÚLTIMOS VENCEDORES</h1>
                <p>Verifique o número do seu bilhete para ver se você é um ganhador do AFORTUNADOS DA SORTE.</p>
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
                    <div class="mb-5 flex flex-col rounded-lg bg-gradient-to-t from-indigo-500 to-indigo-700 p-3 text-white">
                        Os sorteios são baseados na <b>MEGA SENA</b> que ocorre toda a semana. Os participantes compram seus números, para determinar o vencedor, verificamos os números sorteados na
                        <b>MEGA SENA</b> quando encontramos uma ocorrencia sai o vencedor, isso ocorre na ordem que os números do concurso foram sorteados.
                    </div>
                </div>
                <div class="w-full flex-col md:w-4/6">
                    @if($winner)
                        @livewire('winner-component', ['winner' => $winner], key($winner->id))
                    @else
                    <div class="flex w-full flex-col items-center justify-center">
                        <p class="text-2xl text-gray-500">Nenhum vencedor encontrado</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>