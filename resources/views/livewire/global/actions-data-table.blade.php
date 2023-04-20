@if (in_array('show', $requiredActions))
    @if ($row->status == 'active')
        <x-jet-danger-button variant="danger" wire:click="deactivate({{ $row->id }})">
            {{ __('DeActivate') }}
        </x-jet-danger-button>
    @else
        <x-button variant="success" wire:click="activate({{ $row->id }})">
            {{ __('Activate') }}
        </x-button>
    @endif
@endif

@if (in_array('edit', $requiredActions))
    <button wire:click.prefetch="openEditPage({{ $row->id }})" class="btn bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500 px-2.5 py-1.5 text-sm">Edit
    </button>
    {{-- <a href="{{ route('admin.blogs.edit') }}" class="btn btn-success  mb-2 mt-5">Edit</a> --}}
@endif
@if (in_array('delete', $requiredActions))
    <x-button variant="warning" size="sm" wire:click="deleteCheck({{ $row->id }})">
        {{ __('Delete') }}
    </x-button>
@endif
