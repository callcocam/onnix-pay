 <div class="mt-10 grid grid-cols-1 gap-3 rounded p-4 text-center md:grid-cols-3">
     <div class="mx-auto flex w-full flex-col items-center justify-center md:max-w-7xl col-span-full">
         <div class="mb-4 flex w-full flex-col items-center space-y-2 text-center md:text-left">
             <h2 class="text-yellow-500">Conheça os premios disponiveis</h2>
             <h1 class="text-2xl font-bold text-slate-500 md:text-4xl">CONCORRA A SUPER PRÊMIOS</h1>
             <p>Verifique os prêmios disponíveis e participe do sorteio.</p>
         </div>
         @if($this->catecorias->count() > 0)
         <div class="flex w-full mb-10 h-36 flex-col items-center overflow-hidden border-b md:max-w-7xl md:flex-row md:justify-between">
             @foreach($this->catecorias as $categoria)
             <a class="flex w-full flex-col items-center  py-6" href="{{ route('rifas.list', ['category'=>$categoria->slug])}}">
                 <img src="{{ Storage::url($categoria->image) }}" alt="{{ $categoria->name }}" class="object-contain h-24 w-24" />
                 <span class="uppercase">{{ $categoria->name }}</span>
             </a>
             @endforeach
             <!-- <button class="flex w-full flex-col items-center py-4 border-b-4 border-orange-500">
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
             </button> -->
         </div>
         @endif
     </div>
     @if($rifas = $this->rifas)
     @foreach($rifas as $rifa)
     <livewire:rifas.rifa-component :rifa="$rifa" :key="$rifa->id" />
     @endforeach
     <div class="col-span-full">
         {{ $rifas->links( ) }}
     </div>
     @endif
 </div>