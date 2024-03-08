<div class="mb-5 flex w-full flex-col md:flex-row">
    <div class="to-banner-primary from-banner-secundary flex w-full items-center bg-gradient-to-t px-2 py-4 md:w-64">
        <img src="{{ Storage::url($rifa->image) }}" alt="image" class="mx-auto flex md:h-24" />
    </div>
    <div class="relative flex w-full flex-col justify-center bg-gradient-to-t from-pink-400 to-indigo-500 px-2 py-4">
        <!-- <div class="mx-auto md:absolute md:-translate-x-10"><img class="rounded-full h-20 w-20" src="{{ $sale->user->profile_photo_url }}" alt="image" /></div> -->
        <div class="flex w-full justify-around border-b text-center">
            <div class="left my-5">
                @if($rifa )
                <h5 class="text-2xl text-white">
                    <a href="{{ route('rifas.show', ['record'=>$rifa]) }}">{{ $rifa->name }}</a>
                </h5>
                <p class="text-sm text-slate-100">{{ \Str::limit($rifa->preview, 100) }}</p>
                @endif
            </div>
            <div class="right my-5">
                <span class="text-sm font-bold text-green-500">O sorteio aconteceu no dia</span>
                @if($contest = $rifa->contest)
                <p class="text-xl text-white md:text-2xl">{{ date_carbom_format($contest->drawn_at)->format('d/m/Y') }} </p>
                @endif
            </div>
        </div>
        <div class="flex w-full flex-col items-center md:flex-row md:justify-around">
            <div class="flex flex-col">
                <p class="text-lg text-white md:ml-4">Número Sorteado:</p>
                <ul class="mt-2 flex space-x-2 md:w-full  justify-center">
                    @if($sale)
                        @foreach($sale->numbers as $number)
                            @if($number->status == 'winner')
                                <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-green-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">
                                    {{ str_pad($number->number, 2, '0', STR_PAD_LEFT) }}
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
                <!-- number-list end -->
            </div>
            <div class="flex flex-col items-center">
                <p class="text-white">Concurso:</p>
                @if($contest = $rifa->contest)
                <a href="https://loterias.caixa.gov.br/Paginas/Mega-Sena.aspx" target="_blank" class="text-xl font-bold text-white">{{ $contest->number }}</a>
                @endif
            </div>
            <div class="flex flex-col items-center">
                <p class="text-white">Ganhador:</p>
                <div class="mx-auto "><img class="rounded-full h-12 w-12" src="{{ $winner->user->profile_photo_url }}" alt="image" /></div>
                <span class="font-bold text-white">{{ $winner->user->name }}</span>
            </div>
        </div>
    </div>
</div>