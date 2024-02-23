<div class="flex flex-col">
   @if($banner = $this->banner)
   <x-slot name="header">
      <livewire:banner :banner="$banner" />
   </x-slot>
   @endif
   <div class="flex w-full flex-col items-center justify-center">
      <div class="md:my-16 flex flex-col">
         <x-help />
         <!-- CUURENT CONTEST -->
         <div class="w-ful my-16 flex md:mx-auto md:max-w-7xl">
            <div class="flex w-full flex-col justify-center">
               <div class="flex w-full flex-col items-center justify-center">
                  <p class="text-lg text-yellow-400">Tente sua chance de ganhar</p>
                  <h2 class="py-4 text-center text-4xl font-bold text-slate-700 md:text-6xl">RIFA ATUAL</h2>
                  <p class="text-center font-sans text-slate-500">Os participantes compram seus números, para determinar os vencedores, o sorteio e baseado na <b>MEGA SENA</b>. </br>
                     Que ocorre toda a semana</p>
                  <div class="mt-10 flex w-full items-center justify-center space-x-5">
                     <button type="button" class="rounded-full bg-gradient-to-t from-purple-500 to-yellow-300 px-2 py-3 text-white md:w-52">
                        <span>CARRO DOS DONHOS</span>
                     </button>
                     <button type="button" class="rounded-full bg-gradient-to-l from-purple-700 to-purple-400 px-2 py-3 text-white md:w-52">
                        <span>ESTILO DE VIDA</span>
                     </button>
                  </div>
               </div>
               <livewire:rifas.rifas-component limit="3" />
            </div>
         </div>
      </div>

      <livewire:top-winner-component />

      <div class="mx-auto flex w-full flex-col items-center justify-center md:max-w-7xl">
         <div class="mb-4 flex w-full flex-col items-center space-y-2 text-center md:text-left">
            <h2 class="text-yellow-500">Conheça os últimos vencedores do seu concurso favorito</h2>
            <h1 class="text-4xl font-bold text-slate-500 md:text-6xl">ÚLTIMOS VENCEDORES</h1>
            <p>Verifique o número do seu bilhete para ver se você é um ganhador do AFORTUNADOS DA SORTE.</p>
         </div>
         <div class="flex w-full mb-10 h-36 flex-col items-center overflow-hidden border-b md:max-w-7xl md:flex-row md:justify-between">
            <button class="flex w-full flex-col items-center border-b-4 border-orange-500 py-6">
               <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/1.png" alt="DREAM CAR" />
               <span>CARRO DO SONHOS</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
               <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/2.png" alt="Bike" />
               <span>MOTO</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
               <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/3.png" alt="WATCH" />
               <span>RELOGIO</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
               <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/4.png" alt="LEPTOP" />
               <span>NOTBOOK</span>
            </button>
            <button class="flex w-full flex-col items-center py-4">
               <img src="https://pixner.net/rifa1/demo/assets/images/icon/winner-tab/5.png" alt="MONEY" />
               <span>DINHEIRO</span>
            </button>
         </div>
         <div class="mx-auto flex w-full flex-col md:max-w-7xl md:flex-row md:space-x-4">
            <div class="w-full md:w-2/6"> 
            </div>
            <div class="w-full flex-col md:w-4/6">
               @if($this->winners->count() > 0)
               @foreach($this->winners as $winner)
               @livewire('winner-component', ['winner' => $winner], key($winner->id))
               @endforeach
               @else
               <div class="flex w-full flex-col items-center justify-center">
                  <p class="text-2xl text-gray-500">Nenhum vencedor encontrado</p>
               </div>
               @endif
            </div>
         </div>
      </div> 
   </div>
</div>