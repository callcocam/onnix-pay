<x-filament-panels::page>
    <form wire:submit="save" class="flex flex-col gap-y-2">
        {{ $this->form }}

        <div class="mt-5 flex items-center justify-end">
            <x-filament::button type="submit" size="sm">
                Salvar Alterações
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>