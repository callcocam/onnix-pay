<div class="flex" x-data>
    <div class="relative flex">
        <!-- Item active: "border-primary-600 text-primary-600", Item inactive: "border-transparent text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400" -->
        <button @click="$store.navibar.toggle()" type="button" :class="$store.navibar && $store.navibar.on ? 'border-primary text-primary' : 'border-transparent text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400'" class="relative z-10 flex items-center pt-px -mb-px text-sm font-medium text-gray-700 transition-colors duration-200 ease-out border-b-2 " aria-expanded="false">Women</button>
    </div>

    <div x-show="$store.navibar && $store.navibar.on" class="absolute inset-x-0 text-sm text-gray-500 dark:text-gray-100 top-full z-30 shadow-lg " x-cloak>
        <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
        <div class="absolute inset-0 bg-white shadow dark:bg-gray-800 top-1/2" aria-hidden="true"></div>

        <div class="relative bg-slate-50 dark:bg-navy-800">
            <div class="px-8 mx-auto max-w-7xl">
                <div class="grid grid-cols-2 py-16 gap-x-8 gap-y-10">
                    <div class="grid grid-cols-2 col-start-2 gap-x-8">
                        <div class="relative text-base group sm:text-sm">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-cover object-center">
                            </div>
                            <a href="#" class="block mt-6 font-medium text-gray-900 dark:text-gray-100">
                                <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                                New Arrivals
                            </a>
                            <p aria-hidden="true" class="mt-1">Shop now</p>
                        </div>
                        <div class="relative text-base group sm:text-sm">
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
                    <div class="grid grid-cols-3 row-start-1 text-sm gap-x-8 gap-y-10">
                        <div>
                            <p id="Clothing-heading" class="font-medium text-gray-900 dark:text-gray-100">
                                Clothing</p>
                            <ul role="list" aria-labelledby="Clothing-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                <li class="flex">
                                    <x-link href="#" label="Tops" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Dresses" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Pants" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Denim" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Sweaters" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="T-Shirts" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Jackets" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Activewear" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Browse All" />
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p id="Accessories-heading" class="font-medium text-gray-900 dark:text-gray-100">
                                Accessories</p>
                            <ul role="list" aria-labelledby="Accessories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                <li class="flex">
                                    <x-link href="#" label="Watches" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Wallets" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Bags" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Sunglasses" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Hats" />
                                </li>
                                <li class="flex">
                                    <x-link href="#" label="Belts" />
                                </li>
                            </ul>
                        </div>
                        <div>
                            <p id="Brands-heading" class="font-medium text-gray-900 dark:text-gray-100">
                                Brands</p>
                            <ul role="list" aria-labelledby="Brands-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                <li class="flex">
                                    <a href="#" class="hover:text-gray-800 dark:hover:text-gray-400">Full
                                        Nelson</a>
                                </li>
                                <li class="flex">
                                    <a href="#" class="hover:text-gray-800 dark:hover:text-gray-400">My
                                        Way</a>
                                </li>
                                <li class="flex">
                                    <a href="#" class="hover:text-gray-800 dark:hover:text-gray-400">Re-Arranged</a>
                                </li>
                                <li class="flex">
                                    <a href="#" class="hover:text-gray-800 dark:hover:text-gray-400">Counterfeit</a>
                                </li>
                                <li class="flex">
                                    <a href="#" class="hover:text-gray-800 dark:hover:text-gray-400">Significant
                                        Other</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>