<div class="md:grid md:grid-cols-1 md:divide-x md:divide-gray-200 my-5">
    <div class="col-span-12 w-full  my-2">
        <div class="flex items-center justify-between gap-2">
            <div class="border rounded flex w-full text-center p-2 bg-navy-600 text-white">Todos ({{ $this->quantity }})</div>
            <div class="border rounded flex w-full text-center p-2 bg-gray-700 dark:text-gray-900 dark:bg-gray-100 text-white">Selecionar ({{ $this->livres }})</div>
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
            @if(!$this->livres)
                @if($draft)
                    <a href="{{ route('sales.buy', $sale)}}" class="bg-primary hover:bg-primary-focus px-3 py-2 rounded-full text-white">
                        Click aqui para finalizar a compra
                    </a>
                @endif
            @endif

        </div>
    </div>
    @endif
    <div class="px-2 overflow-y-auto max-h-[400px]">
        <div class="mt-2 grid grid-cols-12 text-sm">
            @for($i = 1; $i <= config('onnixpay.quantity', 60); $i++) 
                @include('livewire.rifas.number', ['i' => $i])
            @endfor
        </div>
    </div>
</div>