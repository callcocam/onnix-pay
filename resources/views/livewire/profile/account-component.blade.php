<div>
    <form wire:submit.prevent='updateUserProfile' class="w-full">
        {{ $this->form }}
        <div class="flex items-center justify-end border rounded-md mt-2 p-4">
            <button type="submit" class="bg-primary/90 flex items-center justify-center w-full px-6 py-2 text-base font-medium text-white border border-transparent rounded-full shadow-sm  hover:bg-primary">
                Salvar alterações
            </button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>