<footer class="footer-section rounded-t-full">
    <div class="flex items-center justify-center z-20">
        <div class=" subscribe-area lg:max-w-5xl lg:w-full">
            <div class="left   flex flex-col mt-5">
                <span class="subtitle">Inscreva-se</span>
                <h3 class="title text-sm">Para obter benefícios exclusivos</h3>
            </div>
            <div class="right">
                @livewire('subscribe')
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-2 items-center justify-center pt-120">
        <div class="row pb-5 align-items-center">
            <div class="flex items-center justify-center my-4">
                <ul class="app-btn">
                    <li><a href="#0"><img src="https://pixner.net/rifa1/demo/assets/images/icon/store-btn/1.png" alt="image"></a></li>
                    <li><a href="#0"><img src="https://pixner.net/rifa1/demo/assets/images/icon/store-btn/2.png" alt="image"></a></li>
                </ul>
            </div>
            <div class="flex my-4">
                <ul class="flex  short-links md:justify-end justify-center">
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
                    <li>
                        <a href="{{ route('privacy') }}" active="{{request()->routeIs('privacy')}}"> Politica </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" active="{{request()->routeIs('terms')}}"> Termos </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row py-5 align-items-center">
            <div class="col-lg-6">
                <p class="copy-right-text text-lg-left text-center mb-lg-0 mb-3 text-white">Copyright © 2023.All Rights Reserved By <a href="index.html">Rifa</a></p>
            </div>

        </div>
    </div>
</footer>