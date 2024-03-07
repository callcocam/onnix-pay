<div class="flex flex-col items-center bg-indigo-500 shadow-inner">
    <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="mb-5 flex h-52 w-full cursor-pointer items-center justify-center bg-indigo-400">
        <img src="{{ Storage::url($rifa->image) }}" alt="" class="object-cover p-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110" />
    </a>
    <div class="relative flex w-full flex-col items-center">
        @if($winner = $rifa->winner)
        <div class="absolute -top-[50%] flex h-24 w-24 flex-col items-center justify-center rounded-full bg-green-600 shadow-lg">
            <p class="text-xs text-white">Código</p>
            <span class="text-lg font-bold text-white">{{ $rifa->code }}</span>
        </div>
        @else
        <div class="absolute -top-[50%] flex h-24 w-24 flex-col items-center justify-center rounded-full bg-pink-600 shadow-lg">
            <p class="text-xs text-white">Código</p>
            <span class="text-lg font-bold text-white">{{ $rifa->code }}</span>
        </div>
        @endif

        <div class="mb-4 mt-4 grid w-full grid-cols-1 text-white">
            <div class="ml-2 flex flex-col items-start">
                <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="text-2xl"> {{ $rifa->name }} </a>
                @if($category = $rifa->category)
                <span> {{ $category->name }} </span>
                @endif
            </div>
        </div>
        @if($winner = $rifa->winner)
        <div class="mb-2 mt-4 grid w-full grid-cols-2 text-white">
            <div class="ml-2 flex flex-col items-start">
                <span class="font-serif text-2xl font-bold text-green-500"> {{ $winner->user->name }} </span>
                <span> Ganhador </span>
            </div>
            <div class="mr-2 flex flex-col items-end">
                <span class="font-serif text-2xl font-bold text-green-500">R$ {{ $rifa->totalBrl}} </span>
                <span> Valor do Prêmio </span>
            </div>
        </div>
        <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="flex flex-col h-14 w-full items-center justify-around border-t border-indigo-400">
            <div class="flex space-x-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <span>Sorteio Realizado</span>
            </div>
            <div class="flex h-8 border-x border-indigo-400"></div>
            <div class="flex items-center space-x-3 text-sm font-thin text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
                <span> {{ translatedFormatLong($rifa->contest->drawn_at) }} </span>
            </div>
        </a>
        @else
        <div class="mb-2 mt-4 grid w-full grid-cols-2 text-white">
            <div class="ml-2 flex flex-col items-start">
                <span class="font-serif text-2xl font-bold text-green-500">R$ {{ $rifa->totalBrl}} </span>
                <span> Volor Total </span>
            </div>
            <div class="mr-2 flex flex-col items-end">
                <span class="font-serif text-2xl font-bold text-green-500">R$ {{ $rifa->priceBrl}} </span>
                <span> Preço por número </span>
            </div>
        </div>
        <div class="mb-2 mt-2 grid w-full grid-cols-2 text-white">
            <div class="ml-2 flex flex-col items-start">
                <span class="font-serif text-2xl font-bold text-green-500"> {{ $rifa->quantity }} </span>
            </div>
            <div class="mr-2 flex flex-col items-end">
                <span class="font-serif text-2xl font-bold text-green-500">Número(s) </span>
            </div>
        </div>
        <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="flex h-14 w-full items-center justify-around border-t border-indigo-400">
            <div class="flex space-x-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>Faltam {{ $this->diffDays }} Dias</span>
            </div>
            <div class="flex h-8 border-x border-indigo-400"></div>
            <div class="flex items-center space-x-3 text-sm font-thin text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
                <span> {{ $this->concorentes }} Concorrente(s) </span>
            </div>
        </a>
        @endif
    </div>
</div>