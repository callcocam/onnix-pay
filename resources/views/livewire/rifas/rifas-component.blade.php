 <div class="mt-10 grid grid-cols-1 gap-3 rounded p-4 text-center md:grid-cols-3">
     @if($rifas = $this->rifas)
        @foreach($rifas as $rifa)
         <livewire:rifas.rifa-component :rifa="$rifa" :key="$rifa->id" />
        @endforeach
     <div class="col-span-full">
         {{ $rifas->links( ) }}
     </div>
     @endif
 </div>