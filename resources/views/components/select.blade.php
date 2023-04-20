@props(['label' => false,'options' => null, 'key' => 'id','value' => 'name'])
@if(!is_array($options))
    @php $options = $options->toArray(); @endphp
@endif
@if($label)
    <div class="form-group">
        @if($label)
            <label for="{{$attributes['wire:model']}}">{{__(str_replace('_',' ',$attributes['wire:model']))}}</label>
        @endif
        <select {{$attributes->merge(['class' => 'form-control'])}}>
            @foreach($options as $option)
                <option value="{{$option[$key] }}">
                    @if(is_array($option[$value]))
                        {{$option[$value][app()->getLocale()]}}
                    @else
                        {{$option[$value]}}
                    @endif
                </option>
            @endforeach
        </select>
        @error($attributes['wire:model'])
        <div class="text text-danger small">{{$message}}</div> @enderror
    </div>
@else
    <select {{$attributes->merge(['class' => 'form-control'])}}>
        @foreach($options as $option)
            <option value="{{$option[$key] }}">{{$option[$value] }}</option>
        @endforeach
    </select>
@endif
