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
    <div id="root" class="min-h-100vh flex flex-col w-full grow bg" x-cloak>
        <livewire:navbar />
        @isset($header)
        {{ $header }}
        @endisset
        {{ $slot }}
        @auth
        <livewire:cart />
        <livewire:checkout />
        @endauth
        <livewire:footer />
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
</body>

</html>