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
                    <div class="flex lg:ml-6">
                        <a href="#" @click="()=>{ if($store.darkMode){ $store.darkMode.toggle()} }" class="p-2 text-gray-400 hover:text-gray-500 dark:text-gray-100">
                            <span class="sr-only">Search</span>
                            <!-- sun-->
                            <svg x-cloak x-show="$store.darkMode && $store.darkMode.on" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>

                            <!-- moon-->
                            <svg x-show="$store.darkMode && !$store.darkMode.on" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </a>
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
        
    @livewire('footer')
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