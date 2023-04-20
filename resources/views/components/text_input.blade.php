@props(['label' => false, 'type' => 'text'])
@if($label)
    <div class="form-group">
        <label class="cursor-pointer block" for="{{$attributes['wire:model']}}">
            @if(is_string($label))
                {{$label}}
            @else
                {{__(str_replace('_',' ',$attributes['wire:model']))}}
            @endif
        </label>
        <input id="{{$attributes['wire:model']}}"
               type="{{$type}}" {{$attributes->merge(['class' => 'border border-gray-200 focus:outline-none focus:ring-0 focus:border-gray-400'])}}>
        @error($attributes['wire:model'])
        <div class="text-xs text-red-500">{{$message}}</div>
        @enderror
    </div>
@else
    <input
        type="{{$type}}" {{$attributes->merge(['class' => 'border border-gray-200 focus:outline-none focus:ring-0 focus:border-gray-400'])}}>
    @error($attributes['wire:model'])
    <div class="text-xs text-red-500">{{$message}}</div>
    @enderror
@endif
