<div wire:init='init'>
    <x-filament::modal id="checkout" :slideOver="true" width="xl">
        <x-slot name="heading">Checkout</x-slot>
        <div>
            <form wire:submit.prevent='submit'>
                {{ $this->form }}
            </form>
        </div>
    </x-filament::modal>
</div>