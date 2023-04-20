@section('title', 'Projects')
<x-card>
    <x-slot name="title">
        {{ __('Projects') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.project.form') }}" style="background-color:#AA6949"
                class="btn text-white">{{ __('Create Project') }}</a>
        </div>
    </x-slot>
    <x-slot name="body">
        <livewire:projects.projects-datatable />
    </x-slot>
</x-card>
