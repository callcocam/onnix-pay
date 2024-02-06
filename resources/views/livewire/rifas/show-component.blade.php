<div class="flex flex-col w-full md:max-w-7xl mx-auto">
    <x-slot name="maxHeight">
        h-[calc(100vh-16rem)]
    </x-slot>
    <x-slot name="header">
        <x-crumb label="Rifas" route="{{ route('rifas.list') }}" active="{{ $rifa->name }}" />
        <div class="bg-pink-400 w-full flex md:max-w-5xl mx-auto flex-col justify-center  rounded-t-xl p-3 ">
            <div class="mx-auto text-white flex">
                Esta competição termina em:
            </div>
            <livewire:count-down :time="$rifa->draw_time" :date="$rifa->draw_date" />
        </div>

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
                                    <dt class="sr-only">Numbers</dt>
                                    <dd class="mt-4 text-base font-semibold leading-7 text-gray-900 flex flex-col ">
                                        <div class="flex justify-between text-gray-100">
                                            <span>0</span>
                                            <span>{{ $rifa->quantity }}</span>
                                        </div>
                                        <div class="w-full relative h-2 rounded-full bg-slate-300">
                                            <div class="absolute left-0 h-2  bg-yellow-400 rounded-full" :style="{width: '{{ $this->numberProgress }}%'}">

                                            </div>
                                        </div>
                                    </dd>
                                    @if($rifa->type == 'paid')
                                    <dt class="sr-only">Salary</dt>
                                    <dd class="mt-4 text-3xl font-semibold leading-7 text-gray-100 w-full text-right">R$ {{ $rifa->priceBrl }}</dd>
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
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m6.115 5.19.319 1.913A6 6 0 0 0 8.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 0 0 2.288-4.042 1.087 1.087 0 0 0-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 0 1-.98-.314l-.295-.295a1.125 1.125 0 0 1 0-1.591l.13-.132a1.125 1.125 0 0 1 1.3-.21l.603.302a.809.809 0 0 0 1.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 0 0 1.528-1.732l.146-.292M6.115 5.19A9 9 0 1 0 17.18 4.64M6.115 5.19A8.965 8.965 0 0 1 12 3c1.929 0 3.716.607 5.18 1.64" />
                                        </svg>

                                        <span class="text-gray-200">Link do sorteio:</span>
                                        <span> {{ $rifa->draw_local_link }} </span>
                                    </dd>
                                </dl>
                            </li>


                        </ul>
                        <div class="mt-8 flex border-t border-gray-100 pt-8 text-gray-50">
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
    @livewire('rifas.numbers', ['rifa' => $rifa])
</div>