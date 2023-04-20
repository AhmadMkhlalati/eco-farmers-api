@section('title', 'Leads')
<x-card>
    <x-slot name="title">
        {{ __('Leads') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}

    </x-slot>
    <x-slot name="actions">
    </x-slot>
    <x-slot name="body">
        <livewire:contact-us.contact-us-data-table />
    </x-slot>
</x-card>
