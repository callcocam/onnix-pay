<div class="flex flex-col w-full md:max-w-7xl mx-auto">
    <x-slot name="maxHeight">
        h-[calc(100vh-16rem)]
    </x-slot>
    <x-slot name="header">
        <x-crumb label="Sobre Nos" route="" active="" />

    </x-slot>
    <div class="relative w-full flex flex-col items-center justify-center mt-50 md:-mt-60">
        <div class="bg-indigo-800 py-10 mb-12 rounded-md shadow-lg">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto flex max-w-2xl flex-col justify-between gap-16 lg:mx-0 lg:max-w-none lg:flex-row ">

                       @foreach ($this->abouts as $about)
                        <div class="flex flex-col w-full text-slate-300 justify-center items-center">
                            <h1 class=" text-white text-6xl font-bold">{{ $about->name }}</h1>
                            <p class="text-white p-5 text-justify"  >
                                {!! $about->description !!}
                            </p>
                        </div>
                       @endforeach

                </div>
            </div>
        </div>
        <div class="flex flex-col w-full items-center from-banner-secundary to-banner-primary  bg-gradient-to-t to-90%  p-8 rounded-lg ">
            <h2 class="text-orange-600 text-xl">Testemunhos</h2>
            <h3 class="text-white text-5xl font-bold flex text-center">
                Nossos Clientes Satisfeitos com os nossos serviços em todo o mundo
            </h3>
            <div >

            </div>
        </div>
    </div>
</div>