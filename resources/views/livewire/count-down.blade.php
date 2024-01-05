<div class="flex items-center justify-around  h-16" wire:poll.1000ms>
    @if($diffDays = $this->diffDays)
    <div class="flex flex-col items-center">
        <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">{{ data_get($diffDays, 'days') }}</span>
        <span class="text-white font-bold">DIAS</span>
    </div>
    <div class="flex flex-col items-center">
        <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">{{ data_get($diffDays, 'hours') }}</span>
        <span class="text-white font-bold">HORAS</span>
    </div>
    <div class="flex flex-col items-center">
        <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg">{{ data_get($diffDays, 'minutes') }}</span>
        <span class="text-white font-bold">MINUTOS</span>
    </div>
    <div class="flex flex-col items-center">
        <span class="text-yellow-400 text-4xl font-extrabold shadow-purple-400 drop-shadow-lg" >{{ data_get($diffDays, 'seconds') }}</span>
        <span class="text-white font-bold">SEGUNDOS</span>
    </div>
    @endif
</div>