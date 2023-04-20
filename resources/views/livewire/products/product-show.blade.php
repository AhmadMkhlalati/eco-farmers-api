@section('title', 'Products')
<x-card>
    <x-slot name="title">
        {{ __('Products') }}
    </x-slot>
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.product.form') }}" style="background-color:#AA6949"
                class="btn text-white">{{ __('Create Product') }}</a>
        </div>
    </x-slot>
    <x-slot name="body">
        <livewire:products.product-data-table />
    </x-slot>
</x-card>
