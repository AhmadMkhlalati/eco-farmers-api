    <x-button variant="success" size="sm" wire:click.prefetch="openShowPage({{ $row->id }})">
        {{ __('Show') }}
    </x-button>
    <x-button variant="warning" size="sm" wire:click="deleteCheck({{ $row->id }})">
        {{ __('Delete') }}
    </x-button>
