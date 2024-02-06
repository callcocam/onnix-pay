<div class="md:grid md:grid-cols-1 md:divide-x md:divide-gray-200 my-5">
    <div class="col-span-12 w-full  my-2">
        <div class="flex items-center justify-between gap-2">
            <div class="border rounded flex w-full text-center p-2 bg-navy-600 text-white">Todos ({{ $this->quantity }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-gray-700 dark:text-gray-900 dark:bg-gray-100 text-white">Livres ({{ $this->livres }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-orange-600 text-white">Reservados ({{ $this->reservados }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-green-600 text-white">Meus Numeros ({{ $this->pagos }})</div>
        </div>
    </div>
    <div class="px-2 overflow-y-auto max-h-[400px]">
        <div class="mt-2 grid grid-cols-12 text-sm">
            @for($i = 1; $i <= $rifa->quantity; $i++)
                @if(in_array($i, $pending))
                <div class="border-t border-gray-200 py-2">
                    <button type="button" class="mx-auto flex h-8 w-8 items-center justify-center rounded-full font-semibold bg-orange-600  hover:bg-orange-200">
                        <span>{{ $i }}</span>
                    </button>
                </div>
                @elseif(in_array($i, $pay))
                <div class="border-t border-gray-200 py-2">
                    <button type="button" class="mx-auto flex h-8 w-8 items-center justify-center rounded-full font-semibold bg-green-600  hover:bg-green-200">
                        <span>{{ $i }}</span>
                    </button>
                </div>
                @else
                <div class="border-t border-gray-200 py-2">
                    <button wire:click="addNumber('{{ $i }}')" type="button" class="mx-auto flex h-8 w-8 items-center justify-center rounded-full text-white  bg-gray-700 dark:text-gray-900 dark:bg-gray-100 hover:bg-gray-400">
                        <span>{{ $i }}</span>
                    </button>
                </div>
                @endif
                @endfor
        </div>
    </div>

</div>