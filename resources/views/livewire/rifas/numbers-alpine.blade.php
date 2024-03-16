<div class="md:grid md:grid-cols-1 md:divide-x md:divide-gray-200 my-5  relative translate-x-0">
    <div class="col-span-12 bg-black/25 absolute z-50 top-0 right-0 bottom-0 left-0 min-h-screen flex items-center justify-center rounded-lg" wire:loading.flex>
        <div class="spinner is-grow relative w-16 h-16">
            <span class="absolute inline-block h-full w-full rounded-full bg-primary opacity-75 dark:bg-accent"></span>
            <span class="absolute inline-block h-full w-full rounded-full bg-primary opacity-75 dark:bg-accent"></span>
        </div>
    </div>
    <div class="col-span-12 w-full  my-2">
        <div class="flex items-center justify-between gap-2">
            <div class="border rounded flex w-full text-center p-2 bg-navy-600 text-white">Todos ({{ $this->quantity }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-gray-700 dark:text-gray-900 dark:bg-gray-100 text-white">Livre(s) ({{ $this->livres }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-orange-600 text-white">Reservados ({{ $this->reservados }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-green-600 text-white">Meus Numeros ({{ $this->pagos }})</div>
        </div>
    </div>
    @if($numbers = $this->numbers)
    <div class="px-2 col-span-12 w-full  my-2">
        <div class="mt-2 flex w-full items-center justify-center space-x-3 text-sm">
            @foreach($numbers as $number)
            @include('livewire.rifas.number', ['i' => $number])
            @endforeach
            @if($this->reservados)
            <a href="{{ route('sales.buy', $sale)}}" class="bg-primary hover:bg-primary-focus px-3 py-2 rounded-full text-white">
                Click aqui para finalizar a compra
            </a>
            @endif

        </div>
    </div>
    @endif
    <div class="px-2 overflow-y-auto max-h-[400px] " x-data="{
            numbers:@entangle('numbers'),
            perPage:@entangle('perPage'),
            quantityPerPage:@entangle('quantityPerPage'),
            draft:@entangle('draft'),
            pay:@entangle('pay'),
            pending:@entangle('pending'),        
            loadMore(){
                this.perPage = this.perPage + 49
            }, 
        }" x-init="()=>{ 
            console.log( draft)
            console.log( pay)
            console.log( pending)
            console.log( numbers)
        }">
        <ul class="mt-2 grid grid-cols-12 text-sm gap-1">
            <template x-for="i in perPage + 50">
                <li>
                    <template x-if="draft.find((element) => element == i) ">
                        <x-number-button @click="$wire.removeNumber(i)" title="Remover o número" class="mx-auto flex h-10 w-10 items-center justify-center rounded-full font-semibold   text-white bg-orange-600  hover:bg-orange-200">
                            <span x-text="i"></span>
                        </x-number-button>
                    </template>
                    <template x-if="pay.find((element) => element == i)">
                        <x-number-button type="button" title="Pronto para o sorteio" class="mx-auto flex h-10 w-10 items-center justify-center rounded-full font-semibold   text-white bg-green-600  hover:bg-green-200">
                            <span x-text="i"></span>
                        </x-number-button>
                    </template>
                    <template x-if="pending.find((element) => element == i)">
                        <x-number-button title="Aguardando pagamento" class="mx-auto flex h-10 w-10 items-center justify-center rounded-full font-semibold   text-white bg-blue-600 dark:text-gray-900 dark:bg-gray-100 hover:bg-blue-400">
                            <span x-text="i"></span>
                        </x-number-button>
                    </template>
                    <template x-if="!draft.find((element) => element == i) && !pay.find((element) => element == i) && !pending.find((element) => element == i)">
                        <x-number-button @click="$wire.addNumber(i)" title="Adicionar esse número" class="mx-auto flex h-10 w-10 items-center justify-center rounded-full font-semibold   text-white bg-gray-700 dark:text-gray-900 dark:bg-gray-100 hover:bg-gray-400">
                            <span x-text="i"></span>
                        </x-number-button>
                    </template>
                </li>
            </template>
        </ul>
        <template x-if="perPage < quantityPerPage">
            <div x-intersect="loadMore" class="h-10">
                <div class="spinner is-grow relative w-16 h-16">
                    <span class="absolute inline-block h-full w-full rounded-full bg-primary opacity-75 dark:bg-accent"></span>
                    <span class="absolute inline-block h-full w-full rounded-full bg-primary opacity-75 dark:bg-accent"></span>
                </div>
            </div>
        </template>
    </div>
</div>