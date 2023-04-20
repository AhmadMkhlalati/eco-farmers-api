@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 dark:text-gray-400">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="px-2 py-2">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-dark-eval-3 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
