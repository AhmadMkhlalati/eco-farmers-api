@section('title', 'Categories')
<x-card>
    <x-slot name="title">
        {{ __('Categories') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.category.form') }}" style="background-color:#AA6949"
                class="btn text-white">{{ __('Create Category') }}</a>
        </div>
    </x-slot>
    <x-slot name="body">
        <livewire:category.category-data-table />
    </x-slot>
</x-card>
