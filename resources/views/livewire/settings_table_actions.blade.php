@if($row->status=='active')
    <x-jet-danger-button variant="danger" wire:click="desactivate({{$row->id}})" >
        {{ __('DeActivate') }}
    </x-jet-danger-button>
@else
    <x-jet-button class="bg-green-500 dark:bg-green-500 hover:bg-green-600" wire:click="activate({{$row->id}})" >
        {{ __('Activate') }}
    </x-jet-button>
@endif
