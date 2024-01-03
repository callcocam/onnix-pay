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

<body x-data="{}" :class="$store.darkMode && $store.darkMode.on ? 'dark' : ''">
    <div>
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