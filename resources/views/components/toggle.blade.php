<style>
    /* CHECKBOX TOGGLE SWITCH */
    /* @apply rules for documentation, these do not work as inline style */
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        /*border-color: red;*/
    }
    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: rgba(0,0,0,0.1);
    }

    #{{$attributes['wire:model']}}:checked{
        @apply: bg-gray-100;
        background-color: limegreen;

    }
</style>
@props(['label' => false, 'hidden' => false])
<div>
    <span  class="text-sm hidden text-gray-700">{{__(str_replace('_',' ',$attributes['wire:model']))}}</span>
</div>

<div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
    <input type="checkbox" wire:model="{{$attributes['wire:model']}}"   id="{{$attributes['wire:model']}}" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
    <label for="{{$attributes['wire:model']}}" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer dark:text-gray-200"></label>
</div>
<label for="{{$attributes['wire:model']}}" class="text-xs {{ $hidden ? 'hidden' : '' }} text-gray-700 dark:text-gray-200">{{__(str_replace('_',' ',$attributes['wire:model']))}}</label>
