<ul class="flex w-full  flex-row items-start md:items-center justify-between  md:justify-center space-x-2 md:space-x-16 px-4 font-bold text-purple-200">
    <li>
        <a href="{{ route('dashboard') }}" active="{{request()->routeIs('dashboard')}}"> Início </a>
    </li>
    <li>
        <a href="{{ route('rifas.list') }}" active="{{request()->routeIs('rifas.list')}}"> Rifas </a>
    </li>
    <li>
        <a href="{{ route('about') }}" active="{{request()->routeIs('about')}}"> Sobre Nós </a>
    </li>
    <li>
        <a href="{{ route('contact') }}" active="{{request()->routeIs('contact')}}"> Contato </a>
    </li>
    <!-- <li class="w-full  md:w-64 text-center flex items-center justify-center">
        <a href="" class="from-banner-secundary to-banner-primary flex items-center  rounded-full bg-gradient-to-r px-8 py-2 shadow-md shadow-white w-full">
            <div class="flex items-center justify-center space-x-3 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 -rotate-45">
                    <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                </svg>
                <span>BUY TICKTS</span>
            </div>
        </a>
    </li> -->
</ul>