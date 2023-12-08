<header>
    <p class="flex items-center justify-center h-10 px-4 text-sm font-medium text-white bg-primary sm:px-6 lg:px-8">
        Get free delivery on orders over $100
    </p>

    <nav aria-label="Top" class=" w-full bg-slate-50 dark:bg-navy-900">
        <div class="border-b border-gray-200 border-opacity-20  sticky top-1">
            <div class="flex items-center h-20 px-4 mx-auto max-w-full md:max-w-7xl sm:px-6 lg:px-8">
                <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                <button @click="$store.sidebar.open()" type="button" class="p-2 text-gray-400 bg-white rounded-md dark:text-white dark:bg-gray-800 lg:hidden">
                    <span class="sr-only">Open menu</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Logo -->
                <div class="flex ml-4 lg:ml-0">
                    <a href="#">
                        <span class="sr-only">Your Company</span>
                        <img class="w-auto h-8" src="{{ asset(config('tenant.logo', 'logo2.png')) }}" alt="">
                    </a>
                </div>

                <!-- Flyout menus -->
                <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                    <div class="flex h-full justify-between">
                        <x-navbar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Início</x-navbar-link>
                        <x-navbar-link href="{{ route('rifas.list') }}" :active="request()->routeIs('rifas.list')">Rifas</x-navbar-link>
                        <x-navbar-link href="{{ route('about') }}" :active="request()->routeIs('about')">Sobre Nós</x-navbar-link>
                        <x-navbar-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contato</x-navbar-link>
                    </div>
                </div>

                <div class="flex items-center ml-auto">
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="flex items-center text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="text-sm font-medium">Sair</span>
                            </a>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="flex items-center text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400">
                            <span class="text-sm font-medium">Entrar</span>
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="flex items-center text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400">
                            <span class="text-sm font-medium">Cadastrar</span>
                        </a>
                        @endif
                        @endauth
                    </div>

                    <div class="hidden lg:ml-8 lg:flex">
                        <a href="#" class="flex items-center text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400">
                            <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="flex-shrink-0 block w-5 h-auto">
                            <span class="block ml-3 text-sm font-medium">CAD</span>
                            <span class="sr-only">, change currency</span>
                        </a>
                    </div>

                    <!-- Search -->
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
                    @auth
                    <!-- Cart -->
                    <div class="flow-root ml-4 lg:ml-6">
                        <a href="#" @click="$dispatch('open-modal', {id: 'cart'})" class="flex items-center p-2 -m-2 group">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-100" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-gray-800 dark:hover:text-gray-400 dark:group-hover:text-gray-100">{{ count($cart) }}</span>
                            <span class="sr-only">items in cart, view bag</span>
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>