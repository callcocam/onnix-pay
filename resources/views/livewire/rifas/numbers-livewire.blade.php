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
    @if($this->numbers)
    <div class="px-2 col-span-12 w-full  my-2">
        <div class="mt-2 flex w-full items-center justify-center space-x-3 text-sm">
            @foreach($this->numbers as $number)
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
    <div class="px-2 overflow-y-auto max-h-[400px]">

        <div class="mt-2 grid grid-cols-12 text-sm">
            @for($i = 1; $i <= $rifa->quantity; $i++)
                @include('livewire.rifas.number', ['i'=> $i])
                @endfor
        </div>
    </div>
</div>