 
<div class="border-t border-gray-200 py-1">
    <button type="button" {{ $attributes->merge(['class'=>'mx-auto flex h-10 w-10 items-center justify-center rounded-full font-semibold   text-white']) }}  >
        <span>{{ $slot }}</span>
    </button>
</div>