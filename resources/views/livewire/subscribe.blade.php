<form class="subscribe-form" wire:submit.prevent="sendSubscribe">
    <input type="email" name="subscribe_email" wire:model="email" placeholder="Informe seu e-mail">
    <button class="z-50" type="submit">Inscrever-se</button>
    @error('email') <span class="error text-red-500 dark:text-red-200">{{ $message }}</span> @enderror
</form>