
<div class="mt-3 flex-wrap" style="display:flex;">
    @foreach($multiImages ?? [] as $key => $image)
        @if(!$image)
            @php continue; @endphp
        @endif
        <div class="px-2">
            <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                 @if (!is_array($image)) src="{{ $image->getFullUrl() }}" @else src="{{asset($image['original_url'])}}" @endif>
            <button wire:click="removeFromMultiImage({{$key}} , {{$image['id']}})"
                    class="btn btn-success  mb-2 mt-5 " style="background-color: red; color: white">
                Remove Image
            </button>
        </div>

    @endforeach

{{--    @foreach($newMultiImages ?? [] as $key => $image)--}}
{{--        <div class="px-2">--}}
{{--            <img class="object-cover border-2 w-48 h-48 mt-2.5 "--}}
{{--                 @if ($image) src="{{ $image->temporaryUrl() }}" @endif>--}}
{{--            <button wire:click="removeFromNewMultiImage({{$key}})"--}}
{{--                    class="btn btn-success  mb-2 mt-5 " style="background-color: red; color: white">--}}
{{--                Remove Image--}}
{{--            </button>--}}
{{--        </div>--}}

{{--    @endforeach--}}

    <div style="width: 192px;height: 268px">
        <label>
            <div class="object-cover w-50 h-50 mt-2.5 text-center text-5xl text-secondary"
                 style="border-style: dotted; border-radius: 10px; border-width: thick;width: 100%;height: 71%;display: flex;justify-content: center;align-items: center;cursor: pointer;">
                +
            </div>
            <input name="newMultiImages" wire:model="newMultiImages" type="file" multiple
                   style="display: none">
        </label>
    </div>
</div>
