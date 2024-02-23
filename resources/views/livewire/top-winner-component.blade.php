@if($topWinner)
<div class="flex h-[600px] w-full flex-col md:h-[800px]"> 
    <div class="relative flex h-72 w-full flex-col items-center justify-center bg-no-repeat" style="background-image: url(https://pixner.net/rifa1/demo/assets/images/bg/winner.jpg)">
        <div class="flex flex-col items-center py-10 md:max-w-[90%]">
            <h2 class="text-lg text-yellow-400">Os maiores ganhadores de rifas</h2>
            <h1 class="text-center text-4xl text-white md:text-6xl">TOP VENCEDOR</h1>
            <p class="text-center text-white">Ouve varios ganhadores, más alguns ganhadores tiveram mais sorte do que outros</p>
        </div>
        <div class="from-banner-secundary to-banner-primary absolute top-64 mx-auto h-80 w-full bg-gradient-to-t md:max-w-7xl">
            <div class="absolute -left-5 top-10">
                <img src="{{ $rifa->image_url }}" alt="{{ $rifa->name }}" class="object-cover"/>
            </div>
            <div class="absolute flex flex-col right-10 items-center justify-center top-8">
                <img src="{{ $user->profile_photo_url }}" alt="" class="mx-auto h-72 object-contain rounded-full p-8" />
                <div class="flex w-64 -translate-y-full flex-col items-center rounded-t-2xl bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-500 p-2">
                    <span class="text-white"> {{ $user->name }}</span>
                    <span class="text-purple-800"> O sorteio aconteceu no dia</span>
                    <span class="text-2xl font-bold text-white"> {{ $contest->drawn }} </span>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div>

</div>
@endif