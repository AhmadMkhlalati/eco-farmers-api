@props(['formAction' => false])

<div class="bg-gray-50 w-full shadow">
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}">
            @endif
            <div class="px-4 py-4 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-bold text-gray-900">
                        @if(isset($title))
                            <h3 {{$attributes->merge(['class' => 'capitalize text-lg leading-6 font-medium text-gray-900'])}}>
                                {{ $title }}
                            </h3>
                        @endif
                    </h3>
                    @if(isset($subtitle))
                        <p {{$attributes->merge(['class' => 'capitalize mt-0 max-w-2xl text-sm text-gray-500'])}}>{{ $subtitle }}</p>
                    @endif
                </div>
                <div>
                    <button wire:click="$emit('closeModal')" type="button"
                            class="flex items-center p-1 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-black border-2 border-gray-400 focus:outline-none">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-4">
                {{ $content }}
            </div>

            <div class="bg-gray-50 px-6 pb-5 pt-5 sm:px-4 sm:flex flex item-center justify-between">
                {{ $buttons }}
            </div>
            @if($formAction)
        </form>
    @endif
</div>
