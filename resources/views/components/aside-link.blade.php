@props(['active' => false])

<a {{ $attributes }} class="flex items-center p-3 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
    {{ $slot }}
</a>