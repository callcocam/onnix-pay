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

<body class="relative" x-data="{}" :class="$store.darkMode && $store.darkMode.on ? 'dark' : ''">
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
        <div class="from-banner-secundary to-banner-primary flex min-h-screen w-full flex-col bg-gradient-to-t to-90%">
            <header class="flex h-20 w-full items-center justify-center border-b border-purple-800">
                <div class="flex w-full md:max-w-7xl">
                    <ul class="mx-5 flex items-center space-x-5 text-purple-100">
                        <li class="flex items-center justify-center gap-2" x-data="{open:false}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                            </svg>
                            <span>Customer Support</span>
                        </li>
                        <li>
                            <div class="relative inline-block text-left">
                                <div>
                                    <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md px-2 py-2 text-sm font-semibold text-purple-100 shadow-sm ring-inset" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        En
                                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
                                <div class="absolute right-0 z-10 mt-2 hidden w-56 origin-top-right rounded-md ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1" role="none">
                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                                        <form method="POST" action="#" role="none">
                                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
            <div class="flex items-center justify-center">
                <nav class="mx-5 mt-6 flex w-full md:max-w-7xl items-center">
                    <div class="hidden w-2/12 md:flex">
                        <img src="https://pixner.net/rifa1/demo/assets/images/logo.png" alt="Logo" class="object-cover" />
                    </div>
                    <div class="flex w-full">
                        <ul class="flex w-full flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:justify-center  md:space-x-16 px-4 font-bold text-purple-200">
                            <li>
                                <a href=""> HOME </a>
                            </li>
                            <li>
                                <a href=""> CONTEST </a>
                            </li>
                            <li>
                                <a href=""> WINNERS </a>
                            </li>
                            <li>
                                <a href=""> CONTACT </a>
                            </li>
                            <li class="w-full  md:w-64 text-center flex items-center justify-center">
                                <a href="" class="from-banner-secundary to-banner-primary flex items-center  rounded-full bg-gradient-to-r px-8 py-2 shadow-md shadow-white w-full">
                                    <div class="flex items-center justify-center space-x-3 w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 -rotate-45">
                                            <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                                        </svg>
                                        <span>BUY TICKTS</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
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
                            <li><a href="#0">Abount</a></li>
                            <li><a href="#0">FAQs</a></li>
                            <li><a href="#0">Contact</a></li>
                            <li><a href="#0">Terms of Services</a></li>
                            <li><a href="#0">Privacy</a></li>
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