<div class="flex w-full flex-col p-8">
   <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
   <div class="flex flex-col w-full">
      <div class="hidden sm:block">
         <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
               <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
               <a href="{{ route('profile.show', ['v'=>'account']) }}" @class([ 'border-indigo-500 text-indigo-600 group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium'=> $view === 'account',
                  'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium' => $view === 'orders'
                  ])
                  >
                  <!-- Current: "text-indigo-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                  <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                     <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                  </svg>
                  <span>Minha conta</span>
               </a>
               <a href="{{ route('profile.show', ['v'=>'orders']) }}" @class([ 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium'=> $view === 'account',
                  'border-indigo-500 text-indigo-600 group inline-flex items-center border-b-2 py-4 px-1 text-sm font-medium' => $view === 'orders'
                  ])>
                  <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                     <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z" clip-rule="evenodd" />
                  </svg>
                  <span>Meus pedidos</span>
               </a>
            </nav>
         </div>
      </div>
   </div>
   @livewire(sprintf('profile.%s-component', $view))
</div>