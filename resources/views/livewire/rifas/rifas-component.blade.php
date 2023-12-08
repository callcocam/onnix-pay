<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 shadow-md">
    @if($category = $this->category)
    <div class="   relative">
        <div class="mx-auto max-w-7xl py-12 sm:px-2 sm:py-16 lg:px-4">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-none">
                <div class="max-w-3xl">
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $category->name }}</h2>
                    <p class="mt-4 text-gray-500 dark:text-gray-300">{!! $category->description !!}</p>
                </div>
                <div class="mt-16 grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-5">
                    <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                    @if($categories = $category->categories)
                    @foreach($categories as $category)
                    <div class="cursor-pointer w-full z-10  flex  flex-col items-center text-center justify-center" wire:click="loadCategory('{{ $category->slug }}')">
                        <div class="sm:flex-shrink-0">
                            <img class="h-16 w-16" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                        </div>
                        <div class="mt-4 w-full text-center ">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $category->name }}</h3>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 xl:gap-x-8 p-4 ">

        @if($rifas = $this->rifas)
        @foreach($rifas as $rifa)
        <livewire:rifas.rifa-component :rifa="$rifa" :key="$rifa->id" />
        @endforeach
        @endif
    </div>
</div>