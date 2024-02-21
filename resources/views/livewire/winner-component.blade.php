<div class="mb-5 flex w-full flex-col md:flex-row">
    <div class="to-banner-primary from-banner-secundary flex w-full items-center bg-gradient-to-t px-2 py-4 md:w-64">
        <img src="https://pixner.net/rifa1/demo/assets/images/win-car/4.png" alt="image" class="mx-auto flex md:h-24" />
    </div>
    <div class="relative flex w-full flex-col justify-center bg-gradient-to-t from-pink-400 to-indigo-500 px-2 py-4">
        <div class="mx-auto md:absolute md:-translate-x-10"><img src="https://pixner.net/rifa1/demo/assets/images/winner/4.png" alt="image" /></div>
        <div class="flex w-full justify-around border-b text-center">
            <div class="left my-5">
                <h5 class="text-2xl text-white">The Breeze Zodiac IX</h5>
            </div>
            <div class="right my-5">
                <span class="text-sm font-bold text-green-500">O sorteio aconteceu no dia</span>
                <p class="text-xl text-white md:text-2xl">{{ now()->subDays(rand(2,20))->format("D d M , Y") }} </p>
            </div>
        </div>
        <div class="flex w-full flex-col items-center md:flex-row md:justify-around">
            <div class="flex flex-col">
                <p class="text-lg text-white md:ml-4">Winning Numbers:</p>
                <ul class="mt-2 flex space-x-2 md:w-full">
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">88</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">11</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">23</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">9</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">19</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">26</li>
                    <li class="tetx-sm flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-t from-red-600 to-yellow-400 text-lg font-bold text-white md:h-12 md:w-12">87</li>
                </ul>
                <!-- number-list end -->
            </div>
            <div class="flex flex-col items-center">
                <p class="text-white">Contest No:</p>
                <span class="text-xl font-bold text-white">B2T</span>
            </div>
        </div>
    </div>
</div>