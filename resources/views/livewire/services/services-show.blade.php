@section('title', 'Services')
<x-card>
    <x-slot name="title">
        {{ __('Services') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.service.form') }}"
            style="background-color:#AA6949"
                class="btn text-white">{{ __('Create Service') }}</a>
        </div>
    </x-slot>
    <x-slot name="body">
        <livewire:services.services-data-table />
    </x-slot>
</x-card>
