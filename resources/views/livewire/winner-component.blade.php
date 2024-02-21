<div class="mb-5 flex w-full flex-col md:flex-row">
    <div class="to-banner-primary from-banner-secundary flex w-full items-center bg-gradient-to-t px-2 py-4 md:w-64">
        <img src="https://pixner.net/rifa1/demo/assets/images/win-car/4.png" alt="image" class="mx-auto flex md:h-24" />
    </div>
    <div class="relative flex w-full flex-col justify-center bg-gradient-to-t from-pink-400 to-indigo-500 px-2 py-4">
        <div class="mx-auto md:absolute md:-translate-x-10"><img src="https://pixner.net/rifa1/demo/assets/images/winner/4.png" alt="image" /></div>
        <div class="flex w-full justify-around border-b text-center">
            <div class="left my-5">
                @if($rifa = $winner->rifa)
                <h5 class="text-2xl text-white">{{ $rifa->name }}</h5>
                @endif
            </div>
            <div class="right my-5">
                <span class="text-sm font-bold text-green-500">O sorteio aconteceu no dia</span>
                @if($contest = $winner->contest)
                <p class="text-xl text-white md:text-2xl">{{ \Carbon\Carbon::parse($contest->drawn_at)->format('d/m/Y') }} </p>
                @endif
            </div>
        </div>
        <div class="flex w-full flex-col items-center md:flex-row md:justify-around">
            <div class="flex flex-col">
                <p class="text-lg text-white md:ml-4">Número Sorteados:</p>
                <ul class="mt-2 flex space-x-2 md:w-full">
                    @if($sale = $winner->sale)
                        @if($sale->numbers)
                            @foreach($sale->numbers as $number) 
                            @if($number->number == $winner->number)
                                <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-green-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">
                                    {{ str_pad($number->number, 2, '0', STR_PAD_LEFT) }}
                                </li>
                            @else
                                <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">
                                    {{ str_pad($number->number, 2, '0', STR_PAD_LEFT) }}
                                </li>
                            @endif
                            @endforeach
                        @endif
                    @endif

                </ul>
                <!-- number-list end -->
            </div>
            <div class="flex flex-col items-center">
                <p class="text-white">Número do Concurso:</p>
                @if($contest = $winner->contest)
                <span class="text-xl font-bold text-white">{{ $contest->number }}</span>
                @endif
            </div>
        </div>
    </div>
</div>