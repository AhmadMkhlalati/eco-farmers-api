@props(['title' => null, 'subtitle' => null, 'perPageContainer' => null] )
<div class="w-full border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between">
    <div class="flex-column">
        <h4 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">{{$title}}</h4>
        <div>
            <h6>{{$subtitle}}</h6>
        </div>

    </div>
    {{$slot}}
</div>
