@section('title', 'News')
<x-card>
    <x-slot name="title">
        {{ __('News') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.blog.form') }}"
            style="background-color:#AA6949"
                class="btn  text-white">{{ __('Create News') }}</a>
        </div>
    </x-slot>
    <x-slot name="body">
        <livewire:blogs.blogs-data-table />
    </x-slot>
</x-card>
