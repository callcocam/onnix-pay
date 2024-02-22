 
<div class="border-t border-gray-200 py-2">
    <button type="button" {{ $attributes->merge(['class'=>'mx-auto flex h-8 w-8 items-center justify-center rounded-full font-semibold   text-white']) }}  >
        <span>{{ $slot }}</span>
    </button>
</div>