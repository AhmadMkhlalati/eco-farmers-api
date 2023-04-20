@props(['title' => null,'perPageContainer' => null] )
<div class="w-full py-4 sm:flex sm:items-center sm:justify-between">
    <div class="flex items-center space-x-2">
        <h2 class="text-lg font-bold leading-6 text-gray-900 sm:truncate">{{$title}}</h2>
        <div>{{$perPageContainer}}</div>
    </div>
    {{$slot}}
</div>
