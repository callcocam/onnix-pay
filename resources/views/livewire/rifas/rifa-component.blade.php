<div class="p-2">
    <div class="relative flex flex-col group ">
        <div class="relative h-48 w-full overflow-hidden rounded-lg">
            <img src="{{ Storage::url($record->image) }}" alt="{{ $record->name }}" class="scale-75 group-hover:scale-125 duration-200 p-10 object-cover object-center">
        </div>
        <div class="relative mt-4 mx-5">
            <h3 class=" font-medium text-gray-900 dark:text-gray-100 text-2xl">{{ $record->name }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-yellow-100">{{ $record->category->name }}</p>
        </div>
        <div class=" inset-x-0 top-0 flex h-12 items-end justify-end overflow-hidden rounded-lg p-4">
            <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
            <div class="flex flex-col">
                <p class="relative text-lg font-semibold text-white">R$ {{ $record->price }}</p>

            </div>
        </div>
        <div class="mt-0 p-2">
            <a href="{{ route('rifas.show', $record) }}" class="bg-btn relative flex items-center justify-center rounded-md border border-transparent  px-8 py-2 text-sm font-medium text-gray-900 dark:text-gray-100  ">Comprar Agora</a>
        </div>
    </div>
</div>