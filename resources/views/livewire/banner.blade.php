@if($banner = $this->banner)
<div class="w-full bg-cover bg-center shadow-lg bg-gradient-to-r from-indigo-800 from-5% via-sky-500 via-30% to-indigo-500 to-90%">
    <div class="flex items-center justify-center h-full flex-col ">
        <div class="text-center">
            <h1 class="text-white text-2xl font-semibold uppercase   flex flex-col mt-10">
                <span> {{ $banner->name }} </span>
                <span class="text-blue-900 dark:text-blue-200 shadow-amber-50 text-6xl mt-2 font-bold">
                    {{ $banner->description}}
                </span>
            </h1>
            <button type="button" wire:click="click" class="mt-4 px-6 py-4 rounded-full bg-blue-600 text-white text-lg uppercase font-medium hover:bg-blue-500 focus:outline-none focus:bg-blue-500 bg-gradient-to-r from-indigo-500">
                Participar Agora
            </button>
        </div>
        <div>
            <img src="{{ $banner->image_url }}" alt="" class="w-full h-full md:max-w-6xl object-cover">
        </div>
    </div>
</div>
@endif