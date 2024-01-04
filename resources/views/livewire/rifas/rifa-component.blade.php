<div class="flex flex-col items-center bg-indigo-500 shadow-inner">
    <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="mb-5 flex h-52 w-full cursor-pointer items-center justify-center bg-indigo-400">
        <img src="{{ Storage::url($rifa->image) }}" alt="" class="object-cover p-6 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110" />
    </a>
    <div class="relative flex w-full flex-col items-center">
        <div class="absolute -top-[50%] flex h-24 w-24 flex-col items-center justify-center rounded-full bg-pink-600 shadow-lg">
            <p class="text-xs text-white">Rifa agora</p>
            <span class="text-lg font-bold text-white">X9U</span>
        </div>
        <div class="mb-4 mt-4 grid w-full grid-cols-2 text-white">
            <div class="ml-2 flex flex-col items-start">
                <span class="text-2xl"> {{ $rifa->name }} </span>
                <span> {{ $rifa->category->name }} </span>
            </div>
            <div class="mr-2 flex flex-col items-end">
                <span class="font-serif text-2xl font-bold text-green-500">R$ {{ $rifa->priceBrl}} </span>
                <span> Preço por número </span>
            </div>
        </div>
        <a href="{{ route('rifas.show', ['record'=>$rifa]) }}" class="flex h-14 w-full items-center justify-around border-t border-indigo-400">
            <div class="flex space-x-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span> 5D</span>
            </div>
            <div class="flex h-8 border-x border-indigo-400"></div>
            <div class="flex items-center space-x-3 text-sm font-thin text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
                <span> {{ $this->livres }} Restante </span>
            </div>
        </a>
    </div>
</div>