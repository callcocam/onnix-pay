    @if(in_array($i, $draft))
    <x-number-button wire:click="removeNumber('{{ $i }}')" title="Remover o número" class="bg-orange-600  hover:bg-orange-500">
        <span>{{ $i }}</span>
    </x-number-button>
    @elseif(in_array($i, $pay))
    <x-number-button type="button" title="Pronto para o sorteio" class="bg-green-600  hover:bg-green-500">
        <span>{{ $i }}</span>
    </x-number-button> 
    @elseif(in_array($i, $pending))
    <x-number-button title="Aguardando pagamento" class="bg-blue-600 dark:text-gray-900 dark:bg-gray-100 hover:bg-blue-400">
        <span>{{ $i }} </span>
    </x-number-button>
    @else
    <x-number-button wire:click="addNumber('{{ $i }}')" title="Adicionar esse número" class=" bg-gray-700 dark:text-gray-900 dark:bg-gray-100 hover:bg-gray-400">
        <span>{{ $i }}</span>
    </x-number-button>
    @endif