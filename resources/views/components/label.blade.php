@props(['label' => false])
<label {{ $attributes }} class="block text-sm font-medium text-gray-700">{{ $label ?? $slot }}</label>