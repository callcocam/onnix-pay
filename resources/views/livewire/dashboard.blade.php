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

      <div class="flex h-[600px] w-full flex-col md:h-[800px]">
         <div class="relative flex h-72 w-full flex-col items-center justify-center bg-no-repeat" style="background-image: url(https://pixner.net/rifa1/demo/assets/images/bg/winner.jpg)">
            <div class="flex flex-col items-center py-10 md:max-w-[90%]">
               <h2 class="text-lg text-yellow-400">Os maiores ganhadores de rifas</h2>
               <h1 class="text-center text-4xl text-white md:text-6xl">DEZ ÚLTIMOS VENCEDORES</h1>
               <p class="text-center text-white">Ouve varios ganhadores, más alguns ganhadores tiveram mais sorte do que outros</p>
            </div>
            <div class="from-banner-secundary to-banner-primary absolute top-64 mx-auto h-80 w-full bg-gradient-to-t md:max-w-7xl">
               <div class="absolute -left-5 top-10">
                  <img src="https://pixner.net/rifa1/demo/assets/images/elements/car.png" alt="" />
               </div>
               <div class="absolute right-10 top-8">
                  <img src="https://pixner.net/rifa1/demo/assets/images/winner/w-1.png" alt="" class="mx-auto h-72 object-cover" />
                  <div class="flex w-64 -translate-y-full flex-col items-center rounded-t-2xl bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500 p-2">
                     <span class="text-white"> Claudio Campos</span>
                     <span class="text-purple-800"> O sorteio aconteceu no dia</span>
                     <span class="text-2xl font-bold text-white"> 19/04/2023 </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
               <div class="mb-5 flex flex-col rounded-lg bg-gradient-to-t from-indigo-500 to-indigo-700 p-3 text-white">
                  Os sorteios são baseados na <b>MEGA SENA</b> que ocorre toda a semana. Os participantes compram seus números, para determinar o vencedor, verificamos os números sorteados na
                  <b>MEGA SENA</b> quando encontramos uma ocorrencia sai o vencedor, isso ocorre na ordem que os números do concurso foram sorteados.
               </div>
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
      <div>

      </div>
   </div>
</div>