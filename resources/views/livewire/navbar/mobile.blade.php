<div class="relative z-40 lg:hidden" 
    x-show="$store.sidebar && $store.sidebar.on"
    x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-25"   
                @click="$store.sidebar.close()" 
        x-show="$store.sidebar && $store.sidebar.on"
        x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        aria-hidden="true"
    ></div>

    <div class="fixed inset-0 z-40 flex">
        <div class="relative flex flex-col w-full max-w-xs pb-12 overflow-y-auto bg-slate-50 dark:bg-navy-900 shadow-xl">
            <div class="flex px-4 pt-5 pb-2">
                <button
                @click="$store.sidebar.close()"
                 type="button" class="inline-flex items-center justify-center p-2 -m-2 text-gray-400 rounded-md dark:text-white">
                    <span class="sr-only">Close menu</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Links -->
            <div class="mt-2" x-data="{tab:'tabs-1-tab-1'}">
                <div class="border-b border-gray-200" >
                    <div class="flex px-4 -mb-px space-x-8" aria-orientation="horizontal" role="tablist">
                        <button id="tabs-1-tab-1" class="flex-1 px-1 py-4 text-base font-medium text-gray-900 border-b-2 border-transparent dark:text-gray-100 whitespace-nowrap" aria-controls="tabs-1-panel-1" role="tab" type="button">Women</button>
                        <button id="tabs-1-tab-2" class="flex-1 px-1 py-4 text-base font-medium text-gray-900 border-b-2 border-transparent dark:text-gray-100 whitespace-nowrap" aria-controls="tabs-1-panel-2" role="tab" type="button">Men</button>
                    </div>
                </div>

                <!-- 'Women' tab panel, show/hide based on tab state. -->
                <div id="tabs-1-panel-1" class="px-4 pt-10 pb-8 space-y-10" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                    <div class="grid grid-cols-2 gap-x-4">
                        <div class="relative text-sm group">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-cover object-center">
                            </div>
                            <a href="#" class="block mt-6 font-medium text-gray-900 dark:text-gray-100">
                                <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                New Arrivals
                            </a>
                            <p aria-hidden="true" class="mt-1">Shop now</p>
                        </div>
                        <div class="relative text-sm group">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-cover object-center">
                            </div>
                            <a href="#" class="block mt-6 font-medium text-gray-900 dark:text-gray-100">
                                <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                Basic Tees
                            </a>
                            <p aria-hidden="true" class="mt-1">Shop now</p>
                        </div>
                    </div>
                    <div>
                        <p id="women-clothing-heading-mobile" class="font-medium text-gray-900 dark:text-gray-100">
                            Clothing</p>
                        <ul role="list" aria-labelledby="women-clothing-heading-mobile" class="flex flex-col mt-6 space-y-6">
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Tops</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Dresses</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Pants</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Denim</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Sweaters</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">T-Shirts</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Jackets</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Activewear</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Browse
                                    All</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <p id="women-accessories-heading-mobile" class="font-medium text-gray-900 dark:text-gray-100">Accessories</p>
                        <ul role="list" aria-labelledby="women-accessories-heading-mobile" class="flex flex-col mt-6 space-y-6">
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Watches</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Wallets</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Bags</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Sunglasses</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Hats</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Belts</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <p id="women-brands-heading-mobile" class="font-medium text-gray-900 dark:text-gray-100">
                            Brands</p>
                        <ul role="list" aria-labelledby="women-brands-heading-mobile" class="flex flex-col mt-6 space-y-6">
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Full
                                    Nelson</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">My
                                    Way</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Re-Arranged</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Counterfeit</a>
                            </li>
                            <li class="flow-root">
                                <a href="#" class="block p-2 -m-2 text-gray-500 dark:text-gray-100">Significant Other</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="px-4 py-6 space-y-6 border-t border-gray-200">
                <div class="flow-root">
                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900 dark:text-gray-100">Company</a>
                </div>
                <div class="flow-root">
                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900 dark:text-gray-100">Stores</a>
                </div>
            </div>

            <div class="px-4 py-6 space-y-6 border-t border-gray-200">
                <div class="flow-root">
                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900 dark:text-gray-100">Sign
                        in</a>
                </div>
                <div class="flow-root">
                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900 dark:text-gray-100">Create
                        account</a>
                </div>
            </div>

            <div class="px-4 py-6 border-t border-gray-200">
                <a href="#" class="flex items-center p-2 -m-2">
                    <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="flex-shrink-0 block w-5 h-auto">
                    <span class="block ml-3 text-base font-medium text-gray-900 dark:text-gray-100">CAD</span>
                    <span class="sr-only">, change currency</span>
                </a>
            </div>
        </div>
    </div>
</div>