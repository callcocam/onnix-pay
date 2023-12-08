@props(['label', 'active'=>false])
<a {{$attributes->merge(['class'=>'hover:text-gray-800 dark:hover:text-gray-400'])}}>{{ $label }}</a>