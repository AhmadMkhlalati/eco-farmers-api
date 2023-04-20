<div x-data="{isOpen : @entangle('showDropdown')}" @click="isOpen = !isOpen">
    <a href="{{$route ? route($route) : '#'}}"
       class="{{$route == request()->route()->getName() ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }}
       @if(Auth()->user()->hasRole('client'))
        {{'client_'.preg_replace("/[^a-zA-Z]+/", "", $title)}}
       @endif
       @if(Auth()->user()->hasRole('seller'))
       {{'seller_'.preg_replace("/[^a-zA-Z]+/", "", $title)}}
       @endif
           hover:text-gray-900 hover:bg-gray-50 group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md">
        <!-- Heroicon name: outline/view-list -->
        <div class="flex items-center">
            @if((Auth()->user()->is_branded) && (Auth()->user()->color !=''))
                <div class="group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                     style="color: {{Auth()->user()->color}}">
                    {!! $icon !!}
                </div>
            @else
                @if(str_contains(\Request::getHttpHost(), 'diggipacks'))
                    <div class=" text-red-500 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6">
                        {!! $icon !!}
                    </div>
                @else
                    <div class=" text-blue-500 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6">
                        {!! $icon !!}
                    </div>
                @endif
            @endif
            {{ __($title) }}
        </div>
        @if(!isset($route))
            <svg x-cloak x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300"
                 viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"/>
            </svg>
            @if(str_contains(\Request::getHttpHost(), 'diggipacks'))
                <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            @else
                @if((Auth()->user()->is_branded) && (Auth()->user()->color !=''))
                    <svg x-show="isOpen" style="color: {{Auth()->user()->color}}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                @else
                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                @endif
            @endif

        @endif
    </a>
    @if(count($items))
        <div class="bg-white rounded-lg p-2" x-show="isOpen" x-cloak>
            @foreach($items as $item)
                <a
                    class="{{$item['route'] == request()->route()->getName() ? 'bg-gray-200 text-gray-900' : 'text-gray-700' }} hover:text-gray-900 hover:bg-gray-50 group flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md"
                    href="{{isset($item['route']) ? route($item['route']) : '#'}}">{{ __($item['label']) }}</a>
            @endforeach
        </div>
    @endif
</div>
