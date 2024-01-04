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
            <div class="flex items-center justify-around  h-16">
                <div class="flex flex-col items-center">
                    <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">00</span>
                    <span class="text-white font-bold">DIAS</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">00</span>
                    <span class="text-white font-bold">HORAS</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">00</span>
                    <span class="text-white font-bold">MINUTOS</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">00</span>
                    <span class="text-white font-bold">SEGUNDOS</span>
                </div>
            </div>
        </div>
        
    </x-slot>
    <div class="relative w-full flex items-center justify-center -mt-80">
            <div class="bg-indigo-800 py-32 mb-12">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto flex max-w-2xl flex-col   justify-between gap-16 lg:mx-0 lg:max-w-none lg:flex-row">
                        <div class="w-full lg:max-w-lg lg:flex-auto">                           
                            <img src="{{ Storage::url($rifa->image) }}" alt="" class="  aspect-[6/5] w-full rounded-2xl shadow-lg bg-indigo-400 object-contain lg:aspect-auto lg:h-[34.5rem]">
                        </div>
                        <div class="w-full lg:max-w-xl lg:flex-auto">
                            <h3 class="sr-only">Job openings</h3>
                            <ul class="-my-8 divide-y divide-gray-100">
                                <li class="py-8">
                                    <dl class="relative flex flex-wrap gap-x-3">
                                        <dt class="sr-only">Role</dt>
                                        <dd class="w-full flex-none text-lg font-semibold tracking-tight text-gray-900">
                                            <a href="#">
                                                Full-time designer
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                            </a>
                                        </dd>
                                        <dt class="sr-only">Description</dt>
                                        <dd class="mt-2 w-full flex-none text-base leading-7 text-gray-600">Quos sunt ad dolore ullam qui. Enim et quisquam dicta molestias. Corrupti quo voluptatum eligendi autem labore.</dd>
                                        <dt class="sr-only">Salary</dt>
                                        <dd class="mt-4 text-base font-semibold leading-7 text-gray-900">$75,000 USD</dd>
                                        <dt class="sr-only">Location</dt>
                                        <dd class="mt-4 flex items-center gap-x-3 text-base leading-7 text-gray-500">
                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300" aria-hidden="true">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>
                                            San Francisco, CA
                                        </dd>
                                    </dl>
                                </li>
                                <li class="py-8">
                                    <dl class="relative flex flex-wrap gap-x-3">
                                        <dt class="sr-only">Role</dt>
                                        <dd class="w-full flex-none text-lg font-semibold tracking-tight text-gray-900">
                                            <a href="#">
                                                Laravel developer
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                            </a>
                                        </dd>
                                        <dt class="sr-only">Description</dt>
                                        <dd class="mt-2 w-full flex-none text-base leading-7 text-gray-600">Et veniam et officia dolorum rerum. Et voluptas consequatur magni sapiente amet voluptates dolorum. Ut porro aut eveniet.</dd>
                                        <dt class="sr-only">Salary</dt>
                                        <dd class="mt-4 text-base font-semibold leading-7 text-gray-900">$125,000 USD</dd>
                                        <dt class="sr-only">Location</dt>
                                        <dd class="mt-4 flex items-center gap-x-3 text-base leading-7 text-gray-500">
                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300" aria-hidden="true">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>
                                            San Francisco, CA
                                        </dd>
                                    </dl>
                                </li>
                                <li class="py-8">
                                    <dl class="relative flex flex-wrap gap-x-3">
                                        <dt class="sr-only">Role</dt>
                                        <dd class="w-full flex-none text-lg font-semibold tracking-tight text-gray-900">
                                            <a href="#">
                                                React Native developer
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                            </a>
                                        </dd>
                                        <dt class="sr-only">Description</dt>
                                        <dd class="mt-2 w-full flex-none text-base leading-7 text-gray-600">Veniam ipsam nisi quas architecto eos non voluptatem in nemo. Est occaecati nihil omnis delectus illum est.</dd>
                                        <dt class="sr-only">Salary</dt>
                                        <dd class="mt-4 text-base font-semibold leading-7 text-gray-900">$105,000 USD</dd>
                                        <dt class="sr-only">Location</dt>
                                        <dd class="mt-4 flex items-center gap-x-3 text-base leading-7 text-gray-500">
                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300" aria-hidden="true">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>
                                            San Francisco, CA
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <div class="mt-8 flex border-t border-gray-100 pt-8">
                                <a href="#" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">View all openings <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>