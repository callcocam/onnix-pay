@props(['active'=>false])
<a  {{ $attributes }} 
 @class([
    'flex items-center text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-400 px-3',
    'bg-gray-900 text-white' => $active,
])
>
    {{ $slot }}
</a>