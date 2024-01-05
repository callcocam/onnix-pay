<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />

    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @filamentStyles
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @stack('scripts')
</head>

<body class="relative" x-data="{}">
    <!-- <div class="preloader">
        <svg class="mainSVG" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <path id="puff" d="M4.5,8.3C6,8.4,6.5,7,6.5,7s2,0.7,2.9-0.1C10,6.4,10.3,4.1,9.1,4c2-0.5,1.5-2.4-0.1-2.9c-1.1-0.3-1.8,0-1.8,0
        s-1.5-1.6-3.4-1C2.5,0.5,2.1,2.3,2.1,2.3S0,2.3,0,4.4c0,1.1,1,2.1,2.2,2.1C2.2,7.9,3.5,8.2,4.5,8.3z" fill="#fff" />
                <circle id="dot" cx="0" cy="0" r="5" fill="#fff" />
            </defs>

            <circle id="mainCircle" fill="none" stroke="none" stroke-width="2" stroke-miterlimit="10" cx="400" cy="300" r="130" />
            <circle id="circlePath" fill="none" stroke="none" stroke-width="2" stroke-miterlimit="10" cx="400" cy="300" r="80" />

            <g id="mainContainer">
                <g id="car">
                    <path id="carRot" fill="#FFF" d="M45.6,16.9l0-11.4c0-3-1.5-5.5-4.5-5.5L3.5,0C0.5,0,0,1.5,0,4.5l0,13.4c0,3,0.5,4.5,3.5,4.5l37.6,0
      C44.1,22.4,45.6,19.9,45.6,16.9z M31.9,21.4l-23.3,0l2.2-2.6l14.1,0L31.9,21.4z M34.2,21c-3.8-1-7.3-3.1-7.3-3.1l0-13.4l7.3-3.1
      C34.2,1.4,37.1,11.9,34.2,21z M6.9,1.5c0-0.9,2.3,3.1,2.3,3.1l0,13.4c0,0-0.7,1.5-2.3,3.1C5.8,19.3,5.1,5.8,6.9,1.5z M24.9,3.9
      l-14.1,0L8.6,1.3l23.3,0L24.9,3.9z" />
                </g>
            </g>
        </svg>
    </div> -->
    <div class=" overflow-hidden relative ">
        <div class="from-banner-secundary to-banner-primary flex w-full flex-col bg-gradient-to-t to-90% @isset($maxHeight) {{ $maxHeight }} @endif">
            <header class="flex h-20 w-full items-center justify-center border-b border-purple-800">
                <div class="flex w-full md:max-w-7xl">
                    <ul class="mx-5 flex items-center space-x-5 text-purple-100">
                        <li class="flex items-center justify-center gap-2" x-data="{open:false}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                            </svg>
                            <span>Customer Support</span>
                        </li>
                    </ul>
                </div>
            </header>
            <div class="flex items-center justify-center">
                <nav class="mx-5 mt-6 flex w-full md:max-w-7xl items-center">
                    <div class="hidden w-2/12 md:flex">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="object-cover" />
                    </div>
                    <div class="flex w-full">
                        <livewire:navbar.desktop />
                    </div>
                </nav>
            </div>
            @isset($header)
            {{ $header }}
            @endisset
        </div>
        <x-content>
            {{ $slot }}
        </x-content>
        <footer class="footer-section rounded-t-full">
            <div class="flex items-center justify-center z-20">
                <div class=" subscribe-area lg:max-w-5xl lg:w-full">
                    <div class="left   flex flex-col mt-5">
                        <span class="subtitle">Inscreva-se</span>
                        <h3 class="title text-sm">Para obter benefícios exclusivos</h3>
                    </div>
                    <div class="right">
                        <form class="subscribe-form">
                            <input type="email" name="subscribe_email" placeholder="Enter Your Email">
                            <button type="submit">Subscribe</button>
                        </form>
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
    </div>
    @livewire('notifications')
    @filamentScripts
    <script>
        document.addEventListener('livewire:initialized', () => {
            Alpine.store("darkMode", {
                on: Alpine.$persist(true).as("darkMode_on"),
                toggle() {
                    this.on = !this.on;
                },
            })

            Alpine.store("navibar", {
                on: Alpine.$persist(false).as("open"),
                toggle() {
                    this.on = !this.on;
                },
            })

            Alpine.store("sidebar", {
                on: Alpine.$persist(false).as("open"),
                close() {
                    this.on = false;
                },
                open() {
                    this.on = true;
                },
            })
        });
    </script>
    @stack('scripts')
</body>

</html>