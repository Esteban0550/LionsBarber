@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-amber-500 text-start text-base font-medium text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-900/30 focus:outline-none focus:text-amber-800 dark:focus:text-amber-200 focus:bg-amber-100 dark:focus:bg-amber-900/50 focus:border-amber-600 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 focus:outline-none focus:text-neutral-900 dark:focus:text-neutral-100 focus:bg-neutral-100 dark:focus:bg-neutral-700 focus:border-neutral-300 dark:focus:border-neutral-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
