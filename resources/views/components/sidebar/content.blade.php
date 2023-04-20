<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    @foreach(config('sidebar-items.'.strtolower(auth()->user()->roles->first()->name)) as $item)
        @if(count($item['items']))
            <x-sidebar.dropdown title="{{$item['title']}}" >
                <x-slot name="icon">
                    {!! $item['icon']!!}
                </x-slot>
                @foreach($item['items'] as $subItem)
                    <x-sidebar.sublink title="{{ __($subItem['label']) }}" href="{{isset($subItem['route']) ? route($subItem['route']) : '#'}}"
                               class="{{$subItem['route'] == request()->route()->getName() ? 'bg-gray-200 text-gray-900' : 'text-gray-700' }}" />
                @endforeach
            </x-sidebar.dropdown>
        @else
            <x-sidebar.link title="{{$item['title']}}" href="{{ $item['route'] ? route($item['route'])  :'' }}"
                    class="{{$item['route'] == request()->route()->getName() ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
                <x-slot name="icon">
                    {!! $item['icon']!!}
                </x-slot>

            </x-sidebar.link>
        @endif
    @endforeach

    {{-- Examples --}}




</x-perfect-scrollbar>
